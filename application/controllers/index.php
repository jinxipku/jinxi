<?php
class Index extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
		$this->load->model("post_model");
	}
	public function index() {
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}
		
		$this->assign('digital', $this->get_six_from_category(1));
		$this->assign('book', $this->get_six_from_category(5));

		$this->assign('nav_tab', 1);
		$this->assign('title', '今昔网-主页');
		$this->assign('baseurl', base_url());
		$this->assign('is_index', true);
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'index/main.php' );
		$this->display ( 'index/side.php' );
		$this->display ( 'templates/footer.php' );
	}


	public function get_six_from_category($category1){
		$login_user =  $this->session->userdata('login_user');
		if(!empty($login_user)){            //如果已经登录，获取收藏贴的id
			$favorites = $this->post_model->get_favorite_id_type($login_user['id']);
		}

		$map['category1'] = $category1;
		$map['active'] = 1;
		$this->db->select("post_id,createat");
		$this->db->order_by("createat","desc");
		$this->db->where($map);
		$this->db->limit(6,0);
		$this->db->from("jx_seller_post");
		$seller_posts = $this->db->get()->result_array();
		

		$this->db->select("post_id,createat");
		$this->db->order_by("createat","desc");
		$this->db->where($map);
		$this->db->limit(6,0);
		$this->db->from("jx_buyer_post");
		$buyer_posts = $this->db->get()->result_array();

		$temp = array();
		foreach ($seller_posts as $key => $value) {
			$temp[$value['createat']]['post_id'] = $value['post_id'];
			$temp[$value['createat']]['post_type'] = 0;
		}

		foreach ($buyer_posts as $key => $value) {
			$temp[$value['createat']]['post_id'] = $value['post_id'];
			$temp[$value['createat']]['post_type'] = 1;
		}

		ksort($temp);
		$i = 0;
		$result = array();
		foreach ($temp as $key => $value) {
			$result[] = $this->post_model->get_post($value['post_id'],$value['post_type'],true);
			$i++;
			if($i>=6) break;
		}
		foreach ($result as $key => $value) {
			$result[$key]['description'] = cutString($result[$key]['description']);
			if(isset($favorites)&&in_array($result[$key]['post_id']."#".$result[$key]['type'], $favorites)){
				$result[$key]['has_collect'] = 1;
			}else $result[$key]['has_collect'] = 0;
		}
		return $result;
	}

	public function get_three_from_recommend(){
		$login_user =  $this->session->userdata('login_user');
		if(empty($login_user)){           
			return array();
		}
		$res = $this->post_model->get_user_recommend($login_user['id']);
		$posts = $res['posts'];
		if(count($posts)>3)
			array_slice($posts, 0, 3);
		return $posts;
	}
}