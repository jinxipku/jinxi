<?php
class user_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->helper('date');
	}

	public function get_info($user_id){
		$sql = "select jx_user.*,jx_account.email as register_email,jx_account.logins,jx_account.is_verified,jx_school_info.school_name,jx_school_info.school_region from jx_user left join jx_account on jx_account.id=jx_user.id left join jx_school_info on jx_school_info.school_id=jx_user.school_id where jx_user.id=".$user_id;
		$query = $this->db->query($sql);
		$user = $query->row_array ();
		$user['level'] = get_level($user['points']);
		$user['sex'] = get_sex($user['sex']);
		$user['nick_color'] = get_namecolor($user['nick_color']);
		$user['type'] = get_user_type($user['type']);
		$user['year'] = empty($user['year'])? 0:$user['year'];
		$this->db->where('lovee', $user['id']);
		$this->db->from('jx_love');
		$user['lovers'] = $this->db->count_all_results();
		return $user;
	}

	//TODO:根据公开等字段返回相应的信息，当前为全部返回
	public function get_contact($user_id){
		$this->db->select('email, qq, phone, weixin');
		$query = $this->db->get('jx_user',array("id"=>$user_id));
		$user = $query->row_array ();
		return $user;
	}

	public function update_info($user_id, $info){
		$this->db->where("id",$user_id);
		$res = $this->db->update("jx_user",$info);
		return $res;
	}

	public function addpoints($user_id,$points){
		//TODO:是否sql可以执行加法
		$sql = "update jx_user set points=points+".$points." where id=".$user_id ;
		$query = $this->db->query($sql);
		return !empty($query);
	}
}