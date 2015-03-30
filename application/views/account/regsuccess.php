	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img class="passive" src="{$baseurl}img/info/success.png" alt="register fail">
			</div>
			<div id="info_cont">
				<p>恭喜您验证完毕，今昔网已经自动为您登录，您可以返回注册前页面或立即进入设置页面修改个人资料。</p>
				{if isset($mem_url)}
				<a href="{$mem_url}" type="button" class="btn btn-info btn-hg" title="返回注册前页面">返回页面</a>
				{else}
				<a href="{$baseurl}" type="button" class="btn btn-info btn-hg" title="返回主页">返回主页</a>
				{/if}
				<a href="{$baseurl}setup" type="button" class="btn btn-info btn-hg" title="前往设置页面">设置页面</a>
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