<?php
class Index extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}
	public function index() {
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}
		$this->assign('nav_tab', 1);
		$this->assign('title', '今昔网-主页');
		$this->assign('baseurl', base_url());
		$this->assign('is_index', true);
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'index/main.php' );
		$this->display ( 'index/side.php' );
		$this->display ( 'templates/footer.php' );
	}
}