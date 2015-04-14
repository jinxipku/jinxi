<?php
// +----------------------------------------------------------------------
// | Reply 用户账户操作（注册、登录）
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-4-14
// +----------------------------------------------------------------------
class Reply extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('array');
		$this->load->model('reply_model');
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------
	//post参数  post_id  type reply_to  reply_to_floor content
	public function add_reply(){
		$user =  $this->session->userdata('login_user');
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);
		$reply['post_id'] = $_POST['post_id'];
		$reply['type'] = $_POST['reply'];
		$reply['reply_to_floor'] = $_POST['reply_to_floor'];
		$reply['reply_to'] = $_POST['reply_to'];
		$reply['content'] = $_POST['content'];
		$reply['reply_from'] = $user['id'];
		$res = $this->reply_model->add_reply($reply);
		if($res){
			$this->ajaxReturn(null,"回复成功",1);
		}else{
			$this->ajaxReturn(null,"回复失败",0);
		}
	}
}