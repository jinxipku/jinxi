<?php if($login_user['is_star']):?>
<script src="<?=$baseurl?>js/jquery.js"></script>
<p class="title">
	<i class="icon-star-empty"></i>星级用户
</p>
<hr />
<p class="con">连续登陆</p>
<div class="con">
	<p class="postcon">&nbsp;&nbsp;&nbsp;&nbsp;星级用户如果只间隔一天没有登录，那么这一天的空缺将自动被忽略，不会影响连续登陆天数哦~</p>
</div>
<hr />
<p class="con">经验增长</p>
<div class="con">
	<p class="postcon">&nbsp;&nbsp;&nbsp;&nbsp;星级用户每发一篇帖子增长的积分更多，升级更快哦~</p>
</div>
<hr />
<p class="con">帖子刷新</p>
<div class="con">
	<p class="postcon">&nbsp;&nbsp;&nbsp;&nbsp;您每天有一次机会刷新自己的一篇帖子的发帖时间哦~这样就可以让帖子出现在商品大厅的最顶上啦~</p>
</div>
<hr />
<p class="con">彩色名字</p>
<div class="con">
	<p class="postcon">&nbsp;&nbsp;&nbsp;&nbsp;您可以选择自己名字的颜色哦（默认是绿色）</p>
	<div style="height: 50px;">
		<div class="colordis" style="background-color: #1abc9c">绿色</div>
		<div class="colordis" style="background-color: #3498DB">蓝色</div>
		<div class="colordis" style="background-color: #E74C3C">红色</div>
		<div class="colordis" style="background-color: #F1C40F">黄色</div>
		<div class="colordis" style="background-color: #9B59B6">紫色</div>
	</div>
	<select id="namecolor">
		<option value=0
			<?php if($login_user['namecolor']==0)echo ' selected'?>
			style="color: #000;">绿色</option>
		<option value=1
			<?php if($login_user['namecolor']==1)echo ' selected'?>>蓝色</option>
		<option value=2
			<?php if($login_user['namecolor']==2)echo ' selected'?>>红色</option>
		<option value=3
			<?php if($login_user['namecolor']==3)echo ' selected'?>>黄色</option>
		<option value=4
			<?php if($login_user['namecolor']==4)echo ' selected'?>>紫色</option>
	</select>
</div>
<hr />
<p class="con">自动转发</p>
<div class="con">
	<p class="postcon">&nbsp;&nbsp;&nbsp;&nbsp;如果您绑定了本校的BBS且开启了自动转发功能，那么你在今昔网发的每一篇帖子系统都会自动帮你转发到你的本校BBS哦！！</p>
	<label class="checkbox" for="autoon"> <input type="checkbox" value=""
		id="autoon" data-toggle="checkbox"
		<?php if($login_user['auto_on']) echo ' checked';?>> 开启自动转发功能 
</div>
<hr />
<div class="con">
	<button id="savest" type="button" class="btn btn-lg btn-primary" onclick="savest()">保存</button>
</div>
<script src="<?=$baseurl?>js/bootstrap-select.js"></script>
<script>
	$("#namecolor").selectpicker({style: 'btn-default', menuStyle: 'dropdown'});
</script>
<?php endif;?>