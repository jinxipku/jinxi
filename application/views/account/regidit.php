<div class="container">
<div class="row">
	<div class="leftpart">
		<div
			style="position: relative; float: left; width: 386px; padding-right: 90px; padding-top: 20px;">
			<p style="font-size: 22px; width: 400px;">欢迎加入今昔网！请填写注册信息。</p>
			<form method="post">
				<div class="form-group">
					<input id="schoolid" name="schoolid" type="text" placeholder="学号"
						class="form-control input-lg"
						style="background-color: #f4f4f4; border-radius: 1px;"
						onblur="checkmail(1)"> <span id="checkmail"></span>
				</div>

				<div class="form-group">
					<input id="password1" name="password1" type="password"
						placeholder="密码" class="form-control input-lg"
						style="background-color: #f4f4f4; border-radius: 1px;"
						onblur="checkpw1()"> <span id="checkpw1"></span>
				</div>
				<div class="form-group">
					<input id="password2" name="password2" type="password"
						placeholder="确认密码" class="form-control input-lg"
						style="background-color: #f4f4f4; border-radius: 1px;"
						onblur="checkpw2()"> <span id="check4"></span>
				</div>
				
				<button id="bt4reg" type="button" class="btn btn-primary btn-lg"
					style="border-radius: 1px;" onClick="regidit()">快速注册</button>
			</form>
		</div>
		<div
			style="position: relative; float: left; width: 386px; padding-left: 30px; padding-top: 20px;">
		<?php if(isset($login_user)): ?>
			<p style="font-size: 22px;">您已经登录。</p>
			<a href="<?=$baseurl?>" type="button" class="btn btn-info btn-lg"
				style="border-radius: 1px; margin-right: 100px;">返回主页</a>
		<?php else :?>
		<?php $this->session->set_userdata ( 'mem_url', $baseurl );?>
			<p style="font-size: 22px;">已有今昔网账号？</p>
			<a href="<?=$baseurl?>account/login" type="button"
				class="btn btn-info btn-lg"
				style="border-radius: 1px; margin-right: 100px;">立即登陆</a>
		<?php endif;?>
		<img src="<?=$baseurl?>img/jinxibig.jpg" alt="www.今昔.cn"
				style="width: 230px; margin-top: 15px;" />
		</div>
		<div class="clear"></div>
	</div>
	<!-- <div class=" rightpart">
	<?php
		$this->load->helper('array');
		$gettips = show_tips();
		$strtit = $gettips['strtit'];
		$strcon = $gettips['strcon'];
	?>
	<div>
			<blockquote>
				<p class="righttitle">今昔贴士</p>
			</blockquote>
			<div class="rightcontent panel panel-default">
				<p class="rightcontent" style="font-weight: 600"><?=$strtit?></p>
				<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;<?=$strcon?></p>
				<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
				<p class="rightlink">
					<a class="text-info btn-link">关于今昔</a><span> | </span><a
						class="text-info rightlink btn-link">帮助中心</a>
				</p>
			</div>
		</div>
	</div> -->
</div>
</div>