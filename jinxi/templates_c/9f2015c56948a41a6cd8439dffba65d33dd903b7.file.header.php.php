<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-23 19:06:02
         compiled from "..\application\views\templates\header.php" */ ?>
<?php /*%%SmartyHeaderCode:28843550fb3d06e9f62-69507363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f2015c56948a41a6cd8439dffba65d33dd903b7' => 
    array (
      0 => '..\\application\\views\\templates\\header.php',
      1 => 1427092659,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28843550fb3d06e9f62-69507363',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550fb3d084b6b7_15595594',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550fb3d084b6b7_15595594')) {function content_550fb3d084b6b7_15595594($_smarty_tpl) {?><!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="jinxi">
	<meta name="author" content="fabkxd">
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
img/icon/icon.png">
	<title>今昔网</title> <!-- Bootstrap core CSS -->
	<link href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
css/bootstrap.css" rel="stylesheet"/>
	<link href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
css/font-awesome.css" rel="stylesheet"/>
	<link href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
css/flat-ui.css" rel="stylesheet"/>
	<!-- my CSS -->
	<link href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
css/jinxi.css" rel="stylesheet"/>
	<link href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
css/Jcrop.css" rel="stylesheet"/>
	<link href="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
css/sticky-footer-navbar.css" rel="stylesheet"/>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['data']->value['baseurl'];?>
js/jquery.js"><?php echo '</script'; ?>
>

</head>

<body>
	<div class="row" style="margin-bottom: 0;">
		<div style="position: relative; float: left; width: 176px;">
			<a href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
"><img
				style="height: 80px; margin-left: -50px;"
				src="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
img/icon/header.png" /></a>
			</div>
			<div style="position: relative; float: left; width: 352px;">
				<div class="form-group"
				style="margin-left: 30px; margin-right: 30px;">
				<input type="text" placeholder="请输入关键词搜索" class="form-control"
				style="border-radius: 1px; margin-top: 25px; background-color: #f5f5f5;" />
				<a href="#"><span href="#" class="fui-search input-search"
					style="background-color: #f5f5f5;"></span></a>
				</div>
			</div>
			<div style="position: relative; float: left; width: 440px;">
				<img style="height: 50px; margin-top: 15px;"
				src="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
img/icon/invite.png" />
			</div>
			<div style="position: relative; float: left; width: 88px;">
				<?php echo '<?php'; ?>
 if(isset($login_user)): <?php echo '?>'; ?>

				<a type="button" class="btn btn-primary"
				style="border-radius: 1px; margin-top: 25px;" href="#"
				onclick="addfavorite('<?php echo '<?php'; ?>
 echo '今昔网'<?php echo '?>'; ?>
', '<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
');return false;">收藏本站</a>
			<?php echo '<?php'; ?>
 else:<?php echo '?>'; ?>

			<a type="button" class="btn btn-primary"
			style="border-radius: 1px; margin-top: 25px;"
			href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
account/regidit">立即注册</a>
		<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

	</div>
</div>

<div class="navbar-wrapper" style="z-index: 900; width: 100%;">
	<div class="navbar navbar-inverse"
	style="margin-bottom: 0; height: 45px; padding: 0; border-radius: 0; min-width: 1266px;">
	<div class="mycontainer" style="min-width: 1266px;">
		<div>
			<ul class="nav">
				<li <?php echo '<?php'; ?>
 if($choose==1): <?php echo '?>'; ?>
 class=" active" <?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
><a
					href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
">首页</a></li>
					<li <?php echo '<?php'; ?>
 if($choose==2): <?php echo '?>'; ?>
 class=" active" <?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
><a
						href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
<?php echo '<?php'; ?>
 if (isset ( $login_user ))echo 'user/' . $login_user ['user_id'];else echo 'account/loginfo';<?php echo '?>'; ?>
">个人中心</a></li>
						<li <?php echo '<?php'; ?>
 if($choose==3): <?php echo '?>'; ?>
 class=" active" <?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
><a
							href="#">商品大厅</a></li>
						</ul>
						<ul class="nav pull-right">
							<?php echo '<?php'; ?>
 if(isset($login_user)): <?php echo '?>'; ?>

							<li><a href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
user/<?php echo '<?'; ?>
=$login_user['user_id']<?php echo '?>'; ?>
"><img
								src="<?php echo '<?php'; ?>

								$this->load->helper ( 'file' );
								if ($login_user ['image'] == '0')
									echo $baseurl . 'img/head/0.jpg';
								else
									echo $baseurl . 'img/head/' . $login_user ['user_id'] . '_' . $login_user ['image'];
								<?php echo '?>'; ?>
"
								style="height: 35px; margin-top: -7px; margin-right: 5px;" /><?php echo '<?'; ?>
=$login_user['user_name']<?php echo '?>'; ?>
</a>
							</li>
						<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

						<li <?php echo '<?php'; ?>
 if($choose==5): <?php echo '?>'; ?>
 class=" active" <?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
><a
							href="#">关于</a></li>
							<li <?php echo '<?php'; ?>
 if($choose==6): <?php echo '?>'; ?>
 class=" active" <?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
><a
								href="#">帮助</a></li>
								<li <?php echo '<?php'; ?>
 if($choose==7): <?php echo '?>'; ?>
 class=" active" <?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>
><a
									href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
setup">设置</a></li>
									<?php echo '<?php'; ?>
 if(isset($login_user)): <?php echo '?>'; ?>

									<li><a href="#" onClick="logout();return false;">退出</a></li>
								<?php echo '<?php'; ?>
 elseif($this->uri->uri_string()==''): <?php echo '?>'; ?>

								<li><a id="navbarlogin" href="#"
									onClick="prelogin(0);return false;">登陆</a></li>
								<?php echo '<?php'; ?>
 else: <?php echo '?>'; ?>

								<li><a id="navbarlogin" href="#"
									onClick="memlogin();return false;">登陆</a></li>
								<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

							</ul>
						</div>
					</div>
				</div>
			</div>
	<!-- END NAVBAR --><?php }} ?>
