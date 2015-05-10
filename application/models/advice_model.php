<?php
class advice_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}

	public function add_advice($content,$user_id=0){
		$map['content'] = $content;
		$map['user_id'] = $user_id;
		$map['addat'] = time();
		return $this->db->insert("jx_advice",$map);
	}

	public function get_advice($page){
		$this->db->order_by("addat","desc");
		$res = $this->db->get("jx_advice")->result_array();
		foreach ($res as $key => $value) {
			$res[$key]['addat'] = format_time($value['addat']);
		}
		return $res;
	}
}

?>