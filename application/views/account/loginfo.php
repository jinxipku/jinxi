<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/login.png" alt="" style="width: 100%">
		</div>
		<div style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">您还木有登录哦，请先登录，再尽情使用今昔网~</p>
			<a href="<?=$baseurl?>account/login" type="button" class="btn btn-info btn-hg"
					style="border-radius: 1px;">前往登录</a>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>