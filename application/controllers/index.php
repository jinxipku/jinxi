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
		//var_dump($result);exit;
		return $result;
	}
}