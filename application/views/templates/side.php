		<div id="side">
			<a href="{$baseurl}display/hall" type="button" class="btn btn-primary btn-hg btn-block">商品大厅</a>
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
						<a class="text-info btn-link">关于今昔</a>
						<span> | </span>
						<a class="text-info btn-link">帮助中心</a>
					</p>
				</div>
			</div>

			<div id="side_hot">
				<blockquote>
					<p class="side_title">最热推荐</p>
				</blockquote>
				<div class="panel panel-default">
					最热推荐
				</div>
			</div>

			<div id="side_new">
				<blockquote>
					<p class="side_title">最新推荐</p>
				</blockquote>
				<div class="panel panel-default">
					最新推荐
				</div>
			</div>

			<div id="side_ran">
				<blockquote>
					<p class="side_title">随便看看</p>
				</blockquote>
				<div class="panel panel-default">
					<button type="button" class="btn btn-primary btn-hg btn-block">走你！</button>
				</div>
			</div>

			<img class="passive" id="side_icon" src="{$baseurl}img/jinxismall.jpg" alt="http://www.xn--wmqr18c.cn"/>

			{if isset($thispost)}
			<div id="side_view_box" class="side_content panel panel-default">
				<div id="side_view_header" class="clearfix">
					<h6>{$thispost.plain_title}</h6>
					<div>
						<a href="{$baseurl}user/profile/{$thispost.user_id}">
							<img class="side_view_head" src="{$thispost.user.thumb}" alt="{$thispost.user.nick}" />
						</a>
					</div>
					<div>
						<div>
							<a class="{$thispost.user.nick_color}" href="{$baseurl}user/profile/{$thispost.user_id}">{$thispost.user.nick}</a>
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
					<p class="p_post_content"><strong>品牌型号</strong>： {$thispost.brand} {$thispost.model}</p>
					<p class="p_post_content"><strong>物品状态</strong>： 
					{if $thispost.class == 0}S级别（正品）
					{elseif $thispost.class == 1}S级别（自制）
					{elseif $thispost.class == 2}A级别（九成新）
					{elseif $thispost.class == 3}B级别（七成新）
					{elseif $thispost.class == 4}C级别（五成新）
					{/if}
					</p>
					<p class="p_post_content"><strong>成交方式</strong>： {$thispost.deal}</p>
					<p class="p_post_content"><strong>心理价位</strong>： {if $thispost.price == 0}面议{else}{$thispost.price} 元{/if}</p>
					<p class="p_post_content"><strong>详细描述</strong>： {$thispost.description}</p>
				</div>
				<hr/>
				<div id="side_view_footer">
			    	<button type="button" class="btn btn-primary" onclick="go_to_reply(0, {$thispost.user_id}, '{$thispost.user.nick}')">回复楼主</button>
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
