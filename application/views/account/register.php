	<div id="body" class="row">
		<div id="main">
			<div id="register_form">
				<p>欢迎加入今昔网！请填写注册信息。</p>
				<form method="post">
					<div class="form-group">
						<input id="school" name="school" type="text" placeholder="学校" class="form-control flat input-lg" onclick="chooseUniversity()" maxlength=15 />
						<input id="school_id" name="school_id" type="hidden"/>
						<input id="nomail" name="nomail" type="hidden"/>
						<script type="text/javascript" src="{$baseurl}js/school.js"></script>
						<script type="text/javascript" src="{$baseurl}js/myschool.js"></script>
						<span class="danger" id="check_school"></span>
					</div>
					<div class="form-group">
						<input id="email" name="email" type="mail" placeholder="邮箱" class="form-control flat input-lg" onblur="check_email(0)" onfocus="check_school()"/>
						<span id="email_surfix"></span>
						<span class="danger" id="check_email"></span>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="密码" class="form-control flat input-lg" onblur="check_pw()" onpaste="return false"/>
						<span class="danger" id="check_pw"></span>
					</div>
					<div class="form-group">
						<input id="passworda" name="passworda" type="password" placeholder="确认密码" class="form-control flat input-lg" onblur="check_pwa()" onpaste="return false"/>
						<span class="danger" id="check_pwa"></span>
					</div>
					<button id="btn_register" type="button" class="btn btn-primary btn-lg" onClick="register()">快速注册</button>
				</form>
			</div>
			<div id="register_alter">
				<p>已有今昔网账号？</p>
				<a href="{$baseurl}account/login" type="button" class="btn btn-info btn-lg btn-block">立即登录</a>
				<img class="passive" src="{$baseurl}img/jinxismall.jpg" alt="http://www.xn--wmqr18c.cn"/>
			</div>
		</div>

		<div class="modal fade" id="choose_school" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h6 class="modal-title" id="myModalLabel">选择学校</h6>
					</div>
					<div class="modal-body">
						<div id="choose-a-province"></div>
						<hr />
						<div id="choose-a-school"></div>
					</div>
					<div class="modal-footer">
						<button id="chooseover" type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>