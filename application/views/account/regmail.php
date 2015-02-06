<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 20px;">
			<img src="<?=$baseurl?>img/mail.png" alt="" style="width: 100%">
		</div>
		<div style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">恭喜注册成功，今昔网已经向您的注册邮箱发送了一封激活邮件，请您立即前往激活。</p>
			<a href="<?php
			$url = 'http://mail.'.$mail.'.com';
			if($mail=='gmail')
				$url = 'http://mail.google.com';
			else if($mail=='hotmail')
				$url = 'https://login.live.com';
			echo $url;
			?>" type="button" class="btn btn-info btn-hg"
					style="border-radius: 1px;" title="若您的邮箱为常见邮箱，请点击此按钮登录邮箱。">马上激活</a>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>