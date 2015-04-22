<?php
// +----------------------------------------------------------------------
// | Message 私信操作
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class Message extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model("message_model");
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------

	//post 参数 to_id  content
	public function add_message(){
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) $this->ajaxReturn(null,"未登录",0);
		$to_id = $_POST['to_id'];
		$content = $_POST['content'];
		$res = $this->message_model->add_message($login_user['id'],$to_id,$content);
		$res = ($res==true)?1:0;
		$this->ajaxReturn(null,'',$res);
	}
	//post 参数 message_id
	public function delete_message(){
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) $this->ajaxReturn(null,"未登录",0);
		$msg_id = $_POST['message_id'];
		$res = $this->message_model->delete_message($msg_id,$login_user['id']);
		$res = ($res==true)?1:0;
		$this->ajaxReturn(null,'',$res);
	}

	//无post参数
	public function get_user_messages(){
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) $this->ajaxReturn(null,"未登录",0);
		$data = $this->message_model->get_user_messages($login_user['id'],$page);
		$this->ajaxReturn($data,'',1);
	}
}

?>