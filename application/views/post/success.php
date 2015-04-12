				<div id="newpost_psuccess">
					<div class="post_img">
						<img class="passive" src="{$baseurl}img/info/success.png" alt="发布成功">
					</div>
					<div class="post_cont">
						<p>恭喜，信息发布成功，请点击以下按钮前往该帖界面。</p>
						<a id="a_gotopost" href="{$baseurl}post/viewpost/" type="button" class="btn btn-primary btn-hg">前往该贴</a>
					</div>
				</div>
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

		<div id="picture_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
						<img id="big_picture_view" src="" alt="big picture view"/>
					</div>
				</div>
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

	</div>