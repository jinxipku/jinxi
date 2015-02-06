<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 20px;">
			<img src="<?=$baseurl?>img/success.png" alt="" style="width: 100%">
		</div>
		<div style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">恭喜您信息发布成功，请点击以下按钮前往该帖子界面~</p>
			<a href="<?=$baseurl?>item/viewpost/<?=$post_id?>" type="button" class="btn btn-info btn-hg"
					style="border-radius: 1px;">前往该帖</a>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>