<?php
	class user_model extends CI_Model{
		public function __construct(){
			$this->load->database ();
			$this->load->library('encrypt');
			$this->load->library('user_agent');
			$this->load->helper('date');
		}

		public function get_user($user_id=0,$email){
			if(empty( $email )||empty( $user_id )){
				return null;
			}
			else if(!empty( $user_id )){
				$query = $this->db->get_where ( 'jx_account', array (
				'user_id' => $user_id 
				) );
				return $query->row_array ();
			}else if(!empty( $email )){
				$query = $this->db->get_where ( 'jx_account', array (
				'email' => $email 
				) );
				return $query->row_array ();
			}
		}

		public function 

	}
?>