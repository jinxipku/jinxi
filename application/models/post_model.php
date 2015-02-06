<?php
class post_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function add_post($user_id) {
		$ptime = date ( 'Y-m-d H:i:s' );
		$data = array (
				'post_user' => $user_id,
				'ptype' => $this->session->userdata ( 'ptype' ),
				'pgtype' => $this->session->userdata ( 'pgtype' ),
				'pstype' => $this->session->userdata ( 'pstype' ),
				'class' => $this->session->userdata ( 'class' ),
				'brand' => $this->session->userdata ( 'brand' ),
				'modal' => $this->session->userdata ( 'modal' ),
				'status' => $this->session->userdata ( 'status' ),
				'price' => $this->session->userdata ( 'price' ),
				'pcontent' => $this->session->userdata ( 'pcontent' ),
				'ptime' => $ptime 
		);
		$this->db->insert ( 'jx_post', $data );
		$query = $this->db->get_where ( 'jx_post', array (
				'post_user' => $user_id,
				'ptime' => $ptime 
		) );
		$post_id = $query->row_array ()['post_id'];
		
		$query = $this->db->get_where ( 'jx_user', array (
				'user_id' => $user_id 
		) );
		$userinfo = $query->row_array ();
		$score = $userinfo ['score'];
		$level = $userinfo ['level'];
		$post_num = $userinfo ['post_num'];
		$latest = $post_id;
		$post_num += 1;
		$score += po_score ( $post_num );
		$level = get_level ( $score );
		$data = array (
				'post_num' => $post_num,
				'latest' => $latest,
				'score' => $score,
				'level' => $level 
		);
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'jx_user', $data );
		
		return $post_id;
	}
	public function upload_picture($post_id, $pimage) {
		$data = array (
				'pimage' => $pimage 
		);
		$this->db->where ( 'post_id', $post_id );
		$this->db->update ( 'jx_post', $data );
	}
	public function view($post_id) {
		$query = $this->db->get_where ( 'jx_post', array (
				'post_id' => $post_id 
		) );
		$view = $query->row_array ()['view'];
		$data = array (
				'view' => $view + 1 
		);
		$this->db->where ( 'post_id', $post_id );
		$this->db->update ( 'jx_post', $data );
	}
	public function get_post($post_id) {		
		$this->db->from ( 'jx_post' );
		$this->db->join ( 'jx_user', 'jx_post.post_user = jx_user.user_id' );
		$this->db->where ( 'jx_post.post_id', $post_id );
		return $this->db->get ()->row_array ();
	}
	public function check_focus($user_id , $post_id) {
		$query = $this->db->get_where ( 'jx_focus', array (
				'focuser' => $user_id,
				'focusee' => $post_id 
		) );
		return $query->num_rows ();
	}
	public function add_focus($focuser, $focusee, $focus) {
		$data = array (
				'focuser' => $focuser,
				'focusee' => $focusee 
		);
		$this->db->insert ( 'jx_focus', $data );
		$data = array (
				'focus' => $focus + 1 
		);
		$this->db->where ( 'post_id', $focusee );
		$this->db->update ( 'jx_post', $data );
	}
	public function delete_focus($focuser, $focusee, $focus) {
		$data = array (
				'focuser' => $focuser,
				'focusee' => $focusee 
		);
		$this->db->delete ( 'jx_focus', $data );
		$data = array (
				'focus' => $focus - 1 
		);
		$this->db->where ( 'post_id', $focusee );
		$this->db->update ( 'jx_post', $data );
	}
}