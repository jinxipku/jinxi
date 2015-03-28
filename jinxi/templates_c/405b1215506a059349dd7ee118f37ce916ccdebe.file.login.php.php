<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-27 21:37:07
         compiled from "..\application\views\account\login.php" */ ?>
<?php /*%%SmartyHeaderCode:3159555155d038a0922-15090205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '405b1215506a059349dd7ee118f37ce916ccdebe' => 
    array (
      0 => '..\\application\\views\\account\\login.php',
      1 => 1427457620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3159555155d038a0922-15090205',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55155d038f7435_59601912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55155d038f7435_59601912')) {function content_55155d038f7435_59601912($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="register_form">
				<p>欢迎使用今昔网！请填写邮箱及密码。</p>
				<form method="post">
					<div class="form-group">
						<input id="school" name="school" type="text" placeholder="学校" class="form-control flat input-lg" onclick="chooseUniversity()" maxlength=15 />
						<input id="school_id" name="school_id" type="hidden"/>
						<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
js/school.js"><?php echo '</script'; ?>
>
						<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
js/myschool.js"><?php echo '</script'; ?>
>
						<span class="danger" id="check_school"></span>
					</div>
					<div class="form-group">
						<input id="email" name="email" type="text" placeholder="邮箱" class="form-control flat input-lg" onblur="check_email(0)" onfocus="check_school()"/>
						<span id="email_surfix"></span>
						<span class="danger" id="check_email"></span>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="密码" class="form-control flat input-lg" onblur="check_pw()"/>
						<span class="danger" id="check_pw"></span>
					</div>
					<div class="form-group">
						<input id="passworda" name="passworda" type="password" placeholder="确认密码" class="form-control flat input-lg" onblur="check_pwa()"/>
						<span class="danger" id="check_pwa"></span>
					</div>
					<button id="btn_register" type="button" class="btn btn-primary btn-lg" onClick="register()">快速注册</button>
				</form>
			</div>
			<div id="register_alter">
				<p>已有今昔网账号？</p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/login" type="button" class="btn btn-info btn-lg btn-block">立即登陆</a>
				<img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/jinxibig.jpg" alt="http://www.xn--wmqr18c.cn"/>
			</div>
		</div>
		<div id="side">
			<div id="side_tips">
				<blockquote>
					<p class="side_title">今昔贴士</p>
				</blockquote>
				<div class="side_content panel panel-default">
					<p class="p_song_title"><?php echo $_smarty_tpl->tpl_vars['tips']->value['strtit'];?>
</p>
					<p class="p_song_content">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tips']->value['strcon'];?>
</p>
					<p class="p_song_content">&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
					<p class="p_song_link">
						<a class="text-info btn-link">关于今昔</a>
						<span> | </span>
						<a class="text-info btn-link">帮助中心</a>
					</p>
				</div>
			</div>
		</div>
	</div>


<div class="row">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 386px; padding-right: 90px; padding-top: 20px;">
			<p style="font-size: 22px; width: 400px;">欢迎使用今昔网！请填写账号及密码。</p>
			<form method="post">
				<div class="form-group">
					<input id="mail" name="mail" type="text" placeholder="邮箱"
						class="form-control input-lg"
						style="background-color: #f4f4f4; border-radius: 1px;" onblur="checkmail(0)"> <span
						id="checkmail"></span>
				</div>

				<div class="form-group">
					<input id="password" name="password" type="password"
						placeholder="密码" class="form-control input-lg"
						style="background-color: #f4f4f4; border-radius: 1px;" onblur="checkpw()"> <span
						id="checkpw"></span>
				</div>
				<button type="button" class="btn btn-primary btn-lg"
					style="border-radius: 1px;" onClick="login('<?php echo '<?'; ?>
=$memurl<?php echo '?>'; ?>
')">登录</button>
			</form>
		</div>
		<div style="position: relative; float: left; width: 386px; padding-left: 30px; padding-top: 20px;">
		<?php echo '<?php'; ?>
 if(isset($login_user)): <?php echo '?>'; ?>

			<p style="font-size: 22px;">您已经登录。</p>
			<a href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
" type="button" class="btn btn-info btn-lg"
					style="border-radius: 1px; margin-right: 100px;">返回主页</a>
		<?php echo '<?php'; ?>
 else :<?php echo '?>'; ?>

			<p style="font-size: 22px;">没有今昔网账号？</p>
			<a href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
account/regidit" type="button" class="btn btn-info btn-lg"
					style="border-radius: 1px; margin-right: 100px;">立即注册</a>
		<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

		<img src="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
img/jinxibig.jpg" alt="www.今昔.cn" style=" width: 230px; margin-top: 15px;"/>
		</div>
	</div>
	<div class=" rightpart">
	<?php echo '<?php'; ?>

		$this->load->helper('array');
		$gettips = show_tips();
		$strtit = $gettips['strtit'];
		$strcon = $gettips['strcon'];
	<?php echo '?>'; ?>

	<div>
			<blockquote>
				<p class="righttitle">今昔贴士</p>
			</blockquote>
			<div class="rightcontent panel panel-default">
				<p class="rightcontent" style="font-weight: 600"><?php echo '<?'; ?>
=$strtit<?php echo '?>'; ?>
</p>
				<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<?'; ?>
=$strcon<?php echo '?>'; ?>
</p>
				<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
				<p class="rightlink">
					<a class="text-info btn-link">关于今昔</a><span> | </span><a
						class="text-info rightlink btn-link">帮助中心</a>
				</p>
			</div>
		</div>
	</div>
</div><?php }} ?>
