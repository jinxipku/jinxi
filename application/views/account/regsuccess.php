<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 20px;">
			<img src="<?=$baseurl?>img/success.png" alt="" style="width: 100%">
		</div>
		<div style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">恭喜您验证完毕，今昔网已经自动为您登录，欢迎加入今昔网，请尽情使用。</p>
			<a href="http://xn--wmqr18c.cn" type="button" class="btn btn-info btn-hg"
					style="border-radius: 1px;">返回主页</a>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>