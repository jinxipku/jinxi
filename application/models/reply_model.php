<?php
class reply_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->model("post_model");
		$this->load->model("user_model");
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
			$max_floor = 0;
		}
		$reply['floor'] = $max_floor + 1; //最高楼上加1
		$reply['createat'] = time();
		$res = $this->db->insert("jx_reply",$reply);  //插入回复表
		$res2 = $this->post_model->update_reply_num($reply['post_id'],$reply['type'],1);
		$res3 = $this->user_model->addpoints($reply['reply_from'],$this->config->item("reply_bonus"));
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

	public function get_single_reply($post_id,$type,$floor){
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$map['floor'] = $floor;
		$this->db->where($map);
		$query = $this->db->get("jx_reply");
		return $query->row_array();
	}

	public function get_reply($post_id,$type){
		$sql = "select jx_reply.id,jx_reply.floor,jx_reply.reply_from,jx_reply.reply_to,jx_reply.reply_to_floor,jx_reply.content,jx_reply.createat as reply_date,school_name as reply_school,a.thumb as reply_thumb,a.nick as replyer,a.is_sign_public as reply_is_sign_public, a.signature as reply_sign, b.nick as replyee from jx_reply left join jx_user as a on a.id=jx_reply.reply_from left join jx_user as b on b.id=jx_reply.reply_to left join jx_school_info on jx_school_info.school_id=a.school_id where post_id=".$post_id. " and jx_reply.type=" .$type;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function get_reply_by_id($reply_id){
		$map['id'] = $reply_id;
		$this->db->where($map);
		$query = $this->db->get("jx_reply");
		return $query->row_array();
	}

	public function delete_reply($reply){
		$map['id'] = $reply['id'];
		$res = $this->db->delete('jx_reply',$map);	
		if($res)
			$this->post_model->update_reply_num($reply['post_id'],$reply['type'],-1);
		return $res;	
	}

	public function make_report($reply_id,$reason,$other_reason){
		$map['reply_id'] = $reply_id;
		$map['reason'] = $reason;
		$map['other_reason'] = $other_reason;
		return $this->db->insert('jx_report',$map);
	}
}
?>