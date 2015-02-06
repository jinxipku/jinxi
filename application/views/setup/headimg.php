<p class="title">修改头像</p>
<hr />
<p class="con">头像上传</p>
<div class="con">
	<form name="form_photo" id="form_photo"
		action="http://xn--wmqr18c.cn/ajax/upload_photo/<?=$login_user['user_id']?>"
		enctype="multipart/form-data" accept-charset="utf-8" method="post">
		<div class="form-group">
			<input type="file" id="userfile" name="userfile">
			<p id="fileinfo" class="help-block">支持gif、jpg、png图片格式，大小不要超过2M</p>
		</div>
		<button id="button_photo" type="button" class="btn btn-primary"
			style="border-radius: 1px;">上传</button>
	</form>
</div>
<hr />
<div id="imgshow">
	<p class="con">当前头像</p>
	<div class="con">
		<img
			src="<?=$baseurl?>img/head/<?php
			if($login_user['image']=='0')
				echo '0.jpg';
			else
				echo $login_user['user_id'].'_'.$login_user['image'];
			?>"
			alt="头像" style="width: 200px;"/>
	</div>
</div>
<form id="save_photo"
	action="http://xn--wmqr18c.cn/ajax/save_photo/<?=$login_user['user_id']?>"
	accept-charset="utf-8" method="post">
	<input type="hidden" name="p_x" id="p_x" value=""> <input type="hidden"
		name="p_y" id="p_y" value=""> <input type="hidden" name="p_h" id="p_h"
		value=""> <input type="hidden" name="p_w" id="p_w" value=""> <input
		type="hidden" name="p_k" id="p_k" value=""> <input
		type="hidden" name="hitype" id="hitype" value=".jpg">
</form>

<script src="http://xn--wmqr18c.cn/js/jquery-1.3.2.min.js"></script>
<script src="http://xn--wmqr18c.cn/js/jquery.jcrop.min.js"></script>
<script src="http://xn--wmqr18c.cn/js/jquery.form.js"></script>
<script src="http://xn--wmqr18c.cn/js/crop_photo.js"></script>
