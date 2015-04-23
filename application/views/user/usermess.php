{if $total > 0}
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
{/if}

<div class="user_tab_box panel panel-default">
	{if $total == 0}
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

	{foreach from = $posts item = mess}
	<hr/>
	<div class="user_mess_box">
		<div class="user_mess_header">
			{if $mess.to_id == $user_id}
			<div class="mess_for_other">
				<div>
					<a href="{$baseurl}user/profile/{$mess.from_id}">
						<img class="lazy passive" data-original="{$baseurl}img/head/{$mess.who.thumb}" alt="{$mess.who.nick}">
					</a>
				</div>
				<div>
					<p class="post_user_nick">
						<a class="{$mess.who.nick_color}" href="{$baseurl}user/profile/{$mess.from_id}">{$mess.who.nick}</a>
					</p>
					<p>
						<small class="post_user_school">{$mess.who.school_name}</small>
					</p>
				</div>
			</div>
			{else}
			<div class="mess_for_me">
				我
			</div>
			{/if}
			<div>
				<p>发给</p>
				<p><small class="post_user_date">{$mess.createat}</small></p>
			</div>
			{if $mess.from_id == $user_id}
			<div class="mess_for_other">
				<div>
					<a href="{$baseurl}user/profile/{$mess.from_id}">
						<img class="lazy passive" data-original="{$baseurl}img/head/{$mess.who.thumb}" alt="{$mess.who.nick}">
					</a>
				</div>
				<div>
					<p class="post_user_nick">
						<a class="{$mess.who.nick_color}" href="{$baseurl}user/profile/{$mess.from_id}">{$mess.who.nick}</a>
					</p>
					<p>
						<small class="post_user_school">{$mess.who.school_name}</small>
					</p>
				</div>
			</div>
			{else}
			<div class="mess_for_me">
				我
			</div>
			{/if}
			<button type="button" class="close" aria-label="Close" onclick="delete_mess({$mess.id})" title="删除">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="user_mess_content" title="{if $mess.from_id == $user_id}点击再发一封{else}点击回复TA{/if}" onclick="mess_user({$mess.who.id}, '{$mess.who.nick}', 1)">
			&nbsp;&nbsp;{$mess.content}
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

	{/if}
</div>
<script type="text/javascript" src="{$baseurl}js/message.js"></script>