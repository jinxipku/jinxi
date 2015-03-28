<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-27 20:21:10
         compiled from "..\application\views\index\side.php" */ ?>
<?php /*%%SmartyHeaderCode:32327551121561564f3-61777981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fed332f032a7c140b0dddfebc79879fd1f9560ff' => 
    array (
      0 => '..\\application\\views\\index\\side.php',
      1 => 1427458867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32327551121561564f3-61777981',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5511215621b913_91874970',
  'variables' => 
  array (
    'baseurl' => 0,
    'tips' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5511215621b913_91874970')) {function content_5511215621b913_91874970($_smarty_tpl) {?>		<div id="side">
			<div id="login_box" class="side_content panel panel-default">
				<button type="button" class="close" onClick="pre_login(1)">&times;</button>
				<form method="post" id="login_form">
					<div class="form-group">
						<input id="email" name="email" type="mail" placeholder="校园邮箱" class="form-control flat" onblur="check_email(1)">
						<span class="danger" id="check_email"> </span>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="密码" class="form-control flat" onblur="check_pw()"> 
						<span class="danger" id="check_pw"> </span>
					</div>
					<button type="button" class="btn btn-primary btn-block" onClick="login('<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
')">登录</button>
					<p class="p_info">还木有账号？</p>
					<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
/account/register" type="button" class="btn btn-info btn-block">立即注册</a>
				</form>
			</div>

			<a href="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
hall" type="button" class="btn btn-primary btn-hg btn-block">商品大厅</a>
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

			<div id="side_quality">
				<blockquote>
					<p class="side_title">商品品质</p>
				</blockquote>
				<div class="panel panel-default">
					<img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/quality.jpg" alt="quality.jpg"/>
				</div>
			</div>

			<div id="side_tags">
				<blockquote>
					<p class="side_title">商品标签</p>
				</blockquote>
				<div class="panel panel-default">
					<ul class="list-group">
						<li class="list-group-item">
							<p class="text-primary side_tag" data-toggle="collapse" data-target="#tag1">【转让】：适用于待售商品</p>
							<p id="tag1" class="collapse side_tagcon">&nbsp;&nbsp;标明此商品为转让商品，有相关需求的用户可以关注并回复此帖。</p>
						</li>
						<li class="list-group-item">
							<p class="text-primary side_tag" data-toggle="collapse" data-target="#tag2">【求购】：适用于欲求商品</p>
							<p id="tag2" class="collapse side_tagcon">&nbsp;&nbsp;标明此商品为求购商品，有相关闲置的用户可以关注并回复此帖。</p>
						</li>
						<li class="list-group-item">
							<p class="text-warning side_tag" data-toggle="collapse" data-target="#tag3">【自制】：适用于普通商品</p>
							<p id="tag3" class="collapse side_tagcon">&nbsp;&nbsp;标明此商品为楼主手工自制品，商品品质为S级别。</p>
						</li>
						<li class="list-group-item">
							<p class="text-warning side_tag" data-toggle="collapse" data-target="#tag4">【正品】：适用于普通商品</p>
							<p id="tag4" class="collapse side_tagcon">&nbsp;&nbsp;标明此商品为低价未拆封正品，商品品质为S级别。</p>
						</li>
						<li class="list-group-item">
							<p class="text-purple side_tag" data-toggle="collapse" data-target="#tag7">【图】：适用于待售商品</p>
							<p id="tag7" class="collapse side_tagcon">&nbsp;&nbsp;标明此商品附带展示图片。</p>
						</li>
					</ul>
				</div>
			</div>
			
			<img id="side_icon" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/jinxibig.jpg" alt="http://www.xn--wmqr18c.cn"/>
		</div>
	</div><?php }} ?>
