<?php
class Display extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}
	public function hall() {
		$user_id =  $this->session->userdata('login_user');
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$this->assign('nav_tab', 3);
		$this->assign('title', '今昔网-商品大厅');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		//$this->load->view ( 'display/hall' );
		//$this->load->view ( 'index/right' );
		$this->display ( 'templates/footer.php' );
	}
	public function textbook(){
		
	}
}