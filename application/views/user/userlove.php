{if $total > 0}
<div class="user_tab_header panel panel-default">
	<div class="pull-left">共{$page_num}页（{$total}名用户），这是第{$cur_page}页（每页10项）。</div>
	<div class="pagination pull-right">
	  	<ul>
	    	<li class="previous">
	      		<a href="" class="fui-arrow-left" onclick="show_user_page2('#user_post', {$cur_page - 1});return false;"></a>
	    	</li>
	    	<li class="next">
	      		<a href="" class="fui-arrow-right" onclick="show_user_page2('#user_post', {$cur_page + 1});return false;"></a>
	    	</li>
	  	</ul>
	</div>
</div>
{/if}

<div class="user_tab_box panel panel-default">
	{if $total == 0}
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

	{foreach from = $posts item = user}
	<hr/>
	<div class="lovee_user_box">
		<div class="lovee_user_img">
			<a href="{$baseurl}user/profile/{$user.id}" target="_blank"><img class="lazy passive" data-original="{$baseurl}img/head/{$user.head}" alt="{$user.nick}" title="{$user.nick}" /></a>
		</div>
		<div class="lovee_user_content">
			<div>
				<span><a class="{$user.nick_color}" href="{$baseurl}user/profile/{$user.id}" target="_blank">{$user.nick}</a></span>
				<span>{$user.sex} {$user.school_name}</span>
				<span>{$user.level}级 （{$user.visits}人看过，{$user.lovers}名关注者）</span>
			</div>
			<div>
				<p class="user_sign"><strong>签名： </strong>{$user.signature}</p>
			</div>
			<div>
				<p>
					<strong>最新帖子： </strong>
				{if $user.newest_post == null}
					无
				</p>
				{else}
				</p>
					<a href="{$baseurl}post/viewpost/{if $user.newest_post.type==0}sell{else}buy{/if}/{$user.newest_post.post_id}" title='{$user.newest_post.plain_title}' target="_blank">
						<div>{$user.newest_post.title}</div>
					</a>
				<p>
					<span class="fui-time">
						{$user.newest_post.createat}
					</span>
					<span class="fui-new">
						{$user.newest_post.reply_num}
					</span>
					<span class="fui-heart">
						{$user.newest_post.favorite_num}
					</span>
				</p>
				{/if}
			</div>
		</div>
		<div class="lovee_user_post">
			<div>
				<p class="user_post"><strong>发帖总数：</strong>{$user.post_number}</p>
				<p class="user_post"><strong>活跃帖数：</strong>{$user.active_post_number}</p>
			</div>
			<div>
				<button type="button" data-uid="{$user.id}" class="btn_messta btn btn-warning btn-sm pull-right">私信TA</button>
				<button type="button" data-uid="{$user.id}" class="btn_cancel_love btn btn-info btn-sm pull-right">已关注</button>
			</div>
		</div>
	</div>
	{/foreach}
	
	<hr/>
	{if $page_num > 0}
	<div class="pagination">
	  	<div class="pull-right">{$cur_page}/{$page_num}页</div>
	  	<center>
	  	<ul>
	  		<li class="previous">
	      		<a href="" onclick="show_user_page2('#user_love', 1);return false;">首页</a>
	    	</li>
	    	<li class="previous">
	      		<a href="" class="fui-arrow-left" onclick="show_user_page2('#user_love', {$cur_page - 1});return false;"></a>
	    	</li>
	    	{assign var="page_index" value=$ed_page-$st_page+1}
	    	{section name="loop" loop=$page_index}
			<li {if $smarty.section.loop.index+$st_page==$cur_page}class="active"{/if}>
				<a href="" onclick="show_user_page2('#user_love', {$smarty.section.loop.index + $st_page});return false;">{$smarty.section.loop.index + $st_page}</a>
			</li>
			{/section}
			<li class="next">
	      		<a href="" class="fui-arrow-right" onclick="show_user_page2('#user_love', {$cur_page + 1});return false;"></a>
	    	</li>
	    	<li class="next">
	      		<a href="" onclick="show_user_page2('#user_love', {$page_num});return false;">末页</a>
	    	</li> 
	  	</ul>
	  	</center>
	</div>
	{/if}

	{/if}
</div>
<script type="text/javascript" src="{$baseurl}js/user_love.js"></script>