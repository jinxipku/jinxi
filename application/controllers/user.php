<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'love_model' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
	}
	public function _remap($uid) {
		$user_id = $this->session->userdata ( 'login_user' );
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$cur_user = $this->user_model->get_user ( $uid );
		if(empty($cur_user)){
			show_404('page');
		}
		if($user_id != '' && $this->love_model->get_love($user_id,$uid)>0)
			$data ['haslove'] = 1;
		else 
			$data ['haslove'] = 0;
		$data ['cur_user'] = $cur_user;
		$data ['baseurl'] = base_url ();
		$data ['title'] = $cur_user ['user_name'];
		if($uid == $user_id)
			$data ['choose'] = 2;
		else {
			$this->user_model->visit ( $uid );
			$data ['choose'] = 0;
		}
		$this->load->view ( 'templates/header', $data );
		if ($cur_user ['right_on'])
			$this->load->view ( 'user/index1' );
		else
			$this->load->view ( 'user/index2' );
		$this->load->view ( 'templates/footer' );
	}
}