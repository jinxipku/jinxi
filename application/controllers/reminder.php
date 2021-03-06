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
	public function read($id){
		$login_user =  $this->session->userdata('login_user');
		if(empty($login_user)) {
			$this->session->set_userdata('mem_url', base_url('reminder/read/' . $id));
			redirect('account/loginfo/redirect');
		}
		//限制接受提醒的用户必须是登录用户
		$reminder = $this->reminder_model->get_reminder($id);
		if($reminder['to_user_id']!=$login_user['id']){
			redirect('info/nopage');
		}

		//TODO:删除reminder的时机？
		$url = base_url("info/nopage");
		if(!empty($reminder)){
			switch ($reminder['type']) {
				case '1':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id']);
		
					break;
				case '2':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id']);
					
					break;
				case '3':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$addon2 = empty($reminder['extra'])?"":("/".$reminder['extra']);
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id'].$addon2);
					
					break;
				case '4':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$addon2 = empty($reminder['extra'])?"":("/".$reminder['extra']);
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id'].$addon2);
					
					break;
				case '5':
					//http://www.xn--wmqr18c.cn/user/profile/2#user_mess
					//TODO:这地方没用？？？？？？直接进到message页面。
					$url = base_url("user/profile/".$login_user['id'] . "/message");
					
					break;
				case '6':
					$addon = ($reminder['post_type']==1)?"buy":"sell";
					$url = base_url("post/viewpost/".$addon."/".$reminder['post_id']);
					
					break;
				default:
					# code...
					break;
			}
			$this->reminder_model->delete_reminder($reminder['id']);
			redirect($url);
		}else{
			//已经删除了。要跳转到哪里？
			redirect($url);
		}
	}
//ajax 轮询调用
	public function delete_all(){
		$login_user =  $this->session->userdata('login_user');
		if(empty($login_user)) {
			$this->ajaxReturn(null,"未登录",0);
		}
		$this->reminder_model->delete_all($login_user['id']);
		$this->ajaxReturn(null,"",1);
	}
	public function reminder_number(){
		$login_user =  $this->session->userdata('login_user');
		if(empty($login_user)) {
			$this->ajaxReturn(null,"未登录",0);
		}

		$number = $this->reminder_model->get_reminder_number($login_user['id']);
		$this->ajaxReturn($number,"",1);
	}
}
?>