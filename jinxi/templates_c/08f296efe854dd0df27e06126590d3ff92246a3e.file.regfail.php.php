<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-28 17:47:25
         compiled from "..\application\views\account\regfail.php" */ ?>
<?php /*%%SmartyHeaderCode:31452551663b95ef5f2-92469490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08f296efe854dd0df27e06126590d3ff92246a3e' => 
    array (
      0 => '..\\application\\views\\account\\regfail.php',
      1 => 1427531810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31452551663b95ef5f2-92469490',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551663b96f8898_78785591',
  'variables' => 
  array (
    'baseurl' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551663b96f8898_78785591')) {function content_551663b96f8898_78785591($_smarty_tpl) {?>	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/info/fail.png" alt="register fail">
			</div>
			<div id="info_cont">
				<p>对不起注册失败，请您检查注册信息是否完善。</p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/register" type="button" class="btn btn-info btn-hg">返回注册</a>
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
