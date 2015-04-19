<?php
class Display extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->helper('url');
		$this->load->helper('array');
		$this->load->model('post_model');
		$this->load->model('favorites_model');
		$this->load->model('reply_model');
	}
	public function sell($area = 'school', $sort = 'time', $category1 = 'all', $category2 = 'all', $page = 1) {
		if ($area != 'global' && $area != 'school') {
			redirect('info/nopage');
		}
		if ($sort != 'time' && $sort != 'heat') {
			redirect('info/nopage');
		}
		if ($category1 == 'all') {
			$category1 = 0;
		}
		if ($category2 == 'all') {
			$category2 = -1;
		}
		if (!checkCategory($category1, $category2)) {
			redirect('info/nopage');
		}
		if (!(is_numeric($page) && is_int($page + 0)) || $page < 0) {
			redirect('info/nopage');
		}

		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}

		$this->assign('type', 'sell');
		$this->assign('another_type', 'buy');
		$this->assign('area', $area);
		if ($area == 'school') {
			$this->assign('another_area', 'global');
		} else {
			$this->assign('another_area', 'school');
		}
		$this->assign('sort', $sort);
		if ($sort == 'time') {
			$this->assign('another_sort', 'heat');
		} else {
			$this->assign('another_sort', 'time');
		}
		$this->assign('category1', $category1);
		$this->assign('category1_name', get_category1_name2($category1));
		$this->assign('category2', $category2);
		$this->assign('category2_name', get_category2_name($category2));

		$data = get_posts(0, $area, $sort, $category1, $category2, $page);
		$this->assign('total', $data['total']);
		$this->assign('page_num', $data['page_num']);
		$this->assign('cur_page', $data['cur_page']);
		$this->assign('post_num', $data['post_num']);
		$this->assign('posts', $data['posts']);

		$this->assign('nav_tab', 3);
		$this->assign('title', '今昔网-商品大厅');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'display/main.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}
	public function buy($area = 'school', $sort = 'time', $category1 = 'all', $category2 = 'all', $page = 1) {
		if ($area != 'global' && $area != 'school') {
			redirect('info/nopage');
		}
		if ($sort != 'time' && $sort != 'heat') {
			redirect('info/nopage');
		}
		if ($category1 == 'all') {
			$category1 = 0;
		}
		if ($category2 == 'all') {
			$category2 = -1;
		}
		if (!checkCategory($category1, $category2)) {
			redirect('info/nopage');
		}
		if (!(is_numeric($page) && is_int($page + 0)) || $page < 0) {
			redirect('info/nopage');
		}

		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}

		$this->assign('type', 'buy');
		$this->assign('another_type', 'sell');
		$this->assign('area', $area);
		if ($area == 'school') {
			$this->assign('another_area', 'global');
		} else {
			$this->assign('another_area', 'school');
		}
		$this->assign('sort', $sort);
		if ($sort == 'time') {
			$this->assign('another_sort', 'heat');
		} else {
			$this->assign('another_sort', 'time');
		}
		$this->assign('category1', $category1);
		$this->assign('category1_name', get_category1_name2($category1));
		$this->assign('category2', $category2);
		$this->assign('category2_name', get_category2_name($category2));
		$this->assign('page', $page);

		$data = get_posts(0, $area, $sort, $category1, $category2, $page);
		$this->assign('total', $data['total']);
		$this->assign('page_num', $data['page_num']);
		$this->assign('cur_page', $data['cur_page']);
		$this->assign('post_num', $data['post_num']);
		$this->assign('posts', $data['posts']);

		$this->assign('nav_tab', 3);
		$this->assign('title', '今昔网-商品大厅');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'display/main.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}
	public function textbook(){
		
	}
// +----------------------------------------------------------------------
// | 普通函数
// +----------------------------------------------------------------------


	//返回特定的一篇帖子在大厅展示的信息
	public function get_post_info($post_id, $type){

		$post = $this->post_model->get_post($post_id,$type,true);
		if(empty($post)) return null;

		$post['type'] = $type;
		$post['createat'] = format_time($post['createat']);
		$post['updateat'] = format_time($post['updateat']);

		$post['category1_name'] = get_category1_name($post['category1']);
		$post['category2_name'] = get_category2_name($post['category2']);
		$post['deal'] = get_deal_name($post['deal']);

		$hasimg = false;
		if(!empty($post['picture'])){
			$hasimg = true;
		}
		$post['title'] = get_title($type,$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
		$post['plain_title'] = get_plain_title($type,$post['deal'],$post['class'],$hasimg,$post['category1_name'],$post['category2_name'],$post['brand'],$post['model']);
		$post['favorite_num'] = $this->favorites_model->get_favorites_num($post_id,$type);
		$post['reply_num'] = $this->reply_model->get_reply_num($post_id,$type);
		unset($post['contactby']);
		return $post;
	}

	//返回大厅帖子
	//不给参数，默认返回卖家帖子，按照创建日期排序
	//给参数，$type,$category1,$category2分别表示对帖子进行筛选
	//$page分页
	//$keyword为关键词搜索
	public function get_posts($type=0,$category1=null,$category2=null,$page=3,$keyword=null){
		$data = array();
		if($type!=0&&$type!=1) return null;
		if(isset($keyword)){       //有关键词使用关键词进行搜索
			$data = $this->get_sphinx_result($keyword,$type,$category1,$category2,$page);
		}else{
			$res = $this->post_model->get_post_ids($type,$category1,$category2,$page);
			$total = $this->post_model->get_post_ids_total($type,$category1,$category2);
			$data['posts'] = array();
			$data['total'] = $total;
			foreach ($res as $key => $value) {
				$data['posts'][] = $this->get_post_info($value,$type);
			}
		}
		foreach ($data['posts'] as $key => $value) {
			$data['posts'][$key]['description'] = cutString($data['posts'][$key]['description']);
		}
		//var_dump($data);
		return $data;
	}

	//sphinx调用，用于搜索关键词（关键词的搜索范围为brand,model,description)
	//可以提供参数过滤，参数为type category1 category2 page为第几页的数据
	public function get_sphinx_result($keyword='',$type=null,$category1=null,$category2=null,$page=1){
		$this->load->library('sphinx_client', NULL, 'sphinx');
		$this->sphinx->SetServer ( '127.0.0.1', 9312);

		//以下设置用于返回数组形式的结果
		$this->sphinx->SetArrayResult ( true );
		if(isset($type)){  
			$this->sphinx->setFilter('type',array($type));
		}

		if(isset($category1)){
			$this->sphinx->setFilter('category1',array($category1));
		}
		if(isset($category2)){
			$this->sphinx->setFilter('category2',array($category2));
		}
		$this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "createat"); //按创建时间降序排列
		$num_per_page = $this->config->item("num_per_page");
		$this->sphinx->SetLimits($num_per_page*($page-1),$num_per_page);
		$res = $this->sphinx->Query($keyword,"*");
		$posts = array();
		$matches = $res['matches'];
		if(empty($matches)){
			$data['total'] = 0;
			$data['posts'] = null;
			return $data;
		}
		foreach ($matches as $key => $value) {
			$post_id = $value['id'];
			$type = $value['attrs']['type'];
			$temp_post = $this->get_post_info($post_id,$type,true);
			$posts[] = $temp_post;
		}
		$data['total'] = $res['total'];
		$data['posts'] = $posts;
		return $data;
	}
}