<?php
// +----------------------------------------------------------------------
// | Account 用户账户操作（注册、登录）
// +----------------------------------------------------------------------
// | Author: cuida
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class Account extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	// public function regidit() {
	// 	$user_id =  $this->session->userdata('login_user');
	
	// 	if($user_id != ''){
	// 		$login_user = $this->user_model->get_user($user_id);
	// 		$data ['login_user'] = $login_user;
	// 	}
	// 	$data ['choose'] = 0;
	// 	$data ['baseurl'] = base_url();
	// 	$data ['title'] = '注册';
	
	// 	$this->load->view ( 'templates/header', $data );
	// 	$this->load->view ( 'account/regidit' );
	// 	$this->load->view ( 'templates/footer' );
	// }
	// public function login() {
	// 	$this->output->enable_profiler(TRUE);
	// 	$user_id =  $this->session->userdata('login_user');
	
	// 	if($user_id != ''){
	// 		$login_user = $this->user_model->get_user($user_id);
	// 		$data ['login_user'] = $login_user;
	// 	}
	// 	$memurl = $this->session->userdata ( 'mem_url' );
	// 	if($memurl == '')
	// 		$data ['memurl'] = base_url();
	// 	else 
	// 		$data ['memurl'] = $memurl;
	// 	$data ['choose'] = 0;
	// 	$data ['baseurl'] = base_url();
	// 	$data ['title'] = '登录';
	
	// 	$this->load->view ( 'templates/header', $data );
	// 	$this->load->view ( 'account/login' );
	// 	$this->load->view ( 'templates/footer' );
	// }
	// public function verify() {
	// 	$this->load->library('encrypt');
	// 	$mail = $this->encrypt->decode(str_replace(' ','+',$_GET['mail']));
	// 	$code = $this->encrypt->decode(str_replace(' ','+',$_GET['code']));
	// 	$veres = $this->user_model->verify($mail,$code);
	// 	if($veres == 0){
	// 		header("Location: http://xn--wmqr18c.cn/account/reginfo/fail");
	// 		return;
	// 	}
	// 	$fres = $this->user_model->get_user2($mail);
	// 	$user_id =  $fres['user_id'];
	// 	$pw =  $fres['password'];		
	// 	if($user_id == ''||$pw == ''){
	// 		header("Location: http://xn--wmqr18c.cn/account/reginfo/fail");
	// 		return;
	// 	}
	// 	$logresult = $this->user_model->login ( $mail, $pw );
	// 	if ($logresult == 1) {
	// 		$this->session->set_userdata ( 'login_user', $user_id );
	// 		header("Location: http://xn--wmqr18c.cn/account/reginfo/success");
	// 	}
	// 	else 
	// 		header("Location: http://xn--wmqr18c.cn/account/reginfo/fail");
	// }
	// public function reginfo($status,$mail = 'none'){
	// 	$user_id =  $this->session->userdata('login_user');
	// 	if($user_id != ''){
	// 		$login_user = $this->user_model->get_user($user_id);
	// 		$data ['login_user'] = $login_user;
	// 	}
	// 	$data ['choose'] = 0;
	// 	$data ['baseurl'] = base_url();
	// 	$data ['title'] = '注册提示';
	// 	$data ['mail'] = $mail;
	
	// 	$this->load->view ( 'templates/header', $data );
	// 	$this->load->view ( 'account/reg'.$status );
	// 	$this->load->view ( 'templates/footer' );
	// }
	// public function loginfo(){
	// 	$user_id =  $this->session->userdata('login_user');
	// 	if($user_id != ''){
	// 		$login_user = $this->user_model->get_user($user_id);
	// 		$data ['login_user'] = $login_user;
	// 	}
	// 	$data ['choose'] = 0;
	// 	$data ['baseurl'] = base_url();
	// 	$data ['title'] = '登录提示';
	// 	if(!isset($_SERVER["HTTP_REFERER"])||strpos($_SERVER["HTTP_REFERER"],'account/loginfo'))
	// 		$this->session->set_userdata ( 'mem_url', base_url());
	// 	else
	// 		$this->session->set_userdata ( 'mem_url', $_SERVER["HTTP_REFERER"]);
	
	// 	$this->load->view ( 'templates/header', $data );
	// 	$this->load->view ( 'account/loginfo' );
	// 	$this->load->view ( 'templates/footer' );
	// }

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------

	//用户注册
	//post参数  user_name  mail1  mail2  pw
	//返回 status  0：注册失败   1：注册成功
	public function doregister(){

		$uname = $_POST ['user_name'];
		$mail1 = $_POST ['mail1'];
		$mail2 = $_POST ['mail2'];
		$email = $mail1 .'@'. $mail2;
		$pw = $_POST ['pw'];

		if (strlen ( $mail1 ) == 0 || strlen ( $mail2 ) == 0 || strlen ( $uname ) == 0 || strlen ( $pw ) < 6)
			$this->ajaxReturn( null , '注册信息不全' , 0 );

		$regres = $this->user_model->regidit( $email, $uname, $pw );
		$regres = !empty($regres)? 1:0;
		if($regres == 1){
			$user = $this->user_model->get_user2( $email );
			$this->session->set_userdata( 'login_user' , $user['id'] );
			$this->_sendVerifyEmail( $email );//发送验证邮件
			$this->ajaxReturn( null , '注册成功' , 1 );
		}else
		$this->ajaxReturn( null , '账号已被注册' , 0 );
	}

	//用户登录
	//post参数 mail pw
	public function dologin(){
		$email = $_POST ['mail'];
		$pw = $_POST ['pw'];


		if(strlen( $pw ) == 0 || strlen( $email ) == 0){
			$this->ajaxReturn(null,'登录信息不全',0);
		}

		$logres = $this->user_model->login( $email, $pw );
		if ($logres == 1) {
			$user = $this->user_model->get_user2 ( $email );
			$this->session->set_userdata ( 'login_user', $user ['id'] );
			$this->ajaxReturn(null,"登录成功",1);
		}else{
			$this->ajaxReturn(null,"登录失败",1);
		}
		

	}


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

	private function _sendVerifyEmail($mail){
		$this->load->library ( 'email' );
		// 设置Email参数
		$config ['protocol'] = 'smtp';
		$config ['smtp_host'] = 'smtp.163.com';
		$config ['smtp_user'] = 'jinxicn2013';
		$config ['smtp_pass'] = 'jinxicn';
		$config ['smtp_port'] = '25';
		$config ['charset'] = 'utf-8';
		$config ['wordwrap'] = TRUE;
		$config ['mailtype'] = 'html';
		$this->email->initialize ( $config );
		// 发送
		$content = '
		<style type="text/css">
		a.footer{
			color: #FFFFFF;
		}
		a.footer:hover {
			color: #CCCCCC;
		}
		p.footer{
			color: #FFFFFF;
			font-size: 14px;
			font-family: 微软雅黑,黑体,幼圆,宋体;
			margin-top: 5px;
		}

		</style>
		<div style="width: 450px; margin-top: 15px; margin-left: auto; margin-right: auto;"><img 

		style="width: 100%;" src="http://xn--wmqr18c.cn/img/icon/invite.png" /></div>
		<p style="font-size: 22px; font-family: 微软雅黑,黑体,宋体">&nbsp;&nbsp;&nbsp;&nbsp;尊敬的用户<span style="color: #1ABC9C"> ' . $uname . ' </span>您好，欢迎加入今昔网，您的账号已经注册完毕，请点击以下链接完成验证：<a href="http://xn--wmqr18c.cn/account/verify?mail=' . $encrypted_string_mail . '&code=' . $encrypted_string_code . '">立即激活</a></p>
		<div class="row"
		style="height: 35px; background-color: #1ABC9C; text-align: center; margin-bottom: 

		10px; ">
		<p class="footer">
		<a href="#" class="footer">关于今昔</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">今昔历程</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">联系我们</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">用户协议</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">帮助中心</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">意见建议</a>
		</p>
		</div>

		<div style="text-align: center; margin-bottom: 40px; margin-top: 10px;">
		<p class="footerinfo">&copy; 2013 今昔网 &middot;
		版权所有&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 京ICP备13053152号</p>
		<p class="footerinfo">后夏科技&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址：北京市海淀区</p>
		<p class="footerinfo">Designed and Developed by FABKXD</p>
		</div>
		';
		$this->email->from ( 'jinxicn2013@163.com', '今昔网' );
		$this->email->to ( $mail );
		$this->email->subject ( '今昔网账号邮件验证' );
		$this->email->message ( $content );
		
		$this->email->send ();
	}
}