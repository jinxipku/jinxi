<?php
class post_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->model("user_model");
		$this->load->model("reminder_model");
		$this->load->helper('url');
	}

	public function insert_post($info, $type){
		$table = get_post_table($type);
		$res = $this->db->insert($table, $info); 
		if( $res ){
			$post_id =  $this->db->insert_id();//post id
			$info['post_type'] = $type;
			$info['post_id'] = $post_id;
			$res4 = $this->reminder_model->new_post($info);
			$res3 = $this->user_model->addpoints($info['user_id'],$this->config->item("post_bonus"));
			return $post_id;
		}else return 0;
	}

	//TODO: check if this interface is used!
	//info['description']  info['price']aaa
	public function update_post($post_id,$type,$info){
		$table = get_post_table($type);
		$map['post_id'] = $post_id;
		$this->db->where($map);
		$res =  $this->db->update($table,$info);
		if($res){
			$this->reminder_model->post_update($post_id,$type);
		}
		return $res;
	}

	//TODO: if price is permitted to modify, delete this.
	public function edit_description($post_id,$type,$desc){
		$table = get_post_table($type);
		$map['post_id'] = $post_id;
		$this->db->where($map);
		$res = $this->db->update($table,array("description"=>$desc));
		if($res){
			$this->reminder_model->post_update($post_id,$type);
		}
		return $res;
	}


	//第三个参数用于区别该帖子在帖子页面还是在大厅、个人页面显示
	public function get_post($post_id,$type,$hall=false){
		$table = get_post_table($type);
		$query = $this->db->get_where($table, array('post_id' => $post_id));
		$res = $query->row_array();
		if(empty($res)) return null;

		if($type==0){  //卖家帖子要处理图片
			$picture = unserialize($res['picture']);
			if(is_array($picture)){
				foreach ($picture as $key => $value) {
					$picture[$key]['thumb_picture_url'] = get_thumb($value['picture_url']);
				}
			}
			
			$res['picture'] = $picture;
		}
		
		$this->db->from("jx_user");
		
		if(!$hall)
			$this->db->select('jx_school_info.school_name, nick,id, thumb,nick_color,email,qq,phone,weixin,is_mars');
		else $this->db->select('jx_school_info.school_name, nick,id, thumb,nick_color');
		$this->db->join('jx_school_info',"jx_school_info.school_id=jx_user.school_id");
		$this->db->where(array("id"=>$res['user_id']));
		$user = $this->db->get()->row_array();

		if(empty($user)) return null;
		$user['nick_color'] = get_namecolor($user['nick_color']);
		$user['thumb'] = base_url("img/head/".$user['thumb']);
		$res['user'] = $user;

		if($hall){         //如果是缩略图展示，需要做一些处理
			$res['type'] = $type;
			$res['createat'] = format_time($res['createat']);
			$res['updateat'] = format_time($res['updateat']);

			$res['category1_name'] = get_category1_name2($res['category1']);
			$res['category2_name'] = get_category2_name($res['category2']);
			$res['deal'] = get_deal_name($res['deal'],$type);
			

			$hasimg = false;
			if(!empty($res['picture'])){
				$hasimg = true;
				$res['picture'] = $res['picture'][$res['first_picture']]['thumb_picture_url'];
			}else{
				$res['picture'] = base_url("img/post/".($res['category2']+1).".png");
			}
			$res['title'] = get_title($res['type'],$res['deal'],$res['class'],$hasimg,$res['category1_name'],$res['category2_name'],$res['brand'],$res['model']);
			$res['plain_title'] = get_plain_title($res['type'],$res['deal'],$res['class'],$hasimg,$res['category1_name'],$res['category2_name'],$res['brand'],$res['model']);
			unset($res['contactby']);
		}
		return $res;
	}


	//返回某个用户发的某一页的帖子
	public function get_user_posts($user_id, $login_user_id=null, $page=1){

		$addon = "";
		if($user_id!=$login_user_id) $addon = " and active=1";  //如果不是自己看，需要显示active为1的
		$sql = "select post_id from jx_seller_post where user_id=".$user_id." union all select post_id from jx_buyer_post where user_id=".$user_id.$addon;
		$query = $this->db->query($sql);
		$total = $query->num_rows();

		if($total==0){
			$data['total'] = 0;
			$data['posts'] = array();
			$data['post_num'] = 0;
			$data['page_num'] = 0;
			$data['cur_page'] = 0;
			return $data;
		}
		if($login_user_id!=null){
			$my_favorites = $this->get_favorite_id_type($login_user_id);
		}

		$num_per_page = $this->config->item("num_per_page2");

		$page_num = intval(ceil($total/$num_per_page));
		$page = $page%$page_num;
		$page = ($page==0)? $page_num : $page;

		$length = $num_per_page;
		$offset = ($page-1)*$num_per_page;
		$sql = "select post_id,0 as type,createat,active from jx_seller_post where user_id=".$user_id." union all select post_id,1 as type,createat,active from jx_buyer_post where user_id=".$user_id.$addon." order by createat desc limit $offset,$length";
		
		$query = $this->db->query($sql);
		$records = $query->result_array();
		$posts = array();//结果数组
		foreach ($records as $key => $value) {
			$post = $this->get_post($value['post_id'],$value['type'],true);
			if(empty($post)) continue;

			if(isset($my_favorites)&&in_array($value['post_id']."#".$value['type'], $my_favorites)){
				$post['has_collect'] = 1;
			}else $post['has_collect'] = 0;
			$posts[] = $post;
		}
		$data['total'] = $total;
		$data['posts'] = $posts;
		$data['post_num'] = count($data['posts']);
		$data['page_num'] = intval(ceil($data['total']/$num_per_page));
		$data['cur_page'] = $page;
		return $data;
	}

	public function get_favorite_id_type($user_id){
		$map = array();
		$map['user_id'] = $user_id;
		$this->db->select('post_id,type');
		$query = $this->db->get_where('jx_favorites', $map);

		$res = $query->result_array();
		$result = array();
		foreach ($res as $key => $value) {
			$result[] = $value['post_id']."#".$value['type'];
		}
		return $result;
	}

	public function get_user_favorites($user_id,$page=1){
		$map['user_id'] = $user_id;
		$this->db->where($map);
		$this->db->from("jx_favorites");
		$total = $this->db->count_all_results();

		if($total==0){
			$data['total'] = 0;
			$data['posts'] = array();
			$data['post_num'] = 0;
			$data['page_num'] = 0;
			$data['cur_page'] = 0;
			return $data;
		}
		$num_per_page = $this->config->item("num_per_page2");
		$page_num = intval(ceil($total/$num_per_page));
		$page = $page%$page_num;
		$page = ($page==0)? $page_num : $page;

		$this->db->select("post_id,type");
		$this->db->limit($num_per_page,($page-1)*$num_per_page);
		$this->db->from("jx_favorites");
		$this->db->order_by("addat","desc");
		$this->db->where($map);
		$records = $this->db->get()->result_array();
		$posts = array();//结果数组
		foreach ($records as $key => $value) {
			$post = $this->get_post($value['post_id'],$value['type'],true);
			if(empty($post)) continue;
			$post['has_collect'] = 1;
			$posts[] = $post;
		}
		$data['total'] = $total;
		$data['posts'] = $posts;
		$data['post_num'] = count($data['posts']);
		$data['page_num'] = intval(ceil($data['total']/$num_per_page));
		$data['cur_page'] = $page;
		return $data;
	}

	/*算法:根据用户最近发的一篇帖子以及收藏的最新一篇帖子来看
	* 若无依据，返回空
	* 若有依据
	* 只推荐10篇
	*/
	public function get_user_recommend($user_id,$page=1){
		$this->load->library('sphinx_client', NULL, 'sphinx');
		$this->sphinx->SetServer ( '127.0.0.1', 9312);
		$this->sphinx->SetArrayResult ( true );
		$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
		//$this->sphinx->SetRankingMode ( SPH_RANK_PROXIMITY_BM25 );
	//$this->
		$this->sphinx->SetFieldWeights(array('brand' => 20, 'model' => 10, 'description' => 4,'c1_name'=>1,'c2_name'=>1));
		$this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "createat");
		
		//$this->sphinx->SetMatchMode(SPH_MATCH_FULLSCAN);
		$recommends = array();//所有找到的推荐

		$this->db->order_by("addat","desc");
		$this->db->where("user_id",$user_id);
		$this->db->from("jx_favorites");
		//$res = $this->db->get()->row_array();
		$res = $this->db->get()->result_array();
		foreach ($res as $key => $value) {
			$user_favorites[] = $value['post_id']."#".$value['type'];
		}

		if(!empty($res)){
			$res = $res[0];
			$table = get_post_table($res['type']);
			$this->db->where("post_id",$res['post_id']);
			$this->db->from($table);
			$f_post = $this->db->get()->row_array();

			//$this->sphinx->setFilter('type',array($res['type']));
			$this->sphinx->SetFilter('category1',array($f_post['category1']));
			$this->sphinx->SetFilter('category2',array($f_post['category2']));
			$this->sphinx->SetFilter('user_id',array($user_id),true);
			//$this->sphinx->setFilter('post_id',array($f_post['post_id']),true);
			$f_post['brand'] = trim($f_post['brand']);
			$f_post['model'] = trim($f_post['model']);
			$keyword = $f_post['brand'];
			if(!empty($f_post['model'])){
				$keyword = $keyword." ".$f_post['model'];
			}
			//echo "accordingtomine:".$keyword;
			$source = get_sphinx_index($res['type']);
			$res = $this->sphinx->Query($keyword,$source);
			//var_dump($res);
			if(empty($res)||empty($res['matches'])){
			}else{
				$matches = $res['matches'];
				foreach ($matches as $key => $value) {
					$temp = array();
					$temp['post_id'] = $value['id'];
					$temp['type'] = $value['attrs']['type'];
					$temp['createat'] = $value['attrs']['createat'];
					$recommends[] = $temp;
				}
			}
		}

		$res = $this->user_model->get_newest_post($user_id);
		if(!empty($res)){
			$f_post = $res;
			//这里用相反的
			//$this->sphinx->setFilter('type',array(1-$res['type']));
			$this->sphinx->ResetFilters();
			$this->sphinx->SetFilter('category1',array($f_post['category1']));
			$this->sphinx->SetFilter('category2',array($f_post['category2']));
			$this->sphinx->SetFilter('user_id',array($user_id),true);
			//$this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "createat"); //按创建时间降序排列
			$f_post['brand'] = trim($f_post['brand']);
			$f_post['model'] = trim($f_post['model']);

			$keyword = $f_post['brand'];
			if(!empty($f_post['model'])){
				$keyword = $keyword." ".$f_post['model'];
			}
			$source = get_sphinx_index(1-$res['type']);
			//echo "accordingtoothers:".$keyword;
			$res = $this->sphinx->Query($keyword,$source);
			//var_dump($res);
			if(empty($res)||empty($res['matches'])){
			}else{
				$matches = $res['matches'];
				foreach ($matches as $key => $value) {
					$temp = array();
					$temp['post_id'] = $value['id'];
					$temp['type'] = $value['attrs']['type'];
					$temp['createat'] = $value['attrs']['createat'];
					$recommends[] = $temp;
				}
			}
		}

		//根据recommends提取数据
		$num_per_page = $this->config->item("num_per_page2");
		$total = count($recommends);
		$data = array();
		$data['total'] = $total;
		if($total==0){
			$data['posts'] = array();
		}else{
			//先对recommends预处理，按照时间排序
			foreach ($recommends as $key => $value) {
				$rec[$value['createat']] = $value;
			}
			krsort($rec);
			
			$page_num = intval(ceil($data['total']/$num_per_page));
			$page = $page%$page_num;
			$page = ($page==0)? $page_num : $page;

			$offset = ($page-1)*$num_per_page;
			$length = $num_per_page;
			array_slice($rec,$offset,$length);
			$posts = array();
			foreach ($rec as $key => $value) {
				$temp = $this->get_post($value['post_id'],$value['type'],true);
				if(isset($user_favorites)&&in_array($temp['post_id']."#".$temp['type'], $user_favorites)){
					$temp['has_collect'] = 1;
				}else $temp['has_collect'] = 0;
				$posts[] = $temp;
			}
			$data['posts'] = $posts;
		}
		
		$data['post_num'] = count($data['posts']);
		$data['page_num'] = intval(ceil($data['total']/$num_per_page));
		$data['cur_page'] = $page;
		//var_dump($data);
		return $data;
	}

	public function set_active($post_id,$type,$active){
		$table = get_post_table($type);
		$this->db->where("post_id",$post_id);
		$res =  $this->db->update($table,array("active"=>$active));
		if($res){
			$event = ($active==1)?"open":"close";
			$this->reminder_model->post_update($post_id,$type,$event);
		}
		return $res;
	}

	public function get_hotest_post($login_user_id=null){
		$map['active'] = 1;
		$this->db->where($map);
		$this->db->select("(3*(createat-unix_timestamp())/86400+reply_num*4+favorite_num*5) as heat,post_id");
		$this->db->order_by("heat desc");
		$this->db->limit(1,0);
		$this->db->from("jx_seller_post");
		$res = $this->db->get()->row_array();

		$this->db->where($map);
		$this->db->select("(".$this->config->item("heat_daypass")."*(createat-unix_timestamp())/86400+reply_num*".$this->config->item("heat_reply")."+favorite_num*".$this->config->item("heat_favorite").") as heat,post_id");
		$this->db->order_by("heat desc");
		$this->db->limit(1,0);
		$this->db->from("jx_buyer_post");
		$res2 = $this->db->get()->row_array();

		if(empty($res)&&empty($res2)) return null;
		if(!empty($res)&&!empty($res2)){
			$type = ($res['heat']>$res2['heat'])?0:1;
		}else{
			$type = empty($res)? 1:0;
		}
		$res['type'] = $type;$res2['type'] = $type;
		$result = ($type==0)?$res:$res2;
		$hotest_post = $this->get_post($result['post_id'],$result['type'],true);
	
		$hotest_post['has_collect'] = $this->is_favorite($result['post_id'],$result['type'],$login_user_id);
		
		return $hotest_post;
	}

	public function get_newest_post($login_user_id=null){
		$map['active'] = 1;

		$this->db->order_by("createat","desc");
		$this->db->where($map);
		$query = $this->db->get("jx_seller_post");
		$newest_seller_post = $query->row_array();

		$this->db->order_by("createat","desc");
		$this->db->where($map);
		$query = $this->db->get("jx_buyer_post");
		$newest_buyer_post = $query->row_array();

		$post = null;
		if(!empty($newest_buyer_post)&&!empty($newest_seller_post)){
			$post = $newest_buyer_post;
			$post['type'] = 1;
			if($newest_seller_post['createat']>$newest_buyer_post['createat']){
				$post = $newest_seller_post;
				$post['type'] = 0;
			}
		}else if(empty($newest_seller_post)&&!empty($newest_buyer_post)){
			$post = $newest_buyer_post;
			$post['type'] = 1;
		}else if(empty($newest_buyer_post)&&!empty($newest_seller_post)){
			$post = $newest_seller_post;
			$post['type'] = 0;
		}
		if(empty($post)) return null;
		else{
			$newest_post = $this->get_post($post['post_id'],$post['type'],true);
			
			$newest_post['has_collect'] = $this->is_favorite($newest_post['post_id'],$newest_post['type'],$login_user_id);
		
			return $newest_post;
		}
	}

	public function get_random_post(){
		$rand = rand(0,7);
		if($rand <= 4) $type = 0;
		else $type = 1;
		$table = get_post_table($type);
		$map['active'] = 1;
		$this->db->where($map);
		$this->db->order_by("post_id", "random"); 
		$this->db->limit(1,0);
		
		$query = $this->db->get($table);
		$res = $query->row_array();
		if(empty($res)){
			$data = null;
		}else{
			$data['post_type'] = $type;
			$data['post_id'] = $res['post_id'];
		}
		return $data;

	}

	//获取特定过滤的post_id列表，大厅显示。
	public function get_post_ids($type,$school_id,$category1,$category2,$page,$sort){
		$table = get_post_table($type);
		$map = array();
		$map['active'] = 1;
		if($category1!=0) $map['category1'] = $category1;
		if($category2!=-1) $map['category2'] = $category2;
		$num = $this->config->item('num_per_page');
		$this->db->select($table.".post_id");
		$this->db->limit($num,($page-1)*$num);
		$this->db->from($table);
		if($sort=='time'){
			$this->db->order_by("createat", "desc"); 
		}elseif($sort=='heat'){
			//热度计算  每天减2，每个收藏加5，每个回复+4
			$this->db->select("(3*(createat-unix_timestamp())/86400+reply_num*4+favorite_num*5) as heat");
			$this->db->order_by("heat desc");
		}
		if(isset($school_id)){
			$map['school_id'] = $school_id;
			$this->db->join('jx_user','jx_user.id='.$table.'.user_id');
		}
		$this->db->where($map);
		$post_ids = $this->db->get()->result_array();
		$res = array();
		foreach ($post_ids as $key => $value) {
			$res[] = $value['post_id'];
		}
		return $res;
	}

	public function get_post_ids_total($type,$school_id,$category1,$category2){
		$map = array();
		if($category1!=0) $map['category1'] = $category1;
		if($category2!=-1) $map['category2'] = $category2;
		$map['active'] = 1;
		$table = get_post_table($type);
		if(!isset($school_id)){
			$this->db->where($map);
			$this->db->from($table);
			$res = $this->db->count_all_results();
		}else{
			$map['school_id'] = $school_id;
			$this->db->select($table.".*,"."jx_user.school_id");
			$this->db->where($map);
			$this->db->from($table);
			$this->db->join('jx_user','jx_user.id='.$table.'.user_id');
			$res = $this->db->count_all_results();
		}
		return $res;
	}


	public function update_reply_num($post_id,$type,$num){
		$table = get_post_table($type);
		$num = ($num==1) ? "+1":"-1";
		$sql = "update ".$table." set reply_num=reply_num".$num." where post_id=".$post_id ;
		$query = $this->db->query($sql);
		return !empty($query);
	}

	public function update_favorite_num($post_id,$type,$num){
		$table = get_post_table($type);
		$num = ($num==1) ? "+1":"-1";
		$sql = "update ".$table." set favorite_num=favorite_num".$num." where post_id=".$post_id ;
		$query = $this->db->query($sql);
		return !empty($query);
	}

	public function is_favorite($post_id,$type,$user_id){
		if(empty($user_id)) return 0;
		$map['post_id'] = $post_id;
		$map['type'] = $type;
		$map['user_id'] = $user_id;
		$this->db->where($map);
		$this->db->from("jx_favorites");
		return  $this->db->count_all_results();
	}


}