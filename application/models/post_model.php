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
	public function get_post($post_id,$type,$hall=false){
		$table = get_post_table($type);
		if($hall){
			//$this->db->select('post_id,user_id,class,updateat,createat,description,first_picture,picture,price');
		}
		$query = $this->db->get_where($table, array('post_id' => $post_id));
		$res = $query->row_array();
		if(empty($res)) return null;
		$picture = unserialize($res['picture']);
		if(is_array($picture)){
			foreach ($picture as $key => $value) {
				$picture[$key]['thumb_picture_url'] = get_thumb($value['picture_url']);
			}
		}
		
		$res['picture'] = $picture;

		$this->db->from("jx_user");
		if(!$hall)
			$this->db->select('jx_school_info.school_name, nick,id, thumb,nick_color,email,qq,phone,weixin,is_mars');
		else $this->db->select('jx_school_info.school_name, nick,id, thumb,nick_color');
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

	public function get_post_ids($type,$school_id,$category1,$category2,$page,$sort){
		$table = get_post_table($type);
		$map = array();
		$map['active'] = 1;
		if($category1!=0) $map['category1'] = $category1;
		if($category2!=-1) $map['category2'] = $category2;
		$num = $this->config->item('num_per_page');
		$this->db->select($table.".post_id");
		$this->db->limit($num,($page-1)*$num);
		$this->db->from($table);
		if($sort=='time'){
			$this->db->order_by("createat", "desc"); 
		}elseif($sort=='heat'){
			//热度计算  每天减2，每个收藏加5，每个回复+4
			$this->db->select("(2*(createat-unix_timestamp())/86400+reply_num*4+favorite_num*5) as heat");
			$this->db->order_by("heat desc");
		}
		if(isset($school_id)){
			$map['school_id'] = $school_id;
			$this->db->join('jx_user','jx_user.id='.$table.'.user_id');
		}
		$this->db->where($map);
		$post_ids = $this->db->get()->result_array();
		$res = array();
		foreach ($post_ids as $key => $value) {
			$res[] = $value['post_id'];
		}
		return $res;
	}

	public function get_post_ids_total($type,$school_id,$category1,$category2){
		$map = array();
		if($category1!=0) $map['category1'] = $category1;
		if($category2!=-1) $map['category2'] = $category2;
		$map['active'] = 1;
		$table = get_post_table($type);
		if(!isset($school_id)){
			$this->db->where($map);
			$this->db->from($table);
			$res = $this->db->count_all_results();
		}else{
			$map['school_id'] = $school_id;
			$this->db->select($table.".*,"."jx_user.school_id");
			$this->db->where($map);
			$this->db->from($table);
			$this->db->join('jx_user','jx_user.id='.$table.'.user_id');
			$res = $this->db->count_all_results();
		}
		return $res;
	}


	public function update_reply_num($post_id,$type,$num){
		$table = get_post_table($type);
		$num = ($num==1) ? "+1":"-1";
		$sql = "update ".$table." set reply_num=reply_num".$num." where post_id=".$post_id ;
		$query = $this->db->query($sql);
		return !empty($query);
	}

	public function update_favorite_num($post_id,$type,$num){
		$table = get_post_table($type);
		$num = ($num==1) ? "+1":"-1";
		$sql = "update ".$table." set favorite_num=favorite_num".$num." where post_id=".$post_id ;
		$query = $this->db->query($sql);
		return !empty($query);
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