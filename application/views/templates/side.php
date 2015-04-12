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

			<img class="passive" id="side_icon" src="{$baseurl}img/jinxibig.jpg" alt="http://www.xn--wmqr18c.cn"/>
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
