<p class="set_title"><i class="icon-star-empty"></i>星级用户</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">站内私信（5级）</p>
		<div class="set_table_content">
			<p class="star_info">	用户达到5级即可开启站内私信功能~</p>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">经验增长（7级）</p>
		<div class="set_table_content">
			<p class="star_info">	达到7级的用户每发一篇帖子都能获得更多的积分，升级更快哦~</p>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">连续登录（10级）</p>
		<div class="set_table_content">
			<p class="star_info">	达到10级的用户如果只间隔一天没有登录，则不会影响连续登陆天数哦~</p>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">彩色昵称（15级）</p>
		<div class="set_table_content">
			<p class="star_info">	达到15级的用户可以选择自己昵称的颜色哦~（默认是绿色）</p>
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

	<div class="set_table">
		<hr/>
		<p class="set_table_title">帖子刷新（18级）</p>
		<div class="set_table_content">
			<p class="star_info">	达到18级的用户所发的每篇帖子都有一次刷新发帖时间的机会哦~</p>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">尊贵用户（20级）</p>
		<div class="set_table_content">
			<p class="star_info">	达到20级的用户将成为今昔网的尊贵用户，其昵称左侧将出现VIP字样~</p>
		</div>
	</div>
</div>
<hr />
<button id="btn_saveastar" class="set_save btn btn-lg btn-primary" type="button" onclick="save_star()"> 保 存 </button>
<script type="text/javascript">
	$("#nick_color").selectpicker(
		{
			style: 'btn-default',
			menuStyle: 'dropdown'
		}
	);
</script>