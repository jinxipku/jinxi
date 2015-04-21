{if $total > 0}
<div class="user_tab_header panel panel-default">
	<div class="pull-left">共{$page_num}页（{$total}篇帖子），这是第{$cur_page}页（每页10项）。</div>
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
			<p>立刻去发帖吧，或者试试其他的分类~</p>
		</div>
	</div>
	{else}

	{foreach from = $posts item = post}
	<hr/>
	<div class="post_item_box">
		<div class="post_item_img">
			<a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" target="_blank">
				<img class="lazy" data-original="{$post.picture}" alt="{$post.plain_title}" />
			</a>
		</div>
		<div class="post_item_content">
			<div>
				<a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" title='{$post.plain_title}' target="_blank">
					{$post.title}
				</a>
			</div>
			<div class="post_item_description">
				{$post.description}
			</div>
			<div>
				<div>
					<div class="post_item_user_nick">
						<a href="{$baseurl}user/profile/{$post.user_id}" class="{$post.user.nick_color}" target="_blank">
							<span class="fui-user"></span>{$post.user.nick}	
						</a>
					</div>
					<div class="post_item_user_need">
						{if !isset($login_user)}
						<a type="button" class="btn btn-sm btn-info pull-right" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
						{elseif $post.user_id == $login_user.id}
						<button type="button" class="btn btn-warning btn-sm pull-right" disabled>我 的</button>
						{elseif $post.has_collect}
						<button type="button" data-pid="{$post.post_id}" class="btn1_post_item btn btn-sm btn-info pull-right">已收藏</button>
						{else}
						<button type="button" data-pid="{$post.post_id}" class="btn2_post_item btn btn-sm btn-info pull-right"><span class="fui-plus"></span>收藏</button>
						{/if}
					</div>
				</div>
				<div>
					<span class="fui-location">
						{$post.user.school_name}
					</span>
					<span class="fui-time">
						{$post.createat}
					</span>
					<span class="fui-new">
						{$post.reply_num}
					</span>
					<span class="fui-heart">
						{$post.favorite_num}
					</span>
				</div>
			</div>
		</div>
		<div class="post_item_price">
			<div>
				<img class="lazy" data-original="http://www.xn--wmqr18c.cn/img/class/{$post.class}.png" alt="物品状态" />
			</div>
			<div>
				{if $post.price == 0}面议{else}￥{$post.price}{/if}
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
	      		<a href="" onclick="show_user_page2('#user_post', 1);return false;">首页</a>
	    	</li>
	    	<li class="previous">
	      		<a href="" class="fui-arrow-left" onclick="show_user_page2('#user_post', {$cur_page - 1});return false;"></a>
	    	</li>
	    	{assign var="page_index" value=$ed_page-$st_page+1}
	    	{section name="loop" loop=$page_index}
			<li {if $smarty.section.loop.index+$st_page==$cur_page}class="active"{/if}>
				<a href="" onclick="show_user_page2('#user_post', {$smarty.section.loop.index + $st_page});return false;">{$smarty.section.loop.index + $st_page}</a>
			</li>
			{/section}
			<li class="next">
	      		<a href="" class="fui-arrow-right" onclick="show_user_page2('#user_post', {$cur_page + 1});return false;"></a>
	    	</li>
	    	<li class="next">
	      		<a href="" onclick="show_user_page2('#user_post', {$page_num});return false;">末页</a>
	    	</li> 
	  	</ul>
	  	</center>
	</div>
	{/if}

	{/if}
</div>
<script type="text/javascript" src="{$baseurl}js/post_item.js"></script>