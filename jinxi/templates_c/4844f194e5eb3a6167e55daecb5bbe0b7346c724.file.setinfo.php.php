<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-01 23:15:05
         compiled from "..\application\views\setup\setinfo.php" */ ?>
<?php /*%%SmartyHeaderCode:28967551ad88057ca33-60526982%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4844f194e5eb3a6167e55daecb5bbe0b7346c724' => 
    array (
      0 => '..\\application\\views\\setup\\setinfo.php',
      1 => 1427901302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28967551ad88057ca33-60526982',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551ad8805a61e3_76502078',
  'variables' => 
  array (
    'login_user' => 0,
    'loop' => 0,
    'baseurl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551ad8805a61e3_76502078')) {function content_551ad8805a61e3_76502078($_smarty_tpl) {?><p class="set_title">修改资料</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">基本信息</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="set_label">
					<p>姓 名</p>
				</div>
				<div class="set_input">
					<input id="nick" name="nick" type="text" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['nick'];?>
" class="form-control flat" maxlength=10/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>性 别</p>
				</div>
				<div class="set_input">
					<label class="radio<?php if ($_smarty_tpl->tpl_vars['login_user']->value['sex']=='兔星人') {?> checked<?php }?>">
						<input type="radio" id="sex0" name="sex" value="0" data-toggle="radio"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['sex']=='兔星人') {?> checked<?php }?>/>兔星人
					</label>
					<label class="radio<?php if ($_smarty_tpl->tpl_vars['login_user']->value['sex']=='汪星人') {?> checked<?php }?>">
						<input type="radio" id="sex1" name="sex" value="1" data-toggle="radio"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['sex']=='汪星人') {?> checked<?php }?>/>汪星人
					</label>
					<label class="radio<?php if ($_smarty_tpl->tpl_vars['login_user']->value['sex']=='喵星人') {?> checked<?php }?>"> 
						<input type="radio" id="sex2" name="sex" value="2" data-toggle="radio"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['sex']=='喵星人') {?> checked<?php }?>/>喵星人
					</label> 
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>签 名</p>
				</div>
				<div class="set_input">
					<textarea rows="4" id="signature" name="signature" class="form-control flat" maxlength=80><?php echo $_smarty_tpl->tpl_vars['login_user']->value['signature'];?>
</textarea>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">学校信息</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="set_label">
					<p>学 校</p>
				</div>
				<div class="set_input">
					<input id="school" name="school" type="text" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['school_name'];?>
" class="form-control flat" disabled/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>身 份</p>
				</div>
				<div class="set_input">
					<select id="type" name="type">
						<option value="0"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='未选择') {?> selected<?php }?>>未选择</option>
						<option value="1"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='本科生') {?> selected<?php }?>>本科生</option>
						<option value="2"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='硕士生') {?> selected<?php }?>>硕士生</option>
						<option value="3"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='博士生') {?> selected<?php }?>>博士生</option>
						<option value="4"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='教职工') {?> selected<?php }?>>教职工</option>
						<option value="5"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='校友') {?> selected<?php }?>>校友</option>
						<option value="6"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['type']=='校外合作者') {?> selected<?php }?>>校外合作者</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>年 份</p>
				</div>
				<div class="set_input">
					<select id="year">
						<option value="0"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['year']==0) {?> selected<?php }?>>未选择</option>
					<?php $_smarty_tpl->tpl_vars["loop"] = new Smarty_variable("8", null, 0);?>
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['name'] = "loop";
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['loop']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["loop"]['total']);
?>
　　						<option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']+2008;?>
"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['year']==$_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']+2008) {?> selected<?php }?>>
						<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']+2008;?>
级
						</option>
　　					<?php endfor; endif; ?>
						<option value="1"<?php if ($_smarty_tpl->tpl_vars['login_user']->value['year']==1) {?> selected<?php }?>>其他</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>

	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
js/bootstrap-select.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
		$("select").selectpicker({
			style: 'btn-primary',
			menuStyle: 'dropdown'
		});
	<?php echo '</script'; ?>
>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">联系方式</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="set_label">
					<p>邮 箱</p>
				</div>
				<div class="set_input">
					<input id="email" name="email" type="text" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['email'];?>
" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>Q Q</p>
				</div>
				<div class="set_input">
					<input id="qq" name="qq" type="text" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['qq'];?>
" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>微 信</p>
				</div>
				<div class="set_input">
					<input id="weixin" name="weixin" type="text" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['weixin'];?>
" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>手 机</p>
				</div>
				<div class="set_input">
					<input id="phone" name="phone" type="text" value="<?php echo $_smarty_tpl->tpl_vars['login_user']->value['phone'];?>
" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<hr/>
<button id="btn_saveinfo" class="set_save btn btn-lg btn-primary" type="button" onclick="save_info()"> 保 存 </button><?php }} ?>
