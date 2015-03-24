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
		echo "h";
		//var_dump($this->config->item('school'));
		//var_dump( $this->config->item('school')[2] );
		//echo phpversion();
		//$this->account_model->regidit("443021181@qq.com","asdfss","cuida",1);
		echo $this->account_model->login("443021181@qq.com","asdfss");
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
		//计算email
		$school = $this->config->item('school');
		$email = $student_id . '@' . $school[$school_id]['mailext'];
		$pwd = $_POST ['pwd'];
		$pwd2 = $_POST ['pwd2'];
		if($pwd != $pwd2)
			$this->ajaxReturn(null , '两次输入的密码不一致' , 0);

		if (strlen ( $student_id ) == 0 || empty($school_id) || empty($nick) )
			$this->ajaxReturn( null , '学号、学校、昵称未填写完整' , 0 );

		$regres = $this->account_model->regidit( $email, $pwd, $nick, $school_id );
		if( !empty($regres) ){
			$user = $this->account_model->get_account(null ,$email );
			$this->session->set_userdata( 'login_user' , $user );
			$this->_sendVerifyEmail( $email );//发送验证邮件
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