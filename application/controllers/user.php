<?php
// +----------------------------------------------------------------------
// | User 用户Profile操作
// +----------------------------------------------------------------------
// | Author: cuida
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class User extends MY_Controller {
	protected $head_dir = './img/head/';
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->library('session');
		$this->load->helper('url');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------



// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------


	//用户更新
	//post参数  参考sql建表中的参数
	public function update_info(){
		$user = $this->session->userdata ( 'login_user' );
		$this->user_model->update_info($user['id'],$_POST);
	}
	
	//用户上传头像接口
	//post参数 无  
	//前端表单name为head_image
	public function upload_photo() { // ajax上传图片
		$user = $this->session->userdata ( 'login_user' );
		$user_id = !empty($user) ? $user['id'] : 0; 
		$field = 'head_image';
		$config ['upload_path'] = $this->head_dir;
		$config ['allowed_types'] = 'jpg|png|gif';
		$config ['max_size'] = '2048';
		$config ['overwrite'] = true;
		$config ['file_name'] = genFileName($user_id,'');

		$this->load->library('upload',$config);

		if( !$this->upload->do_upload($field) ){
			$this->ajaxReturn(null,"上传失败:".$this->upload->display_errors ( '', '' ),0);//可以删掉$this->upload->display_errors ( '', '' )
		}else{			
			$res = $this->upload->data();
			$data['file_name'] = $res['file_name'];  //返回上传后的文件名
			$data['image_width'] = $res['image_width'];
			$this->ajaxReturn($data,"上传成功",1);
		}
	} 
	//用户裁剪头像,前端需要限制裁剪框大小为100*100
	//post 参数 file_name
	//TODO:删除原图
	public function crop_photo(){
		$user = $this->session->userdata ( 'login_user' );
		$user_id = isset($user)? $user['id'] : 0; 
		$source_image = $this->head_dir . $_POST['file_name'];
		$ext = getFileExt($source_image);
		$config ['image_library'] = 'gd2';
		$config ['source_image'] = $source_image;
		$new_image = $this->head_dir . genFileName($user_id,$ext);
		$config ['new_image'] = $new_image;
		$config ['maintain_ratio'] = FALSE; // 保证设置的长宽有效
		$config ['x_axis'] = $_POST ['p_x'] * $_POST ['p_k']; // 一定要乘以p_k，因为这里存放的
		$config ['y_axis'] = $_POST ['p_y'] * $_POST ['p_k']; // 是原图而不是浏览器上经过缩放的
		$config ['width'] = $_POST ['p_w'] * $_POST ['p_k']; // 的图
		$config ['height'] = $_POST ['p_h'] * $_POST ['p_k'];
		$this->load->library ( 'image_lib', $config );
		if (! $this->image_lib->crop ()) {
			$this->ajaxReturn(null,"裁剪失败".$this->image_lib->display_errors (),0);
		} else {
			//分别生成一张100*100的图和一张60*60的图
			$config2 ['image_library'] = 'gd2';
			$config2 ['source_image'] = $new_image;

			$h_image = genFileName($user_id,$ext);
			$head_image = $this->head_dir.$h_image;
			
			$config2 ['new_image'] = $head_image;
			$config2 ['maintain_ratio'] = FALSE; 
			$config2 ['width'] = 300;
			$config2 ['height'] = 300;
			$this->image_lib->initialize($config2);
			$this->image_lib->resize ();
			
			$config3 ['image_library'] = 'gd2';
			$config3 ['source_image'] = $new_image;

			$t_image = genFileName($user_id,$ext);
			$head_image_thumb = $this->head_dir . $t_image;
			$config3 ['new_image'] = $head_image_thumb;
			$config3 ['maintain_ratio'] = FALSE; 
			$config3 ['width'] = 60;
			$config3 ['height'] = 60;
			$this->image_lib->initialize($config3);
			$this->image_lib->resize ();
			
	
			$info['head'] = $h_image;
			$info['thumb'] = $t_image;
			$this->user_model->update_info($user_id,$info);

			unlink($source_image);
			unlink($new_image);
			$this->ajaxReturn('',"裁剪成功",1);
		}
	}



// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

}