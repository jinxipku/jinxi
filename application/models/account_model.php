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
				$data = array(
					'logins' => $account['logins'],
					'last_login' => time(),
					'last_ip' => getClientIp(),
					);
				$this->db->where ( 'email', $email );
				$this->db->update ( 'jx_account', $data );
				return 1;
			}else return 0;
		}
		return 0;
	}

	public function register($email, $pwd, $school_id) {
		$encryptPwd = $this->encrypt->encode($pwd);
		$nowtime = time();
		$data = array (
			'email' => "$email",
			'password' => "$encryptPwd",
			'is_verified' => 0,
			'reg_ip' => getClientIp(),
			'last_ip' => getClientIp(),
			'last_login' => "$nowtime",
			'logins' => 1,
			);
		$res = $this->db->insert ( 'jx_account', $data );
		if($res){
			$userdata['id'] = $this->db->insert_id();
			$userdata['nick'] = "今昔兔";
			$userdata['points'] = 0;
			$userdata['email'] = $email;
			$userdata['school_id'] = $school_id;
			$userdata['head'] = $this->config->item('default_head');
			$userdata['thumb'] = $this->config->item('default_thumb');
			$this->db->insert('jx_user',$userdata); //插入新记录到user表中
		}
		
		return $res;
	}

	public function verify($id){
		$data = array("is_verified" => 1);
		$this->db->where( 'id', $id);
		$this->db->update ( 'jx_account', $data );
	}
}
?>