<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/type.png" alt="" style="width: 100%">
		</div>
		<div
			style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 50px;">
			<p style="font-size: 22px;">请选择您的意愿~</p>
			<p style="font-size: 22px; margin-bottom: 15px;">您既可以转让商品也可以求购商品哦~</p>
			<form action="<?=$baseurl?>item/newpost/type2/0" method="post">
				<input type="hidden" id="ptype" name="ptype" /> <input type="submit"
					class="btn btn-primary btn-hg btn-wide"
					onclick="$('#ptype').val(0)" value="我要转让" /> <input type="submit"
					class="btn btn-primary btn-hg btn-wide"
					onclick="$('#ptype').val(1)" value="我要求购" />
			</form>

		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>