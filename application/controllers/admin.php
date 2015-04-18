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
		if($res){
			$this->session->set_userdata('admin','admin');
			redirect('admin/index');
		}else echo '密码错误';
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------

	public function get_report_info(){
		$page = $_POST['page'];
		$res = $this->admin_model->get_report_info();
		//var_dump($res);
		$this->ajaxReturn($res,'',1);
	}


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------
	
	
}