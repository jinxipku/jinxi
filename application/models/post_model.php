<?php
class post_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}


	public function insert_post($info, $type){
		$table = get_post_table($type);
		$res = $this->db->insert($table, $info); 
		if( $res ){
			return $this->db->insert_id();//post id
		}else return 0;
		
	}

	public function update_post($info,$user_id,$post_id,$type){
		$table = get_post_table($type);
		$map['user_id'] = $user_id;
		$map['post_id'] = $post_id;
		$this->db->where($map);
		return $this->db->update($table,$info);
	}

	public function edit_description($post_id,$type,$desc){
		$table = get_post_table($type);
		$map['post_id'] = $post_id;
		$this->db->where($map);
		return $this->db->update($table,array("description"=>$desc));
	}


	//TODO:当两张表区别较大时，再区别处理.
	public function get_post($post_id,$type){
		$table = get_post_table($type);
		$query = $this->db->get_where($table, array('post_id' => $post_id));
		$res = $query->row_array();
		if(empty($res)) return null;
		$res['picture'] = unserialize($res['picture']);

		$this->db->from("jx_user");
		$this->db->select('jx_school_info.school_name, nick,id, thumb,nick_color,email,qq,phone,weixin,is_mars');
		$this->db->join('jx_school_info',"jx_school_info.school_id=jx_user.school_id");
		$this->db->where(array("id"=>$res['user_id']));
	
		$user = $this->db->get()->row_array();

		if(empty($user)) return null;
		$user['nick_color'] = get_namecolor($user['nick_color']);
		$user['thumb'] = base_url("img/head/".$user['thumb']);
		$res['user'] = $user;
		return $res;
	}

	//返回某个用户发的所有帖子，不需要联立其他表，只需要返回对应post表中信息
	public function get_user_posts($user_id,$type){
		$table = get_post_table($type);
		$this->db->order_by("createat", "desc"); 
		$query = $this->db->get_where($table, array('user_id' => $user_id));
		$res = $query->result_array();

		foreach ($res as $key => &$v) {
			$v['createat'] = date('Y-m-d H:i:s',$v['createat']);
			$v['updateat'] = date('Y-m-d H:i:s',$v['updateat']);
			$temp = unserialize($v['picture']);
			if(is_array($temp)&&count($temp)!=0){
				foreach ($temp as $ke => $value) {
					$temp[$ke]['thumb_picture_url'] = get_thumb($value['picture_url']);
				}
			}else $temp = null;
			$v['picture'] = $temp;
		}
		return $res;
	}

	public function set_active($post_id,$type,$active){
		$table = get_post_table($type);
		$this->db->where("post_id",$post_id);
		return $this->db->update($table,array("active"=>$active));
	}



//************************************以下是旧的*****************//

	
	// public function add_post($user_id) {
	// 	$ptime = date ( 'Y-m-d H:i:s' );
	// 	$data = array (
	// 		'post_user' => $user_id,
	// 		'ptype' => $this->session->userdata ( 'ptype' ),
	// 		'pgtype' => $this->session->userdata ( 'pgtype' ),
	// 		'pstype' => $this->session->userdata ( 'pstype' ),
	// 		'class' => $this->session->userdata ( 'class' ),
	// 		'brand' => $this->session->userdata ( 'brand' ),
	// 		'modal' => $this->session->userdata ( 'modal' ),
	// 		'status' => $this->session->userdata ( 'status' ),
	// 		'price' => $this->session->userdata ( 'price' ),
	// 		'pcontent' => $this->session->userdata ( 'pcontent' ),
	// 		'ptime' => $ptime 
	// 		);
	// 	$this->db->insert ( 'jx_post', $data );
	// 	$query = $this->db->get_where ( 'jx_post', array (
	// 		'post_user' => $user_id,
	// 		'ptime' => $ptime 
	// 		) );
	// 	$post_id = $query->row_array ()['post_id'];

	// 	$query = $this->db->get_where ( 'jx_user', array (
	// 		'user_id' => $user_id 
	// 		) );
	// 	$userinfo = $query->row_array ();
	// 	$score = $userinfo ['score'];
	// 	$level = $userinfo ['level'];
	// 	$post_num = $userinfo ['post_num'];
	// 	$latest = $post_id;
	// 	$post_num += 1;
	// 	$score += po_score ( $post_num );
	// 	$level = get_level ( $score );
	// 	$data = array (
	// 		'post_num' => $post_num,
	// 		'latest' => $latest,
	// 		'score' => $score,
	// 		'level' => $level 
	// 		);
	// 	$this->db->where ( 'user_id', $user_id );
	// 	$this->db->update ( 'jx_user', $data );

	// 	return $post_id;
	// }
	// public function upload_picture($post_id, $pimage) {
	// 	$data = array (
	// 		'pimage' => $pimage 
	// 		);
	// 	$this->db->where ( 'post_id', $post_id );
	// 	$this->db->update ( 'jx_post', $data );
	// }
	// public function view($post_id) {
	// 	$query = $this->db->get_where ( 'jx_post', array (
	// 		'post_id' => $post_id 
	// 		) );
	// 	$view = $query->row_array ()['view'];
	// 	$data = array (
	// 		'view' => $view + 1 
	// 		);
	// 	$this->db->where ( 'post_id', $post_id );
	// 	$this->db->update ( 'jx_post', $data );
	// }
	// public function get_post($post_id) {		
	// 	$this->db->from ( 'jx_post' );
	// 	$this->db->join ( 'jx_user', 'jx_post.post_user = jx_user.user_id' );
	// 	$this->db->where ( 'jx_post.post_id', $post_id );
	// 	return $this->db->get ()->row_array ();
	// }
	// public function check_focus($user_id , $post_id) {
	// 	$query = $this->db->get_where ( 'jx_focus', array (
	// 		'focuser' => $user_id,
	// 		'focusee' => $post_id 
	// 		) );
	// 	return $query->num_rows ();
	// }
	// public function add_focus($focuser, $focusee, $focus) {
	// 	$data = array (
	// 		'focuser' => $focuser,
	// 		'focusee' => $focusee 
	// 		);
	// 	$this->db->insert ( 'jx_focus', $data );
	// 	$data = array (
	// 		'focus' => $focus + 1 
	// 		);
	// 	$this->db->where ( 'post_id', $focusee );
	// 	$this->db->update ( 'jx_post', $data );
	// }
	// public function delete_focus($focuser, $focusee, $focus) {
	// 	$data = array (
	// 		'focuser' => $focuser,
	// 		'focusee' => $focusee 
	// 		);
	// 	$this->db->delete ( 'jx_focus', $data );
	// 	$data = array (
	// 		'focus' => $focus - 1 
	// 		);
	// 	$this->db->where ( 'post_id', $focusee );
	// 	$this->db->update ( 'jx_post', $data );
	// }
}