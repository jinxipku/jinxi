<div class="row" style="margin-top: 20px;">
	<div id="scrollhead1" style="position: absolute; top: 310px;"></div>
	<div class="leftpart">
		<div class="userheader">
			<div
				style="position: relative; float: left; width: 200px; height: 200px;">
				<a href="{$baseurl}user/profile/{$user.id}"><img src="{$baseurl}img/head/{$user.head}" alt="user_{$user.id}_headimg" title="{$user['nick']}" style="width: 200px;" /></a>
			</div>
			<div style="position: relative; float: left; width: 572px; height: 200px; padding-left: 30px;">
				<div id="lovebox" style="position: absolute; top: 0; right: 0">
				{if !isset($login_user)}
					<a type="button" class="btn btn-sm btn-info"
						href="{$baseurl}account/loginfo"><span class="fui-plus"></span>关注</a>
				{elseif isset($myself)}
					<a type="button" class="btn btn-sm btn-info"
						href="{$baseurl}setup"><span class="fui-gear"></span>编辑</a>
				{elseif isset($haslove)}
					<button id="lovebt" type="button" class="btn btn-sm btn-info"
						onclick="deletelove(<?=$login_user['user_id']?>,<?=$cur_user['user_id']?>,<?=$cur_user['love']?>)"
						onmouseover="change2dl()" onmouseout="change2al()">已关注</button>
				{else}
					<button type="button" class="btn btn-sm btn-info"
						onclick="addlove(<?=$login_user['user_id']?>,<?=$cur_user['user_id']?>,<?=$cur_user['love']?>)">
						<span class="fui-plus"></span>关注
					</button>
				{/if}
				</div>
				<p class="username">
					<a class="{$user.nick_color}" href="{$baseurl}user/profile/{$user.id}">{$user.nick}</a>
					<small>（{$user.visits}人看过，{$user.lovers}名关注者）</small>
				</p>
				<p class="userlevel">{$user.level}级 连续登陆{$user.logins}天</p>
				<p class="userinfo">{$user.sex} | {$user.school} | {$user.type} | {$user.year}</p>
				<p class="usersign">签名：{$user.signature}</p>
			</div>
			{if isset($myself)}
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
			{else}
			<ul class="nav nav-tabs"
				style="position: relative; float: left; margin-top: 4px;">
				<li class="active"><a href="#mypost" data-toggle="tab"
					onclick="showuserpage(2,<?=$cur_user['user_id']?>,1,0)">TA的商品</a></li>
				<li><a id="mycommlink" href="#mycomm" data-toggle="tab"
					onclick="showuserpage(5,<?=$cur_user['user_id']?>,1,0)">TA的评论</a></li>
			</ul>
			{/if}
		</div>
		<div class=" panel panel-default">
		{if isset($myself)}
			<div class="tab-content">
				<div class="tab-pane fade in active" id="thisrec"></div>
				<div class="tab-pane fade" id="bbsrec"></div>
				<div class="tab-pane fade" id="mypost"></div>
				<div class="tab-pane fade" id="myfocus"></div>
				<div class="tab-pane fade" id="mylove"></div>
				<div class="tab-pane fade" id="mycomm"></div>
				<div class="tab-pane fade" id="mymess"></div>
			</div>
			{else}
			<div class="tab-content">
				<div class="tab-pane fade in active" id="mypost"></div>
				<div class="tab-pane fade" id="mycomm"></div>
			</div>
			{/if}
		</div>
	</div>
