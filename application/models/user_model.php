<?php
class user_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->library('user_agent');
		$this->load->helper('date');
	}
	public function login($mail, $pw) {
		$user = $this->get_user2($mail);
		if(!empty($user)){
			$rpw = $this->encrypt->decode($user['password']);
			if($pw == $rpw){
				$daysec = 86400;
				$login =  $user['last_login'] - $user['last_login'] % $daysec;
				echo date("Y:m:d H:i:s",$user['last_login']);
				$delta = (time() - $login)/$daysec;
				if($delta >= 1 && $delta < 2){
					$user['logins'] = $user['logins'] + 1;
				}else{
					$user['logins'] = 1;
				}
				$data = array(
					'logins' => $user['logins'],
					'last_login' => time()
				);
				$this->db->where ( 'email', $mail );
				$this->db->update ( 'jx_account', $data );
				return 1;
			}else return 0;
		}
		return -1;
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