<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-30 22:15:54
         compiled from "..\application\views\account\regsuccess.php" */ ?>
<?php /*%%SmartyHeaderCode:2333955195a9aba8709-53802372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8309d2581d0b03ebadb6d1c6955d37aed472d4c9' => 
    array (
      0 => '..\\application\\views\\account\\regsuccess.php',
      1 => 1427723485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2333955195a9aba8709-53802372',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
    'mem_url' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55195a9adf5610_39655270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55195a9adf5610_39655270')) {function content_55195a9adf5610_39655270($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img class="passive" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/info/success.png" alt="register fail">
			</div>
			<div id="info_cont">
				<p>恭喜您验证完毕，今昔网已经自动为您登录，您可以返回注册前页面或立即进入设置页面修改个人资料。</p>
				<?php if (isset($_smarty_tpl->tpl_vars['mem_url']->value)) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['mem_url']->value;?>
" type="button" class="btn btn-info btn-hg" title="返回注册前页面">返回页面</a>
				<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
" type="button" class="btn btn-info btn-hg" title="返回主页">返回主页</a>
				<?php }?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
setup" type="button" class="btn btn-info btn-hg" title="前往设置页面">设置页面</a>
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
