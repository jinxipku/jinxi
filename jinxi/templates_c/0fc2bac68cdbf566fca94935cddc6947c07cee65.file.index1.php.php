<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-31 15:03:30
         compiled from "..\application\views\user\index1.php" */ ?>
<?php /*%%SmartyHeaderCode:12525551a2b07cd7421-01674241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fc2bac68cdbf566fca94935cddc6947c07cee65' => 
    array (
      0 => '..\\application\\views\\user\\index1.php',
      1 => 1427785408,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12525551a2b07cd7421-01674241',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551a2b07d6cb73_28220585',
  'variables' => 
  array (
    'baseurl' => 0,
    'user' => 0,
    'login_user' => 0,
    'myself' => 0,
    'haslove' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551a2b07d6cb73_28220585')) {function content_551a2b07d6cb73_28220585($_smarty_tpl) {?>	<div id="body" class="row">
        <div id="main">
            <div class="userheader">
			<div style="position: relative; float: left; width: 200px; height: 200px;">
				<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/head/<?php echo $_smarty_tpl->tpl_vars['user']->value['head'];?>
" alt="user_<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
_headimg" title="<?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
" style="width: 200px;" /></a>
			</div>
			<div style="position: relative; float: left; width: 572px; height: 200px; padding-left: 30px;">
				<div id="lovebox" style="position: absolute; top: 0; right: 0">
				<?php if (!isset($_smarty_tpl->tpl_vars['login_user']->value)) {?>
					<a type="button" class="btn btn-sm btn-info"
						href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
account/loginfo"><span class="fui-plus"></span>关注</a>
				<?php } elseif (isset($_smarty_tpl->tpl_vars['myself']->value)) {?>
					<a type="button" class="btn btn-sm btn-info"
						href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
setup"><span class="fui-gear"></span>编辑</a>
				<?php } elseif (isset($_smarty_tpl->tpl_vars['haslove']->value)) {?>
					<button id="lovebt" type="button" class="btn btn-sm btn-info"
						onclick="deletelove(<?php echo '<?'; ?>
=$login_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$cur_user['love']<?php echo '?>'; ?>
)"
						onmouseover="change2dl()" onmouseout="change2al()">已关注</button>
				<?php } else { ?>
					<button type="button" class="btn btn-sm btn-info"
						onclick="addlove(<?php echo '<?'; ?>
=$login_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$cur_user['love']<?php echo '?>'; ?>
)">
						<span class="fui-plus"></span>关注
					</button>
				<?php }?>
				</div>
				<p class="username">
					<a class="<?php echo $_smarty_tpl->tpl_vars['user']->value['nick_color'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
</a>
					<small>（<?php echo $_smarty_tpl->tpl_vars['user']->value['visits'];?>
人看过，<?php echo $_smarty_tpl->tpl_vars['user']->value['lovers'];?>
名关注者）</small>
				</p>
				<p class="userlevel"><?php echo $_smarty_tpl->tpl_vars['user']->value['level'];?>
级 连续登陆<?php echo $_smarty_tpl->tpl_vars['user']->value['logins'];?>
天</p>
				<p class="userinfo"><?php echo $_smarty_tpl->tpl_vars['user']->value['sex'];?>
 | <?php echo $_smarty_tpl->tpl_vars['user']->value['school_name'];?>
 | <?php echo $_smarty_tpl->tpl_vars['user']->value['type'];?>
 | <?php echo $_smarty_tpl->tpl_vars['user']->value['year'];?>
</p>
				<p class="usermark">发帖总数：<?php echo $_smarty_tpl->tpl_vars['user']->value['post_number'];?>
 | 有效帖数：<?php echo $_smarty_tpl->tpl_vars['user']->value['active_post_number'];?>
</p>
				<p class="usersign">签名：<?php echo $_smarty_tpl->tpl_vars['user']->value['signature'];?>
</p>
			</div>
			<?php if (isset($_smarty_tpl->tpl_vars['myself']->value)) {?>
			<ul class="nav nav-tabs"
				style="position: relative; float: left; margin-top: 4px;">
				<li class="active"><a href="#thisrec" data-toggle="tab"
					onclick="showuserpage(0,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">本站推荐</a></li>
				<li><a href="#bbsrec" data-toggle="tab"
					onclick="showuserpage(1,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">BBS推荐</a></li>
				<li><a href="#mypost" data-toggle="tab"
					onclick="showuserpage(2,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">我的商品</a></li>
				<li><a href="#myfocus" data-toggle="tab"
					onclick="showuserpage(3,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">我的收藏</a></li>
				<li><a href="#mylove" data-toggle="tab"
					onclick="showuserpage(4,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">我的关注</a></li>
				<li><a id="mycommlink" href="#mycomm" data-toggle="tab"
					onclick="showuserpage(5,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">我的评论</a></li>
				<li><a href="#mymess" data-toggle="tab"
					onclick="showuserpage(8,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">我的消息</a></li>
			</ul>
			<?php } else { ?>
			<ul class="nav nav-tabs"
				style="position: relative; float: left; margin-top: 4px;">
				<li class="active"><a href="#mypost" data-toggle="tab"
					onclick="showuserpage(2,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">TA的商品</a></li>
				<li><a id="mycommlink" href="#mycomm" data-toggle="tab"
					onclick="showuserpage(5,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,0)">TA的评论</a></li>
			</ul>
			<?php }?>
		</div>
		<div class=" panel panel-default">
		<?php if (isset($_smarty_tpl->tpl_vars['myself']->value)) {?>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="thisrec"></div>
				<div class="tab-pane fade" id="bbsrec"></div>
				<div class="tab-pane fade" id="mypost"></div>
				<div class="tab-pane fade" id="myfocus"></div>
				<div class="tab-pane fade" id="mylove"></div>
				<div class="tab-pane fade" id="mycomm"></div>
				<div class="tab-pane fade" id="mymess"></div>
			</div>
			<?php } else { ?>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="mypost"></div>
				<div class="tab-pane fade" id="mycomm"></div>
			</div>
			<?php }?>
		</div>
        </div>
<?php }} ?>
