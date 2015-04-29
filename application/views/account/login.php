	<div id="body" class="row">
		<div id="main">
			<div id="register_form">
				<p>欢迎使用今昔网！请填写登录信息。</p>
				<form method="post">
					<div class="form-group">
						<input id="email" name="email" type="text" placeholder="邮箱" class="form-control flat input-lg" onblur="check_email(1)">
						<span class="danger" id="check_email"></span>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="密码" class="form-control flat input-lg" onblur="check_pw()" onpaste="return false"/>
						<span class="danger" id="check_pw"></span>
					</div>
					<button id="btn_login" type="button" class="btn btn-primary btn-lg" onClick="login(1)">登录</button>
				</form>
			</div>
			<div id="register_alter">
				<p>没有今昔网账号？</p>
				<a href="{$baseurl}account/register" type="button" class="btn btn-info btn-lg btn-block">立即注册</a>
				<img class="passive" src="{$baseurl}img/jinxibig.jpg" alt="http://www.xn--wmqr18c.cn"/>
			</div>
		</div>