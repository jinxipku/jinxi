{if $total > 0}
<div id="post_page_header" class="panel panel-default">
	<div class="pull-left">共{$page_num}页（{$total}篇帖子），这是第{$cur_page}页（每页30项）。</div>
	<div class="pagination pull-right">
	  	<ul>
	    	<li class="previous">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$cur_page - 1}" class="fui-arrow-left"></a>
	    	</li>
	    	<li class="next">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$cur_page + 1}" class="fui-arrow-right"></a>
	    	</li>
	  	</ul>
	</div>
</div>
{/if}

<div id="post_items_box" class="panel panel-default">
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
			<a href="{$baseurl}post/viewpost/{$type}/{$post.post_id}" target="_blank">
				<img class="lazy" data-original="{$post.picture}" alt="{$post.plain_title}" />
			</a>
		</div>
		<div class="post_item_content">
			<div>
				<a href="{$baseurl}post/viewpost/{$type}/{$post.post_id}" title='{$post.plain_title}' target="_blank">
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
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/1">首页</a>
	    	</li>
	    	<li class="previous">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$cur_page - 1}" class="fui-arrow-left"></a>
	    	</li>
	    	{assign var="page_index" value=$ed_page-$st_page+1}
	    	{section name="loop" loop=$page_index}
			<li {if $smarty.section.loop.index+$st_page==$cur_page}class="active"{/if}>
				<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$smarty.section.loop.index + $st_page}">{$smarty.section.loop.index + $st_page}</a>
			</li>
			{/section}
			<li class="next">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$cur_page + 1}" class="fui-arrow-right"></a>
	    	</li>
	    	<li class="next">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$page_num}">末页</a>
	    	</li> 
	  	</ul>
	  	</center>
	</div>
	{/if}

	{/if}
</div>

{if $total == 0}
<div id="post_items_block" class="panel panel-default">
	<div class="sorry_box">
		<div>
			<img class="passive" src="{$baseurl}img/info/sorry.png" alt="sorry"/>
		</div>
		<div>
			<p>sorry，今昔网木有为您找到数据~sss</p>
			<p>立刻去发帖吧，或者试试其他的分类~</p>
		</div>
	</div>
</div>
{else}
<div id="post_items_block">
	{foreach from = $posts item = post}
	<div class="post_item_block panel panel-default">
		<div class="post_item_block_user">
			<div>
				<a href="{$baseurl}user/profile/{$post.user_id}" target="_blank">
					<img class="lazy" data-original="{$post.user.thumb}" alt="{$post.user.nick}" />	
				</a>
			</div>
			<div>
				<p>
					<a href="{$baseurl}user/profile/{$post.user_id}" class="{$post.user.nick_color}" target="_blank">{$post.user.nick}</a><small>{$post.user.school_name}</small>
				</p>
				<p>
					<small>{$post.createat}</small>
				</p>
			</div>
		</div>

		<div class="post_item_block_img">
			<a href="{$baseurl}post/viewpost/{$type}/{$post.post_id}" target="_blank">
				<div class="post_item_block_class_cover">
				</div>
				<div class="post_item_block_class_cont">
					<div>
						{if $post.price == 0}面议{else}￥{$post.price}{/if}
					</div>
					<div>
						<img class="lazy passive" data-original="http://www.xn--wmqr18c.cn/img/class/{$post.class}.png" alt="物品状态" />
					</div>
				</div>
				<img class="lazy" data-original="{$post.picture}" alt="{$post.plain_title}" />
			</a>
		</div>
		<div class="post_item_block_title">
			<a href="{$baseurl}post/viewpost/{$type}/{$post.post_id}" title='{$post.plain_title}' target="_blank">
				{$post.title}
			</a>
		</div>
		<div class="post_item_block_others">
			<div>
				<span class="fui-new">
					{$post.reply_num}
				</span>
				<span class="fui-heart">
					{$post.favorite_num}
				</span>
			</div>
			<div>
				{if !isset($login_user)}
				<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
				{elseif $post.user_id == $login_user.id}
				<button type="button" class="btn btn-warning btn-sm" disabled>我 的</button>
				{elseif $post.has_collect}
				<button type="button" data-pid="{$post.post_id}" class="btn1_post_item btn btn-sm btn-info">已收藏</button>
				{else}
				<button type="button" data-pid="{$post.post_id}" class="btn2_post_item btn btn-info btn-sm"><span class="fui-plus"></span>收藏</button>
				{/if}
			</div>
		</div>
	</div>			
	{/foreach}
	
	<hr/>
	{if $page_num > 0}
	<div class="pagination panel panel-default">
	  	<div class="pull-right">{$cur_page}/{$page_num}页</div>
	  	<center>
	  	<ul>
	  		<li class="previous">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/1">首页</a>
	    	</li>
	    	<li class="previous">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$cur_page - 1}" class="fui-arrow-left"></a>
	    	</li>
	    	{assign var="page_index" value=$ed_page-$st_page+1}
	    	{section name="loop" loop=$page_index}
			<li {if $smarty.section.loop.index+$st_page==$cur_page}class="active"{/if}>
				<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$smarty.section.loop.index + $st_page}">{$smarty.section.loop.index + $st_page}</a>
			</li>
			{/section}
			<li class="next">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$cur_page + 1}" class="fui-arrow-right"></a>
	    	</li>
	    	<li class="next">
	      		<a href="{$baseurl}display/{$type}/{$area}/{$sort}/{if $category1 > 0}{$category1}{else}all{/if}/{if $category2 > -1}{$category2}{else}all{/if}/{$page_num}">末页</a>
	    	</li> 
	  	</ul>
	  	</center>
	</div>
	{/if}
</div>
{/if}
<script type="text/javascript" src="{$baseurl}js/post_item.js"></script>