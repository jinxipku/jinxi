<?php
class Setup extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
	}
	public function index() {
		$this->output->enable_profiler(TRUE);
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) {
			$this->session->set_userdata('mem_url', base_url('setup'));
			redirect('account/loginfo');
		}
		$data ['login_user'] = $login_user;
		$data ['baseurl'] = base_url();
		$data ['title'] = '设置';
		$data ['choose'] = 7;
		$data ['tab'] = 1;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'setup/index' );
		$this->load->view ( 'templates/footer' );
	}
	public function headimg() {
		$this->output->enable_profiler(TRUE);
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user))
			redirect('account/login');
		$login_user = $this->user_model->get_user($user_id);
		$data ['login_user'] = $login_user;
		$data ['baseurl'] = base_url();
		$data ['title'] = '设置';
		$data ['choose'] = 7;
		$data ['tab'] = 2;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'setup/index' );
		$this->load->view ( 'templates/footer' );
	}
	public function account() {	
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user))
			redirect('account/login');
		$login_user = $this->user_model->get_user($user_id);
		$data ['login_user'] = $login_user;
		$data ['baseurl'] = base_url();
		$data ['title'] = '设置';
		$data ['choose'] = 7;
		$data ['tab'] = 3;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'setup/index' );
		$this->load->view ( 'templates/footer' );
	}
	public function tiebbs() {
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user))
			redirect('account/login');
		$login_user = $this->user_model->get_user($user_id);
		$data ['login_user'] = $login_user;
		$data ['baseurl'] = base_url();
		$data ['title'] = '设置';
		$data ['choose'] = 7;
		$data ['tab'] = 4;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'setup/index' );
		$this->load->view ( 'templates/footer' );
	}
	public function star() {
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user))
			redirect('account/login');
		$login_user = $this->user_model->get_user($user_id);
		$data ['login_user'] = $login_user;
		$data ['baseurl'] = base_url();
		$data ['title'] = '设置';
		$data ['choose'] = 7;
		$data ['tab'] = 5;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'setup/index' );
		$this->load->view ( 'templates/footer' );
	}
}