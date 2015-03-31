<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-31 20:42:37
         compiled from "..\application\views\user\main.php" */ ?>
<?php /*%%SmartyHeaderCode:28334551a47481eeca8-13466585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '169c3ef0eab18217ce7242055b7ead1a3b478071' => 
    array (
      0 => '..\\application\\views\\user\\main.php',
      1 => 1427805681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28334551a47481eeca8-13466585',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551a474827adf3_52694309',
  'variables' => 
  array (
    'baseurl' => 0,
    'user' => 0,
    'login_user' => 0,
    'myself' => 0,
    'has_love' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551a474827adf3_52694309')) {function content_551a474827adf3_52694309($_smarty_tpl) {?>	<div id="body" class="row">
        <div id="main">
            <div id="user_header">
				<div id="user_img">
					<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
						<img class="passive" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/head/<?php echo $_smarty_tpl->tpl_vars['user']->value['head'];?>
" alt="user_<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
_headimg" title="<?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
"/>
					</a>
				</div>
				<div id="user_info">
					<p class="user_name">
						<a class="<?php echo $_smarty_tpl->tpl_vars['user']->value['nick_color'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
</a>
						<small>（<?php echo $_smarty_tpl->tpl_vars['user']->value['visits'];?>
人看过，<?php echo $_smarty_tpl->tpl_vars['user']->value['lovers'];?>
名关注者）</small>
					</p>
					<p class="user_level"><?php echo $_smarty_tpl->tpl_vars['user']->value['level'];?>
级 连续登陆<?php echo $_smarty_tpl->tpl_vars['user']->value['logins'];?>
天</p>
					<p class="user_info"><?php echo $_smarty_tpl->tpl_vars['user']->value['sex'];?>
 | <?php echo $_smarty_tpl->tpl_vars['user']->value['school_name'];?>
 | <?php echo $_smarty_tpl->tpl_vars['user']->value['type'];?>
 | <?php echo $_smarty_tpl->tpl_vars['user']->value['year'];?>
</p>
					<p class="user_post">发帖总数：<?php echo $_smarty_tpl->tpl_vars['user']->value['post_number'];?>
 | 有效帖数：<?php echo $_smarty_tpl->tpl_vars['user']->value['active_post_number'];?>
</p>
					<p class="user_sign">签名：<?php echo $_smarty_tpl->tpl_vars['user']->value['signature'];?>
</p>
				</div>
				<div id="user_edit">
					<?php if (!isset($_smarty_tpl->tpl_vars['login_user']->value)) {?>
					<a type="button" class="btn btn-sm btn-info" href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/loginfo">
						<span class="fui-plus"></span>关注
					</a>
					<?php } elseif (isset($_smarty_tpl->tpl_vars['myself']->value)) {?>
					<a type="button" class="btn btn-sm btn-info" href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
setup">
						<span class="fui-gear"></span>编辑
					</a>
					<?php } elseif (isset($_smarty_tpl->tpl_vars['has_love']->value)) {?>
					<button id="btn_love" type="button" class="btn btn-sm btn-info" onclick="delete_love(<?php echo $_smarty_tpl->tpl_vars['login_user']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
)" onmouseover="change2dl()" onmouseout="change2al()">
						已关注
					</button>
					<?php } else { ?>
					<button id="btn_love" type="button" class="btn btn-sm btn-info" onclick="add_love(<?php echo $_smarty_tpl->tpl_vars['login_user']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
)">
						<span class="fui-plus"></span>关注
					</button>
					<?php }?>
				</div>
			</div>
			<div id="scroll_bench"></div>
			<div id="user_tabs">
				<?php if (isset($_smarty_tpl->tpl_vars['myself']->value)) {?>
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#user_post" data-toggle="tab" onclick="show_user_page('#user_post', <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, 1 , 1)">我的帖子</a>
					</li>
					<li>
						<a href="#user_best" data-toggle="tab" onclick="show_user_page('#user_best', <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, 1 , 1)">我的推荐</a>
					</li>
					<li>
						<a href="#user_coll" data-toggle="tab" onclick="show_user_page('#user_coll', <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, 1 , 1)">我的收藏</a>
					</li>
					<li>
						<a href="#user_love" data-toggle="tab" onclick="show_user_page('#user_love', <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, 1 , 1)">我的关注</a>
					</li>
					<li>
						<a href="#user_mess" data-toggle="tab" onclick="show_user_page('#user_mess', <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, 1 , 1)">我的消息</a>
					</li>
				</ul>
				<?php } else { ?>
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#user_post" data-toggle="tab" onclick="show_user_page('#user_post', <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
, 1 , 1)">TA的帖子</a>
					</li>
				</ul>
				<?php }?>
			</div>
			<?php echo '<script'; ?>
 type="text/javascript">
				$(window).scroll(function(event) {
					var st = $(this).scrollTop();
					if (st > 351) {
						$("#user_tabs").css("position","fixed");
						$("#user_tabs").css("top",0);
						$("#user_panels").css("margin-top", 92);
					} else {
						$("#user_tabs").css("position","relative");
						$("#user_panels").css("margin-top", 0);
					}
				});
			<?php echo '</script'; ?>
>

			<div id="user_panels" class=" panel panel-default">
				<?php if (isset($_smarty_tpl->tpl_vars['myself']->value)) {?>
				<div class="tab-content">
					<div id="user_post" class="tab-pane fade in active"></div>
					<div id="user_best" class="tab-pane fade"></div>
					<div id="user_coll" class="tab-pane fade"></div>
					<div id="user_love" class="tab-pane fade"></div>
					<div id="user_mess" class="tab-pane fade"></div>
				</div>
				<?php } else { ?>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="#user_post"></div>
				</div>
				<?php }?>
			</div>
        </div>
<?php }} ?>
