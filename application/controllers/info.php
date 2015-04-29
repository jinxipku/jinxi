<?php
// +----------------------------------------------------------------------
// | Info 信息
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-4-1
// +----------------------------------------------------------------------
class Info extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'reminder_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------
	public function reminder() {
		$login_user =  $this->session->userdata('login_user');
		if (empty($login_user)) {
			return null;
		}
		$data = $this->reminder_model->get_user_reminder($login_user['id']);
		$cnt = count($data);
		$this->assign('cnt', $cnt);
		$this->assign('data', $data);
		$this->assign('baseurl', base_url());
		$this->display ( 'info/reminder.php' );
	}

	public function nopage() {
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}
		$this->assign('nav_tab', 0);
		$this->assign('title', '今昔网-错误');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'info/show404.php' );
		$this->display ( 'templates/smallside.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function about(){
		$this->assign('nav_tab', 0);
		$this->assign('title', '今昔网-关于');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		$this->assign("about_us",about_us());
		$this->display ( 'templates/header.php' );
		$this->display ( 'info/about.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}

}