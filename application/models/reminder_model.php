<?php
class reminder_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->helper("url");
	}

/*
提醒表结构  id type to_user_id from_user_id post_id post_type reply_id createat content is_read
提醒包括：
类型：
	收藏贴被更新(type=1) 你收藏的帖子《xxx》有了更新
	发的贴被回复(type=2) 你发表的求购帖《xxx》收到来自今昔兔的回复：“楼主东西不错，求个......”
	回复被回复(type=3)   今昔兔回复了你在帖子《xxx》的评论：“楼主是傻逼，你觉得呢？”
	接受到私信(type=4)   你收到了一条来自今昔兔的私信：“求微信联系方式”
	关注的人发贴(type=5) 你关注的今昔兔发了求购贴：“[求购] 日用百货 > 个人乐器 : 篮球”
	收藏贴被开关(type=6)  你收藏的帖子《xxx》被楼主关闭了
*/

	//info
	public function add_reminder($info){
		$res = $this->db->insert("jx_favorites",$info);
		return $res;
	}

	public function get_user_reminder($user_id){
		$map['to_user_id'] = $user_id;
		$map['is_read'] = 0;
		$this->db->where($map);
		$this->db->from("jx_reminder");
		$res = $this->db->get()->result_array();
		$reminders = array();
		foreach ($res as $key => $value) {
			$temp = $this->format_reminder($value);
			$reminders[] = $temp;
		}
		var_dump($reminders);
	}

	public function format_reminder($reminder){
		$url = '';
		$content = '';
		$result['createat'] = format_time($reminder['createat']);
		switch ($reminder['type']) {
			case '1':
				$type = ($reminder['post_type']==0)?"sell":"buy";
				$url = base_url("post/viewpost/$type/".$reminder['post_id']);
				$content = "你收藏的帖子《".$this->get_post_title($reminder['post_id'],$reminder['post_type'])."》有了更新";
				
				break;
			
			default:
				# code...
				break;
		}
		$result['url'] = $url;
		$result['content'] = $content;
		return $result;

	}

	public function get_post_title($post_id,$type){
		$table = get_post_table($type);
		$query = $this->db->get_where($table, array('post_id' => $post_id));
		$res = $query->row_array();

		$res['category1_name'] = get_category1_name2($res['category1']);
		$res['category2_name'] = get_category2_name($res['category2']);
		$res['deal'] = get_deal_name($res['deal']);

		$hasimg = false;
		if(!empty($res['picture'])){
			$hasimg = true;
		}
		$res['plain_title'] = get_plain_title($type,$res['deal'],$res['class'],$hasimg,$res['category1_name'],$res['category2_name'],$res['brand'],$res['model']);
		$res['plain_title'] = cutString($res['plain_title'],20);
		return $res['plain_title'];
	}

	public function post_update($post_id,$post_type){
		$map['post_id'] = $post_id;
		$map['type'] = $post_type;
		$this->db->where($map);
		$this->db->from("jx_favorites");
		$res = $this->db->get()->result_array();
		$batch = array();
		$time = time();
		foreach ($res as $key => $value) {
			$temp['to_user_id'] = $value['user_id'];
			$temp['post_id'] = $post_id;
			$temp['post_type'] = $post_type;
			$temp['type'] = 1;
			$temp['createat'] = $time;
			$batch[] = $temp;
		}
		$res = $this->db->insert_batch('jx_reminder', $batch); 
		return $res;
	}

}
?>