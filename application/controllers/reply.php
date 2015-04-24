<?php
// +----------------------------------------------------------------------
// | Reply 用户回帖相关
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
		$this->load->model("post_model");
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------
	//post参数  post_id  type reply_to  reply_to_floor content
	public function add_reply(){
		$user =  $this->session->userdata('login_user');
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);
		$reply['post_id'] = $_POST['post_id'];
		$reply['type'] = $_POST['type'];
		$reply['reply_to_floor'] = $_POST['reply_to_floor'];
		$reply['reply_to'] = $_POST['reply_to'];
		$reply['content'] = $_POST['content'];
		$reply['reply_from'] = $user['id'];
		$res = $this->reply_model->add_reply($reply);
		if($res){
			$reply_id = $this->db->insert_id();
			$type_name = ($reply['type']==0)?"sell":"buy";
			$data = base_url("post/viewpost/$type_name/".$reply['post_id']."/".$reply_id);
			$this->ajaxReturn($data,"回复成功",1);
		}else{
			$this->ajaxReturn(null,"回复失败",0);
		}
	}
	//post参数 reply_id
	public function delete_reply(){
		$user =  $this->session->userdata('login_user');
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);
		$res = $this->reply_model->get_reply_by_id($_POST['reply_id']);
		if(empty($res)){
			$this->ajaxReturn(null,'帖子不存在',0);
		}else{
			if($res['reply_from']!=$user['id']){
				$this->ajaxReturn(null,'你不能删除别人的回复',0);
			}
			$res = $this->reply_model->delete_reply($res);
			if($res) $this->ajaxReturn(null,'操作成功',1);
			else $this->ajaxReturn(null,'操作失败',0);
		}
	}
	
	public function make_report(){
		$user =  $this->session->userdata('login_user');
		if(empty($user)) $this->ajaxReturn(null,'未登录',0);
		$report_reply_id = $_POST['report_reply_id'];
		$report_reason = $_POST['report_reason'];
		$report_other_reason = $_POST['report_other_reason'];
		$res = $this->reply_model->make_report($report_reply_id,$report_reason,$report_other_reason);
		if($res) $this->ajaxReturn(null,'操作成功',1);
		else $this->ajaxReturn(null,'操作失败',0);
	}
}