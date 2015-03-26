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
		$this->load->model ( 'account_model' );
		$this->load->library('session');
		$this->load->helper('url');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------

	public function login(){

	}

	public function regidit(){

	}

	public function userInfo(){

	}

	public function test(){
	
		$verify_url = base_url('account/doverify').'?code=' . $this->_genCodeForVerify(9);
		echo 'h'.$verify_url;
		echo urlencode($verify_url);
		//var_dump($this->config->item('school'));
		//var_dump( $this->config->item('school')[2] );
		//echo phpversion();
		//$this->account_model->regidit("443021181@qq.com","asdfss","cuida",1);
		//echo $this->account_model->login("443021181@qq.com","asdfss");
		// $user = $this->account_model->get_account(6,null);
		// $this->_sendVerifyEmail( $user['email'], $user );
	// 	$key = $this->config->item('verify_pkey');
	// 	$c = $this->encrypt->encode(1,$key);
	// 	echo $c."<br>";
	// 	echo $this->encrypt->decode('Y0I/BGZHh211vFyQ86sOmckDxNqXZ1f3SbFsC5RtfpOaOiGGnbsAEpf3Z8D0pAjZzGGlhxIgp5Yc0T0RqA4QQ==',$key);
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------

	//用户注册
	//post参数  student_id school_id  pwd pwd2 nick
	//status  0：注册失败   1：注册成功
	public function doregister(){

		$student_id = $_POST ['student_id'];
		$school_id = $_POST ['school_id'];
		$nick = $_POST ['nick'];
		$pwd = $_POST ['pwd'];
		$pwd2 = $_POST ['pwd2'];

		//计算email
		$school = $this->config->item('school');
		$email = $student_id . '@' . $school[$school_id]['mailext'];
		
		if($pwd != $pwd2)
			$this->ajaxReturn(null , '两次输入的密码不一致' , 0);

		if (strlen ( $student_id ) == 0 || empty($school_id) || empty($nick) )
			$this->ajaxReturn( null , '学号、学校、昵称未填写完整' , 0 );

		$regres = $this->account_model->regidit( $email, $pwd, $nick, $school_id );
		if( !empty($regres) ){
			$user = $this->account_model->get_account(null ,$email );
			$this->session->set_userdata( 'login_user' , $user );
			$this->_sendVerifyEmail( $email, $user );//发送验证邮件
			$this->ajaxReturn( null , '注册成功' , 1 );
		}else
			$this->ajaxReturn( null , '账号已被注册' , 0 );
	}

	//用户登录
	//post参数 mail pw
	public function dologin(){
		$email = $_POST ['mail'];
		$pwd = $_POST ['pwd'];


		if(strlen( $pwd ) == 0 || strlen( $email ) == 0){
			$this->ajaxReturn(null,'登录信息不全',0);
		}

		$logres = $this->account_model->login( $email, $pwd );
		if ($logres == 1) {
			$user = $this->account_model->get_account (null ,$email );
			$this->session->set_userdata ( 'login_user', $user );
			$this->ajaxReturn(null,"登录成功",1);
		}else{
			$this->ajaxReturn(null,"登录失败",1);
		}
		

	}

	public function doverify(){
		if(!empty( $_GET['code'] )){
			/*TODO: 判断合法 */
			$key = $this->config->item('verify_pkey');
			$id = $this->_genIdFromCode( $_GET['code'] );
			$this->account_model->verify( $id );
		}

	}


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

	/**
	**TODO: 修改baseurl
	*/
	private function _sendVerifyEmail( $mail, $user ){
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

		$verify_url = base_url('account/doverify').'?code=' . $this->_genCodeForVerify($user['id']);
		//$verify_url = urlencode($verify_url);
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
		<p style="font-size: 22px; font-family: 微软雅黑,黑体,宋体">&nbsp;&nbsp;&nbsp;&nbsp;尊敬的用户<span style="color: #1ABC9C"> ' . $user['nick'] . ' </span>您好，欢迎加入今昔网，您的账号已经注册完毕，请点击以下链接完成验证：<a href="'. $verify_url .'">立即激活</a></p>
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

	private function _genCodeForVerify($id=0){
		$key = $this->config->item('verify_pkey');
		return $this->encrypt->encode( $id, $key);
	}

	private function _genIdFromCode($code){
		$key = $this->config->item('verify_pkey');
		return $this->encrypt->decode( $code, $key);
	}
}