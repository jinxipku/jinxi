<?php
class favorites_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}

	//type  0 全部返回   1返回卖家  2返回买家
	//TODO: join post表
	public function get_favorites($user_id,$type){
		$this->db->order_by("addat", "desc"); 
		$map = array();
		$map['user_id'] = $user_id;
		if($type!=0){
			$map['type'] = $type;
		}
		$query = $this->db->get_where('jx_favorites', $map);
		$res = $query->result_array();
		return $res;
	}

	public function delete_favorites($user_id,$post_id,$type){
		$map['user_id'] = $user_id;
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$res = $this->db->delete("jx_favorites",$map);
		return $res;
	}

	public function add_favorites($user_id,$post_id,$type){
		$map['user_id'] = $user_id;
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$res = $this->db->insert("jx_favorites",$map);
		return $res;
	}

	//商品的收藏数
	public function favorites_count($post_id,$type){
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$this->db->where($map);
		$this->db->from('jx_favorites');
		$res = $this->db->count_all_results();
		return $res;
	}
	
}