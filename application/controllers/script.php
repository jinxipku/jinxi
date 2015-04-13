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
	}
	public function testContact(){
		$this->load->model("user_model");
		$user = $this->user_model->get_contact(1);
		var_dump($user);
	}

	public function test(){
		//echo genFileName(2,'',2222222);
		//unlink(substr($value, strpos("img/",$value)));
		$value = "http://www.xn--wmqr18c.cn/img/picture/2/WQhVExwS2eTnZdMUh1428557031.jpg";
		$c = strpos($value,"img/");
		echo $c."<br>";
		echo substr($value, $c);
		//echo replaceall
		
	}

	public function testPost(){
		$this->load->model("post_model");
		$res = $this->post_model->get_buyer_post(1);
		var_dump($res);
	}

	public function testfavorites(){
		$this->load->model("favorites_model");
		$res = $this->favorites_model->get_favorites(2,0);
		var_dump($res);
		$res = $this->favorites_model->delete_favorites(2,13,1);
		var_dump($res);
		$res = $this->favorites_model->favorites_count(15,1);
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
		$post_id = 1;
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
}
?>