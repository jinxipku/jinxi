<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/class.png" alt="" style="width: 100%">
		</div>
		<div
			style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 20px;">
			<form id="classform" action="<?=$baseurl?>item/newpost/info/0"
				method="post">
				<p style="font-size: 22px; margin-bottom: 15px;">请选择商品所属大类：</p>
				<select id="classpre" name="classpre">
					<option value=1
						<?php if($this->session->userdata ( 'classpre'  )==1)echo ' selected'?>>电脑数码</option>
					<option value=2
						<?php if($this->session->userdata ( 'classpre'  )==2)echo ' selected'?>>日用百货</option>
					<option value=3
						<?php if($this->session->userdata ( 'classpre'  )==3)echo ' selected'?>>服饰箱包</option>
					<option value=4
						<?php if($this->session->userdata ( 'classpre'  )==4)echo ' selected'?>>运动户外</option>
					<option value=5
						<?php if($this->session->userdata ( 'classpre'  )==5)echo ' selected'?>>图书</option>
					<option value=6
						<?php if($this->session->userdata ( 'classpre'  )==6)echo ' selected'?>>音像</option>
					<option value=7
						<?php if($this->session->userdata ( 'classpre'  )==7)echo ' selected'?>>美容化妆</option>
					<option value=8
						<?php if($this->session->userdata ( 'classpre'  )==8)echo ' selected'?>>其他</option>
				</select>
				<p style="font-size: 22px; margin-bottom: 15px;">请选择商品所属小类：</p>
				<select id="class" name="class">
				</select>
				<p style="font-size: 22px; margin-bottom: 15px;">确认请按下一步。</p>
				<input type="submit"
					class="btn btn-default btn-hg btn-wide"
					onclick="$('#classform').attr('action','<?=$baseurl?>item/newpost/type2/1')"
					value="上一步" /> <input type="submit"
					class="btn btn-primary btn-hg btn-wide"
					onclick="$('#classform').attr('action','<?=$baseurl?>item/newpost/info/0')"
					value="下一步" />
			</form>
			<script src="<?=$baseurl?>js/classselect.js"></script>

		</div>
	</div>
	<script src="<?=$baseurl?>js/bootstrap-select.js"></script>
	<script>
	$("select").selectpicker({style: 'btn-primary', menuStyle: 'dropdown'});
	</script>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>