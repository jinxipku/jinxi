<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-01 00:54:33
         compiled from "..\application\views\setup\index.php" */ ?>
<?php /*%%SmartyHeaderCode:26539551ad14969c356-97928179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61ce8cfdf4df492e1defa5ffd69ef3e1edced919' => 
    array (
      0 => '..\\application\\views\\setup\\index.php',
      1 => 1427443793,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26539551ad14969c356-97928179',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551ad1496d7229_26566293',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551ad1496d7229_26566293')) {function content_551ad1496d7229_26566293($_smarty_tpl) {?><link href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
css/school.css" rel="stylesheet">
<div class="row" style="margin-top: 20px;">
<?php echo '<?php'; ?>
 if ($login_user['right_on']): <?php echo '?>'; ?>

	<div class="leftpart">
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

		<div class=" leftchoose">
			<ul class="nav nav-pills">
				<li <?php echo '<?php'; ?>
 if($tab==1)echo 'class="active" ';<?php echo '?>'; ?>

					style="margin-left: 2px;"><a href="#selfinfo" data-toggle="tab">修改资料</a></li>
				<li <?php echo '<?php'; ?>
 if($tab==2)echo 'class="active" ';<?php echo '?>'; ?>
><a href="#headimg"
					data-toggle="tab">修改头像</a></li>
				<li <?php echo '<?php'; ?>
 if($tab==3)echo 'class="active" ';<?php echo '?>'; ?>
><a href="#changepw"
					data-toggle="tab">账户设置</a></li>
				<li <?php echo '<?php'; ?>
 if($tab==4)echo 'class="active" ';<?php echo '?>'; ?>
><a href="#tiebbs"
					data-toggle="tab">绑定BBS</a></li>
				<li <?php echo '<?php'; ?>
 if($tab==5)echo 'class="active" ';<?php echo '?>'; ?>
><a href="#star"
					data-toggle="tab"><i class="icon-star-empty"></i>星级用户</a></li>
			</ul>
		</div>
<?php echo '<?php'; ?>
 if ($login_user['right_on']): <?php echo '?>'; ?>

		<div class=" righttext panel panel-default">
<?php echo '<?php'; ?>
 else: <?php echo '?>'; ?>

		<div class=" righttextall panel panel-default">
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

		
			<div class="tab-content">
					<div class="tab-pane fade<?php echo '<?php'; ?>
 if($tab==1)echo ' in active';<?php echo '?>'; ?>
"
						id="selfinfo">
			<?php echo '<?php'; ?>

			$this->load->view ( 'setup/selfinfo' );
			<?php echo '?>'; ?>

			</div>
					<div class="tab-pane fade<?php echo '<?php'; ?>
 if($tab==2)echo ' in active';<?php echo '?>'; ?>
"
						id="headimg">
			<?php echo '<?php'; ?>

			$this->load->view ( 'setup/headimg' );
			<?php echo '?>'; ?>

			</div>
					<div class="tab-pane fade<?php echo '<?php'; ?>
 if($tab==3)echo ' in active';<?php echo '?>'; ?>
"
						id="changepw">
			<?php echo '<?php'; ?>

			$this->load->view ( 'setup/account' );
			<?php echo '?>'; ?>

			</div>
					<div class="tab-pane fade<?php echo '<?php'; ?>
 if($tab==4)echo ' in active';<?php echo '?>'; ?>
"
						id="tiebbs">
			<?php echo '<?php'; ?>

			$this->load->view ( 'setup/tiebbs' );
			<?php echo '?>'; ?>

			</div>
					<div class="tab-pane fade<?php echo '<?php'; ?>
 if($tab==5)echo ' in active';<?php echo '?>'; ?>
"
						id="star">
			<?php echo '<?php'; ?>

			$this->load->view ( 'setup/star' );
			<?php echo '?>'; ?>

			</div>
				</div>
			</div>
<?php echo '<?php'; ?>
 if ($login_user['right_on']): <?php echo '?>'; ?>

	</div>
<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

<?php echo '<?php'; ?>


if ($login_user ['right_on'])
	$this->load->view ( 'index/righthalf' );
else
	echo '</div>';
<?php echo '?>'; ?>

<div class="modal fade" id="chooseschool" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width: 650px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h6 class="modal-title" id="myModalLabel" style="font-family: 微软雅黑;">选择学校</h6>
					</div>
					<div class="modal-body">
						<div id="choose-a-province"></div>
						<hr />
						<div id="choose-a-school"></div>
					</div>
					<div class="modal-footer">
						<button id="chooseover" type="button" class="btn btn-default"
							data-dismiss="modal">关闭</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div><?php }} ?>
