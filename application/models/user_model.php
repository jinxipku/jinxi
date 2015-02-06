<?php
class user_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function get_user($user_id = 0) {
		if ($user_id === 0) {
			$query = $this->db->get ( 'jx_user' );
			return $query->result_array ();
		}
		
		$query = $this->db->get_where ( 'jx_user', array (
				'user_id' => $user_id 
		) );
		return $query->row_array ();
	}
	public function get_user2($mail = 0) {
		if ($mail === 0) {
			$query = $this->db->get ( 'jx_user' );
			return $query->result_array ();
		}
		
		$query = $this->db->get_where ( 'jx_user', array (
				'mail' => $mail 
		) );
		return $query->row_array ();
	}
	public function login($mail, $pw) {
		$query = $this->db->get_where ( 'jx_user', array (
				'mail' => $mail,
				'password' => $pw 
		) );
		$num = $query->num_rows ();
		if ($num > 0) {
			$array = $query->row_array ();
			$verify = $array['is_verified'];
			if ($verify == 1){
				$userinfo = $query->row_array ();
				$score = $userinfo['score'];
				$level = $userinfo['level'];
				$last_login = $userinfo['last_login'];
				$login_days = $userinfo['login_days'];
				$nowtime = date ( "Y-m-d" );
				$delta = (strtotime($nowtime) - strtotime($last_login))/86400;
				if($delta>0){
					if($delta==1)
						$login_days += 1;
					else if($delta==2 && $userinfo['is_star']==1)
						$login_days += 1;
					else if($delta>1)
						$login_days = 1;
					$score += ld_score($login_days);
					$level = get_level($score);
					$data = array (
							'last_login' => $nowtime,
							'login_days' => $login_days,
							'score' => $score,
							'level' => $level
					);
					$this->db->where ( 'mail', $mail );
					$this->db->update ( 'jx_user', $data );
				}		
				return 1;
			}
			else
				return 0;
		}
		return - 1;
	}
	public function changehi($uid, $type) {
		$query = $this->db->get_where ( 'jx_user', array (
				'user_id' => $uid 
		) );
		$array = $query->row_array ();
		$otype = $array['image'];
		if ($otype != '0')
			unlink ( './img/head/' . $uid . '_' . $otype );
		$data = array (
				'image' => $type 
		);
		$this->db->where ( 'user_id', $uid );
		return $this->db->update ( 'jx_user', $data );
	}
	public function regidit($mail, $name, $pw) {
		$randpwd = '';
		for($i = 0; $i < 6; $i ++) {
			$tp = mt_rand ( 48, 90 );
			while ( $tp < 65 && $tp > 57 ) {
				$tp = mt_rand ( 48, 90 );
			}
			$randpwd .= chr ( $tp );
		}
		$nowtime = date ( "Y-m-d" );
		$data = array (
				'mail' => "$mail",
				'user_name' => "$name",
				'password' => "$pw",
				'code' => "$randpwd",
				'sign' => '我是一只快乐的今昔兔~',
				'last_login' => "$nowtime" 
		);
		$res = $this->db->insert ( 'jx_user', $data );
		if ($res > 0)
			return $mail . '*&*' . $randpwd;
		return 0;
	}
	public function verify($mail, $code) {
		$data = array (
				'is_verified' => 1 
		);
		$this->db->where ( 'mail', $mail );
		$this->db->where ( 'code', $code );
		if ($this->db->get ( 'jx_user' )->num_rows () == 0)
			return 0;
		$this->db->update ( 'jx_user', $data );
		return 1;
	}
	public function check_mail($mail) {
		$query = $this->db->get_where ( 'jx_user', array (
				'mail' => $mail 
		) );
		return $query->num_rows ();
	}
	public function savebi($user_id, $username, $sex, $school, $degree, $year, $sign, $qq, $phone) {
		$data = array (
				'user_name' => $username,
				'sex' => $sex,
				'school' => $school,
				'degree' => $degree,
				'year' => $year,
				'sign' => $sign,
				'qq' => $qq,
				'phone' => $phone 
		);
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'jx_user', $data );
	}
	public function saveac($user_id, $mail_on, $qq_on, $phone_on, $sign_on1, $sign_on2, $right_on) {
		$data = array (
				'mail_on' => $mail_on,
				'qq_on' => $qq_on,
				'phone_on' => $phone_on,
				'sign_on1' => $sign_on1,
				'sign_on2' => $sign_on2,
				'right_on' => $right_on 
		);
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'jx_user', $data );
	}
	public function savest($user_id, $namecolor, $auto_on) {
		$data = array (
				'namecolor' => $namecolor,
				'auto_on' => $auto_on 
		);
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'jx_user', $data );
	}
	public function get_mys($user_id, $page) {
		$this->db->from ( 'jx_post' );
		$this->db->join ( 'jx_user', 'jx_post.post_user = jx_user.user_id' );
		$this->db->where ( array (
				'user_id' => $user_id
		) );
		$ret ['total'] = $this->db->count_all_results ();
		$this->db->from ( 'jx_post' );
		$this->db->join ( 'jx_user', 'jx_post.post_user = jx_user.user_id' );
		$this->db->where ( array (
				'user_id' => $user_id
		) );
		$this->db->order_by("ptime", "desc");
		$this->db->limit ( 20, ($page - 1) * 20 );
		$ret ['data'] = $this->db->get ()->result_array ();
		return $ret;
	}
	public function get_loves($user_id, $page) {
		$this->db->from ( 'jx_love' );
		$this->db->join ( 'jx_user', 'jx_love.lovee = jx_user.user_id' );
		$this->db->join ( 'jx_post', 'jx_user.latest = jx_post.post_id' );
		$this->db->where ( array (
				'lover' => $user_id 
		) );
		$ret ['total'] = $this->db->count_all_results ();
		$this->db->from ( 'jx_love' );
		$this->db->join ( 'jx_user', 'jx_love.lovee = jx_user.user_id' );
		$this->db->join ( 'jx_post', 'jx_user.latest = jx_post.post_id' );
		$this->db->where ( array (
				'lover' => $user_id 
		) );
		$this->db->limit ( 20, ($page - 1) * 20 );
		$ret ['data'] = $this->db->get ()->result_array ();
		return $ret;
	}
	public function get_comms($user_id, $page, $commtype) {
		$this->db->from ( 'jx_comment' );
		$this->db->join ( 'jx_user', 'jx_comment.subject_id = jx_user.user_id' );
		$this->db->where ( 'jx_comment.user_id', $user_id );
		if ($commtype == 6)
			$this->db->where ( 'ctype', 0 );
		else if ($commtype == 7)
			$this->db->where ( 'ctype', 1 );
		$ret ['total'] = $this->db->count_all_results ();
		$this->db->from ( 'jx_comment' );
		$this->db->join ( 'jx_user', 'jx_comment.subject_id = jx_user.user_id' );
		$this->db->where ( 'jx_comment.user_id', $user_id );
		if ($commtype == 6)
			$this->db->where ( 'ctype', 0 );
		else if ($commtype == 7)
			$this->db->where ( 'ctype', 1 );
		$this->db->order_by("ctime", "desc");
		$this->db->limit ( 20, ($page - 1) * 20 );
		$ret ['data'] = $this->db->get ()->result_array ();
		return $ret;
	}
	public function visit($object_id){
		$query = $this->db->get_where ( 'jx_user', array (
				'user_id' => $object_id
		) );
		$array =  $query->row_array();
		$visit = $array['visit'];
		$data = array (
				'visit' => $visit + 1
		);
		$this->db->where ( 'user_id', $object_id );
		$this->db->update ( 'jx_user', $data );
	}
}