		<div id="side">
			<a href="{$baseurl}display/sell{if isset($area)}/{$area}{/if}{if isset($sort)}/{$sort}{/if}" type="button" class="btn btn-primary btn-hg btn-block">商品大厅</a>
			<a href="{$baseurl}post/newpost" type="button" class="btn btn-primary btn-hg btn-block">发布信息</a>

			<div id="side_tips">
				<blockquote>
					<p class="side_title">今昔贴士</p>
				</blockquote>
				<div class="side_content panel panel-default">
					<p class="p_song_title">{$tips.strtit}</p>
					<p class="p_song_content">&nbsp;&nbsp;{$tips.strcon}</p>
					<p class="p_song_content">&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
					<p class="p_song_link">
						<a href="{$baseurl}info/about" class="text-info btn-link">关于今昔</a>
						<span> | </span>
						<a href="{$baseurl}info/help" class="text-info btn-link">帮助中心</a>
					</p>
				</div>
			</div>

			<div id="side_hot">
				<blockquote>
					<p class="side_title">最热推荐</p>
				</blockquote>
				<div class="post_item_block panel panel-default">
					<div class="post_item_block_user">
						<div>
							<a href="{$baseurl}user/profile/{$hotest.user_id}" target="_blank">
								<img class="passive" src="{$hotest.user.thumb}" alt="{$hotest.user.nick}" title="{$hotest.user.school_name}"/>	
							</a>
						</div>
						<div>
							<p>
								<a href="{$baseurl}user/profile/{$hotest.user_id}" class="{$hotest.user.nick_color}" target="_blank" title="{$hotest.user.school_name}">{$hotest.user.nick}</a><small>{$hotest.user.school_name}</small>
							</p>
							<p>
								<small>{$hotest.createat}</small>
							</p>
						</div>
					</div>

					<div class="post_item_block_img">
						<a href="{$baseurl}post/viewpost/{if $hotest.type == 0}sell{else}buy{/if}/{$hotest.post_id}" target="_blank">
							<div class="post_item_block_class_cover">
							</div>
							<div class="post_item_block_class_cont">
								<div>
									{if $hotest.price == 0 && $hotest.deal == '面议'}面议{else}￥{$hotest.price}{/if}
								</div>
								<div>
									<img class="passive" src="{$baseurl}img/class/{$hotest.class}.png" alt="物品状态" />
								</div>
							</div>
							<img class="passive" src="{$hotest.picture}" alt="{$hotest.plain_title}" />
						</a>
					</div>
					<div class="post_item_block_title">
						<a href="{$baseurl}post/viewpost/{if $hotest.type == 0}sell{else}buy{/if}/{$hotest.post_id}" title='{$hotest.plain_title}' target="_blank">
							{$hotest.title}
						</a>
					</div>
					<div class="post_item_block_others">
						<div>
							<span class="fui-new">
								{$hotest.reply_num}
							</span>
							<span class="fui-heart">
								{$hotest.favorite_num}
							</span>
						</div>
						<div>
							{if !isset($login_user)}
							<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
							{elseif $hotest.user_id == $login_user.id}
							<button type="button" class="btn btn-warning btn-sm" disabled>我 的</button>
							{elseif $hotest.has_collect}
							<button type="button" data-pid="{$hotest.post_id}" data-ptype="{$hotest.type}" class="btn1_post_item btn btn-sm btn-info">已收藏</button>
							{else}
							<button type="button" data-pid="{$hotest.post_id}" data-ptype="{$hotest.type}" class="btn2_post_item btn btn-info btn-sm"><span class="fui-plus"></span>收藏</button>
							{/if}
						</div>
					</div>
				</div>
			</div>

			<div id="side_new">
				<blockquote>
					<p class="side_title">最新推荐</p>
				</blockquote>
				<div class="post_item_block panel panel-default">
					<div class="post_item_block_user">
						<div>
							<a href="{$baseurl}user/profile/{$newest.user_id}" target="_blank">
								<img class="passive" src="{$newest.user.thumb}" alt="{$newest.user.nick}" title="{$newest.user.school_name}"/>	
							</a>
						</div>
						<div>
							<p>
								<a href="{$baseurl}user/profile/{$newest.user_id}" class="{$newest.user.nick_color}" target="_blank"  title="{$newest.user.school_name}">{$newest.user.nick}</a><small>{$newest.user.school_name}</small>
							</p>
							<p>
								<small>{$newest.createat}</small>
							</p>
						</div>
					</div>

					<div class="post_item_block_img">
						<a href="{$baseurl}post/viewpost/{if $newest.type == 0}sell{else}buy{/if}/{$newest.post_id}" target="_blank">
							<div class="post_item_block_class_cover">
							</div>
							<div class="post_item_block_class_cont">
								<div>
									{if $newest.price == 0 && $newest.deal == '面议'}面议{else}￥{$newest.price}{/if}
								</div>
								<div>
									<img class="passive" src="{$baseurl}img/class/{$newest.class}.png" alt="物品状态" />
								</div>
							</div>
							<img class="passive" src="{$newest.picture}" alt="{$newest.plain_title}" />
						</a>
					</div>
					<div class="post_item_block_title">
						<a href="{$baseurl}post/viewpost/{if $newest.type == 0}sell{else}buy{/if}/{$newest.post_id}" title='{$newest.plain_title}' target="_blank">
							{$newest.title}
						</a>
					</div>
					<div class="post_item_block_others">
						<div>
							<span class="fui-new">
								{$newest.reply_num}
							</span>
							<span class="fui-heart">
								{$newest.favorite_num}
							</span>
						</div>
						<div>
							{if !isset($login_user)}
							<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
							{elseif $newest.user_id == $login_user.id}
							<button type="button" class="btn btn-warning btn-sm" disabled>我 的</button>
							{elseif $newest.has_collect}
							<button type="button" data-pid="{$newest.post_id}" data-ptype="{$newest.type}" class="btn1_post_item btn btn-sm btn-info">已收藏</button>
							{else}
							<button type="button" data-pid="{$newest.post_id}" data-ptype="{$newest.type}" class="btn2_post_item btn btn-info btn-sm"><span class="fui-plus"></span>收藏</button>
							{/if}
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="{$baseurl}js/collect_bind.js"></script>

			<div id="side_ran">
				<blockquote>
					<p class="side_title">随便看看</p>
				</blockquote>
				<div class="panel panel-default">
					<a type="button" class="btn btn-primary btn-hg btn-block" href="{$baseurl}post/viewpost/{if $random.post_type == 0}sell{else}buy{/if}/{$random.post_id}" target="_blank">走你！</a>
				</div>
			</div>

			<img class="passive" id="side_icon" src="{$baseurl}img/jinxismall.jpg" alt="{$baseurl}"/>

			{if isset($thispost)}
			<div id="side_view_box" class="side_content panel panel-default">
				<div id="side_view_header" class="clearfix">
					<h6>{$thispost.plain_title}</h6>
					<div>
						<a href="{$baseurl}user/profile/{$thispost.user_id}">
							<img class="side_view_head" src="{$thispost.user.thumb}" alt="{$thispost.user.nick}" title="{$thispost.user.school_name}"/>
						</a>
					</div>
					<div>
						<div>
							<a class="{$thispost.user.nick_color}" href="{$baseurl}user/profile/{$thispost.user_id}" title="{$thispost.user.school_name}">{$thispost.user.nick}</a>
							<small class="post_user_school"> {$thispost.user.school_name}</small>
						</div>
						<div>
							<small class="post_user_date">{$thispost.createat}</small>
						</div>
					</div>
				</div>
				<hr/>
				<div id="side_view_content">
					<p class="p_post_content"><strong>帖子类型</strong>： {$post_type}</p>
					<p class="p_post_content"><strong>一级分类</strong>： {$thispost.category1_name}</p>
					<p class="p_post_content"><strong>二级分类</strong>： {$thispost.category2_name}</p>
					<p class="p_post_content">{if $thispost.category1 == 5}<strong>书本信息</strong>：《{$thispost.brand}》{$thispost.model}{else}<strong>品牌型号</strong>： {$thispost.brand} {$thispost.model}{/if}</p>
					<p class="p_post_content"><strong>物品状态</strong>： 
					{if $thispost.class == 0}S级别（正品）
					{elseif $thispost.class == 1}S级别（自制）
					{elseif $thispost.class == 2}A级别（九成新）
					{elseif $thispost.class == 3}B级别（七成新）
					{elseif $thispost.class == 4}C级别（五成新）
					{/if}
					</p>
					<p class="p_post_content"><strong>成交方式</strong>： {$thispost.deal}</p>
					<p class="p_post_content"><strong>心理价位</strong>： {if $thispost.price == 0 && $thispost.deal == '面议'}面议{else}{$thispost.price} 元{/if}</p>
					<p class="p_post_content"><strong>详细描述</strong>： {if $thispost.description == ""}无{else}{$thispost.description}{/if}</p>
				</div>
				<hr/>
				<div id="side_view_footer">
			    	{if isset($login_user)}
		      		<button type="button" class="btn btn-primary" onclick="go_to_reply(0, {$thispost.user_id}, '{$thispost.user.nick}')">回复楼主</button>
		      		{else}
		      		<a href="{$baseurl}account/loginfo" type="button" class="btn btn-primary">回复楼主</a>
		      		{/if}
				</div>
			</div>
			{/if}
		</div>
	</div>

	<div id="info_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<p class="modal-cont"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-primary">确认</button>
				</div>
			</div>
		</div>
	</div>

	<div id="mess_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">请填写私信内容</h4>
				</div>
				<div class="modal-body">
					<p class="modal-cont"></p>
					<textarea id="mess_content" name="mess_content" class="form-control flat" placeholder="填写私信" onpropertychange="if(this.scrollHeight > 80)this.style.height=this.scrollHeight + 'px';" oninput="if(this.scrollHeight > 80)this.style.height=this.scrollHeight + 'px';" maxlength=300></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-primary">发送</button>
				</div>
			</div>
		</div>
	</div>
