<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-28 17:04:02
         compiled from "..\application\views\account\regsuccess.php" */ ?>
<?php /*%%SmartyHeaderCode:1229555166e314bfeb8-85705769%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab24184cf8db2868a8cb55556452f60468847417' => 
    array (
      0 => '..\\application\\views\\account\\regsuccess.php',
      1 => 1427533440,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1229555166e314bfeb8-85705769',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55166e31533ce8_76855395',
  'variables' => 
  array (
    'baseurl' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55166e31533ce8_76855395')) {function content_55166e31533ce8_76855395($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/info/success.png" alt="register fail">
			</div>
			<div id="info_cont">
				<p>恭喜您验证完毕，今昔网已经自动为您登录，欢迎加入今昔网，请尽情使用。</p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
" type="button" class="btn btn-info btn-hg" title="若您的邮箱符合常见后缀规则，请点击此按钮登录邮箱。">返回主页</a>
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
