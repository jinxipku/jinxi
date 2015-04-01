<?php
// +----------------------------------------------------------------------
// | Account 用户账户操作（注册、登录）
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class Account extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'account_model' );
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------

	public function login() {
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			redirect(base_url());
		}
		if (strpos($_SERVER['HTTP_REFERER'], "account") == false) {
			$this->session->set_userdata( 'mem_url' ,  $_SERVER['HTTP_REFERER'] );
		}
		$this->assign('nav_tab', 7);
		$this->assign('title', '今昔网-登录');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'account/login.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function loginfo($redirect = '') {
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			redirect(base_url());
		}
		else if ($redirect == '' && strpos($_SERVER['HTTP_REFERER'], "account") == false) {
			$this->session->set_userdata('mem_url', $_SERVER['HTTP_REFERER']);
		}
		$this->assign('nav_tab', 7);
		$this->assign('title', '今昔网-登录');
		$this->assign('baseurl', base_url());
		$this->assign('tips',show_tips());

		$this->display ( 'templates/header.php' );
		$this->display ( 'account/loginfo.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function register() {
		$login_user =  $this->session->userdata('login_user');
		if(!empty($login_user)){
			redirect(base_url());
		}
		if (strpos($_SERVER['HTTP_REFERER'], "account") == false) {
			$this->session->set_userdata( 'mem_url' ,  $_SERVER['HTTP_REFERER'] );
		}
		$this->assign('nav_tab', 8);
		$this->assign('title', '今昔网-注册');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'account/register.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function reginfo($surfix = "") {
		$this->assign('nav_tab', 8);
		$this->assign('title', '今昔网-注册');
		$this->assign('baseurl', base_url());
		$this->assign('tips',show_tips());
		$this->assign('verify_email', 'http://mail.'.$surfix);

		$this->display ( 'templates/header.php' );
		if ($surfix != "") {
			$this->display ( 'account/regmail.php' );
		}
		else {
			$this->display ( 'account/regfail.php' );
		}
		$this->display ( 'templates/footer.php' );
	}

	public function verify() {
		if (!empty( $_GET['code'] )) {
			$key = $this->config->item('verify_pkey');
			$id = $this->_genIdFromCode( $_GET['code'] );
			$this->account_model->verify( $id );

			if ($id != '') {
				$login_user = $this->user_model->get_info($id);
				$this->session->set_userdata ( 'login_user', $login_user);
				$this->assign('login_user', $login_user);
			}

			$mem_url = $this->session->userdata('mem_url');
			if ($mem_url != '' && strpos($mem_url, "account") == false) {
				$this->assign('mem_url', $mem_url);
			}

			$this->assign('nav_tab', 8);
			$this->assign('title', '今昔网-注册');
			$this->assign('baseurl', base_url());
			$this->assign('tips',show_tips());

			$this->display ( 'templates/header.php' );
			$this->display ( 'account/regsuccess.php' );
			$this->display ( 'templates/footer.php' );
		}

	}


// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------

	//用户注册
	//post参数  email school_id  password passworda
	//status  0：注册失败   1：注册成功
	public function doregister() {

		$school_id = $_POST ['school_id'];
		$email = $_POST['email'];
		$pwd = $_POST ['password'];
		$pwd2 = $_POST ['passworda'];

		//计算email	
		if($pwd != $pwd2)
			$this->ajaxReturn(null , '两次输入的密码不一致' , 0);

		if (empty ( $school_id ) ||  empty($email) )
			$this->ajaxReturn( null , '学校、email未填写完整' , 0 );
		$regres = $this->account_model->register( $email, $pwd, $school_id );//返回用户id
		if( !empty($regres) ){
			$user = $this->account_model->get_account(null, $email);
			$this->_sendVerifyEmail( $user );//发送验证邮件
			$this->ajaxReturn( null , '注册成功' , 1 );
		}else
		$this->ajaxReturn( null , '账号已被注册' , 0 );
	}

	//验证邮箱是否存在
	//post参数 email
	public function docheck() {
		
		$email = $_POST ['email'];
		$account = $this->account_model->get_account(null, $email);
		if( empty(  $account ) ){
			$this->ajaxReturn(null , '账号未被注册' , 1);
		}else{
			if($account['is_verified']==0){
				$this->ajaxReturn(null , '账号已经被注册但未通过验证' , 0);
			}
			else $this->ajaxReturn(null , '账号已经被注册并且已经通过验证' , -1);
		}
	}

	//用户登录
	//post参数 mail pwd
	public function dologin() {
		$email = $_POST ['email'];
		$pwd = $_POST ['password'];

		if(strlen( $pwd ) == 0 || strlen( $email ) == 0){
			$this->ajaxReturn(null,'登录信息不全',0);
		}

		$logres = $this->account_model->login( $email, $pwd );
		if (!empty($logres)) {
			$user = $this->user_model->get_info ($logres );
			if($user['is_verified']!=1){
				$this->ajaxReturn(null,"账户尚未激活",0);
			}else{
				$this->session->set_userdata ( 'login_user', $user );
				$mem_url = $this->session->userdata('mem_url');
				if ($mem_url != '' && strpos($mem_url, "account") == false) {
					$this->ajaxReturn($mem_url,"登录成功",1);
				} else {
					$this->ajaxReturn(null,"登录成功",1);
				}
			}
			
		} else {
			$this->ajaxReturn(null,"登录失败",0);
		}
	}

	public function dologout() {
		$this->session->unset_userdata ( 'login_user' );
	}


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

	/**
	**TODO: 修改baseurl
	*/
	private function _sendVerifyEmail( $user ){
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

		//$verify_url = "http://wwww.jinxi.com/account/doverify".'?code=' . $this->_genCodeForVerify($user['id']);
		$verify_url = base_url('account/verify?code=').urlencode($this->_genCodeForVerify($user['id']));
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

		style="width: 100%;" src="'.base_url('img/icon/invite.png').'" /></div>
		<p style="font-size: 22px; font-family: 微软雅黑,黑体,宋体">&nbsp;&nbsp;&nbsp;&nbsp;尊敬的用户您好，欢迎加入今昔网，您的账号已经注册完毕，请点击以下链接完成验证：<a href="'. $verify_url .'">立即激活</a></p>
		<div class="row"
		style="height: 35px; background-color: #1ABC9C; text-align: center; margin-bottom: 

		10px; padding-top: 8px;">
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
		<p class="footerinfo">Designed and Developed by JINXI</p>
		</div>
		';
		$this->email->from ( 'jinxicn2013@163.com', '今昔网' );
		$this->email->to ( $user['email'] );
		$this->email->subject ( '今昔网账号邮件验证' );
		$this->email->message ( $content );
		
		$this->email->send ();
	}

	private function _genCodeForVerify($id=0){
		$key = $this->config->item('verify_pkey');
		return $this->encrypt->encode( $id, $key);
	}

	private function _genIdFromCode($code){
		$key = $this->config->item('verify_pkey');
		return $this->encrypt->decode( $code, $key);
	}
}