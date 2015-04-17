<?php
class admin_model extends CI_Model{
	public function __construct(){
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->library('user_agent');
	}

	public function login($admin_name,$password){
		$admin = $this->db->get_where("jx_admin",array("id"=>1))->row_array();
		$rpwd = $this->encrypt->decode($admin['password']);
		if($admin['admin_name']==$admin_name&&$password==$rpwd){
			return true;
		}else return false;
	}
}
?>