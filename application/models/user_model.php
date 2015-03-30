<?php
class user_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->helper('date');
	}

	public function get_info($user_id){
		$sql = "select jx_user.*,jx_school_info.school_name,jx_school_info.school_region from jx_user left join jx_school_info on jx_school_info.school_id=jx_user.school_id where jx_user.id=".$user_id;
		$query = $this->db->query($sql);
		$user = $query->row_array ();
		$user['level'] = get_level($user['points']);
		return $user;
	}

	public function update_info($user_id, $info){
		$this->db->where("id",$user_id);
		$this->db->update("jx_user",$info);
	}
}