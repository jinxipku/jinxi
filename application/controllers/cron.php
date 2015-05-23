<?php
// +----------------------------------------------------------------------
// | Cron 定时脚本
// +----------------------------------------------------------------------
// | Author: JINXI
// +----------------------------------------------------------------------
// | date: 2015-5-23
// +----------------------------------------------------------------------
class Cron extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model("admin_model");
		$this->load->helper("directory");
	}

	public function do_daily(){
		$content[] = "脚本执行时间：".date('Y-m-d H:i:s',time());
		$user_info = $this->admin_model->get_user_info();
		$content[] = "总注册用户数量：".$user_info['total'];
		$content[] = "今日登陆用户：".$user_info['today_total'];
		//TODO:删除二维码
		$files = directory_map("img/qrcode");
		$count = 0;
		foreach ($files as $key => $value) {
			$createtime = substr($value,strpos($value,"_")+1, strpos($value,".")-strpos($value,"_")-1);
			if(is_numeric($createtime)&&time()-$createtime > 86400*3){ //删除三天前的
				unlink("img/qrcode/".$value);
				$count ++;
			}
		}
		$content[] = "删除三天前二维码数量：".$count;
		$this->_sendOneEmail("443021181@qq.com",$content);
	}

	public function test(){
		$str = "4_123123.png";
		echo strpos($str,"_");
		echo strpos($str,".");
		echo substr($str, 2);
	}


	private function _sendOneEmail( $email,$info ){
		$this->load->library ( 'email' );
		// 设置Email参数
		$config ['protocol'] = 'smtp';
		$config ['smtp_host'] = 'smtp.163.com';
		$config ['smtp_user'] = 'jinxicn2013';
		$config ['smtp_pass'] = 'jinxicn';
		$config ['smtp_port'] = '25';
		$config ['charset'] = 'utf-8';
		$config ['wordwrap'] = TRUE;
		$config ['mailtype'] = 'html';
		$this->email->initialize ( $config );
		$content = "";
		foreach ($info as $key => $value) {
			$content = $content . $value . "<br/>";
		}

		$this->email->from ( 'jinxicn2013@163.com', '今昔网' );
		$this->email->to ( $email );
		$this->email->subject ( '每日定时脚本执行情况' );
		$this->email->message ( $content );
		
		$this->email->send ();
	}

}