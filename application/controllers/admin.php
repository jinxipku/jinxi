<?php
// +----------------------------------------------------------------------
// | Admin 管理员后台
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class Admin extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'account_model' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'post_model');
		$this->load->model ( 'admin_model');
		$this->load->helper('url');
		$this->load->helper('array');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------

	public function index(){
		$admin =  $this->session->userdata('admin');
		$this->assign('title', '今昔网-后台');
		$this->assign('baseurl', base_url());
		$this->assign('admin',$admin);
		if(empty($admin)){
			$this->display("admin/login.php");
		}else{
			$user_info = $this->admin_model->get_user_info();
			$this->assign("user_info",$user_info);
			$post_info = $this->admin_model->get_post_info();
			$this->assign("post_info",$post_info);
			$this->display("admin/index.php");
		}
		
	}

	public function dologin(){
		$admin_name = $_POST['admin_name'];
		$password = $_POST['password'];

		$res = $this->admin_model->login($admin_name,$password);
		if($res!=false){
			$this->session->set_userdata('admin',$res);
			redirect('admin/index');
		}else echo '密码错误';
	}

	public function dologout(){
		$this->session->unset_userdata ( 'admin' );
		$this->ajaxReturn(null,"",1);
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------

	public function get_report_info(){

		$admin =  $this->session->userdata('admin');
		if(empty($admin)){
			$this->ajaxReturn(null,"未登录",0);
		}
		if($admin['auth_level']>1){
			$res = $this->admin_model->get_report_info($admin['school_id']);
		}
		else $res = $this->admin_model->get_report_info();
		//var_dump($res);
		//$page = $_POST['page'];
		$this->ajaxReturn($res,'',1);
	}

	public function appoint(){
		$admin =  $this->session->userdata('admin');
		if(empty($admin)){
			$this->ajaxReturn(null,"未登录",0);
		}
		if($admin['auth_level']!=1){
			$this->ajaxReturn(null,"权限不够",1);
		}
		$res = $this->admin_model->appoint($_POST);
		$result = $res?1:0;
		$this->ajaxReturn($res,'',$res);
	}


	//TODO：判断权限
	public function delete_post(){
		$admin =  $this->session->userdata('admin');
		if(empty($admin)){
			$this->ajaxReturn(null,"未登录",0);
		}
		//暂时权限托管给超管
		if($admin['auth_level']!=1){
			$this->ajaxReturn(null,"权限不够",1);
		}
		$url = $_POST['post_url'];
		$url_array = explode("/",$url);
		$flag = true;
		$post_id = null;
		$post_type = null;
		foreach ($url_array as $key => $value) {
			if(!$flag){
				$post_id = $value;
			}
			if($value=='buy'||$value=='sell'){
				$flag = false;
				$post_type = ($value=='buy')?1:0;
			}
		}
		$reason = $_POST['reason'];
		//$reason = "";
		if(empty($reason)) $this->ajaxReturn(null,'请填写删除理由',0);
		//echo $post_id.$post_type;
		$res = $this->admin_model->delete_post($post_id,$post_type,$reason);
		if($res)
			$this->ajaxReturn(null,"删除成功",1);
		else $this->ajaxReturn(null,"删除失败",0);
	}

		//TODO：判断权限
	public function delete_reply(){
		$admin =  $this->session->userdata('admin');
		if(empty($admin)){
			$this->ajaxReturn(null,"未登录",0);
		}
		//暂时权限托管给超管
		if($admin['auth_level']!=1){
			$this->ajaxReturn(null,"权限不够",1);
		}
		$url = $_POST['post_url'];
		$url_array = explode("/",$url);
		$flag = true;
		$post_id = null;
		$post_type = null;
		foreach ($url_array as $key => $value) {
			if(!$flag){
				$post_id = $value;
			}
			if($value=='buy'||$value=='sell'){
				$flag = false;
				$post_type = ($value=='buy')?1:0;
			}
		}
		$reason = $_POST['reason'];
		$floor = $_POST['floor'];
		//$reason = "";
		if(empty($reason)) $this->ajaxReturn(null,'请填写删除理由',0);
		//echo $post_id.$post_type;
		$res = $this->admin_model->delete_reply($post_id,$post_type,$floor,$reason);
		if($res)
			$this->ajaxReturn(null,"删除成功",1);
		else $this->ajaxReturn(null,"删除失败",0);
	}

	public function get_advice(){
		$admin =  $this->session->userdata('admin');
		if(empty($admin)){
			$this->ajaxReturn(null,"未登录",0);
		}
		$this->load->model("advice_model");
		$res = $this->advice_model->get_advice(1);
		$this->ajaxReturn($res,'',1);	
	}


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------
	
	
}