	<div id="body" class="row">
		<div id="main" class="help">
			<h6><strong>今昔网 搜索结果</strong></h6>
			<hr/>
			<br/>

			{if $total > 0}
			<div id="post_page_header" class="panel panel-default">
				<div class="pull-left">今昔网为您找到了{$total}篇帖子。</div>
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
						<p>请试试其他关键词~</p>
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
								<div>
									{if !isset($login_user)}
									<a type="button" class="btn btn-xs btn-info pull-right" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
									{elseif $post.user_id == $login_user.id}
									<button type="button" class="btn btn-warning btn-xs pull-right" disabled>我 的</button>
									{elseif $post.has_collect}
									<button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn1_post_item btn btn-xs btn-info pull-right">已收藏</button>
									{else}
									<button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn2_post_item btn btn-xs btn-info pull-right"><span class="fui-plus"></span>收藏</button>
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
							<img class="lazy" data-original="{$baseurl}img/class/{$post.class}.png" alt="物品状态" />
						</div>
						<div>
							{if $post.price == 0 && $post.deal == '面议'}面议{else}￥{$post.price}{/if}
						</div>
					</div>
				</div>
				{/foreach}

				{/if}
			</div>
    				
		</div>