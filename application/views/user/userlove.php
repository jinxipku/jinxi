<div class="postitembig">
	<div class="postimage">
	<a href="{$baseurl}user/<?=$loveitem['user_id']?>"><img style="width: 114px; height: 114px;"
		src=""alt="" title="<?=$loveitem['user_name']?>" /></a></div>

	<div class="postinfo">
		<p class="username">
			<a class="text-primary" href="{$baseurl}user/<?=$loveitem['user_id']?>">fabkxd</a>
			<span>北京大学</span><span style="color: #999;">15级</span>
			<small>1人看过，1名关注者）</small>
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
{if $total > 0}
<div class="user_tab_header panel panel-default">
	<div class="pull-left">共{$page_num}页（{$total}名用户），这是第{$cur_page}页（每页10项）。</div>
	<div class="pagination pull-right">
	  	<ul>
	    	<li class="previous">
	      		<a href="" class="fui-arrow-left" onclick="show_user_page2('#user_love', {$cur_page - 1});return false;"></a>
	    	</li>
	    	<li class="next">
	      		<a href="" class="fui-arrow-right" onclick="show_user_page2('#user_love', {$cur_page + 1});return false;"></a>
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

	{foreach from = $users item = user}
	<div class="lovee_user_box">
		<div class="lovee_user_img">
			<img class="lazy passive" data-original="{$user.head}" alt="{$user.nick}" />
		</div>
		<div class="lovee_user_content">
			<div>
				<span>{$user.nick}</span>
				<span>{$user.sex}</span>
				<span>{$user.school_name</span>
				<span>{$user.level}级</span>
				<span>（{$user.visit_num}人看过，{$user.love_num}名关注者）</span>
			</div>
			<div>
				<p class="user_sign">签名：{$user.signature}</p>
			</div>
			<div>
				<p>最新帖子：</p>
				<a href="{$baseurl}post/viewpost/{$user.newest_post.type}/{$user.newest_post.id}" title='{$user.newest_post.plain_title}' target="_blank">
					{$user.newest_post.title}
				</a>
			</div>
		</div>
		<div class="lovee_user_post">
			<div>
				<p class="user_post">发帖总数：{$user.post_number}</p>
				<p class="user_post">活跃帖数：{$user.active_post_number}</p>
			</div>
			<div>
				<img class="lazy passive" data-original="{$user.newest_post.picture}" alt="{$user.newest_post.plain_title}">
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
<script type="text/javascript" src="{$baseurl}js/post_item.js"></script>