				<div id="newpost_picture">
					<div class="post_img">
						<div>
							<img id="img_mobile_upload" class="passive" src="{$baseurl}img/info/picture.png" alt="上传图片">
						</div>
						<div>
							<p>扫它就可以用手机上传图片哦~</p>
							<img id="img_erweima" class="passive" src="" alt="扫此二维码手机传图">
						</div>
					</div>
					<div class="post_cont">
						<form id="form_picture_upload" name="0" action="{$baseurl}post/upload_picture" enctype="multipart/form-data" accept-charset="utf-8" method="post">
							<div id="display_area">
								<div id="preview_boxes">
								</div>
								<div id="upload_box">
									<button id="btn_upload_picture" type="button" class="btn btn-primary btn-block"><span>本地上传图片</span><br/>点击右侧相机可手机上传图片</button>
									<button id="btn_mobile_picture" type="button" class="btn btn-primary btn-block"><span>显示手机所上传的图片</span></button>
								</div>
							</div>

							<div class="form-group">
								<input type="file" id="picture" name="picture">
								<p id="file_info" class="help-block">支持jpg和png图片格式，大小不要超过2M。</p>
							</div>
						</form>
						<p>确认请按下一步。</p>
						<button type="button" class="btn btn-default" onclick="picture2detail()">上一步</button>
						<button type="button" class="btn btn-primary btn-hg" onclick="picture2contact()">下一步</button>
						<script src="{$baseurl}js/jquery.form.js"></script>
						<script src="{$baseurl}js/picture.js"></script>
					</div>
				</div>