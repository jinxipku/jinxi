<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-01 22:23:31
         compiled from "..\application\views\user\userlove.php" */ ?>
<?php /*%%SmartyHeaderCode:5398551bff63043217-20742144%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae72a8886bc3f3281d2d194b9d58cc6a0d3f5a72' => 
    array (
      0 => '..\\application\\views\\user\\userlove.php',
      1 => 1427894953,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5398551bff63043217-20742144',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpage' => 0,
    'tuser' => 0,
    'cpage' => 0,
    'baseurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551bff6384ae66_18618989',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551bff6384ae66_18618989')) {function content_551bff6384ae66_18618989($_smarty_tpl) {?><p class="numinfo">共<?php echo $_smarty_tpl->tpl_vars['tpage']->value;?>
页（<?php echo $_smarty_tpl->tpl_vars['tuser']->value;?>
名用户），这是第<?php echo $_smarty_tpl->tpl_vars['cpage']->value;?>
页（每页20项）。</p>
<hr/>
<?php if ($_smarty_tpl->tpl_vars['tuser']->value==0) {?>
<div class="sorry_box">
	<div>
		<img class="passive" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/info/sorry.png" alt="sorry"/>
	</div>
	<div>
		<p>sorry，今昔网木有为您找到数据~</p>
		<p>立刻去关注些小伙伴，了解他们的动态吧~</p>
	</div>
</div>
<?php } else { ?>
<?php echo '<?php'; ?>
 foreach ($loves as $loveitem): <?php echo '?>'; ?>

<div class="postitembig">
	<div class="postimage">
	<a href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
user/<?php echo '<?'; ?>
=$loveitem['user_id']<?php echo '?>'; ?>
"><img style="width: 114px; height: 114px;"
		src="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
img/head/<?php echo '<?php'; ?>

	if ($loveitem ['image'] == '0')
		echo '0.jpg';
	else
		echo $loveitem ['user_id'] . '_' . $loveitem ['image'];
	<?php echo '?>'; ?>
"
		alt="" title="<?php echo '<?'; ?>
=$loveitem['user_name']<?php echo '?>'; ?>
" /></a></div>

	<div class="postinfo">
		<p class="username">
			<a class="<?php echo '<?'; ?>
=get_namecolor($loveitem['namecolor'])<?php echo '?>'; ?>
"
				href="<?php echo '<?'; ?>
=$baseurl<?php echo '?>'; ?>
user/<?php echo '<?'; ?>
=$loveitem['user_id']<?php echo '?>'; ?>
"><?php echo '<?'; ?>
=$loveitem['user_name']<?php echo '?>'; ?>
</a>
			<span>[<?php echo '<?'; ?>
=$loveitem['school']<?php echo '?>'; ?>
]</span><span style="color: #999;">&nbsp;<?php echo '<?'; ?>
=$loveitem['level']<?php echo '?>'; ?>
级</span>
			<small>（<?php echo '<?'; ?>
=$loveitem['visit']<?php echo '?>'; ?>
人看过，<?php echo '<?'; ?>
=$loveitem['love']<?php echo '?>'; ?>
名关注者）</small>
		</p>
		<div style="height: 43px; width: 543px;">
			<p style="margin-bottom: 0; color: #7F8C8D; font-size: 13px;">签名：</p>
			<div class="signwraper">
				<norb class="userlatest" title="<?php echo '<?'; ?>
=$loveitem['sign']<?php echo '?>'; ?>
">
				<?php echo '<?'; ?>
=$loveitem['sign']<?php echo '?>'; ?>

			</norb>
			</div>
		</div>
		<div style="height: 43px; width: 543px;">
			<p style="margin-bottom: 0; color: #7F8C8D; font-size: 13px;">最新帖子：</p>
			<div class="signwraper">
				<norb class="userlatest"
					title="<?php echo '<?php'; ?>

	if ($loveitem ['latest'] == 1)
		echo '暂无';
	else
		echo get_title_str ( $loveitem ['ptype'], $loveitem ['pgtype'], $loveitem ['pstype'], $loveitem ['class'], $loveitem ['brand'], $loveitem ['modal'], $loveitem ['pimage'] );
	<?php echo '?>'; ?>
">
				<?php echo '<?php'; ?>

	if ($loveitem ['latest'] == 1)
		echo '暂无';
	else
		echo '<a href="'.$baseurl.'item/viewpost/'.$loveitem ['post_id'].'">'.get_title_str ( $loveitem ['ptype'], $loveitem ['pgtype'],
				$loveitem ['pstype'], $loveitem ['class'],
				$loveitem ['brand'], $loveitem ['modal'], $loveitem ['pimage'] ).'</a>';
	<?php echo '?>'; ?>

			</norb>
			</div>
		</div>
	</div>
	<div class="postquality" style="text-align: center;">
		<p class="userstat">帖子总数</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?php echo '<?'; ?>
=$loveitem['post_num']<?php echo '?>'; ?>
</p>
		<p class="userstat">卖家评分</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?php echo '<?php'; ?>

	if ($loveitem ['sell_comment'] == 0)
		echo '暂无评分';
	else
		echo round ( 10 * $loveitem ['sell_mark'] / $loveitem ['sell_comment'] ) / 10;
	<?php echo '?>'; ?>
</p>
		<p class="userstat">买家评分</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?php echo '<?php'; ?>

	if ($loveitem ['buy_comment'] == 0)
		echo '暂无评分';
	else
		echo round ( 10 * $loveitem ['buy_mark'] / $loveitem ['buy_comment'] ) / 10;
	<?php echo '?>'; ?>
</p>
	</div>
</div>
<hr style="margin-top: 1px; margin-bottom: 1px;" />
<?php echo '<?php'; ?>
 endforeach; <?php echo '?>'; ?>

<center>
	<div class="pagination">
		<ul>
			<li class="previous"><a href="#" style="margin: 0;"
				onclick="showuserpage(4,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,1,1);return false;">首页</a></li>
		<?php echo '<?php'; ?>
 if($page>1):<?php echo '?>'; ?>

			<li class="previous"><a href="#" class="fui-arrow-left"
				onclick="showuserpage(4,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$page-1<?php echo '?>'; ?>
,1);return false;"></a></li>
		<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

		<?php echo '<?php'; ?>
 for($i = $stpage;$i<=$edpage;$i++):<?php echo '?>'; ?>

			<li <?php echo '<?php'; ?>
 if($i==$page)echo ' class="active"';<?php echo '?>'; ?>
><a href="#"
				onclick="showuserpage(4,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$i<?php echo '?>'; ?>
,1);return false;"><?php echo '<?'; ?>
=$i<?php echo '?>'; ?>
</a></li>
		<?php echo '<?php'; ?>
 endfor;<?php echo '?>'; ?>

		<?php echo '<?php'; ?>
 if($page<$totalpage):<?php echo '?>'; ?>

			<li class="next"><a href="#" class="fui-arrow-right"
				onclick="showuserpage(4,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$page+1<?php echo '?>'; ?>
,1);return false;"></a></li>
		<?php echo '<?php'; ?>
 endif;<?php echo '?>'; ?>

		<li class="next" style="margin: 0;"><a href="#" style="margin: 0;"
				onclick="showuserpage(4,<?php echo '<?'; ?>
=$cur_user['user_id']<?php echo '?>'; ?>
,<?php echo '<?'; ?>
=$totalpage<?php echo '?>'; ?>
,1);return false;">末页</a></li>
		</ul>
	</div>
</center>
<?php }?>
<?php }} ?>
