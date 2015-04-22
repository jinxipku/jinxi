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

	public function add_report($object_id, $rtype, $rcontent) {
		$rtime = date ( 'Y-m-d H:i:s' );
		$data = array (
				'object_id' => $object_id,
				'rtype' => $rtype,
				'rcontent' => $rcontent,
				'rtime' => $rtime 
		);
		$res = $this->db->insert ( 'jx_report', $data );
	}
}