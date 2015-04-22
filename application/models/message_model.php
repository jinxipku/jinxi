<?php
class message_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->model("user_model");
	}

	public function add_message($from_id,$to_id,$content){
		$map['from_id'] = $from_id;
		$map['to_id'] = $to_id;
		$map['content'] = $content;
		$map['createat'] = time();
		$res = $this->db->insert("jx_message",$map);
		return $res;
	}

	public function delete_message($msg_id,$user_id){
		$this->db->where("id",$msg_id);
		$res = $this->db->get("jx_message")->row_array();
		if(empty($res)) return false;
		else{
			if($res['from_id']==$user_id){
				if($res['delete_by_to']==1){
					return $this->db->delete("jx_message",array("id"=>$res['id']));
				}else{
					$info['delete_by_from'] = 1;
					$this->db->where("id",$res['id']);
					return $this->db->update("jx_message",$info);
				}
			}elseif($res['to_id']==$user_id){
				if($res['delete_by_from']==1){
					return $this->db->delete("jx_message",array("id"=>$res['id']));
				}else{
					$info['delete_by_to'] = 1;
					$this->db->where("id",$res['id']);
					return $this->db->update("jx_message",$info);
				}
			}else return false;
		}
	}

	//获取一个用户的所有私信，数组
	public function get_message($id){
		$this->db->where("(from_id=$id and delete_by_from=0) or (to_id=$id and delete_by_to=0)");
		$this->db->from("jx_message");
		$this->db->order_by("createat","desc");
		$query = $this->db->get();
		$res = $query->result_array();
		foreach ($res as $key => $value) {
			$who = $value['from_id'];
			if($value['from_id']==$id){
				$who = $value['to_id'];
			}
			$res[$key]['who'] = $this->user_model->get_info($who,"message");
		}
		return $res;
	}

}
?>