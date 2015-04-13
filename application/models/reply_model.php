<?php
class reply_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}

	//add_reply时要确保每层楼只有一个0
	public function add_reply($entity){
		$res = $this->db->insert("jx_reply",$entity);
		if($entity['reply_to'] == 0){
			$entity['floor'] = get_max_floor()+1;
		}
		return $res;
	}

	public function get_max_floor($post_id,$type){
		
	}

	public function get_reply($post_id,$type){
		$sql = "select jx_reply.*,a.nick as replyer, b.nick as replyee from jx_reply left join jx_user as a on a.id=jx_reply.reply_from left join jx_user as b on b.id=jx_reply.reply_to where post_id=".$post_id. " and jx_reply.type=" .$type;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
}
?>