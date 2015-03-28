<?php
// +----------------------------------------------------------------------
// | 公共controller
// +----------------------------------------------------------------------
// | 包含一些预加载库的操作
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-2-9
// +----------------------------------------------------------------------
class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('common');
	}
    
    public function assign($key,$val) {
        $this->cismarty->assign($key,$val);
    }

    public function display($html) {
        $this->cismarty->display($html);
    }

	/**
     +----------------------------------------------------------
     * Ajax方式返回数据到客户端
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param mixed $data 要返回的数据
     * @param String $info 提示信息
     * @param boolean $status 返回状态
     * @param String $type ajax返回类型 JSON XML
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
	protected function ajaxReturn($data,$info='',$status=1,$type='JSON') {
        $result  =  array();
        $result['status']  =  $status;
        $result['info'] =  $info;
        $result['data'] = $data;
        
        if(strtoupper($type)=='JSON') {
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:text/html; charset=utf-8');
            exit(json_encode($result));
        }elseif(strtoupper($type)=='XML'){
            // 返回xml格式数据
            header('Content-Type:text/xml; charset=utf-8');
            exit(xml_encode($result));
        }elseif(strtoupper($type)=='EVAL'){
            // 返回可执行的js脚本
            header('Content-Type:text/html; charset=utf-8');
            exit($data);
        }else{
            // TODO 增加其它格式
        }
    }

}
?>