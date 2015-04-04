	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img class="passive" src="{$baseurl}img/info/type.png" alt="choose type">
			</div>
			<div id="info_cont">
				<p>请选择您的意愿！</p>
				<p>您既可以转让物品也可以求购物品哦~</p>
				<form action="{$baseurl}post/newpost/category" method="post">
					<input type="hidden" id="post_type" name="post_type"/>
					<input type="submit" class="btn btn-primary btn-hg" onclick="$('#post_type').val(0)" value="我要转让"/>
					<input type="submit" class="btn btn-primary btn-hg" onclick="$('#post_type').val(1)" value="我要求购"/>
				</form>
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