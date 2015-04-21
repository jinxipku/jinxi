<?php
class post_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->model("user_model");
		$this->load->helper('url');
	}


	public function insert_post($info, $type){
		$table = get_post_table($type);
		$res = $this->db->insert($table, $info); 
		if( $res ){
			$post_id =  $this->db->insert_id();//post id
			$res3 = $this->user_model->addpoints($info['user_id'],$this->config->item("post_bonus"));
			return $post_id;
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
		if($type==0){
			$picture = unserialize($res['picture']);
			if(is_array($picture)){
				foreach ($picture as $key => $value) {
					$picture[$key]['thumb_picture_url'] = get_thumb($value['picture_url']);
				}
			}
			
			$res['picture'] = $picture;
		}
		

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


	//返回某个用户发的某一页的帖子
	public function get_user_posts($user_id, $login_user_id=null, $page=1){
		$sql = "select post_id from jx_seller_post where user_id=".$user_id." union all select post_id from jx_buyer_post where user_id=".$user_id;
		$query = $this->db->query($sql);
		$total = $query->num_rows();

		if($total==0){
			$data['total'] = 0;
			$data['posts'] = array();
			$data['post_num'] = 0;
			$data['page_num'] = 0;
			$data['cur_page'] = 0;
			return $data;
		}
		if($login_user_id!=null){
			$my_favorites = $this->get_favorite_id_type($login_user_id);
		}

		$num_per_page = $this->config->item("num_per_page2");

		$page_num = intval(ceil($total/$num_per_page));
		$page = $page%$page_num;
		$page = ($page==0)? $page_num : $page;

		$length = $num_per_page;
		$offset = ($page-1)*$num_per_page;
		$sql = "select post_id,0 as type,createat from jx_seller_post where user_id=".$user_id." union all select post_id,1 as type,createat from jx_buyer_post where user_id=".$user_id." order by createat limit $offset,$length";
		
		$query = $this->db->query($sql);
		$records = $query->result_array();
		$posts = array();//结果数组
		foreach ($records as $key => $value) {
			$post = $this->get_post($value['post_id'],$value['type'],true);
			if(empty($post)) continue;

			$post['type'] = $value['type'];
			$post['createat'] = format_time($post['createat']);
			$post['updateat'] = format_time($post['updateat']);

			$post['category1_name'] = get_category1_name2($post['category1']);
			$post['category2_name'] = get_category2_name($post['category2']);
			$post['deal'] = get_deal_name($post['deal']);

			$hasimg = false;
			if(!empty($post['picture'])){
				$hasimg = true;
				$post['picture'] = $post['picture'][$post['first_picture']]['thumb_picture_url'];
			}else{
				$post['picture'] = base_url("img/post/".($post['category2']+1).".png");
			}
			$post['title'] = get_title($value['type'],$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
			$post['plain_title'] = get_plain_title($value['type'],$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
			unset($post['contactby']);
			if(isset($my_favorites)&&in_array($value['post_id']."#".$value['type'], $my_favorites)){
				$post['has_collect'] = 1;
			}else $post['has_collect'] = 0;
			$posts[] = $post;
		}
		$data['total'] = $total;
		$data['posts'] = $posts;
		$data['post_num'] = count($data['posts']);
		$data['page_num'] = intval(ceil($data['total']/$num_per_page));
		$data['cur_page'] = $page;
		return $data;
	}

	public function get_favorite_id_type($user_id){
		$map = array();
		$map['user_id'] = $user_id;
		$this->db->select('post_id,type');
		$query = $this->db->get_where('jx_favorites', $map);

		$res = $query->result_array();
		$result = array();
		foreach ($res as $key => $value) {
			$result[] = $value['post_id']."#".$value['type'];
		}
		return $result;
	}

	public function get_user_favorites($user_id,$page=1){
		$map['user_id'] = $user_id;
		$this->db->where($map);
		$this->db->from("jx_favorites");
		$total = $this->db->count_all_results();

		if($total==0){
			$data['total'] = 0;
			$data['posts'] = array();
			$data['post_num'] = 0;
			$data['page_num'] = 0;
			$data['cur_page'] = 0;
			return $data;
		}
		$num_per_page = $this->config->item("num_per_page2");
		$page_num = intval(ceil($total/$num_per_page));
		$page = $page%$page_num;
		$page = ($page==0)? $page_num : $page;

		$this->db->select("post_id,type");
		$this->db->limit($num_per_page,($page-1)*$num_per_page);
		$this->db->from("jx_favorites");
		$this->db->order_by("addat","desc");
		$this->db->where($map);
		$records = $this->db->get()->result_array();
		$posts = array();//结果数组
		foreach ($records as $key => $value) {
			$post = $this->get_post($value['post_id'],$value['type'],true);
			if(empty($post)) continue;

			$post['type'] = $value['type'];
			$post['createat'] = format_time($post['createat']);
			$post['updateat'] = format_time($post['updateat']);

			$post['category1_name'] = get_category1_name2($post['category1']);
			$post['category2_name'] = get_category2_name($post['category2']);
			$post['deal'] = get_deal_name($post['deal']);

			$hasimg = false;
			if(!empty($post['picture'])){
				$hasimg = true;
				$post['picture'] = $post['picture'][$post['first_picture']]['thumb_picture_url'];
			}else{
				$post['picture'] = base_url("img/post/".($post['category2']+1).".png");
			}
			$post['title'] = get_title($value['type'],$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
			$post['plain_title'] = get_plain_title($value['type'],$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
			$post['has_collect'] = 1;
			unset($post['contactby']);
			$posts[] = $post;
		}
		$data['total'] = $total;
		$data['posts'] = $posts;
		$data['post_num'] = count($data['posts']);
		$data['page_num'] = intval(ceil($data['total']/$num_per_page));
		$data['cur_page'] = $page;
		return $data;
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
			$this->db->select("(3*(createat-unix_timestamp())/86400+reply_num*4+favorite_num*5) as heat");
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