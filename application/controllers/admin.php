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


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------
	
	
}