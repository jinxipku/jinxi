<?php
// +----------------------------------------------------------------------
// | Post 用户帖子相关
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-4-1
// +----------------------------------------------------------------------
class Post extends MY_Controller {

	protected $picture_path = 'img/picture/';
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'account_model' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'post_model' );
		$this->load->model ( 'favorites_model');
		$this->load->helper('url');
		$this->load->helper('array');
		$this->load->helper('directory');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------

	public function newpost() {
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) {
			$this->session->set_userdata('mem_url', base_url('post/newpost'));
			redirect('account/loginfo/redirect');
		}
		$this->assign('nav_tab', 0);
		$this->assign('login_user', $login_user);
		$this->assign('title', '今昔网-发帖');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());

		$this->display ( 'templates/header.php' );
		$this->display ( 'post/type.php' );
		$this->display ( 'post/category.php' );
		$this->display ( 'post/info.php' );
		$this->display ( 'post/price.php' );
		$this->display ( 'post/detail.php' );
		$this->display ( 'post/picture.php' );
		$this->display ( 'templates/footer.php' );
	}

	
	public function mobile_upload(){
		$key = $this->config->item('verify_pkey');
		$code = $_GET["code"];
		$decode = $this->encrypt->decode($code,$key);
		$exp = explode("_",$decode);
		if(count($exp)!=2){
			//display error page....提示参数错误
			echo '参数错误';
		}else{
			$user_id = $exp[0];
			$timespec = $exp[1];
			$this->assign("title","今昔网-拍照上传图片");
			$this->assign("timespec",$timespec);
			$this->assign("user_id",$user_id);
			$this->assign('baseurl', base_url());
			$this->display ( 'mobile/upload.php' );
		}
	
	}

// +----------------------------------------------------------------------
// | 普通函数
// +----------------------------------------------------------------------

	public function get_post($post_id, $type){
		return $this->post_model->get_post($post_id,$type);
	}




// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------
	
	//发贴接口
	//TODO: a lot
	public function make_post(){
		$now = time();
		$user =  $this->session->userdata('login_user');
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);

		$_POST['user_id'] = $user['id'];
		$_POST['updateat'] = $now;
		$_POST['createat'] = $now;

		if(isset($_POST['picture'])){
			$picture = $_POST['picture'];
			$picture = json_decode($picture);
			$picture= serialize($picture);     //序列化
			$_POST['picture'] = $picture;
		}
		

		$type = $_POST['type'];
		if(isset($_POST['type']))       //过滤掉POST中的无关项
			unset($_POST['type']);

		//删除掉手机相关图片
		if($type == 0){
			$res = $this->post_model->insert_post($_POST, "buy");
		}else if($type == 1){
			$res = $this->post_model->insert_post($_POST, "sell");
		}else $this->ajaxReturn(null,'参数错误',0);
		if($res)
			$this->ajaxReturn(null,'发表成功',1);
		else
			$this->ajaxReturn(null,'发表出现数据库错误',0);
	}

	public function update_post(){
		$user =  $this->session->userdata('login_user');
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);
		$_POST['updateat'] = time();

		$type = $_POST['type'];
		$post_id = $_POST['post_id'];
		if(!isset($_POST['post_id'])||!isset($_POST['type'])){
			$this->ajaxReturn(null,'参数错误',0);
		}
		unset($_POST['post_id']);
		unset($_POST['type']);

		$res = $this->post_model->update_post($_POST,$user['id'],$post_id,$type);
		if($res)
			$this->ajaxReturn(null,'更新成功',1);
		else
			$this->ajaxReturn(null,'更新失败',0);
	}

	//返回某用户发表的帖子（卖，买，买卖） 
	//param mode 0同时返回  1返回卖东西的帖子  2返回买东西的帖子
	//param user_id 不写则使用当前用户 写则使用提供的id
	public function getuserposts(){
		$mode = $_POST['mode'];
		$login_user =  $this->session->userdata('login_user');
		$user_id = isset($_POST['user_id'])? $_POST['user_id']: $login_user['id'];
		switch ($mode) {
			case '0':
				$data['buy'] = $this->post_model->get_buyer_post($user_id);
				$data['sell'] = $this->post_model->get_seller_post($user_id);
				break;
			case '1':
				$data['sell'] = $this->post_model->get_seller_post($user_id);
				break;
			case '2':
				$data['buy'] =$this->post_model->get_buyer_post($user_id);
			default:
				$this->ajaxReturn(null,'参数错误',0);
				break;
		}
		$this->ajaxReturn($data,'',1);
	}

	//返回收藏贴
	//post  type 0同时返回  1卖2买
	public function get_favorites(){
		$type = $_POST['type'];
		$login_user =  $this->session->userdata('login_user');
		$user_id = $login_user['id'];
		return $this->favorites_model->get_favorites($user_id,$user_id);
	}


	/*移动客户端上传流程
	1.PC调用getQRCode，返回的数据中包含二维码链接link以及一个时间戳t,二维码中信息包括t以及user_id
	2.客户端扫描二维码，访问Controller并且上传图片，上传携带参数t及user_id，上传到相应的用户目录
	3.PC端点击按钮进行同步，同步的依据为t和user_id
	*/

	//点击生成二维码的操作
	//生成二维码函数
	//参数$post_id
	//链接为http://今昔.cn//post//uploadpicture?code=XXXXX
	public function getQRCode(){
		$login_user =  $this->session->userdata('login_user');

		if(empty($login_user)){
			$this->ajaxReturn(null,"未登录或session过期",0);
		}
		$userid = $login_user['id'];

		$timespec = time();

		require_once APPPATH.'/libraries/phpqrcode/phpqrcode.php';

		$key = $this->config->item('verify_pkey');
		$code = $this->encrypt->encode( $userid.'_'.$timespec, $key);
		$value = base_url('post/mobile_upload?code=').urlencode($code);
		
		$errorCorrectionLevel = 'L';//容错级别 
		$matrixPointSize = 6;//生成图片大小 
		$qrfile = 'img/qrcode/'.$userid.'_'.$timespec.'.png';
		QRcode::png($value, $qrfile, $errorCorrectionLevel, $matrixPointSize, 2);

		//TODO:替换为ajax返回参数形式
		//同时需要返回一个时间戳
		$myfile = fopen($this->picture_path.$userid.'/'.$timespec."$.tmp", "w");
		$data['timespec'] = $timespec;
		$data['qrimg'] = $qrfile;        //qrfile形如   img/qrcode/.......
		$data['qrimg'] = base_url($data['qrimg']);
		$data['value'] = $value;
		$this->ajaxReturn($data, "", 1); 
	}

	//上传图片接口
	//表单名称为picture
	public function upload_picture(){
		$user = $this->session->userdata ( 'login_user' );
		if( isset( $_POST['from'] ) ){
			if( $_POST['from'] == "mobile"){
				$user_id = $_POST['user_id'];      //手机端user_id来自表单
			}
		}else{
			if( empty($user) ){
				$this->ajaxReturn(null,"未登录",0);
			}
			$user_id = $user['id'];
		}

		$field = 'picture';
		if(!file_exists($this->picture_path.$user_id)){  //生成用户专属图片目录
			mkdir($this->picture_path.$user_id);
		}
		$config ['upload_path'] = $this->picture_path.$user_id.'/';
		$config ['allowed_types'] = 'jpg|png';
		$config ['max_size'] = '2048';
		$config ['overwrite'] = true;

		if(isset($_POST['timespec'])){
			if(!file_exists($this->picture_path.$user_id."/".$_POST['timespec']."$.tmp")){
				$this->ajaxReturn(null,"帖子已关闭",0);
			}
			$config ['file_name'] = genFileName($user_id,'',$_POST['timespec']);
		}
		else $config ['file_name'] = genFileName($user_id,'');


		$this->load->library('upload',$config);

		if( !$this->upload->do_upload($field) ){
			$this->ajaxReturn(null, $this->upload->display_errors ( '', '' ),0);
		}else{			
			$res = $this->upload->data();
			$this->load->library ( 'image_lib');
			// $data['file_name'] = $res['file_name'];  //返回上传后的文件名
			// $data['image_width'] = $res['image_width'];
			//$data['image_height'] = $res['image_height'];
			$data['file_name'] = $this->picture_path.$user_id.'/'.$res['file_name'];

			$image_width = $res['image_width'];
			$image_height = $res['image_height'];
			if($res['image_width']>800){
				
				$source = $data['file_name'];  
				$config2 ['image_library'] = 'gd2';
				$config2 ['source_image'] = $source;
				$config2 ['new_image'] = $source;
				//$config2 ['maintain_ratio'] = TRUE; 
				$config2 ['width'] = 800;
				$config2 ['height'] = $image_height*800/$image_width;
				$this->image_lib->initialize($config2);
				$flag1 = $this->image_lib->resize ();  //resize结果
				if(!$flag1){
					$this->ajaxReturn(null,"因图片太宽导致裁剪错误");
				}
				
				$image_height = $image_height*800/$image_width;
				$image_width = 800;
			}

			//crop
			$source = $data['file_name'];  
			$thumb = $this->picture_path.$user_id.'/thumb_'.$res['file_name'];
			$config3 ['source_image'] = $source;
			$config3 ['new_image'] = $thumb;
			$config3 ['image_library'] = 'gd2';
			$config3 ['maintain_ratio'] = FALSE; 
			if($image_width>$image_height){	
				$config3 ['x_axis'] =  ($image_width-$image_height)/2;
				$config3 ['y_axis'] = 0;
				$config3 ['width'] =  $image_height;
				$config3 ['height'] = $image_height;
			}
			else if($image_width<=$image_height){
				$config3 ['x_axis'] =  0;
				$config3 ['y_axis'] = ($image_height-$image_width)/2;
				$config3 ['width'] =  $image_width;
				$config3 ['height'] = $image_width;
			}
			$this->image_lib->initialize($config3);
			$flag1 = $this->image_lib->crop ();  //resize结果
			if(!$flag1){
				$this->ajaxReturn(null,"crop错误",0);
			}


	
				$config4 ['image_library'] = 'gd2';
				$config4 ['source_image'] = $thumb;
				$config4 ['new_image'] = $thumb;
				//$config4 ['maintain_ratio'] = TRUE; // 保证设置的长宽有效
				$config4 ['width'] =  200;
				$config4 ['height'] = 200;
				$this->image_lib->initialize($config4);
				$flag1 = $this->image_lib->resize();  //resize结果
				if(!$flag1){
					$this->ajaxReturn(null,"resize错误",0);
				}
			
			$data['file_name_thumb'] = $thumb;
			$data['file_name'] = base_url($data['file_name']);
			$data['file_name_thumb'] = base_url($data['file_name_thumb']);

			$this->ajaxReturn($data,"上传成功",1);
		}
	}

	//PC端获取移动端上传的数据
	public function get_mobile_picture(){
		$user = $this->session->userdata ( 'login_user' );
		if(empty($user)) $this->ajaxReturn(null,"未登录",0);
		$user_id = $user['id'];
		$timespec = $_POST['timespec'];           //之前拿到的时间戳
		
		$files = directory_map($this->picture_path.$user_id.'/');
		$return = array();
		foreach ($files as $key => $filename) {
			if( strpos($filename, $timespec. ".") !=false && strpos($filename,"thumb_")===false ){
				$k = filemtime($this->picture_path.$user_id.'/'.$filename);
				$return[$k]['file_name'] = base_url($this->picture_path.$user_id.'/'.$filename);
				$return[$k]['file_name_thumb'] = base_url($this->picture_path.$user_id.'/thumb_'.$filename);
			}
		}
		ksort($return);
		if(count($return)==0){
			$this->ajaxReturn(null,"并没有数据",0);
		}
		$this->ajaxReturn($return,'',1);
	}

	public function delete_picture(){
		$user = $this->session->userdata ( 'login_user' );
		if(empty($user)) $this->ajaxReturn(null,"未登录",0);
		$userid = $user['id'];
		if(!isset($_POST['picture_url'])){
			$this->ajaxReturn(null,'参数错误',0);
		}

		if(isset($_POST['timespec'])){   //非正常退出时，删除手机上传的照片
			$timespec = $_POST['timespec'];
			if(file_exists($this->picture_path.$userid.'/'.$timespec."$.tmp")){
				unlink($this->picture_path.$userid.'/'.$timespec."$.tmp");
				$files = directory_map($this->picture_path.$userid.'/');
				foreach ($files as $key => $filename) {
						if( strpos($filename, $timespec. ".") !=false ){
							unlink($this->picture_path.$userid.'/'.$filename);
						}
				}
			}
		}
		if(!empty($_POST['picture_url'])){
			$array = explode(",",$_POST['picture_url']);
			foreach ($array as $key => $value) {
				unlink(substr($value, strpos($value,"img/")));
			}
		}
		
		
		$this->ajaxReturn(null,'',1);
	}


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

}