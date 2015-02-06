<?php
class Display extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function hall() {
		$this->output->enable_profiler(TRUE);
		$user_id =  $this->session->userdata('login_user');
		
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$data ['choose'] = 1;
		$data ['baseurl'] = base_url();
		$data ['title'] = '商品大厅';
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'display/hall' );
		$this->load->view ( 'index/right' );
		$this->load->view ( 'templates/footer' );
	}
	public function textbook(){
		
	}
}