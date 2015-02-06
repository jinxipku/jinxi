<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div
			style="position: relative; float: left; width: 286px; padding-top: 10px;">
			<img src="<?=$baseurl?>img/info.png" alt="" style="width: 100%">
		</div>
		<div
			style="position: relative; float: left; width: 486px; padding-left: 30px; padding-top: 20px;">
			<form id="infoform" action="<?=$baseurl?>item/newpost/content/0"
				method="post">
				<p style="font-size: 22px; margin-bottom: 15px;">请输入<?php
				
				if ($this->session->userdata ( 'classpre' ) == 5)
					echo '图书书名，请输入书名号：';
				else
					echo '商品品牌/名称：';
				?></p>
				<input id="brand" name="brand" type="text"
					value="<?php
					
					if ($this->session->userdata ( 'brand' ))
						echo $this->session->userdata ( 'brand' );
					else if ($this->session->userdata ( 'classpre' ) == 5 && $this->session->userdata ( 'ptype' ) == 1)
						echo '书名不限';
					else if ($this->session->userdata ( 'classpre' ) == 5 && $this->session->userdata ( 'ptype' ) == 0)
						echo '书名不详';
					else if ($this->session->userdata ( 'classpre' ) != 5 && $this->session->userdata ( 'ptype' ) == 1)
						echo '品牌不限';
					else if ($this->session->userdata ( 'classpre' ) != 5 && $this->session->userdata ( 'ptype' ) == 0)
						echo '品牌不详';
					?>"
					class="form-control"
					style="width: 250px; background-color: #f4f4f4;" maxlength=20 />
				<p style="font-size: 22px; margin-bottom: 15px;">请输入<?php
				
				if ($this->session->userdata ( 'classpre' ) == 5)
					echo '图书出版社和作者，空格隔开：';
				else
					echo '商品型号：';
				?></p>
				<input id="modal" name="modal" type="text"
					value="<?php
					
					if ($this->session->userdata ( 'modal' ))
						echo $this->session->userdata ( 'modal' );
					else if ($this->session->userdata ( 'classpre' ) == 5 && $this->session->userdata ( 'ptype' ) == 1)
						echo '出版社及作者不限';
					else if ($this->session->userdata ( 'classpre' ) == 5 && $this->session->userdata ( 'ptype' ) == 0)
						echo '出版社及作者不详';
					else if ($this->session->userdata ( 'classpre' ) != 5 && $this->session->userdata ( 'ptype' ) == 1)
						echo '型号不限';
					else if ($this->session->userdata ( 'classpre' ) != 5 && $this->session->userdata ( 'ptype' ) == 0)
						echo '型号不详';
					?>"
					class="form-control"
					style="width: 250px; background-color: #f4f4f4;" maxlength=20 />
				<p style="font-size: 22px; margin-bottom: 15px;">请选择商品状态：</p>
				<select id="status" name="status">
					<option value=1
						<?php if($this->session->userdata ( 'status'  )==1)echo ' selected'?>>S级别</option>
					<option value=2
						<?php if($this->session->userdata ( 'status'  )==2)echo ' selected'?>>A级别</option>
					<option value=3
						<?php if($this->session->userdata ( 'status'  )==3)echo ' selected'?>>B级别</option>
					<option value=4
						<?php if($this->session->userdata ( 'status'  )==4)echo ' selected'?>>C级别</option>
				</select>
				<p style="font-size: 22px; margin-bottom: 15px;">请输入您的心理最<?php
				
if ($this->session->userdata ( 'ptype' ) == 1)
					echo '高';
				else
					echo '低';
				?>价位（人民币），若欲面议价格，请输入0：</p>
				<input id="price" name="price" type="text"
					value="<?php
					if ($this->session->userdata ( 'price' ))
						echo $this->session->userdata ( 'price' );
					else
						echo 0;
					?>"
					class="form-control"
					style="width: 250px; background-color: #f4f4f4;" maxlength=10 />
				<p style="font-size: 22px; margin-bottom: 15px;">确认请按下一步。</p>
				<input type="submit" class="btn btn-default btn-hg btn-wide"
					onclick="$('#infoform').attr('action','<?=$baseurl?>item/newpost/class/1')"
					value="上一步" /> <input type="submit"
					class="btn btn-primary btn-hg btn-wide"
					onclick="$('#infoform').attr('action','<?=$baseurl?>item/newpost/content/0')"
					value="下一步" />
			</form>
			<script src="<?=$baseurl?>js/bootstrap-select.js"></script>
			<script>
	$("select").selectpicker({style: 'btn-primary', menuStyle: 'dropdown'});
	</script>
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'account/jinxitip' );
	?>
	</div>
</div>