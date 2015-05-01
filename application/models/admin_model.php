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

	public function get_report_info(){
		$this->db->from("jx_report");
		$this->db->join("jx_reply","jx_reply.id=jx_report.reply_id");
		$report_info = $this->db->get()->result_array();
		foreach ($report_info as $key => $value) {
			
			$temp = ($value['type']==0)?"sell":"buy";
			$report_info[$key]['url'] = base_url('post/viewpost/'.$temp.'/'.$value['post_id'].'/'.$value['id']);
			$report_info[$key]['url_thumb'] = 'post/viewpost/'.$temp.'/'.$value['post_id'].'/'.$value['id'];
		}
		return $report_info;
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
}
?>