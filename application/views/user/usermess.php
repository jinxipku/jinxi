<!-- {if $total > 0}
<div class="user_tab_header panel panel-default">
	<div class="pull-left">共{$page_num}页（{$total}封私信），这是第{$cur_page}页（每页10项）。</div>
	<div class="pagination pull-right">
	  	<ul>
	    	<li class="previous">
	      		<a href="" class="fui-arrow-left" onclick="show_user_page2('#user_mess', {$cur_page - 1});return false;"></a>
	    	</li>
	    	<li class="next">
	      		<a href="" class="fui-arrow-right" onclick="show_user_page2('#user_mess', {$cur_page + 1});return false;"></a>
	    	</li>
	  	</ul>
	</div>
</div>
{/if} -->

<div class="user_tab_box panel panel-default">
	<hr/>
	<div class="user_mess_box">
		<div class="user_mess_header">
			<div>
				<div>
					<a href="http://www.xn--wmqr18c.cn/user/profile/1">
						<img class="lazy passive" data-original="http://www.xn--wmqr18c.cn/img/head/svxvkeeS1xmvThxME1429093424.jpg" alt="一剑轻安" src="http://www.xn--wmqr18c.cn/img/head/svxvkeeS1xmvThxME1429093424.jpg" style="display: inline;">
					</a>
				</div>
				<div>
					<p class="post_user_nick">
						<a class="text_purple" href="http://www.xn--wmqr18c.cn/user/profile/1">一剑轻安</a>
					</p>
					<p>
						<small class="post_user_school">北京大学</small>
					</p>
				</div>
			</div>
			<div>
				<p>发给</p>
				<p><small class="post_user_date">2015-04-22 14:29:39</small></p>
			</div>
			<div>
				我
			</div>
			<button type="button" class="close" aria-label="Close" onclick="delete_mess()" title="删除">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="user_mess_content" title="点击回复" onclick="send_mess()">
			我想要你的吉他，能不能便宜点卖给我呀~
		</div>
	</div>

	<hr/>
	<div class="user_mess_box">
		<div class="user_mess_header">
			<div>
				<div>
					<a href="http://www.xn--wmqr18c.cn/user/profile/1">
						<img class="lazy passive" data-original="http://www.xn--wmqr18c.cn/img/head/svxvkeeS1xmvThxME1429093424.jpg" alt="一剑轻安" src="http://www.xn--wmqr18c.cn/img/head/svxvkeeS1xmvThxME1429093424.jpg" style="display: inline;">
					</a>
				</div>
				<div>
					<p class="post_user_nick">
						<a class="text_purple" href="http://www.xn--wmqr18c.cn/user/profile/1">一剑轻安</a>
					</p>
					<p>
						<small class="post_user_school">北京大学</small>
					</p>
				</div>
			</div>
			<div>
				<p>发给</p>
				<p><small class="post_user_date">2015-04-22 14:29:39</small></p>
			</div>
			<div>
				我
			</div>
			<button type="button" class="close" aria-label="Close" onclick="delete_mess()" title="删除">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="user_mess_content" title="点击回复" onclick="send_mess()">
			我想要你的吉他，能不能便宜点卖给我呀~
		</div>
	</div>



	<!-- {if $total == 0}
	<div class="sorry_box">
		<div>
			<img class="passive" src="{$baseurl}img/info/sorry.png" alt="sorry"/>
		</div>
		<div>
			<p>sorry，今昔网木有为您找到数据~</p>
			<p>立刻去私信小伙伴们吧~</p>
		</div>
	</div>
	{else}

	{foreach from = $posts item = post}
	<hr/>
	<div class="post_item_box">
		
	</div>
	{/foreach}
	
	<hr/>
	{if $page_num > 0}
	<div class="pagination">
	  	<div class="pull-right">{$cur_page}/{$page_num}页</div>
	  	<center>
	  	<ul>
	  		<li class="previous">
	      		<a href="" onclick="show_user_page2('#user_mess', 1);return false;">首页</a>
	    	</li>
	    	<li class="previous">
	      		<a href="" class="fui-arrow-left" onclick="show_user_page2('#user_mess', {$cur_page - 1});return false;"></a>
	    	</li>
	    	{assign var="page_index" value=$ed_page-$st_page+1}
	    	{section name="loop" loop=$page_index}
			<li {if $smarty.section.loop.index+$st_page==$cur_page}class="active"{/if}>
				<a href="" onclick="show_user_page2('#user_mess', {$smarty.section.loop.index + $st_page});return false;">{$smarty.section.loop.index + $st_page}</a>
			</li>
			{/section}
			<li class="next">
	      		<a href="" class="fui-arrow-right" onclick="show_user_page2('#user_mess', {$cur_page + 1});return false;"></a>
	    	</li>
	    	<li class="next">
	      		<a href="" onclick="show_user_page2('#user_mess', {$page_num});return false;">末页</a>
	    	</li> 
	  	</ul>
	  	</center>
	</div>
	{/if}

	{/if} -->
</div>
<script type="text/javascript" src="{$baseurl}js/message.js"></script>