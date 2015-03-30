<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-30 21:28:51
         compiled from "..\application\views\account\loginfo.php" */ ?>
<?php /*%%SmartyHeaderCode:1693555194dd97ac582-05815655%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b9d0f8f786f61c637eb939579376f57c7122b6a' => 
    array (
      0 => '..\\application\\views\\account\\loginfo.php',
      1 => 1427722129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1693555194dd97ac582-05815655',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55194dd97e1d24_09351948',
  'variables' => 
  array (
    'baseurl' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55194dd97e1d24_09351948')) {function content_55194dd97e1d24_09351948($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img class="passive" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/info/login.png" alt="register fail">
			</div>
			<div id="info_cont">
				<p>您木有登录哦，请先登录，再尽情使用今昔网~</p>
				<p>什么？您还木有账号？赶紧注册吧~</p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/login" type="button" class="btn btn-info btn-hg">前往登录</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/register" type="button" class="btn btn-info btn-hg">立即注册</a>
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
