<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-01 21:51:06
         compiled from "..\application\views\setup\side.php" */ ?>
<?php /*%%SmartyHeaderCode:17993551bf7cadc15d6-35564439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '972c76559aa098d84a8e8440232674c8d241467d' => 
    array (
      0 => '..\\application\\views\\setup\\side.php',
      1 => 1427894953,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17993551bf7cadc15d6-35564439',
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
  'unifunc' => 'content_551bf7cae8c4a1_69709562',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551bf7cae8c4a1_69709562')) {function content_551bf7cae8c4a1_69709562($_smarty_tpl) {?>		<div id="side">
			<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
display/hall" type="button" class="btn btn-primary btn-hg btn-block">商品大厅</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
item/newpost/type" type="button" class="btn btn-primary btn-hg btn-block">发布信息</a>

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

			<div id="side_hot">
				<blockquote>
					<p class="side_title">最热推荐</p>
				</blockquote>
				<div class="panel panel-default">
					最热推荐
				</div>
			</div>

			<div id="side_new">
				<blockquote>
					<p class="side_title">最新推荐</p>
				</blockquote>
				<div class="panel panel-default">
					最新推荐
				</div>
			</div>

			<div id="side_ran">
				<blockquote>
					<p class="side_title">随便看看</p>
				</blockquote>
				<div class="panel panel-default">
					<button type="button" class="btn btn-primary btn-hg btn-block">走你！</button>
				</div>
			</div>

			<img class="passive" id="side_icon" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/jinxibig.jpg" alt="http://www.xn--wmqr18c.cn"/>
		</div>
	</div>

	<div id="info_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<p class="modal-cont"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-primary">确认</button>
				</div>
			</div>
		</div>
	</div>
<?php }} ?>
