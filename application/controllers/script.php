<?php
// +----------------------------------------------------------------------
// | 一次性脚本
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class Script extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model("user_model");
		$this->load->model("post_model");
		$this->load->model("reply_model");
		$this->load->model("admin_model");
		$this->load->model("favorites_model");
		$this->load->database();
	}

	public function object_array($array){
		if(is_object($array)){
			$array = (array)$array;
		}
		if(is_array($array)){
			foreach($array as $key=>$value){
				$array[$key] = $this->object_array($value);
			}
		}
		return $array;
	} 

	public function convertSchoolFromJS(){
		$jsurl = './js/school.js';
		$jsfile = fopen($jsurl,"r");
		$content = fread($jsfile,filesize($jsurl));
		$cont = explode("=", $content);
		$obj = $this->object_array(json_decode($cont[1])); //将stdclass转化为array
		//print_r($obj);
		//var_dump($obj);
		foreach ($obj as $key => $v) {
			// echo $v['id'].'<br>';
			$region = $v['name'];
			foreach ($v['school'] as $k => $value) {
				$data['school_id'] = $value['id'];
				$data['school_name'] = $value['name'];
				$data['school_region'] = $v['name'];
				$this->db->insert('jx_school_info',$data);
			}
		}
	}

	public function testSession(){
		$c=$this->session->userdata('login_user');
		var_dump($c);

		$d = $this->session->all_userdata();
		var_dump($d);
	}
	public function testContact(){
		$this->load->model("user_model");
		$user = $this->user_model->get_contact(1);
		var_dump($user);
	}

	public function test(){
		//echo genFileName(2,'',2222222);
		$user = $this->user_model->get_info(1);
		$this->session->set_userdata('login_user',$user);
		var_dump($user);	
	}

	public function testPost(){
		$this->load->model("post_model");
		$res = $this->post_model->get_buyer_post(1);
		var_dump($res);
	}

	public function testfavorites(){
		$this->load->model("favorites_model");
		// $res = $this->favorites_model->get_favorites(2,0);
		// var_dump($res);
		// $res = $this->favorites_model->delete_favorites(2,13,1);
		// var_dump($res);
		// $res = $this->favorites_model->favorites_count(15,1);
		// var_dump($res);
		$res = $this->favorites_model->is_favorite(2,1,0);
		var_dump($res);
	}

	public function testMars(){
		$c = turnToMars("0123456789");
		var_dump($c);
	}

	public function testHelper(){
		$picture = "http://wwww.baidu.com/picture/2/123142132.jpg";
		echo get_thumb($picture);
	}

	public function testUserpost(){
		$user_id = 2;
		$type = 0;
		$res = $this->post_model->get_user_posts($user_id,$type);
		var_dump($res);
		foreach ($res as $key => $value) {
			print_r($value['picture']);
			echo '<br>';
		}
	}
	public function getpost(){
		$post_id = 2;
		$type = 0;
		$res = $this->post_model->get_post($post_id,$type);
		var_dump($res);
	}

	public function testreply(){
		$post_id = 2;
		$type = 0;
		$res = $this->reply_model->get_reply($post_id,$type);
		$floor = array();
		foreach ($res as $key => $value) {
			$floor[$value['floor']][] = $value;
		}
		var_dump($floor);
		//var_dump($res);
	}

	public function test_add_reply(){
		$reply = array();
		$reply['post_id'] = 8;
		$reply['type'] = 0;
		$reply['reply_to_floor'] = 2;
		$reply['content'] = '这个东西真好wa！';
		$reply['reply_from'] = 1;
		$res = $this->reply_model->add_reply($reply);
		var_dump($res);
	}

	public function test_sphinx(){
		$this->load->library('sphinx_client', NULL, 'sphinx');
		$this->sphinx->SetServer ( '127.0.0.1', 9312);

//以下设置用于返回数组形式的结果

$this->sphinx->SetArrayResult ( true );
//$this->sphinx->SetIDRange(3,4);
//$this->sphinx->setFilter('group_id',array(2));
$res = $this->sphinx->Query("iphone","*");
echo '<pre>';


print_r($res);


echo '</pre>';

	}
	public function test_checkcat(){
		var_dump( checkCategory(45,44) );
	}
	public function test_admin(){

	}

	public function test_post_model(){
		 $res = $this->post_model->get_post_ids(0,1002,null,null,1,'heat');
		 var_dump($res);
		//echo now();
	}

	public function test_advice(){
		$content = '你们网站做的不错~个别地方需要改进，比如。。。。。';
		$user_id = 2;
		$this->load->model("advice_model");
		$this->advice_model->add_advice($content,$user_id);
	}

	public function test_get_favorite_ids(){
		$res = $this->favorites_model->get_favorite_ids(2,0);
		var_dump($res);
	}

	public function test_visit(){
		$this->user_model->visit(1,2);
		$tremp = $this->user_model->get_visit_num(2);
		var_dump($tremp);
	}

	//用于发一火车皮帖子
	public function auto_make_post(){
		$num = 200;
		$type = 0;//发转让贴
	
		for( $i=0; $i<$num;$i=$i+1){
			$post['user_id'] = rand(1,2);
			$class = rand(0,50);
			$post['category1'] = map_to_cat1($class);
			
			$post['category2'] = $class;
			$post['brand'] = "随机生成的brand";
			$post['model'] = "随机生成的model";
			$post['class'] = rand(0,4);
			$post['description'] = "随机生成的描述";
			$post['price'] = rand(0,9999);
			$post['deal'] = rand(1,4);
			$post['contactby'] = rand(0,4);
			$post['createat'] = rand(1000000,time());
			
			$this->post_model->insert_post($post, $type);
			//echo 'i';
		}

		$type = 1;//发求购贴
	
		for( $i=0; $i<$num;$i=$i+1){
			$post['user_id'] = rand(1,2);
			$class = rand(0,50);
			$post['category1'] = map_to_cat1($class);
			
			$post['category2'] = $class;
			$post['brand'] = "随机生成的brand";
			$post['model'] = "随机生成的model";
			$post['class'] = rand(0,4);
			$post['description'] = "随机生成的描述";
			$post['price'] = rand(0,9999);
			$post['deal'] = rand(1,4);
			$post['contactby'] = rand(0,4);
			$post['createat'] = rand(1000000,time());
			
			$this->post_model->insert_post($post, $type);
			//echo 'i';
		}
	}
}
?>