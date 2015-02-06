<p class="title">账户设置</p>
<hr />
<p class="con">发帖设置</p>
<div class="con">
	<label class="checkbox" for="mailcheck"> <input type="checkbox"
		value="" id="mailcheck" data-toggle="checkbox"
		<?php if($login_user['mail_on']) echo ' checked';?>> 发帖自动附带邮箱联系方式
	</label> <label class="checkbox" for="qqcheck"> <input type="checkbox"
		value="" id="qqcheck" data-toggle="checkbox"
		<?php if($login_user['qq_on']) echo ' checked';?>> 发帖自动附带QQ联系方式
	</label> <label class="checkbox" for="phonecheck"> <input
		type="checkbox" value="" id="phonecheck" data-toggle="checkbox"
		<?php if($login_user['phone_on']) echo ' checked';?>> 发帖自动附带手机联系方式
	</label>
</div>
<hr />
<p class="con">回复设置</p>
<div class="con">
	<label class="checkbox" for="sign1"> <input type="checkbox" value=""
		id="sign1" data-toggle="checkbox"
		<?php if($login_user['sign_on1']) echo ' checked';?>> 回复附带签名
	</label> <label class="checkbox" for="sign2"> <input type="checkbox"
		value="" id="sign2" data-toggle="checkbox"
		<?php if($login_user['sign_on2']) echo ' checked';?>> 评论附带签名
	</label>
</div>
<hr />
<p class="con">版面设置</p>
<div class="con">
	<label class="checkbox" for="righton"> <input type="checkbox" value=""
		id="righton" data-toggle="checkbox"
		<?php if($login_user['right_on']) echo ' checked';?>> 设置、关于、帮助及个人页面显示右侧边栏
	</label>
</div>
<hr />
<div class="con">
	<button id="saveac" type="button" class="btn btn-lg btn-primary" onclick="saveac()">保存</button>
</div>