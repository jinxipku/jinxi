<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-01 01:47:54
         compiled from "..\application\views\setup\main.php" */ ?>
<?php /*%%SmartyHeaderCode:19413551ad20d8a86f1-96717695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abf8b449c9b40af27379d24efb6343a5327423de' => 
    array (
      0 => '..\\application\\views\\setup\\main.php',
      1 => 1427824072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19413551ad20d8a86f1-96717695',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551ad20d8fade4_44057381',
  'variables' => 
  array (
    'set_tab' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551ad20d8fade4_44057381')) {function content_551ad20d8fade4_44057381($_smarty_tpl) {?>	<div id="body" class="row">
        <div id="main">
			<div id="set_tabs">
				<ul class="nav nav-pills nav-stacked">
					<li <?php if ($_smarty_tpl->tpl_vars['set_tab']->value==1) {?>class="active"<?php }?>>
						<a href="#set_info" data-toggle="tab">修改资料</a>
					</li>
					<li <?php if ($_smarty_tpl->tpl_vars['set_tab']->value==2) {?>class="active"<?php }?>>
						<a href="#set_head" data-toggle="tab">修改头像</a>
					</li>
					<li <?php if ($_smarty_tpl->tpl_vars['set_tab']->value==3) {?>class="active"<?php }?>>
						<a href="#set_pw" data-toggle="tab">账户设置</a>
					</li>
					<li <?php if ($_smarty_tpl->tpl_vars['set_tab']->value==4) {?>class="active"<?php }?>>
						<a href="#set_star" data-toggle="tab">星级用户</a>
					</li>
				</ul>
			</div>
			<div id="set_panels" class="panel panel-default">
				<div class="tab-content">
					<div id="set_info" class="tab-pane fade<?php if ($_smarty_tpl->tpl_vars['set_tab']->value==1) {?> in active<?php }?>">
						<?php echo $_smarty_tpl->tpl_vars['this']->value->display('setup/setinfo.php');?>

					</div>
					<div id="set_head" class="tab-pane fade<?php if ($_smarty_tpl->tpl_vars['set_tab']->value==2) {?> in active<?php }?>">
						<?php echo $_smarty_tpl->tpl_vars['this']->value->display('setup/setinfo.php');?>

					</div>
					<div id="set_pw" class="tab-pane fade<?php if ($_smarty_tpl->tpl_vars['set_tab']->value==3) {?> in active<?php }?>">
						<?php echo $_smarty_tpl->tpl_vars['this']->value->display('setup/setinfo.php');?>

					</div>
					<div id="set_pw" class="tab-pane fade<?php if ($_smarty_tpl->tpl_vars['set_tab']->value==4) {?> in active<?php }?>">
						<?php echo $_smarty_tpl->tpl_vars['this']->value->display('setup/setinfo.php');?>

					</div>
				</div>
			</div>
	</div><?php }} ?>
