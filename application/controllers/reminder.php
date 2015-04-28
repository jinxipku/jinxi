<?php
// +----------------------------------------------------------------------
// | Reminder 提醒重定向
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-4-25
// +----------------------------------------------------------------------
class Reminder extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model("reminder_model");
		$this->load->helper("url");
	}
	public function index($id){
		$login_user =  $this->session->userdata('login_user');
		if (empty($login_user)) {
			echo '这地方是redirect到提示登录页面';exit;
		}
		//限制接受提醒的用户必须是登录用户
		$reminder = $this->reminder_model->get_reminder($id);
		if($reminder['to_user_id']!=$login_user['id']){
			echo '这地方需要提示这条提醒不是发送给该用户的';exit;
		}

		//TODO:删除reminder的时机？
		if(!empty($reminder)){
			switch ($reminder['type']) {
				case '1':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id']);
					redirect($url);
					break;
				case '2':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id']);
					redirect($url);
					break;
				case '3':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$addon2 = empty($reminder['extra'])?"":("/".$reminder['extra']);
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id'].$addon2);
					redirect($url);
					break;
				case '4':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$addon2 = empty($reminder['extra'])?"":("/".$reminder['extra']);
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id'].$addon2);
					redirect($url);
					break;
				case '5':
					//http://www.xn--wmqr18c.cn/user/profile/2#user_mess
					//TODO:这地方没用？？？？？？直接进到message页面。
					$url = base_url("user/profile/".$login_user['id']."#mess");
					redirect($url);
					break;
				case '6':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id']);
					redirect($url);
					break;
				default:
					# code...
					break;
			}
		}else{
			//已经删除了。要跳转到哪里？
		}
	}
}
?>