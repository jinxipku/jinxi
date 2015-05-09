<?php
class admin_model extends CI_Model{
	public function __construct(){
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->library('user_agent');
		$this->load->model("post_model");
	}

	public function login($admin_name,$password){
		$map['admin_name'] = $admin_name;
		$admin = $this->db->get_where("jx_admin",$map)->row_array();
		$rpwd = $this->encrypt->decode($admin['password']);
		if($password==$rpwd){
			if($admin['auth_level']>1){
				$map2['school_id'] = $admin['school_id'];
				$this->db->where($map2);
				$this->db->from("jx_school_info");
				$school_info = $this->db->get()->row_array();	
				$admin['school_name'] = $school_info['school_name'];
			}
			return $admin;
		}else return false;
	}

	public function get_user_info(){
		$this->db->from('jx_account');
		$res = $this->db->count_all_results();
		$user_info['total'] = $res;

		$this->db->where("is_verified",1);
		$this->db->from('jx_account');
		$res = $this->db->count_all_results();
		$user_info['verified_total'] = $res;

		$daysec = 86400;
		$login =  time() - time() % $daysec;
		$this->db->where("last_login >",$login);
		$this->db->from('jx_account');
		$res = $this->db->count_all_results();
		$user_info['today_total'] = $res;
		return $user_info;
	}

	public function get_post_info(){
		$post_info = array();
		for($type=0;$type<=1;$type++){
			$table = get_post_table($type);
			$this->db->from($table);
			$res = $this->db->count_all_results();
			$post_info[$type]['total'] = $res;

			$this->db->where("active",1);
			$this->db->from($table);
			$res = $this->db->count_all_results();
			$post_info[$type]['active_total'] = $res;
		}
		return $post_info;
		
	}

	public function get_school_posts($school_id){
		$this->db->select("jx_seller_post.post_id");
		$this->db->from("jx_seller_post");
		$this->db->where(array("jx_school_info.school_id"=>$school_id));
		$this->db->join("jx_user","jx_user.id=jx_seller_post.user_id");
		$this->db->join("jx_school_info","jx_school_info.school_id=jx_user.school_id");
		$array1 = $this->db->get()->result_array();
		
		$this->db->select("jx_buyer_post.post_id");
		$this->db->from("jx_buyer_post");
		$this->db->where(array("jx_school_info.school_id"=>$school_id));
		$this->db->join("jx_user","jx_user.id=jx_buyer_post.user_id");
		$this->db->join("jx_school_info","jx_school_info.school_id=jx_user.school_id");
		$array2 = $this->db->get()->result_array();

		$temp = array();
		foreach ($array1 as $key => $value) {
			$temp[] = $value['post_id']."#0";
		}

		foreach ($array2 as $key => $value) {
			$temp[] = $value['post_id']."#1";
		}
		return $temp;
		

	}

	public function get_report_info($school_id = null){
		$this->db->from("jx_report");
		$report_info = $this->db->get()->result_array();
		if(isset($school_id))
			$school_posts = $this->get_school_posts($school_id);
		$return = array();
		foreach ($report_info as $key => $value) {
			if($value['floor']<=0){//举报的是帖子
				$post_type = ($value['floor']==-1)?0:1;
				$post_id = $value['reply_id'];
				$id_and_type = $post_id."#".$post_type;
				if(isset($school_posts)&&!in_array($id_and_type, $school_posts)){
					continue;
				}
				$temp = ($value['floor']==-1)?"sell":"buy";
				$ele['url'] = base_url('post/viewpost/'.$temp.'/'.$value['reply_id']);
				$ele['url_thumb'] = 'post/viewpost/'.$temp.'/'.$value['reply_id'];
				$ele['report_id'] = $value['report_id'];
				$ele['reason'] = $value['reason'];
				$ele['other_reason'] = $value['other_reason'];
				$ele['type'] = 0;
				$return[] = $ele;
			}else{
				$map['reply_id'] = $value['reply_id'];
				$res = $this->db->get("jx_reply",$map)->row_array();
				$post_type = $res['type'];
				$post_id = $res['post_id'];
				$id_and_type = $post_id."#".$post_type;
				if(isset($school_posts)&&!in_array($id_and_type, $school_posts)){
					continue;
				}
				$temp = ($post_type==0)?"sell":"buy";
				$ele['url'] = base_url('post/viewpost/'.$temp.'/'.$post_id.'/'.$value['reply_id']);
				$ele['url_thumb'] = 'post/viewpost/'.$temp.'/'.$post_id.'/'.$value['reply_id'];
				$ele['report_id'] = $value['report_id'];
				$ele['reason'] = $value['reason'];
				$ele['other_reason'] = $value['other_reason'];
				$ele['type'] = 1;
				$return[] = $ele;
			}
		}
		return $return;
	}

	public function appoint($admin){
		$map['admin_name'] = $admin['admin_name'];
		$this->db->where($map);
		$this->db->from("jx_admin");
		$res = $this->db->get()->row_array();
		$admin['password'] = $this->encrypt->encode($admin['password']);
		if(empty($res)){
			return $this->db->insert("jx_admin",$admin);
		}else{
			$map2['id'] = $res['id'];
			$this->db->where($map2);
			return $this->db->update("jx_admin",$admin);
		}
	}

	public function delete_post($post_id,$post_type,$reason=""){
		//TODO:write admin log
		$map['post_id'] = $post_id;
		$table = get_post_table($post_type);
		$update['active'] = -1;
		$this->db->where($map);
		$res = $this->db->update($table,$update);
		return $res;
	}

	public function delete_reply($post_id,$post_type,$floor,$reason=""){
		$map['post_id'] = $post_id;
		$map['type'] = $post_type;
		$map['floor'] = $floor;
		return $this->db->delete("jx_reply",$map);
	}
}
?>