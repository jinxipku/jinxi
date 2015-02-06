<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/fail.png" alt="" style="width: 100%">
		</div>
		<div style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">对不起信息发布失败，请您按照流程进行信息发布，并确保信息填写无误，然后重新进行信息发布。</p>
			<a href="<?=$baseurl?>item/newpost/type" type="button" class="btn btn-info btn-hg"
					style="border-radius: 1px;">返回信息发布</a>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>