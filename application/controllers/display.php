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
		} else if($area == 'school') {
			if (strpos($_SERVER['PHP_SELF'], 'school') > -1) {
				redirect(str_replace("school", "global", $_SERVER['PHP_SELF']));
			}
			$area = 'global';
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
		$this->assign('page', $page);

		$data = $this->get_posts(0, $area, $sort, $category1, $category2, $page);
		$this->assign('total', $data['total']);
		$this->assign('page_num', $data['page_num']);
		$this->assign('cur_page', $data['cur_page']);
		$this->assign('post_num', $data['post_num']);
		$this->assign('posts', $data['posts']);

		if ($data['page_num'] > 0) {
			$this->assign('st_page', floor(($data['cur_page'] - 1) / 10) * 10 + 1);
			$end_page = floor(($data['cur_page'] - 1) / 10 + 1) * 10;
			if ($end_page > $data['page_num'])
				$end_page = $data['page_num'];
			$this->assign('ed_page', $end_page);
		}

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

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
		} else if($area == 'school') {
			if (strpos($_SERVER['PHP_SELF'], 'school') > -1) {
				redirect(str_replace("school", "global", $_SERVER['PHP_SELF']));
			}
			$area = 'global';
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

		$data = $this->get_posts(1, $area, $sort, $category1, $category2, $page);
		$this->assign('total', $data['total']);
		$this->assign('page_num', $data['page_num']);
		$this->assign('cur_page', $data['cur_page']);
		$this->assign('post_num', $data['post_num']);
		$this->assign('posts', $data['posts']);

		if ($data['page_num'] > 0) {
			$this->assign('st_page', floor(($data['cur_page'] - 1) / 10) * 10 + 1);
			$end_page = floor(($data['cur_page'] - 1) / 10 + 1) * 10;
			if ($end_page > $data['page_num'])
				$end_page = $data['page_num'];
			$this->assign('ed_page', $end_page);
		}

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

		$this->assign('nav_tab', 3);
		$this->assign('title', '今昔网-商品大厅');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'display/main.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function search(){
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}
		$this->assign('nav_tab', 0);
		$this->assign('title', '今昔网-搜索');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

		$keyword = "无";
		if (isset($_POST['search_key'])) {
			$keyword = $_POST['search_key'];
		}

		$search_page = 1;
		if (isset($_POST['search_page'])) {
			$search_page = $_POST['search_page'];
		}
		
		$data = $this->get_posts(null,null,null,null,null,$search_page,$keyword);


		$this->assign('total', $data['total']);
		$this->assign('page_num', $data['page_num']);
		$this->assign('cur_page', $data['cur_page']);
		$this->assign('post_num', $data['post_num']);
		$this->assign('posts', $data['posts']);

		if ($data['page_num'] > 0) {
			$this->assign('st_page', floor(($data['cur_page'] - 1) / 10) * 10 + 1);
			$end_page = floor(($data['cur_page'] - 1) / 10 + 1) * 10;
			if ($end_page > $data['page_num'])
				$end_page = $data['page_num'];
			$this->assign('ed_page', $end_page);
		}
		$this->assign('keyword', $keyword);

		$this->display ( 'templates/header.php' );
		$this->display ( 'info/search.php' );
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
		return $post;
	}

	//返回大厅帖子
	//不给参数，默认返回卖家帖子，按照创建日期排序
	//给参数，$type,$category1,$category2分别表示对帖子进行筛选
	//$page分页
	//$keyword为关键词搜索
	//($type, $area, $sort, $category1, $category2, $page);
	//sort  time heat
	//area school global
	//type 0卖  1买
	public function get_posts($type=0,$area='school',$sort='time',$category1=0,$category2=-1,$page=1,$keyword=null){
		$data = array();
		$login_user =  $this->session->userdata('login_user');

		$school_id = null;
		if(!empty($login_user)&&$area=='school'){
			$school_id = $login_user['school_id'];//当前用户学校
		}
		
		$num_per_page = $this->config->item("num_per_page");
		if($type!=0&&$type!=1) return null;

		if(!empty($login_user)){            //如果已经登录，获取收藏贴的id
			$favorite_ids = $this->favorites_model->get_favorite_ids($login_user['id'],$type);
		}
		
		//有关键词使用关键词进行搜索---sphinx排序和area
		//type没有值表示都返回
		if(isset($keyword)){      
			$data = $this->get_sphinx_result($keyword,$type,$category1,$category2,$page);
		}else{
			$total = $this->post_model->get_post_ids_total($type,$school_id,$category1,$category2);
			$data['total'] = $total;
			if($total==0){
				$data['posts'] = array();
			}else{
				$page_num = intval(ceil($data['total']/$num_per_page));
				$page = $page%$page_num;
				$page = ($page==0)? $page_num : $page;
				$res = $this->post_model->get_post_ids($type,$school_id,$category1,$category2,$page,$sort);
				$data['posts'] = array();
				
				foreach ($res as $key => $value) {
					$data['posts'][] = $this->get_post_info($value,$type);
				}
			}
			$data['post_num'] = count($data['posts']);
			$data['page_num'] = intval(ceil($data['total']/$num_per_page));
			$data['cur_page'] = $page;
			
		}
		foreach ($data['posts'] as $key => $value) {
			$data['posts'][$key]['description'] = cutString($data['posts'][$key]['description']);
			if(isset($favorite_ids)&&in_array($data['posts'][$key]['post_id'], $favorite_ids)){
				$data['posts'][$key]['has_collect'] = 1;
			}else $data['posts'][$key]['has_collect'] = 0;
		}
		
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';

		return $data;
	}

	//sphinx调用，用于搜索关键词（关键词的搜索范围为brand,model,description)
	//可以提供参数过滤，参数为type category1 category2 page为第几页的数据
	public function get_sphinx_result($keyword='',$type=null,$category1=null,$category2=null,$page=1){
		$this->load->library('sphinx_client', NULL, 'sphinx');
		$this->sphinx->SetServer ( '127.0.0.1', 9312);
		$keyword = urldecode($keyword);//decode url
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
		//$this->sphinx->SetMatchMode(SPH_MATCH_ANY);
		$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
		$this->sphinx->SetFieldWeights(array('brand' => 10, 'model' => 10, 'description' => 4));
		$this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "createat"); //按创建时间降序排列
		$num_per_page = $this->config->item("num_per_page");
		//$this->sphinx->SetLimits($num_per_page*($page-1),$num_per_page);
		$this->sphinx->SetLimits(0,1000);

		$res = $this->sphinx->Query($keyword,"*");

		if(empty($res)||empty($res['matches'])){
			$data['total'] = 0;
			$data['posts'] = array();
			$data['post_num'] = 0;
			$data['page_num'] = 0;
			$data['cur_page'] = 0;			
			return $data;
		}
		$posts = array();
		$matches = $res['matches'];

		$total = count($matches);

		$page_num = intval(ceil($total/$num_per_page));
		$page = $page%$page_num;
		$page = ($page==0)? $page_num : $page;

		$offset1 = ($page-1)*$num_per_page;
		$offset2 = $page*$num_per_page;
		$i = 0;
		foreach ($matches as $key => $value) {
			if($i>=$offset1&&$i<$offset2){
				$post_id = $value['id'];
				$type = $value['attrs']['type'];
				$temp_post = $this->get_post_info($post_id,$type,true);
				$posts[] = $temp_post;
			}
			$i++;
		}
		$data['total'] = $total;
		$data['posts'] = $posts;
		$data['cur_page'] = $page;
		$data['page_num'] = $page_num;
		$data['post_num'] = count($posts);
		return $data;
	}

}