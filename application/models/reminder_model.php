<?php
class reminder_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->helper("url");
	}

/*
提醒表结构  id type to_user_id from_user_id post_id post_type reply_id createat content
提醒包括：
类型：
	收藏贴被更新(type=1) 你收藏的帖子《xxx》有了更新
	收藏贴被开关(type=2)  你收藏的帖子《xxx》被楼主关闭了
	发的贴被回复(type=3) 你发表的求购帖《xxx》收到来自今昔兔的回复：“楼主东西不错，求个......”
	回复被回复(type=4)   今昔兔回复了你在帖子《xxx》的评论：“楼主是傻逼，你觉得呢？”
	接受到私信(type=5)   你收到了一条来自今昔兔的私信：“求微信联系方式”
	关注的人发贴(type=6) 你关注的今昔兔发了求购贴：“[求购] 日用百货 > 个人乐器 : 篮球”
	
*/

	//info
	public function add_reminder($info){
		$res = $this->db->insert("jx_favorites",$info);
		return $res;
	}

	public function get_user_reminder($user_id){
		$map['to_user_id'] = $user_id;
		$this->db->select("jx_reminder.*,jx_user.nick,jx_user.nick_color,jx_user.thumb");
		$this->db->where($map);
		$this->db->from("jx_reminder");
		$this->db->join("jx_user","jx_user.id=jx_reminder.from_user_id","left");
		$res = $this->db->get()->result_array();
		$reminders = array();
		foreach ($res as $key => $value) {
			$temp = $this->format_reminder($value);
			$reminders[] = $temp;
		}
		//var_dump($reminders);
		return $reminders;
	}

	public function format_reminder($reminder){
		$url = '';
		$content = '';
		$result['createat'] = format_time($reminder['createat']);
		$result['type'] = $reminder['type'];
		if(!empty($reminder['from_user_id'])){
			$nick_color = get_namecolor($reminder['nick_color']);
			$from_user = "<span class='".$nick_color."'>".$reminder['nick']."</span>";
			$thumb = base_url("img/head".$reminder['thumb']);
		}
		switch ($reminder['type']) {
			case '1':
				$part1 = $from_user."更新了您收藏的帖子：";
				$info =  $this->get_post_info($reminder['post_id'],$reminder['post_type']);
				$part2 = $info['plain_title'];
				$part3 = $info['description'];
				break;
			case '2':
				$addon = ($reminder['extra']==1)?"打开":"关闭";
				$part1 = $from_user.$addon."了您收藏的帖子";
				$info =  $this->get_post_info($reminder['post_id'],$reminder['post_type']);
				$part2 = $info['plain_title'];
				$part3 = $info['description'];
				break;
			case '3':
				$addon = ($reminder['post_type']==1)?"求购贴":"转让贴";
				$info =  $this->get_post_info($reminder['post_id'],$reminder['post_type']);
				
				$part1 = $from_user."在您发表的".$addon."：".$info['plain_title'];
				$part2 = "中发布了新的回复";
				$part3 = cutString($reminder['content'],20);
				break;
			case '4':
				$info =  $this->get_post_info($reminder['post_id'],$reminder['post_type']);
				$part1 = $from_user."在帖子：".$info['plain_title'];
				$part2 = "回复了你";
				$part3 = cutString($reminder['content'],20);
				break;
			case '5':
				$part1 = $from_user;
				$part2 = "给您发了一条私信";
				$part3 = cutString($reminder['content'],20);
				break;
			case '6':
				$addon = ($reminder['post_type']==1)?"求购贴":"转让贴";
				$info =  $this->get_post_info($reminder['post_id'],$reminder['post_type']);
				$part1 = "您关注的用户".$from_user."发布了一篇".$addon."：";
				$part2 = $info['plain_title'];
				$part3 = $info['description'];
				break;
			default:
				# code...
				break;
		}
		$result['part1'] = $part1;
		$result['part2'] = $part2;
		$result['part3'] = $part3;
		return $result;

	}

	public function get_post_info($post_id,$type,$request="update"){
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
		$data['plain_title'] = cutString($res['plain_title'],20);
		$data['description'] = cutString($res['description'],20);
		return $data;
	}


	public function post_update($post_id,$post_type,$event="update"){

		$map['post_id'] = $post_id;
		$this->db->select("user_id");
		$this->db->where($map);
		$table = get_post_table($post_type);
		$res = $this->db->get($table)->row_array();
		if(!empty($res)){
			$from_user_id = $res['user_id'];
		}

		$map['type'] = $post_type;
		$this->db->where($map);
		$this->db->from("jx_favorites");
		$res = $this->db->get()->result_array();
		$batch = array();
		$time = time();

		$reminder_type = 1;
		if($event=="open"||$event=="close"){
			$reminder_type = 2;
			if($event=="open"){
				$reply_id = 1;
			}else{
				$reply_id = 0;
			}	
		}
		foreach ($res as $key => $value) {
			$temp['to_user_id'] = $value['user_id'];
			$temp['post_id'] = $post_id;
			$temp['post_type'] = $post_type;
			$temp['type'] = $reminder_type;
			$temp['createat'] = $time;
			if(isset($from_user_id)) $temp['from_user_id'] = $from_user_id;
			if(isset($reply_id)) $temp['extra'] = $reply_id;
			$batch[] = $temp;
		}
		$res = $this->db->insert_batch('jx_reminder', $batch); 
		return $res;
	}

	//type=3发表帖子有新的回复
	//type=4回复被回复
	//hint 自己给自己发回复不能发提醒
	public function new_reply($reply){

		if($reply['reply_from']==$reply['reply_to']) return;
		$map['post_id'] = $reply['post_id'];
		$this->db->select("user_id");
		$this->db->where($map);
		$table = get_post_table($reply['type']);
		$res = $this->db->get($table)->row_array();
		if(!empty($res)){
			$post_user_id = $res['user_id'];
			//分为两个部分，要不要给楼主发回复
			$data['from_user_id'] = $reply['reply_from'];
			
			$data['extra'] = $reply['id'];
			$data['post_id'] = $reply['post_id'];
			$data['post_type'] = $reply['type'];
			$data['createat'] = time();
			$data['content'] = $reply['content'];
			if($reply['reply_from']!=$post_user_id){//自己给自己的帖子回复不给自己发提醒
				$data['type'] = 3;
				$data['to_user_id'] = $post_user_id;
				$this->db->insert("jx_reminder",$data);
			}
			
			//被回复者如果是楼主，那么之前的提醒肯定已经发出去了，故不考虑
			if($post_user_id != $reply['reply_to']){ 
				$data['type'] = 4;
				$data['to_user_id'] = $reply['reply_to'];
				$this->db->insert("jx_reminder",$data);
			}

		}
		return;

	}

	public function new_message($message){
		$data['from_user_id'] = $message['from_id'];
		$data['to_user_id'] = $message['to_id'];
		$data['content'] = $message['content'];
		$data['createat'] = time();
		$data['extra'] = $message['id'];
		$data['type'] = 5;
		return $this->db->insert("jx_reminder",$data);
	}

	public function new_post($post_info){
		$data['from_user_id'] = $post_info['user_id'];
		$map['lovee'] = $post_info['user_id'];
		$this->db->where($map);
		$this->db->from("jx_love");
		$res = $this->db->get()->result_array();

		$temp['from_user_id'] = $post_info['user_id'];
		$temp['type'] = 6;
		$batch = array();

		foreach ($res as $key => $value) {
			$temp['to_user_id'] = $value['lover']; //给关注它的人发提醒
			$temp['createat'] = time();
			$temp['post_type'] = $post_info['post_type'];
			$temp['post_id'] = $post_info['post_id'];
			$batch[] = $temp;
		}
		if(count($batch)>0){
			$this->db->insert_batch("jx_reminder",$batch);
		}
		return;
	}

}
?>