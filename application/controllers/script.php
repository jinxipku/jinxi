<?php
// +----------------------------------------------------------------------
// | 一次性脚本
// +----------------------------------------------------------------------
// | Author: cuida
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class Script extends MY_Controller {
	public function __construct() {
		parent::__construct ();
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

	public function test(){
		$this->load->model("account_model");
		$this->account_model->regidit("1000012887@pku.edu.cn",'123456',1002);
	}
}
?>