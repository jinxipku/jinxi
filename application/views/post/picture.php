				<div id="newpost_picture">
					<div class="post_img">
						<img id="img_mobile_upload" class="passive" src="{$baseurl}img/info/picture.png" alt="上传图片">
					</div>
					<div class="post_cont">
						<form id="form_picture_upload" name="1" action="{$baseurl}post/upload_picture" enctype="multipart/form-data" accept-charset="utf-8" method="post">
							<div id="display_area">
								<div id="preview_boxes">
									<!--
									<div class="preview_box">
										<div>
											<img class="passive" src="{$baseurl}/img/jinxi.jpg" alt=""/>
											<p>点击预览</p>
										</div>
										<div>
											<textarea rows="4" class="form-control flat" placeholder="请填写图片描述" maxlength=30></textarea>
											<label class="radio checked">
												<input type="radio" name="first_picture" value="1" data-toggle="radio" checked/>设为首图
											</label>
											<button type="button" class="btn btn-default">删除<span class="fui-cross"></span></button>
										</div>
									</div>
									-->
								</div>
								<div id="upload_box">
									<button id="btn_upload_picture" type="button" class="btn btn-primary btn-block"><span>本地上传图片</span><br/>点击右侧相机可手机上传图片</button>
								</div>
							</div>

							<div class="form-group">
								<input type="file" id="picture" name="picture">
								<p id="file_info" class="help-block">支持jpg和png图片格式，大小不要超过2M。</p>
							</div>
						</form>
						<p>确认请按完成发布。</p>
						<button type="button" class="btn btn-default" onclick="picture2detail()">上一步</button>
						<button id="btn_confirm_post_sell" type="button" class="btn btn-primary btn-hg" onclick="confirm_post()">完成发布</button>
						<script src="{$baseurl}js/jquery.form.js"></script>
						<script src="{$baseurl}js/picture.js"></script>
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
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary">确认</button>
					</div>
				</div>
			</div>
		</div>
	</div>