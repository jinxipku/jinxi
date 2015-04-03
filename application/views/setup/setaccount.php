<p class="set_title">账户设置</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">个人设置</p>
		<div class="set_table_content">
			<div class="set_row">
				<label class="checkbox" for="email_check"> <input type="checkbox" value="" id="email_check" data-toggle="checkbox" {if $login_user.is_email_public == 1}checked{/if}>
					发帖默认附带邮箱联系方式
				</label>
			</div>
			<div class="set_row">
				<label class="checkbox" for="qq_check"> <input type="checkbox" value="" id="qq_check" data-toggle="checkbox" {if $login_user.is_qq_public == 1}checked{/if}>
					发帖默认附带QQ联系方式
				</label>
			</div>
			<div class="set_row">
				<label class="checkbox" for="weixin_check"> <input type="checkbox" value="" id="weixin_check" data-toggle="checkbox" {if $login_user.is_weixin_public == 1}checked{/if}>
					发帖默认附带微信联系方式
				</label>
			</div>
			<div class="set_row">
				<label class="checkbox" for="phone_check"> <input type="checkbox" value="" id="phone_check" data-toggle="checkbox" {if $login_user.is_phone_public == 1}checked{/if}>
					发帖默认附带手机联系方式
				</label>
			</div>
			<div class="set_row">
				<label class="checkbox" for="sign_check"> <input type="checkbox" value="" id="sign_check" data-toggle="checkbox" {if $login_user.is_sign_public == 1}checked{/if}>
					回复附带签名
				</label>
			</div>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">修改密码</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="form-group">
					<input id="passwordo" name="passwordo" type="password" placeholder="旧密码" class="form-control flat input-lg" onblur="check_pwo()"/>
					<span class="danger" id="check_pwo"></span>
				</div>
			</div>
			<div class="set_row">
				<div class="form-group">
					<input id="password" name="password" type="password" placeholder="新密码" class="form-control flat input-lg" onblur="check_pw()"/>
					<span class="danger" id="check_pw"></span>
				</div>
			</div>
			<div class="set_row">
				<div class="form-group">
					<input id="passworda" name="passworda" type="password" placeholder="确认新密码" class="form-control flat input-lg" onblur="check_pwa()"/>
					<span class="danger" id="check_pwa"></span>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>
<button id="btn_saveaccount" class="set_save btn btn-lg btn-primary" type="button" onclick="save_account()"> 保 存 </button>