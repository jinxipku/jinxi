	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img class="passive" src="{$baseurl}img/info/class.png" alt="choose category">
			</div>
			<div id="info_cont">
				<form id="category_form" action="{$baseurl}post/newpost/info" method="post">
					<p>请选择商品所属大类：</p>
					<select id="category1" name="category1">
						<option value=1 {if $category1 == 1}selected{/if}>电脑数码</option>
						<option value=2 {if $category1 == 2}selected{/if}>日用百货</option>
						<option value=3 {if $category1 == 3}selected{/if}>服饰箱包</option>
						<option value=4 {if $category1 == 4}selected{/if}>运动户外</option>
						<option value=5 {if $category1 == 5}selected{/if}>图书</option>
						<option value=6 {if $category1 == 6}selected{/if}>音像</option>
						<option value=7 {if $category1 == 7}selected{/if}>美容化妆</option>
						<option value=8 {if $category1 == 8}selected{/if}>其他</option>
					</select>
					<p>请选择商品所属小类：</p>
					<input type="hidden" id="c2_input" value="{$category2}"/>
					<select id="category2" name="category2">
					</select>
					<p>确认请按下一步。</p>
					<a type="button" href="{$baseurl}post/newpost/type" class="btn btn-default btn-hg">上一步</a>
					<input type="submit" class="btn btn-primary btn-hg" value="下一步"/>
				</form>
				<script src="{$baseurl}js/classselect.js"></script>
				<script src="{$baseurl}js/bootstrap-select.js"></script>
				<script type="text/javascript">
					$("select").selectpicker(
						{
							style: 'btn-primary',
							menuStyle: 'dropdown'
						}
					);
				</script>
			</div>
		</div>
		<div id="side">
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
		</div>
	</div>