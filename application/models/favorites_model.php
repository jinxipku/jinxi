<?php
class favorites_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->model("post_model");
	}


	//type  0返回卖家  1返回买家
	//TODO: join post表
	public function get_favorites($user_id,$type){
		$this->db->order_by("addat", "desc"); 
		$map = array();
		$map['user_id'] = $user_id;
		$map['type'] = $type;
		$table = get_post_table($type);
		$this->db->join($table,'post.id');
		$query = $this->db->get_where('jx_favorites', $map);

		$res = $query->result_array();
		return $res;
	}

	public function get_favorite_ids($user_id,$type){
		$map = array();
		$map['user_id'] = $user_id;
		$map['type'] = $type;
		$this->db->select('post_id');
		$query = $this->db->get_where('jx_favorites', $map);

		$res = $query->result_array();
		$result = array();
		foreach ($res as $key => $value) {
			$result[] = $value['post_id'];
		}
		return $result;
	}



	public function delete_favorite($user_id,$post_id,$type){
		$map['user_id'] = $user_id;
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$res = $this->db->delete("jx_favorites",$map);
		if($res)
			$this->post_model->update_favorite_num($post_id,$type,-1);
		return $res;
	}

	public function add_favorite($user_id,$post_id,$type){
		$map['user_id'] = $user_id;
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$map['addat'] = time();
		$res = $this->db->insert("jx_favorites",$map);
		if($res)
			$this->post_model->update_favorite_num($post_id,$type,1);
		return $res;
	}

	//商品的收藏数
	public function get_favorites_num($post_id,$type){
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$this->db->where($map);
		$this->db->from('jx_favorites');
		$res = $this->db->count_all_results();
		return $res;
	}

	public function is_favorite($user_id, $post_id,$type) {
		$query = $this->db->get_where ( 'jx_favorites', array (
				'user_id' => $user_id,
				'post_id' => $post_id,
				'type' => $type 
		) );
		return $query->num_rows ();
	}
	
}