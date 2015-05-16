<p class="set_title">账户设置</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">昵称颜色</p>
		<div class="set_table_content">
			<div id="nick_color_box">
				<div class="colordis">绿色</div>
				<div class="colordis">蓝色</div>
				<div class="colordis">红色</div>
				<div class="colordis">黄色</div>
				<div class="colordis">紫色</div>
			</div>
			<select id="nick_color">
				<option value=0 {if $login_user.nick_color == 'text-primary'}selected{/if}>绿色</option>
				<option value=1 {if $login_user.nick_color == 'text-info'}selected{/if}>蓝色</option>
				<option value=2 {if $login_user.nick_color == 'text-danger'}selected{/if}>红色</option>
				<option value=3 {if $login_user.nick_color == 'text-warning'}selected{/if}>黄色</option>
				<option value=4 {if $login_user.nick_color == 'text-purple'}selected{/if}>紫色</option>
			</select>
		</div>
	</div>
	<script type="text/javascript">
		$("#nick_color").selectpicker(
			{
				style: 'btn-default',
				menuStyle: 'dropdown'
			}
		);
	</script>

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
			<div class="set_row">
				<label class="checkbox" for="mars_check"> <input type="checkbox" value="" id="mars_check" data-toggle="checkbox" {if $login_user.is_mars == 1}checked{/if}>
					开启手机号、QQ号自动转火星文
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
					<input id="passwordo" name="passwordo" type="password" placeholder="旧密码" class="form-control flat input-lg" onblur="check_pwo()" onpaste="return false"/>
					<span class="danger" id="check_pwo"></span>
				</div>
			</div>
			<div class="set_row">
				<div class="form-group">
					<input id="password" name="password" type="password" placeholder="新密码" class="form-control flat input-lg" onblur="check_pw()" onpaste="return false"/>
					<span class="danger" id="check_pw"></span>
				</div>
			</div>
			<div class="set_row">
				<div class="form-group">
					<input id="passworda" name="passworda" type="password" placeholder="确认新密码" class="form-control flat input-lg" onblur="check_pwa()" onpaste="return false"/>
					<span class="danger" id="check_pwa"></span>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>
<button id="btn_saveaccount" class="set_save btn btn-lg btn-primary" type="button" onclick="save_account()"> 保 存 </button>