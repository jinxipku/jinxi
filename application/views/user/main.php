	<div id="body" class="row">
        <div id="main">
            <div id="user_header">
				<div id="user_img">
					<a href="{$baseurl}user/profile/{$user.id}">
						<img class="passive" src="{$baseurl}img/head/{$user.head}" alt="user_{$user.id}_headimg" title="{$user['nick']}"/>
					</a>
				</div>
				<div id="user_info">
					<p class="user_name">
						<a class="{$user.nick_color}" href="{$baseurl}user/profile/{$user.id}">{$user.nick}</a>
						<small>（{$user.visits}人看过，{$user.lovers}名关注者）</small>
					</p>
					<p class="user_level">{$user.level}级 连续登陆{$user.logins}天</p>
					<p class="user_info">{$user.sex} | {$user.school_name} | {$user.type} | {$user.year}</p>
					<p class="user_post">发帖总数：{$user.post_number} | 有效帖数：{$user.active_post_number}</p>
					<p class="user_sign">签名：{$user.signature}</p>
				</div>
				<div id="user_edit">
					{if !isset($login_user)}
					<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo">
						<span class="fui-plus"></span>关注
					</a>
					{elseif isset($myself)}
					<a type="button" class="btn btn-sm btn-info" href="{$baseurl}setup">
						<span class="fui-gear"></span>编辑
					</a>
					{elseif isset($has_love)}
					<button id="btn_love" type="button" class="btn btn-sm btn-info" onclick="delete_love({$login_user.id}, {$user.id})" onmouseover="change2dl()" onmouseout="change2al()">
						已关注
					</button>
					{else}
					<button id="btn_love" type="button" class="btn btn-sm btn-info" onclick="add_love({$login_user.id}, {$user.id})">
						<span class="fui-plus"></span>关注
					</button>
					{/if}
				</div>
			</div>
			<div id="scroll_bench"></div>
			<div id="user_tabs">
				{if isset($myself)}
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#user_post" data-toggle="tab" onclick="show_user_page('#user_post', {$user.id}, 1 , 1)">我的帖子</a>
					</li>
					<li>
						<a href="#user_best" data-toggle="tab" onclick="show_user_page('#user_best', {$user.id}, 1 , 1)">我的推荐</a>
					</li>
					<li>
						<a href="#user_coll" data-toggle="tab" onclick="show_user_page('#user_coll', {$user.id}, 1 , 1)">我的收藏</a>
					</li>
					<li>
						<a href="#user_love" data-toggle="tab" onclick="show_user_page('#user_love', {$user.id}, 1 , 1)">我的关注</a>
					</li>
					<li>
						<a href="#user_mess" data-toggle="tab" onclick="show_user_page('#user_mess', {$user.id}, 1 , 1)">我的消息</a>
					</li>
				</ul>
				{else}
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#user_post" data-toggle="tab" onclick="show_user_page('#user_post', {$user.id}, 1 , 1)">TA的帖子</a>
					</li>
				</ul>
				{/if}
			</div>
			<script type="text/javascript">
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
			</script>

			<div id="user_panels" class=" panel panel-default">
				{if isset($myself)}
				<div class="tab-content">
					<div id="user_post" class="tab-pane fade in active"></div>
					<div id="user_best" class="tab-pane fade"></div>
					<div id="user_coll" class="tab-pane fade"></div>
					<div id="user_love" class="tab-pane fade"></div>
					<div id="user_mess" class="tab-pane fade"></div>
				</div>
				{else}
				<div class="tab-content">
					<div class="tab-pane fade in active" id="#user_post"></div>
				</div>
				{/if}
			</div>
        </div>
