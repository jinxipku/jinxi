<?php
class user_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->helper('date');
	}

	public function get_info($user_id,$info_type="none"){
		$sql = "select jx_user.*,jx_account.email as register_email,jx_account.logins,jx_account.is_verified,jx_school_info.school_name,jx_school_info.school_region from jx_user left join jx_account on jx_account.id=jx_user.id left join jx_school_info on jx_school_info.school_id=jx_user.school_id where jx_user.id=".$user_id;
		$query = $this->db->query($sql);
		$user = $query->row_array ();	
		if(empty($user)) return null;
		$user['level'] = get_level($user['points']);
		$user['sex'] = get_sex($user['sex']);
		$user['nick_color'] = get_namecolor($user['nick_color']);
		$user['signature'] = parse_tag($user['signature']);
		$user['type'] = get_user_type($user['type']);
		$user['year'] = empty($user['year'])? 0:$user['year'];

		if($info_type=="message") return $user;

		$this->db->where('lovee', $user['id']);
		$this->db->from('jx_love');
		$user['lovers'] = $this->db->count_all_results();
		
		$user['post_number'] = 0;
		$this->db->where("user_id",$user['id']);
		$this->db->from('jx_seller_post');
		$user['post_number'] += $this->db->count_all_results();
		$this->db->where("user_id",$user['id']);
		$this->db->from('jx_buyer_post');
		$user['post_number'] += $this->db->count_all_results();

		$user['active_post_number'] = 0;
		$this->db->where("user_id",$user['id']);
		$this->db->where("active",1);
		$this->db->from('jx_seller_post');
		$user['active_post_number'] += $this->db->count_all_results();
		$this->db->where("user_id",$user['id']);
		$this->db->where("active",1);
		$this->db->from('jx_buyer_post');
		$user['active_post_number'] += $this->db->count_all_results();

		$user['visits'] = $this->get_visit_num($user_id);

		if($info_type=="profile"){  //需要返回最新一篇帖子
			$map['user_id'] = $user['id'];
			$map['active'] = 1;

			$this->db->order_by("createat","desc");
			$this->db->where($map);
			$query = $this->db->get("jx_seller_post");
			$newest_seller_post = $query->row_array();

			$this->db->order_by("createat","desc");
			$this->db->where($map);
			$query = $this->db->get("jx_buyer_post");
			$newest_buyer_post = $query->row_array();

			$post = null;
			if(!empty($newest_buyer_post)&&!empty($newest_seller_post)){
				$post = $newest_buyer_post;
				$post['type'] = 1;
				if($newest_seller_post['createat']>$newest_buyer_post['createat']){
					$post = $newest_seller_post;
					$post['type'] = 0;
				}
			}else if(empty($newest_seller_post)&&!empty($newest_buyer_post)){
				$post = $newest_buyer_post;
				$post['type'] = 1;
			}else if(empty($newest_buyer_post)&&!empty($newest_seller_post)){
				$post = $newest_seller_post;
				$post['type'] = 0;
			}
			if(empty($post)) $user['newest_post'] = null;
			else{
				$post['category1_name'] = get_category1_name2($post['category1']);
				$post['category2_name'] = get_category2_name($post['category2']);
				$post['deal'] = get_deal_name($post['deal'],$post['type']);
				$post['createat'] = format_time($post['createat']);
				$hasimg = false;
				if(!empty($post['picture'])){
					$hasimg = true;
				}else $post['picture'] = array();
				$post['title'] = get_title($post['type'],$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
				$post['plain_title'] = get_plain_title($post['type'],$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);			
				$user['newest_post'] = $post;
			}
		}
		return $user;
	}

	//TODO:根据公开等字段返回相应的信息，当前为全部返回
	public function get_contact($user_id){
		$this->db->select('email, qq, phone, weixin');
		$query = $this->db->get('jx_user',array("id"=>$user_id));
		$user = $query->row_array ();
		if(empty($user)) return null;
		return $user;
	}

	public function update_info($user_id, $info){
		$this->db->where("id",$user_id);
		$res = $this->db->update("jx_user",$info);
		return $res;
	}

	public function addpoints($user_id,$points){
		$sql = "update jx_user set points=points+".$points." where id=".$user_id ;
		$query = $this->db->query($sql);
		return !empty($query);
	}

	public function visit($visitor,$visitee){
		$map['visitor'] = $visitor;
		$map['visitee'] = $visitee;
		$this->db->where($map);
		$this->db->from("jx_visit");
		$res = $this->db->count_all_results();
		if($res==0){
			return $this->db->insert("jx_visit",$map);
		}
		return false;
	}

	public function get_visit_num($id){
		$map['visitee'] = $id;
		$this->db->where($map);
		$this->db->from("jx_visit");
		$res = $this->db->count_all_results();
		return $res;
	}

	public function get_user_loves($id,$page){
		$map['lover'] = $id;
		$this->db->where($map);
		$this->db->from("jx_love");
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
		
		$this->db->select("lovee");
		$this->db->where($map);
		$this->db->limit($num_per_page,($page-1)*$num_per_page);
		$this->db->from("jx_love");

		$records = $this->db->get()->result_array();

		$users = array();
		foreach ($records as $key => $value) {
			$user = $this->get_info($value['lovee'],'profile');
			$users[] = $user;
		}
		$data['total'] = $total;
		$data['posts'] = $users;
		$data['post_num'] = count($users);
		$data['page_num'] = $page_num;
		$data['cur_page'] = $page;
		return $data;

	}
}