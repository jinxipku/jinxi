<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/picture.png" alt="" style="width: 100%">
		</div>
		<div
			style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 20px;">
			<form id="picform1" action="<?=$baseurl?>ajax/picture/<?=$post_id?>/1"
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

		</div>
	</div>
	<script src="http://xn--wmqr18c.cn/js/jquery-1.8.3.min.js"></script>
	<script src="http://xn--wmqr18c.cn/js/jquery.form.js"></script>
	<script src="http://xn--wmqr18c.cn/js/picture.js"></script>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>