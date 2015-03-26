<?php
class account_model extends CI_Model{
	public function __construct(){
		$this->load->database ();
		$this->load->library('encrypt');
		$this->load->library('user_agent');
		$this->load->helper('date');
	}
	//获取用户账户信息
	public function get_account($user_id,$email){
		if(empty( $email )&&empty( $user_id )){
			return null;
		}
		else if(!empty( $user_id )){
			$query = $this->db->get_where ( 'jx_account', array (
				'id' => $user_id 
				) );
			return $query->row_array ();
		}else if(!empty( $email )){
			$query = $this->db->get_where ( 'jx_account', array (
				'email' => $email 
				) );
			return $query->row_array ();
		}
	}
	public function login($email, $pwd){
		$account = $this->get_account(null , $email );
		if( !empty($account) ){
			$rpwd = $this->encrypt->decode($account['password']);
			echo $rpwd.'*'.$pwd;
			if($pwd == $rpwd){
				$daysec = 86400;
				$login =  $account['last_login'] - $account['last_login'] % $daysec;
				$delta = (time() - $login)/$daysec;
				//累积登录天数
				if($delta == 1){
					$account['logins'] = $account['logins'] + 1;
				}else{
					$account['logins'] = 1;
				}
				if($delta > 1){
					$account['points'] = $account['points'] + 1;//暂时每天加1积分
				}
				$data = array(
					'logins' => $account['logins'],
					'last_login' => time(),
					'last_ip' => getClientIp(),
					'points' => $account['points'],
					);
				$this->db->where ( 'email', $email );
				$this->db->update ( 'jx_account', $data );
				return 1;
			}else return 0;
		}
		return 0;
	}

	public function regidit($email, $pwd, $nick, $school_id) {
		$encryptPwd = $this->encrypt->encode($pwd);
		$nowtime = time();
		$data = array (
			'email' => "$email",
			'nick' => "$nick",
			'password' => "$encryptPwd",
			'school_id' => $school_id,
			'is_verified' => 0,
			'reg_ip' => getClientIp(),
			'last_ip' => getClientIp(),
			'last_login' => "$nowtime",
			'logins' => 1,
			'points' => 0,
			);
		$res = $this->db->insert ( 'jx_account', $data );
		return $res;
	}

	public function verify($id){
		$data = array("is_verified" => 1);
		$this->db->where( 'id', $id);
		$this->db->update ( 'jx_account', $data );
	}
}
?>