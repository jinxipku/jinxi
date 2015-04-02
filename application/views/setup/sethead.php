<p class="set_title">修改头像</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">头像上传</p>
		<div class="set_table_content">
			<form id="form_photo" name="form_photo" action="{$baseurl}user/upload_photo" enctype="multipart/form-data" accept-charset="utf-8" method="post">
				<div class="form-group">
					<input type="file" id="head_image" name="head_image">
					<p id="file_info" class="help-block">支持gif、jpg、png图片格式，大小不要超过2M</p>
				</div>
				<button id="btn_upload_head" type="button" class="btn btn-primary btn-lg">上 传</button>
			</form>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">当前头像</p>
		<div class="set_table_content">
			<div id="show_head">
				<img src="{$baseurl}img/head/{$login_user.head}" alt="{$login_user.nick}的头像"/>
			</div>
			<form id="save_photo" action="{$baseurl}user/crop_photo" accept-charset="utf-8" method="post">
				<input type="hidden" name="p_x" id="p_x" value="">
				<input type="hidden" name="p_y" id="p_y" value="">
				<input type="hidden" name="p_h" id="p_h" value="">
				<input type="hidden" name="p_w" id="p_w" value="">
				<input type="hidden" name="p_k" id="p_k" value="">
				<input type="hidden" name="file_name" id="file_name" value="">
			</form>
		</div>
	</div>
</div>
<script src="{$baseurl}js/jquery.jcrop.min.js"></script>
<script src="{$baseurl}js/jquery.form.js"></script>
<script src="{$baseurl}js/crop_photo.js"></script>
