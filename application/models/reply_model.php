<?php
class reply_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}

	//add_reply时要确保每层楼只有一个0
	public function add_reply($reply){
		$map['post_id'] = $reply['post_id'];
		$map['type'] = $reply['type'];
		$this->db->where($map);
		$this->db->select_max('floor');
		$query = $this->db->get("jx_reply");
		$res = $query->row_array();
		$max_floor = $res['floor'];
		if(empty($max_floor)){
			$max_floor = 1;
		}
		$reply['floor'] = $max_floor + 1; //最高楼上加1
		$res = $this->db->insert("jx_reply",$reply);  //插入回复表
		return $res;
	}

	public function get_max_floor($post_id,$type){
		
	}

	public function get_reply_num($post_id,$type){
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$this->db->where($map);
		$this->db->from('jx_reply');
		$res = $this->db->count_all_results();
		return $res;
	}

	public function get_reply($post_id,$type){
		$sql = "select jx_reply.*,a.nick as replyer, b.nick as replyee from jx_reply left join jx_user as a on a.id=jx_reply.reply_from left join jx_user as b on b.id=jx_reply.reply_to where post_id=".$post_id. " and jx_reply.type=" .$type;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
}
?>