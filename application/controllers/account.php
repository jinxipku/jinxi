<?php
class Account extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function regidit() {
		$user_id =  $this->session->userdata('login_user');
		
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$data ['choose'] = 0;
		$data ['baseurl'] = base_url();
		$data ['title'] = '注册';
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'account/regidit' );
		$this->load->view ( 'templates/footer' );
	}
	public function login() {
		$this->output->enable_profiler(TRUE);
		$user_id =  $this->session->userdata('login_user');
		
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$memurl = $this->session->userdata ( 'mem_url' );
		if($memurl == '')
			$data ['memurl'] = base_url();
		else 
			$data ['memurl'] = $memurl;
		$data ['choose'] = 0;
		$data ['baseurl'] = base_url();
		$data ['title'] = '登录';
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'account/login' );
		$this->load->view ( 'templates/footer' );
	}
	public function verify() {
		$this->load->library('encrypt');
		$mail = $this->encrypt->decode(str_replace(' ','+',$_GET['mail']));
		$code = $this->encrypt->decode(str_replace(' ','+',$_GET['code']));
		$veres = $this->user_model->verify($mail,$code);
		if($veres == 0){
			header("Location: http://xn--wmqr18c.cn/account/reginfo/fail");
			return;
		}
		$fres = $this->user_model->get_user2($mail);
		$user_id =  $fres['user_id'];
		$pw =  $fres['password'];		
		if($user_id == ''||$pw == ''){
			header("Location: http://xn--wmqr18c.cn/account/reginfo/fail");
			return;
		}
		$logresult = $this->user_model->login ( $mail, $pw );
		if ($logresult == 1) {
			$this->session->set_userdata ( 'login_user', $user_id );
			header("Location: http://xn--wmqr18c.cn/account/reginfo/success");
		}
		else 
			header("Location: http://xn--wmqr18c.cn/account/reginfo/fail");
	}
	public function reginfo($status,$mail = 'none'){
		$user_id =  $this->session->userdata('login_user');
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$data ['choose'] = 0;
		$data ['baseurl'] = base_url();
		$data ['title'] = '注册提示';
		$data ['mail'] = $mail;
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'account/reg'.$status );
		$this->load->view ( 'templates/footer' );
	}
	public function loginfo(){
		$user_id =  $this->session->userdata('login_user');
		if($user_id != ''){
			$login_user = $this->user_model->get_user($user_id);
			$data ['login_user'] = $login_user;
		}
		$data ['choose'] = 0;
		$data ['baseurl'] = base_url();
		$data ['title'] = '登录提示';
		if(!isset($_SERVER["HTTP_REFERER"])||strpos($_SERVER["HTTP_REFERER"],'account/loginfo'))
			$this->session->set_userdata ( 'mem_url', base_url());
		else
			$this->session->set_userdata ( 'mem_url', $_SERVER["HTTP_REFERER"]);
	
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'account/loginfo' );
		$this->load->view ( 'templates/footer' );
	}
}