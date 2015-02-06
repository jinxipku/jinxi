<?php
class Setup extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function index() {
		$this->output->enable_profiler(TRUE);
		$user_id =  $this->session->userdata('login_user');	
		if($user_id == '')
			header("Location: ".base_url("account/loginfo"));
		$login_user = $this->user_model->get_user($user_id);
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
		$user_id =  $this->session->userdata('login_user');		
		if($user_id == '')
			header("Location: ".base_url("account/loginfo"));
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
		$user_id =  $this->session->userdata('login_user');		
		if($user_id == '')
			header("Location: ".base_url("account/loginfo"));
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
		$user_id =  $this->session->userdata('login_user');		
		if($user_id == '')
			header("Location: ".base_url("account/loginfo"));
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
		$user_id =  $this->session->userdata('login_user');
		if($user_id == '')
			header("Location: ".base_url("account/loginfo"));
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