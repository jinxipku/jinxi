<?php
// +----------------------------------------------------------------------
// | User 用户Profile操作
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class User extends MY_Controller {
	protected $head_dir = './img/head/';
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'love_model' );
		$this->load->model ( 'account_model' );
		$this->load->model ( 'post_model' );
		$this->load->model ( 'message_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------
	public function profile($id = 0, $tab = 'mine') {
		if ($id == 0) {
			$login_user =  $this->session->userdata('login_user');
			if (!empty($login_user)) {
				redirect('user/profile/' . $login_user['id']);
			}
			else {
				$this->session->set_userdata('mem_url', base_url('user/profile/0'));
				redirect('account/loginfo/redirect');
			}
		}
		if ($tab != 'mine' && $tab != 'message' && $tab != 'best') {
			redirect('user/profile/' . $id);
		}
		$user = $this->user_model->get_info($id);
		if ($user == null) {
			redirect('info/nopage');
		}
		$this->assign('nav_tab', 0);
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
			if ($login_user['id'] == $id) {
				$this->assign('myself', true);
				$this->assign('nav_tab', 2);
			}
			else{
				$this->user_model->visit($login_user['id'],$id);
				if ($this->love_model->get_love($login_user['id'], $id) > 0) {
					$this->assign('has_love', true);
				}
			}
		} else if($tab == 'message' || $tab == 'best') {
			redirect('user/profile/' . $id);
		}
		$this->assign('user_tab', $tab);

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

		$this->assign('user', $user);
		$this->assign('title', '今昔网-'.$user['nick']);
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'user/main.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function show_user_page() {
		$tab = $_POST ['tab_id'];
		$page = $_POST ['page'];
		$id = $_POST ['user_id'];
		$this->assign('baseurl', base_url());
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}
		$this->assign('user_id', $id);

		if ($tab == '#user_post')
			$data = $this->post_model->get_user_posts($id, $login_user['id'], $page);
		else if ($tab == '#user_best')
			$data = $this->post_model->get_user_recommend($login_user['id'], $page);

		else if ($tab == '#user_coll')
			$data = $this->post_model->get_user_favorites($id, $page);
		else if ($tab == '#user_love')
			$data = $this->user_model->get_user_loves($id, $page);
		else {
			$data = $this->message_model->get_user_messages($id, $page);
		}

		$this->assign('total', $data['total']);
		$this->assign('page_num', $data['page_num']);
		$this->assign('cur_page', $data['cur_page']);
		$this->assign('post_num', $data['post_num']);
		$this->assign('posts', $data['posts']);

		if ($data['page_num'] > 0) {
			$this->assign('st_page', floor(($data['cur_page'] - 1) / 10) * 10 + 1);
			$end_page = floor(($data['cur_page'] - 1) / 10 + 1) * 10;
			if ($end_page > $data['page_num'])
				$end_page = $data['page_num'];
			$this->assign('ed_page', $end_page);
		}

		if ($tab == '#user_love')
			$this->display ( 'user/userlove.php' );
		else if ($tab == '#user_mess')
			$this->display ( 'user/usermess.php' );
		else
			$this->display ( 'user/userpost.php' );
	}

	public function setup($set_tabs = 1) {
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) {
			$this->session->set_userdata('mem_url', base_url('user/setup'));
			redirect('account/loginfo/redirect');
		}
		$this->assign('login_user', $login_user);
		$this->assign('title', '今昔网-设置');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		$this->assign('nav_tab', 6);
		if ($set_tabs != 1 && $set_tabs != 2 && $set_tabs != 3 && $set_tabs != 4)
			$set_tabs = 1;
		$this->assign('set_tab', $set_tabs);
		$this->assign('this', $this);

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'setup/main.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}
// +----------------------------------------------------------------------
// | 普通函数
// +----------------------------------------------------------------------

	//获取用户发的帖子，不分买和卖
	public function get_user_post($user_id){

	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------


	//用户更新
	//post参数  参考sql建表中的参数
	public function save_info(){
		
		$user = $this->session->userdata ( 'login_user' );

		//是否修改密码
		
		if(isset($_POST['pwo'])){
			$pwo = $_POST['pwo'];
			if(!empty($pwo)){
				$account = $this->account_model->get_account($user['id'],null);
				$rpwd = $this->encrypt->decode($account['password']);
				if($pwo != $rpwd){
					$this->ajaxReturn(null,'密码错误',0);
				}else{
					$pwn = $_POST['pwn'];
					$pwa = $_POST['pwa'];
					if(strlen($pwn)<6) $this->ajaxReturn(null,'新密码长度过短',0);
					if($pwn != $pwa) $this->ajaxReturn(null,'两次输入的密码不一致',0);
					else{
						$res = $this->account_model->changepwd($user['id'],$pwa);
						if(!$res){
							$this->ajaxReturn(null,'修改密码出现错误',0);
						}

					}
				}
			}
			unset($_POST['pwo']);
			unset($_POST['pwn']);
			unset($_POST['pwa']);
		}

		// if(isset($_POST['nick_color'])&&$_POST['nick_color']!=0){
		// 	if($user['level'] < 15){
		// 		$this->ajaxReturn(null,"未达到等级",0);
		// 	}
		// }
		
		//$_POST['signature'] = parse_tag($_POST['signature']);

		$res = $this->user_model->update_info($user['id'],$_POST);
		if(empty($res)){
			$this->ajaxReturn(null,'',0);
		}else{
			$this->session->set_userdata('login_user',$this->user_model->get_info($user['id']));
			$this->ajaxReturn(null,'',1);
		}
	}
	
	//用户上传头像接口
	//post参数 无  
	//前端表单name为head_image
	public function upload_photo() { // ajax上传图片
		$user = $this->session->userdata ( 'login_user' );
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);
		$user_id = !empty($user) ? $user['id'] : 0; 
		$field = 'head_image';
		$config ['upload_path'] = $this->head_dir;
		$config ['allowed_types'] = 'jpg|png|gif';
		$config ['max_size'] = '2048';
		$config ['overwrite'] = true;
		$config ['file_name'] = genFileName($user_id,'');

		$this->load->library('upload',$config);

		if( !$this->upload->do_upload($field) ){
			$this->ajaxReturn(null, $this->upload->display_errors ( '', '' ),0);//可以删掉$this->upload->display_errors ( '', '' )
		}else{			
			$res = $this->upload->data();
			$data['file_name'] = $res['file_name'];  //返回上传后的文件名
			$data['image_width'] = $res['image_width'];
			$data['image_height'] = $res['image_height'];
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
			//分别生成一张200*200的图和一张60*60的图

			//TODO:判断结果
			$config2 ['image_library'] = 'gd2';
			$config2 ['source_image'] = $new_image;

			$h_image = genFileName($user_id,$ext);
			$head_image = $this->head_dir.$h_image;
			
			$config2 ['new_image'] = $head_image;
			$config2 ['maintain_ratio'] = FALSE; 
			$config2 ['width'] = 200;
			$config2 ['height'] = 200;
			$this->image_lib->initialize($config2);
			$flag1 = $this->image_lib->resize ();  //resize结果
			
			$config3 ['image_library'] = 'gd2';
			$config3 ['source_image'] = $new_image;

			$t_image = genFileName($user_id,$ext);
			$head_image_thumb = $this->head_dir . $t_image;
			$config3 ['new_image'] = $head_image_thumb;
			$config3 ['maintain_ratio'] = FALSE; 
			$config3 ['width'] = 60;
			$config3 ['height'] = 60;
			$this->image_lib->initialize($config3);
			$flag2 = $this->image_lib->resize ();  //resize结果

			unlink ( $source_image );
			unlink ( $new_image );

			if(!$flag1||!$flag2){
				$this->ajaxReturn('',"裁剪失败",0);
			}else{
				$info['head'] = $h_image;
				$info['thumb'] = $t_image;
				$this->user_model->update_info($user_id,$info);

				if($user['head'] != $this->config->item('default_head')){
					if(file_exists($this->head_dir . $user['head'])) unlink($this->head_dir . $user['head']);
				}
				if($user['thumb'] != $this->config->item('default_thumb')){
					if(file_exists($this->head_dir . $user['thumb'])) unlink($this->head_dir . $user['thumb']);
				}
				$user['head'] = $h_image;
				$user['thumb'] = $t_image;
				$this->session->set_userdata("login_user",$user);
				$this->ajaxReturn('',"裁剪成功",1);
			}
		}
	}

	public function delete_file($url) {
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) {
			$this->ajaxReturn(null,"删除失败",0);
		}
		unlink ( $this->head_dir . $url );
		$this->ajaxReturn(null,"删除成功",1);
	}

	public function add_love(){
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) $this->ajaxReturn(null,"未登录",0);
		$lover = $login_user['id'];
		$lovee = $_POST['lovee'];
		$res = $this->love_model->add_love($lover,$lovee);
		if($res)
			$this->ajaxReturn(null,"",1);
		else $this->ajaxReturn(null,"",0);
	}

	public function delete_love(){
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) $this->ajaxReturn(null,"未登录",0);
		$lover = $login_user['id'];
		$lovee = $_POST['lovee'];
		$res = $this->love_model->delete_love($lover,$lovee);
		if($res)
			$this->ajaxReturn(null,"",1);
		else $this->ajaxReturn(null,"",0);
	}





// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

}