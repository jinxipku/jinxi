<?php
// +----------------------------------------------------------------------
// | Info 信息
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-4-1
// +----------------------------------------------------------------------
class Info extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'post_model' );
		$this->load->model ( 'reminder_model' );
		$this->load->helper('url');
		$this->load->helper('array');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------
	public function reminder() {
		$login_user =  $this->session->userdata('login_user');
		if (empty($login_user)) {
			return null;
		}
		$data = $this->reminder_model->get_user_reminder($login_user['id']);
		$cnt = count($data);
		$this->assign('cnt', $cnt);
		$this->assign('data', $data);
		$this->assign('baseurl', base_url());
		$this->display ( 'info/reminder.php' );
	}

	public function nopage() {
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}
		$this->assign('nav_tab', 0);
		$this->assign('title', '今昔网-错误');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		
		$this->display ( 'templates/header.php' );
		$this->display ( 'info/show404.php' );
		$this->display ( 'templates/smallside.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function about($about_part = "none"){
		if ($about_part != "none" && $about_part != "contact" && $about_part != "history" && $about_part != "suggest") {
			redirect('info/nopage');
		}
		$this->assign('about_part', $about_part);
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}

		$this->assign('nav_tab', 4);
		$this->assign('title', '今昔网-关于');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());
		$this->assign("about_us",about_us());

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

		$this->display ( 'templates/header.php' );
		$this->display ( 'info/about.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function help(){
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}

		$this->assign('nav_tab', 5);
		$this->assign('title', '今昔网-帮助');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

		$this->display ( 'templates/header.php' );
		$this->display ( 'info/help.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}

	public function agreement(){
		$login_user =  $this->session->userdata('login_user');
		if (!empty($login_user)) {
			$this->assign('login_user', $login_user);
		}

		$this->assign('nav_tab', 0);
		$this->assign('title', '今昔网-协议');
		$this->assign('baseurl', base_url());
		$this->assign('tips', show_tips());

		$hotest = $this->post_model->get_hotest_post($login_user['id']);
		$newest = $this->post_model->get_newest_post($login_user['id']);
		$random = $this->post_model->get_random_post();
		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
		$this->assign('random', $random);

		$this->display ( 'templates/header.php' );
		$this->display ( 'info/agreement.php' );
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

		$data = $_POST['search_key'];
		$this->assign('search_key', $data);

		$this->display ( 'templates/header.php' );
		$this->display ( 'info/search.php' );
		$this->display ( 'templates/side.php' );
		$this->display ( 'templates/footer.php' );
	}

	//ajax接口
	//post参数 content
	public function add_advice(){
		$login_user =  $this->session->userdata('login_user');
		if(empty($login_user)) $user_id = 0;
		else $user_id = $login_user['id'];
		$content = $_POST['content'];
		$this->load->model("advice_model");
		$res = $this->advice_model->add_advice($content,$user_id);
		$status = $res?1:0;
		$this->ajaxReturn(null,"",$status);
	}

}