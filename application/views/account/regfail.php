<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/fail.png" alt="" style="width: 100%">
		</div>
		<div style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">对不起注册失败，请您检查注册信息是否符合标准，或验证邮件是否已经过期，然后重新注册。</p>
			<a href="http://xn--wmqr18c.cn/account/regidit" type="button" class="btn btn-info btn-hg"
					style="border-radius: 1px;">返回注册</a>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>