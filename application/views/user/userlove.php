<p class="numinfo">共{$tpage}页（{$tuser}名用户），这是第{$cpage}页（每页20项）。</p>
<hr/>
{if $tuser == 0}
<div class="sorry_box">
	<div>
		<img class="passive" src="{$baseurl}img/info/sorry.png" alt="sorry"/>
	</div>
	<div>
		<p>sorry，今昔网木有为您找到数据~</p>
		<p>立刻去关注些小伙伴，了解他们的动态吧~</p>
	</div>
</div>
{else}
<?php foreach ($loves as $loveitem): ?>
<div class="postitembig">
	<div class="postimage">
	<a href="<?=$baseurl?>user/<?=$loveitem['user_id']?>"><img style="width: 114px; height: 114px;"
		src="<?=$baseurl?>img/head/<?php
	if ($loveitem ['image'] == '0')
		echo '0.jpg';
	else
		echo $loveitem ['user_id'] . '_' . $loveitem ['image'];
	?>"
		alt="" title="<?=$loveitem['user_name']?>" /></a></div>

	<div class="postinfo">
		<p class="username">
			<a class="<?=get_namecolor($loveitem['namecolor'])?>"
				href="<?=$baseurl?>user/<?=$loveitem['user_id']?>"><?=$loveitem['user_name']?></a>
			<span>[<?=$loveitem['school']?>]</span><span style="color: #999;">&nbsp;<?=$loveitem['level']?>级</span>
			<small>（<?=$loveitem['visit']?>人看过，<?=$loveitem['love']?>名关注者）</small>
		</p>
		<div style="height: 43px; width: 543px;">
			<p style="margin-bottom: 0; color: #7F8C8D; font-size: 13px;">签名：</p>
			<div class="signwraper">
				<norb class="userlatest" title="<?=$loveitem['sign']?>">
				<?=$loveitem['sign']?>
			</norb>
			</div>
		</div>
		<div style="height: 43px; width: 543px;">
			<p style="margin-bottom: 0; color: #7F8C8D; font-size: 13px;">最新帖子：</p>
			<div class="signwraper">
				<norb class="userlatest"
					title="<?php
	if ($loveitem ['latest'] == 1)
		echo '暂无';
	else
		echo get_title_str ( $loveitem ['ptype'], $loveitem ['pgtype'], $loveitem ['pstype'], $loveitem ['class'], $loveitem ['brand'], $loveitem ['modal'], $loveitem ['pimage'] );
	?>">
				<?php
	if ($loveitem ['latest'] == 1)
		echo '暂无';
	else
		echo '<a href="'.$baseurl.'item/viewpost/'.$loveitem ['post_id'].'">'.get_title_str ( $loveitem ['ptype'], $loveitem ['pgtype'],
				$loveitem ['pstype'], $loveitem ['class'],
				$loveitem ['brand'], $loveitem ['modal'], $loveitem ['pimage'] ).'</a>';
	?>
			</norb>
			</div>
		</div>
	</div>
	<div class="postquality" style="text-align: center;">
		<p class="userstat">帖子总数</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?=$loveitem['post_num']?></p>
		<p class="userstat">卖家评分</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?php
	if ($loveitem ['sell_comment'] == 0)
		echo '暂无评分';
	else
		echo round ( 10 * $loveitem ['sell_mark'] / $loveitem ['sell_comment'] ) / 10;
	?></p>
		<p class="userstat">买家评分</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?php
	if ($loveitem ['buy_comment'] == 0)
		echo '暂无评分';
	else
		echo round ( 10 * $loveitem ['buy_mark'] / $loveitem ['buy_comment'] ) / 10;
	?></p>
	</div>
</div>
<hr style="margin-top: 1px; margin-bottom: 1px;" />
<?php endforeach; ?>
<center>
	<div class="pagination">
		<ul>
			<li class="previous"><a href="#" style="margin: 0;"
				onclick="showuserpage(4,<?=$cur_user['user_id']?>,1,1);return false;">首页</a></li>
		<?php if($page>1):?>
			<li class="previous"><a href="#" class="fui-arrow-left"
				onclick="showuserpage(4,<?=$cur_user['user_id']?>,<?=$page-1?>,1);return false;"></a></li>
		<?php endif;?>
		<?php for($i = $stpage;$i<=$edpage;$i++):?>
			<li <?php if($i==$page)echo ' class="active"';?>><a href="#"
				onclick="showuserpage(4,<?=$cur_user['user_id']?>,<?=$i?>,1);return false;"><?=$i?></a></li>
		<?php endfor;?>
		<?php if($page<$totalpage):?>
			<li class="next"><a href="#" class="fui-arrow-right"
				onclick="showuserpage(4,<?=$cur_user['user_id']?>,<?=$page+1?>,1);return false;"></a></li>
		<?php endif;?>
		<li class="next" style="margin: 0;"><a href="#" style="margin: 0;"
				onclick="showuserpage(4,<?=$cur_user['user_id']?>,<?=$totalpage?>,1);return false;">末页</a></li>
		</ul>
	</div>
</center>
{/if}
