<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/info.png" alt="" style="width: 100%">
		</div>
		<div
			style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 20px;">
			<form id="conform" action="<?=$baseurl?>item/newpost/picture"
				method="post">
				<p style="font-size: 22px; margin-bottom: 15px;">请填写您对商品的详细<?php
				if ($this->session->userdata ( 'ptype' ) == 1)
					echo '要求';
				else
					echo '描述';
				?></p>
				<textarea rows="8" id="content" name="pcontent" class="form-control"
					placeholder="请键入内容..."
					style="width: 400px; background-color: #f4f4f4;" maxlength=300></textarea>
				<p style="font-size: 22px; margin-bottom: 15px;">确认请按下一步。</p>
				<input type="submit" class="btn btn-default btn-hg btn-wide"
					onclick="$('#conform').attr('action','<?=$baseurl?>item/newpost/info/1')"
					value="上一步" /> <input type="submit"
					class="btn btn-primary btn-hg btn-wide"
					onclick="$('#conform').attr('action','<?=$baseurl?>item/newpost/picture')"
					value="下一步" />
			</form>

		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>