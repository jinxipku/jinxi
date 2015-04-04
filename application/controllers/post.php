<?php
// +----------------------------------------------------------------------
// | Post 用户帖子相关
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-4-1
// +----------------------------------------------------------------------
class Post extends MY_Controller {

	protected $temp_imagepath = 'img/temp/';
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'account_model' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'post_model' );
		$this->load->helper('url');
	}

// +----------------------------------------------------------------------
// | 前台页面跳转
// +----------------------------------------------------------------------
	public function newpost() {
		$login_user =  $this->session->userdata('login_user');	
		if(empty($login_user)) {
			$this->session->set_userdata('mem_url', base_url('post/new'));
			redirect('account/loginfo/redirect');
		}
	}

// +----------------------------------------------------------------------
// | 普通函数
// +----------------------------------------------------------------------

	public function getapost($post_id, $type){
		return $this->post_model->get_post($post_id,$type);
	}

	public function makebuypost(){

	}

	public function makesellerpost(){

	}

	public function mobilepush(){
		//$this->assign('baseurl', base_url());
		$key = $this->config->item('verify_pkey');
		$code = $_GET["code"];
		$decode = $this->encrypt->decode($code,$key);

		$this->assign("test",$decode);
		$this->assign('baseurl', base_url());
		$this->display ( 'mobile/upload.php' );
	}

	public function mobile_upload(){
		echo 'c';
	}

	//点击生成二维码的操作
	//生成二维码函数
	//参数$post_id
	//链接为http://今昔.cn//post//uploadpicture?code=XXXXX
	public function getQRCode(){
		$folder = "1@".time();

		require_once APPPATH.'/libraries/phpqrcode/phpqrcode.php';

		$key = $this->config->item('verify_pkey');
		$code = $this->encrypt->encode( $folder, $key);

		$value = 'http://192.168.6.230/jinxi/jinxi/post/mobilepush?code='.urlencode($code);
		echo "<a href='$value' >lianjie</a>";
		$errorCorrectionLevel = 'L';//容错级别 
		$matrixPointSize = 6;//生成图片大小 
		
		$qrfile = 'img/qrcode/'.$folder.'.png';
		QRcode::png($value, $qrfile, $errorCorrectionLevel, $matrixPointSize, 2);

		//创建文件夹
		if(!file_exists($this->temp_imagepath.$folder)){
			mkdir($this->temp_imagepath.$folder);
		}
		//TODO:替换为ajax返回参数形式
		echo '<img src="http://'.base_url($qrfile).'">';   
	}

// +----------------------------------------------------------------------
// | 以下为ajax接口
// +----------------------------------------------------------------------
	
	//返回某用户发表的帖子（卖，买，买卖） 
	//param mode 0同时返回  1返回卖东西的帖子  2返回买东西的帖子
	//param user_id 不写则使用当前用户 写则使用提供的id
	public function getuserposts(){
		$mode = $_POST['mode'];
		$login_user =  $this->session->userdata('login_user');
		$user_id = isset($_POST['user_id'])? $_POST['user_id']: $login_user['id'];
		switch ($mode) {
			case '0':
				$data['buy'] = $this->post_model->get_buyer_post($user_id);
				$data['sell'] = $this->post_model->get_seller_post($user_id);
				break;
			case '1':
				$data['sell'] = $this->post_model->get_seller_post($user_id);
				break;
			case '2':
				$data['buy'] =$this->post_model->get_buyer_post($user_id);
			default:
				$this->ajaxReturn(null,'参数错误',0);
				break;
		}
		$this->ajaxReturn($data,'',1);
	}

	//返回收藏贴


// +----------------------------------------------------------------------
// | 私有函数
// +----------------------------------------------------------------------

}