<p class="title">修改资料</p>
<hr />
<p class="con">基本信息</p>
<div class="con">
	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">姓 名</p>
		</div>
		<div class="tableright">
			<input id="username" type="text"
				value="<?=$login_user['user_name']?>" class="form-control flat"
				style="width: 220px;" maxlength=10 />
		</div>
	</div>
	<div style="height: 108px;">
		<div class="tableleft">
			<p class="postcon">性 别</p>
		</div>
		<div class="tableright">
			<label class="radio"> <input type="radio" name="sex" value="1"
				data-toggle="radio" <?php if($login_user['sex']==1)echo 'checked';?>>喵星人
			</label> <label class="radio"> <input type="radio" name="sex"
				value="2" data-toggle="radio"
				<?php if($login_user['sex']==2)echo 'checked';?>>汪星人
			</label> <label class="radio"> <input type="radio" name="sex"
				value="0" data-toggle="radio"
				<?php if($login_user['sex']==0)echo 'checked';?>>兔星人
			</label>
		</div>
	</div>
	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">学 校</p>
		</div>
		<div class="tableright">
			<input type="text" name="university" id="university"
				class="form-control flat" onclick="chooseuniversity()"
				value="<?=$login_user['school']?>" style="width: 220px;"
				maxlength=15 />
			<script src="<?=$baseurl?>js/school.js"></script>
			<script src="<?=$baseurl?>js/myschool.js"></script>
		</div>
	</div>

	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">身 份</p>
		</div>
		<div class="tableright">
			<select id="degree">
				<option value="本科"
					<?php if($login_user['degree']=='本科')echo ' selected'?>>本科</option>
				<option value="硕士"
					<?php if($login_user['degree']=='硕士')echo ' selected'?>>硕士</option>
				<option value="博士"
					<?php if($login_user['degree']=='博士')echo ' selected'?>>博士</option>
				<option value="教工"
					<?php if($login_user['degree']=='教工')echo ' selected'?>>教工</option>
			</select>
		</div>
	</div>

	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">年 份</p>
		</div>
		<div class="tableright">
			<select id="year">
			<?php
			
			for($i = 2013; $i >= 1998; $i --) {
				$str = '<option value="' . $i . '级" ';
				if ($login_user ['year'] == $i . '级')
					$str .= 'selected';
				$str .= '>' . $i . '级</option>';
				echo $str;
			}
			?>
			</select>
		</div>
	</div>

	<div style="height: 110px;">
		<div class="tableleft">
			<p class="postcon">签 名</p>
		</div>
		<div class="tableright">
			<textarea rows="4" id="sign" name="sign" class="form-control flat"
				style="width: 300px;" maxlength=100><?=$login_user['sign']?></textarea>
		</div>
	</div>
</div>
<script src="<?=$baseurl?>js/bootstrap-select.js"></script>
<script>
	$("select").selectpicker({style: 'btn-primary', menuStyle: 'dropdown'});
</script>
<hr />
<p class="con">联系方式</p>
<div class="con">
	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">邮 箱</p>
		</div>
		<div class="tableright">
			<input id="mail" type="text" value="<?=$login_user['mail']?>"
				class="form-control flat" style="width: 220px;" disabled />
		</div>
	</div>
	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">Q Q</p>
		</div>
		<div class="tableright">
			<input id="qq" type="text" value="<?=$login_user['qq']?>"
				class="form-control flat" style="width: 220px;" maxlength=12 />
		</div>
	</div>
	<div class="tableline">
		<div class="tableleft">
			<p class="postcon">手 机</p>
		</div>
		<div class="tableright">
			<input id="phone" type="text" value="<?=$login_user['phone']?>"
				class="form-control flat" style="width: 220px;" maxlength=18>
		</div>
	</div>
</div>
<hr />
<div class="con">
	<button id="savebi" type="button" class="btn btn-lg btn-primary" onclick="savebi()">保存</button>
</div>