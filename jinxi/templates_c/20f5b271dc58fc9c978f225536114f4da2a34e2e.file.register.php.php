<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-28 18:07:52
         compiled from "..\application\views\account\register.php" */ ?>
<?php /*%%SmartyHeaderCode:31583551523a76dabb0-94537843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20f5b271dc58fc9c978f225536114f4da2a34e2e' => 
    array (
      0 => '..\\application\\views\\account\\register.php',
      1 => 1427537045,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31583551523a76dabb0-94537843',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551523a7718d05_40058519',
  'variables' => 
  array (
    'baseurl' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551523a7718d05_40058519')) {function content_551523a7718d05_40058519($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="register_form">
				<p>欢迎加入今昔网！请填写注册信息。</p>
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
account/login" type="button" class="btn btn-info btn-lg btn-block">立即登录</a>
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

	<div class="modal fade" id="choose_school" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h6 class="modal-title" id="myModalLabel">选择学校</h6>
				</div>
				<div class="modal-body">
					<div id="choose-a-province"></div>
					<hr />
					<div id="choose-a-school"></div>
				</div>
				<div class="modal-footer">
					<button id="chooseover" type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div><?php }} ?>
