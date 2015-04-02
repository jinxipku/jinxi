<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-02 00:49:01
         compiled from "..\application\views\setup\sethead.php" */ ?>
<?php /*%%SmartyHeaderCode:7838551c16f4026944-50377551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '289a816b8cc5e81873eba1acd622ccf873353797' => 
    array (
      0 => '..\\application\\views\\setup\\sethead.php',
      1 => 1427906938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7838551c16f4026944-50377551',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551c16f4049882_60348605',
  'variables' => 
  array (
    'baseurl' => 0,
    'login_user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551c16f4049882_60348605')) {function content_551c16f4049882_60348605($_smarty_tpl) {?><p class="set_title">修改头像</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">头像上传</p>
		<div class="set_table_content">
			<form id="form_photo" name="form_photo" action="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
user/upload_photo" enctype="multipart/form-data" accept-charset="utf-8" method="post">
				<div class="form-group">
					<input type="file" id="head_image" name="head_image">
					<p id="file_info" class="help-block">支持gif、jpg、png图片格式，大小不要超过2M</p>
				</div>
				<button id="btn_upload_head" type="button" class="btn btn-primary btn-lg">上 传</button>
			</form>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">当前头像</p>
		<div class="set_table_content">
			<div id="show_head">
				<img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/head/<?php echo $_smarty_tpl->tpl_vars['login_user']->value['head'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['nick'];?>
的头像"/>
			</div>
			<form id="save_photo" action="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
user/crop_photo" accept-charset="utf-8" method="post">
				<input type="hidden" name="p_x" id="p_x" value="">
				<input type="hidden" name="p_y" id="p_y" value="">
				<input type="hidden" name="p_h" id="p_h" value="">
				<input type="hidden" name="p_w" id="p_w" value="">
				<input type="hidden" name="p_k" id="p_k" value="">
				<input type="hidden" name="file_name" id="file_name" value="">
			</form>
		</div>
	</div>
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
js/jquery.jcrop.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
js/jquery.form.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
js/crop_photo.js"><?php echo '</script'; ?>
>
<?php }} ?>
