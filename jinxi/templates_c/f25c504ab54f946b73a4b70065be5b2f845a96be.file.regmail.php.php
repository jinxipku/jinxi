<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-29 01:55:40
         compiled from "..\application\views\account\regmail.php" */ ?>
<?php /*%%SmartyHeaderCode:55235516eb1cf02860-86228916%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f25c504ab54f946b73a4b70065be5b2f845a96be' => 
    array (
      0 => '..\\application\\views\\account\\regmail.php',
      1 => 1427553485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55235516eb1cf02860-86228916',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
    'verify_email' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5516eb1d1b27f3_00181672',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5516eb1d1b27f3_00181672')) {function content_5516eb1d1b27f3_00181672($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/info/mail.png" alt="register fail">
			</div>
			<div id="info_cont">
				<p>恭喜注册成功，今昔网已经向您的注册邮箱发送了一封激活邮件，请您立即前往激活。</p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['verify_email']->value;?>
" type="button" class="btn btn-info btn-hg" title="若您的邮箱符合常见后缀规则，请点击此按钮登录邮箱">马上激活</a>
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
