				<div id="newpost_detail">
					<div class="post_img">
						<img class="passive" src="{$baseurl}img/info/picture.png" alt="上传图片">
					</div>
					<div class="post_cont">
						<form id="picform1" action="{$baseurl}ajax/picture/<?=$post_id?>/1"
						enctype="multipart/form-data" accept-charset="utf-8" method="post">
						<p style="font-size: 22px; margin-bottom: 15px;">信息已经保存，您现在可以上传最多三张商品照片，若不需要上传图片请直接点击完成发布。</p>
						<div class="form-group">
							<input type="file" id="image1" name="image1">
						</div>
						</form>
						<form id="picform2" action="<?=$baseurl?>ajax/picture/<?=$post_id?>/2"
							enctype="multipart/form-data" accept-charset="utf-8" method="post">
							<div class="form-group">
								<input type="file" id="image2" name="image2">
							</div>
						</form>
						<form id="picform3" action="<?=$baseurl?>ajax/picture/<?=$post_id?>/3"
							enctype="multipart/form-data" accept-charset="utf-8" method="post">
							<div class="form-group">
								<input type="file" id="image3" name="image3">
								<p id="fileinfo" class="help-block">注意仅支持上传jpg格式的图片，宽度建议800像素左右，大小不要超过2M</p>
							</div>
						</form>
						<div id="pictureinfo0">
							<button id="ulpicture" type="button"
								class="btn btn-primary btn-hg btn-wide" onclick="ulpicture()">完成发布</button>
						</div>
						<div id="pictureinfo1"></div>
						<div id="pictureinfo2"></div>
						<div id="pictureinfo3"></div>
						<p>确认请按下一步。</p>
						<button type="button" class="btn btn-default" onclick="detail2price()">上一步</button>
						<button type="button" class="btn btn-primary btn-hg" onclick="detail2picture()">下一步</button>
						<script src="http://xn--wmqr18c.cn/js/jquery-1.8.3.min.js"></script>
						<script src="http://xn--wmqr18c.cn/js/jquery.form.js"></script>
						<script src="http://xn--wmqr18c.cn/js/picture.js"></script>
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
	</div>