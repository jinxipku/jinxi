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
	public function add_love($lover, $lovee, $love) {
		$data = array (
				'lover' => $lover,
				'lovee' => $lovee 
		);
		$this->db->insert ( 'jx_love', $data );
	}
	
	public function delete_love($lover, $lovee, $love) {
		$data = array (
				'lover' => $lover,
				'lovee' => $lovee 
		);
		$this->db->delete ( 'jx_love', $data );
		$data = array (
				'love' => $love - 1 
		);
		$this->db->where ( 'user_id', $lovee );
		$this->db->update ( 'jx_user', $data );
	}
	public function add_comment($user_id, $subject_id, $ctype, $cscore, $ccontent) {
		if ($ctype == 0) {
			$query = $this->db->get_where ( 'jx_user', array (
					'user_id' => $user_id 
			) );
			$arr = $query->row_array ();
			$sell_mark = $arr['sell_mark'];
			$sell_comment = $arr['sell_comment'];
			$has_sign = $arr['sign_on2'];
			$data = array (
					'sell_mark' => $sell_mark + $cscore,
					'sell_comment' => $sell_comment + 1 
			);
			$this->db->update ( 'jx_user', $data );
		} else if ($ctype == 1) {
			$query = $this->db->get_where ( 'jx_user', array (
					'user_id' => $user_id 
			) );
			$arr = $query->row_array ();
			$buy_mark = $arr['buy_mark'];
			$buy_comment = $arr['buy_comment'];
			$has_sign = $arr['sign_on2'];
			$data = array (
					'buy_mark' => $buy_mark + $cscore,
					'buy_comment' => $buy_comment + 1 
			);
			$this->db->update ( 'jx_user', $data );
		}
		
		$query = $this->db->get_where ( 'jx_user', array (
				'user_id' => $subject_id
		) );
		$arr = $query->row_array ();
		$has_sign = $arr['sign_on2'];
		
		$ctime = date ( 'Y-m-d H:i:s' );
		$data = array (
				'user_id' => $user_id,
				'subject_id' => $subject_id,
				'ctype' => $ctype,
				'cscore' => $cscore,
				'ctime' => $ctime,
				'ccontent' => $ccontent,
				'has_sign' =>  $has_sign
		);
		$res = $this->db->insert ( 'jx_comment', $data );
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