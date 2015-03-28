<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-29 01:43:37
         compiled from "..\application\views\account\login.php" */ ?>
<?php /*%%SmartyHeaderCode:323475516e8497eac86-82538270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d2a97db25dc9a0f2064cd5205d4fda759ceea48' => 
    array (
      0 => '..\\application\\views\\account\\login.php',
      1 => 1427553485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '323475516e8497eac86-82538270',
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
  'unifunc' => 'content_5516e849936088_73328924',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5516e849936088_73328924')) {function content_5516e849936088_73328924($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="register_form">
				<p>欢迎使用今昔网！请填写登录信息。</p>
				<form method="post">
					<div class="form-group">
						<input id="email" name="email" type="text" placeholder="邮箱" class="form-control flat input-lg" onblur="check_email(1)">
						<span class="danger" id="check_email"></span>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="密码" class="form-control flat input-lg" onblur="check_pw()"/>
						<span class="danger" id="check_pw"></span>
					</div>
					<button id="btn_login" type="button" class="btn btn-primary btn-lg" onClick="login()">登录</button>
				</form>
			</div>
			<div id="register_alter">
				<p>没有今昔网账号？</p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/register" type="button" class="btn btn-info btn-lg btn-block">立即注册</a>
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
	</div><?php }} ?>
