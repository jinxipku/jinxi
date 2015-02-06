<?php
class Item extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'love_model' );
		$this->load->model ( 'post_model' );
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
	}
	public function newpost($step, $op = 0, $pid = 0) {
		$user_id = $this->session->userdata ( 'login_user' );
		if ($user_id == '')
			header ( "Location: " . base_url ( "account/loginfo" ) );
		$login_user = $this->user_model->get_user ( $user_id );
		$data ['login_user'] = $login_user;
		$data ['baseurl'] = base_url ();
		$data ['title'] = '发布信息';
		$data ['choose'] = 3;
		switch ($step) {
			case 'type' :
				{
					if ($op == 1) {
						$this->session->unset_userdata ( 'pgtype' );
						$this->session->unset_userdata ( 'pstype' );
					}
					break;
				}
			case 'type2' :
				{
					if ($op == 0) {
						if (! isset ( $_POST ['ptype'] ))
							header ( "Location: " . base_url ( "item/newpost/fault" ) );
						$ptype = $_POST ['ptype'];
						if ($ptype == 0 || $ptype == 1)
							$this->session->set_userdata ( 'ptype', $ptype );
						else
							$this->session->unset_userdata ( 'ptype' );
					} else {
						$this->session->unset_userdata ( 'class' );
						$this->session->unset_userdata ( 'classpre' );
					}
					break;
				}
			case 'class' :
				{
					if ($op == 0) {
						if (! (isset ( $_POST ['pgtype'] ) && isset ( $_POST ['pstype'] )))
							header ( "Location: " . base_url ( "item/newpost/fault" ) );
						$pgtype = $_POST ['pgtype'];
						$pstype = $_POST ['pstype'];
						$this->session->set_userdata ( 'pgtype', $pgtype );
						$this->session->set_userdata ( 'pstype', $pstype );
					} else {
						$this->session->unset_userdata ( 'brand' );
						$this->session->unset_userdata ( 'modal' );
						$this->session->unset_userdata ( 'status' );
						$this->session->unset_userdata ( 'price' );
					}
					break;
				}
			case 'info' :
				{
					if ($op == 0) {
						if (! (isset ( $_POST ['classpre'] ) && isset ( $_POST ['class'] )))
							header ( "Location: " . base_url ( "item/newpost/fault" ) );
						$classpre = $_POST ['classpre'];
						$class = $_POST ['class'];
						$this->session->set_userdata ( 'classpre', $classpre );
						$this->session->set_userdata ( 'class', $class );
					} else {
					}
					break;
				}
			case 'content' :
				{
					if (! (isset ( $_POST ['brand'] ) && isset ( $_POST ['modal'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['price'] )))
						header ( "Location: " . base_url ( "item/newpost/fault" ) );
					$brand = $_POST ['brand'];
					$modal = $_POST ['modal'];
					$status = $_POST ['status'];
					$price = $_POST ['price'];
					$this->session->set_userdata ( 'brand', $brand );
					$this->session->set_userdata ( 'modal', $modal );
					$this->session->set_userdata ( 'status', $status );
					if ($this->session->userdata ( 'ptype' ) == 1 && $price == 0)
						$price = 99999999;
					$this->session->set_userdata ( 'price', $price );
					break;
				}
			case 'picture' :
				{
					$pcontent = $_POST ['pcontent'];
					$this->session->set_userdata ( 'pcontent', $pcontent );
					if ($this->session->userdata ( 'ptype' ) && $this->session->userdata ( 'pgtype' ) && $this->session->userdata ( 'pstype' ) && $this->session->userdata ( 'calss' ) && $this->session->userdata ( 'brand' ) && $this->session->userdata ( 'modal' ) && $this->session->userdata ( 'status' ) && $this->session->userdata ( 'price' ) && $this->session->userdata ( 'content' ))
						header ( "Location: " . base_url ( "item/newpost/fault" ) );
					$pid = $this->post_model->add_post ( $user_id );
					$data ['post_id'] = $pid;
					$this->session->set_userdata ( 'post_id', $pid );
					if ($this->session->userdata ( 'ptype' ) == 1)
						header ( "Location: " . base_url ( "item/newpost/complete" ) );
					break;
				}
			case 'fault' :
				{
					$this->session->unset_userdata ( 'ptype' );
					$this->session->unset_userdata ( 'pgtype' );
					$this->session->unset_userdata ( 'pstype' );
					$this->session->unset_userdata ( 'class' );
					$this->session->unset_userdata ( 'classpre' );
					$this->session->unset_userdata ( 'brand' );
					$this->session->unset_userdata ( 'modal' );
					$this->session->unset_userdata ( 'status' );
					$this->session->unset_userdata ( 'price' );
					$this->session->unset_userdata ( 'pcontent' );
					$this->session->unset_userdata ( 'pimage' );
					$this->session->unset_userdata ( 'post_id' );
					break;
				}
			case 'complete' :
				{
					if ($this->session->userdata ( 'ptype' ) == 0 && $op > 0)
						$this->post_model->upload_picture ( $this->session->userdata ( 'post_id' ), $op );
					$data ['post_id'] = $this->session->userdata ( 'post_id' );
					$this->session->unset_userdata ( 'ptype' );
					$this->session->unset_userdata ( 'pgtype' );
					$this->session->unset_userdata ( 'pstype' );
					$this->session->unset_userdata ( 'class' );
					$this->session->unset_userdata ( 'classpre' );
					$this->session->unset_userdata ( 'brand' );
					$this->session->unset_userdata ( 'modal' );
					$this->session->unset_userdata ( 'status' );
					$this->session->unset_userdata ( 'price' );
					$this->session->unset_userdata ( 'pcontent' );
					$this->session->unset_userdata ( 'pimage' );
					$this->session->unset_userdata ( 'post_id' );
					break;
				}
			default :
				{
					header ( "Location: " . base_url ( "item/newpost/fault" ) );
					break;
				}
		}
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'Item/' . $step );
		$this->load->view ( 'templates/footer' );
	}
	public function viewpost($pid) {
		$this->output->enable_profiler ( TRUE );
		$user_id = $this->session->userdata ( 'login_user' );
		if ($user_id != '') {
			$login_user = $this->user_model->get_user ( $user_id );
			$data ['login_user'] = $login_user;
			$data ['has_focus'] = $this->post_model->check_focus ( $user_id,$pid );
		}
		$thispost = $this->post_model->get_post ( $pid );
		if (empty ( $thispost )) {
			show_404 ( 'page' );
		}
		$this->post_model->view ( $pid );
		$data ['thispost'] = $thispost;
		$data ['baseurl'] = base_url ();
		$data ['title'] = get_title_str ( $thispost ['ptype'], $thispost ['pgtype'], 
				$thispost ['pstype'], $thispost ['class'], $thispost ['brand'], 
				$thispost ['modal'], $thispost ['pimage'] );
		$data ['choose'] = 3;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'item/viewpost' );
		$this->load->view ( 'templates/footer' );
	}
}