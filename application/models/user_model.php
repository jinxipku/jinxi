<?php
class user_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->helper('date');
	}

	public function get_info($user_id){
		$query = $this->db->get_where ( 'jx_user', array (
			'id' => $user_id 
			) );
		return $query->row_array ();
	}
}