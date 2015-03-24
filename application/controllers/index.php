<?php
class Index extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}
	public function index() {
		$this->output->enable_profiler(FALSE);
		$user_id =  $this->session->userdata('login_user');
		
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$this->assign('nav_tab', 1);
		$this->assign('title', '今昔网-主页');
		$this->assign('baseurl', base_url());
		$this->assign('uri_string', $this->uri->uri_string());
		$this->assign('tips',show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'index/main.php' );
		$this->display ( 'index/side.php' );
		$this->display ( 'templates/footer.php' );

	}
}