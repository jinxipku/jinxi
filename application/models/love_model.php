<?php
class love_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function get_love($lover, $lovee) {
		$query = $this->db->get_where ( 'jx_love', array (
				'lover' => $lover,
				'lovee' => $lovee 
		) );
		return $query->num_rows ();
	}
	public function add_love($lover, $lovee ) {
		$data = array (
				'lover' => $lover,
				'lovee' => $lovee 
		);
		return $this->db->insert ( 'jx_love', $data );
	}
	
	public function delete_love($lover, $lovee) {
		$data = array (
				'lover' => $lover,
				'lovee' => $lovee 
		);
		return $this->db->delete ( 'jx_love', $data );
	}

}