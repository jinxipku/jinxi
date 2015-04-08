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
		echo genFileName(2,'',2222222);
	}

	public function testPost(){
		// for($i=0;$i<10;$i++){
		// 	$data = array(
		// 		"user_id"=>1,
		// 		"category1"=>1,
		// 		"category2"=>1,
		// 		"class"=>1,
		// 		"createat"=>time(),
		// 		"updateat"=>time(),
		// 		);
		// 	$this->db->insert ( 'jx_buyer_post', $data );
		// }
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
}
?>