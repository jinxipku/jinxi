<div class="row" style="margin-top: 20px;">
	<div id="scrollhead1" style="position: absolute; top: 310px;"></div>
	<div class="leftpart">
		<div class="userheader">
			<div
				style="position: relative; float: left; width: 200px; height: 200px;">
				<a href="<?=$baseurl?>user/<?=$cur_user['user_id']?>"><img
					src="<?=$baseurl?>img/head/<?php
					if ($cur_user ['image'] == '0')
						echo '0.jpg';
					else
						echo $cur_user ['user_id'] . '_' . $cur_user ['image'];
					?>"
					alt="" title="<?=$cur_user['user_name']?>" style="width: 200px;" /></a>
			</div>
			<div
				style="position: relative; float: left; width: 572px; height: 200px; padding-left: 30px;">
				<div id="lovebox" style="position: absolute; top: 0; right: 0">
				<?php if(!isset($login_user)):?>
					<a type="button" class="btn btn-sm btn-info"
						href="<?=$baseurl?>account/loginfo"><span class="fui-plus"></span>关注</a>
				<?php elseif($cur_user['user_id']==$login_user['user_id']):?>
					<a type="button" class="btn btn-sm btn-info"
						href="<?=$baseurl?>setup"><span class="fui-gear"></span>编辑</a>
				<?php elseif($haslove == 1):?>
					<button id="lovebt" type="button" class="btn btn-sm btn-info"
						onclick="deletelove(<?=$login_user['user_id']?>,<?=$cur_user['user_id']?>,<?=$cur_user['love']?>)"
						onmouseover="change2dl()" onmouseout="change2al()">已关注</button>
				<?php else:?>
					<button type="button" class="btn btn-sm btn-info"
						onclick="addlove(<?=$login_user['user_id']?>,<?=$cur_user['user_id']?>,<?=$cur_user['love']?>)">
						<span class="fui-plus"></span>关注
					</button>
				<?php endif;?>
				</div>
				<p class="username">
					<a class="<?=get_namecolor($cur_user['namecolor'])?>"
						href="<?=$baseurl?>user/<?=$cur_user['user_id']?>"><?=$cur_user['user_name']?></a><small>（<?=$cur_user['visit']?>人看过，<?=$cur_user['love']?>名关注者）</small>
				</p>
				<p class="userlevel"><?=$cur_user['level']?>级 连续登陆<?=$cur_user['login_days']?>天</p>
				<p class="userinfo"><?=get_sex($cur_user['sex'])?> | <?=$cur_user['school']?> | <?=$cur_user['degree']?> | <?=$cur_user['year']?></p>
				<p class="usermark">卖家评分：<?php
				if ($cur_user ['sell_comment'] == 0)
					echo '暂无评分';
				else
					echo round ( 10 * $cur_user ['sell_mark'] / $cur_user ['sell_comment'] ) / 10;
				?> ; 买家评分：<?php
				if ($cur_user ['buy_comment'] == 0)
					echo '暂无评分';
				else
					echo round ( 10 * $cur_user ['buy_mark'] / $cur_user ['buy_comment'] ) / 10;
				?></p>
				<p class="usersign">签名：<?=$cur_user['sign']?></p>
			</div>
			<?php if(isset($login_user)&&$cur_user['user_id']==$login_user['user_id']):?>
			<ul class="nav nav-tabs"
				style="position: relative; float: left; margin-top: 4px;">
				<li class="active"><a href="#thisrec" data-toggle="tab"
					onclick="showuserpage(0,<?=$cur_user['user_id']?>,1,0)">本站推荐</a></li>
				<li><a href="#bbsrec" data-toggle="tab"
					onclick="showuserpage(1,<?=$cur_user['user_id']?>,1,0)">BBS推荐</a></li>
				<li><a href="#mypost" data-toggle="tab"
					onclick="showuserpage(2,<?=$cur_user['user_id']?>,1,0)">我的商品</a></li>
				<li><a href="#myfocus" data-toggle="tab"
					onclick="showuserpage(3,<?=$cur_user['user_id']?>,1,0)">我的收藏</a></li>
				<li><a href="#mylove" data-toggle="tab"
					onclick="showuserpage(4,<?=$cur_user['user_id']?>,1,0)">我的关注</a></li>
				<li><a id="mycommlink" href="#mycomm" data-toggle="tab"
					onclick="showuserpage(5,<?=$cur_user['user_id']?>,1,0)">我的评论</a></li>
				<li><a href="#mymess" data-toggle="tab"
					onclick="showuserpage(8,<?=$cur_user['user_id']?>,1,0)">我的消息</a></li>
			</ul>
			<?php else:?>
			<ul class="nav nav-tabs"
				style="position: relative; float: left; margin-top: 4px;">
				<li class="active"><a href="#mypost" data-toggle="tab"
					onclick="showuserpage(2,<?=$cur_user['user_id']?>,1,0)">TA的商品</a></li>
				<li><a id="mycommlink" href="#mycomm" data-toggle="tab"
					onclick="showuserpage(5,<?=$cur_user['user_id']?>,1,0)">TA的评论</a></li>
			</ul>
			<div style="position: absolute; top: 207px; right: 0">
				<?php if(!isset($login_user)):?>
				<a type="button" class="btn btn-sm btn-primary"
					href="<?=$baseurl?>account/loginfo">评论TA</a>
				<?php else:?>
				<button type="button" class="btn btn-sm btn-primary"
					onclick="gotocomm(<?=$cur_user['user_id']?>)">评论TA</button>
				<?php endif;?>
			</div>
			<?php endif;?>
		</div>
		<div class=" panel panel-default">
		<?php if(isset($login_user)&&$cur_user['user_id']==$login_user['user_id']):?>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="thisrec"></div>
				<div class="tab-pane fade" id="bbsrec"></div>
				<div class="tab-pane fade" id="mypost"></div>
				<div class="tab-pane fade" id="myfocus"></div>
				<div class="tab-pane fade" id="mylove"></div>
				<div class="tab-pane fade" id="mycomm"></div>
				<div class="tab-pane fade" id="mymess"></div>
			</div>
			<?php else:?>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="mypost"></div>
				<div class="tab-pane fade" id="mycomm"></div>
			</div>
			<?php endif;?>
		</div>
	</div>
	
	<?php
	$this->load->view ( 'index/righthalf' );
	?>