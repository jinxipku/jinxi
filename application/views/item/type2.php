<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/type.png" alt="" style="width: 100%">
		</div>
		<div
			style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 20px;">
			<form id="type2form" action="<?=$baseurl?>item/newpost/class/0" method="post">
				<p style="font-size: 22px; margin-bottom: 15px;">您要<?php
				if ($this->session->userdata ( 'ptype' ) == 1)
					echo '求购';
				else
					echo '转让';
				?>的商品是否是S级别的自制品或正品？</p>
				<select id="pgtype" name="pgtype">
					<option value="0"
						<?php if($this->session->userdata ( 'pgtype'  )==0)echo ' selected'?>>无</option>
					<option value="1"
						<?php if($this->session->userdata ( 'pgtype'  )==1)echo ' selected'?>>自制</option>
					<option value="2"
						<?php if($this->session->userdata ( 'pgtype'  )==2)echo ' selected'?>>正品</option>
				</select>
				<p style="font-size: 22px; margin-bottom: 15px;">您要<?php
				if ($this->session->userdata ( 'ptype' ) == 1)
					echo '求购';
				else
					echo '转让';
				?>的商品是否<?php
			if ($this->session->userdata ( 'ptype' ) == 1)
				echo '有特殊需求';
			else
				echo '有多件存货';
			?>？</p>
				<select id="pstype" name="pstype">
					<option value="0"
						<?php if($this->session->userdata ( 'pstype'  )==0)echo ' selected'?>>无</option>
					<?php if($this->session->userdata ( 'ptype'  )==0):?>
					<option value="1"
						<?php if($this->session->userdata ( 'pstype'  )==1)echo ' selected'?>>有多件存货</option>
					<?php else:?>
					<option value="2"
						<?php if($this->session->userdata ( 'pstype'  )==2)echo ' selected'?>>有特殊需求</option>
					<?php endif;?>
				</select>
				<p style="font-size: 22px; margin-bottom: 15px;">确认请按下一步。</p>
				<input
					type="submit" class="btn btn-default btn-hg btn-wide"
					onclick="$('#type2form').attr('action','<?=$baseurl?>item/newpost/type/1')" value="上一步" /> <input type="submit"
					class="btn btn-primary btn-hg btn-wide"
					onclick="$('#type2form').attr('action','<?=$baseurl?>item/newpost/class/0')" value="下一步" />
			</form>

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