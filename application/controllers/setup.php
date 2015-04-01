<?php
class Setup extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}
	public function index() {
		$this->output->enable_profiler(TRUE);
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) {
			$this->session->set_userdata('mem_url', base_url('setup'));
			redirect('account/loginfo/redirect');
		}
		$this->assign('login_user', $login_user);
		$this->assign('title', '今昔网-设置');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		$this->assign('nav_tab', 6);
		$this->assign('set_tab', 1);
		$this->assign('this', $this);
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'setup/main.php' );
		$this->display ( 'setup/side.php' );
		$this->display ( 'templates/footer.php' );
	}
}