<link href="<?=$baseurl?>css/school.css" rel="stylesheet">
<div class="row" style="margin-top: 20px;">
<?php if ($login_user['right_on']): ?>
	<div class="leftpart">
<?php endif;?>
		<div class=" leftchoose">
			<ul class="nav nav-pills">
				<li <?php if($tab==1)echo 'class="active" ';?>
					style="margin-left: 2px;"><a href="#selfinfo" data-toggle="tab">修改资料</a></li>
				<li <?php if($tab==2)echo 'class="active" ';?>><a href="#headimg"
					data-toggle="tab">修改头像</a></li>
				<li <?php if($tab==3)echo 'class="active" ';?>><a href="#changepw"
					data-toggle="tab">账户设置</a></li>
				<li <?php if($tab==4)echo 'class="active" ';?>><a href="#tiebbs"
					data-toggle="tab">绑定BBS</a></li>
				<li <?php if($tab==5)echo 'class="active" ';?>><a href="#star"
					data-toggle="tab"><i class="icon-star-empty"></i>星级用户</a></li>
			</ul>
		</div>
<?php if ($login_user['right_on']): ?>
		<div class=" righttext panel panel-default">
<?php else: ?>
		<div class=" righttextall panel panel-default">
<?php endif;?>
		
			<div class="tab-content">
					<div class="tab-pane fade<?php if($tab==1)echo ' in active';?>"
						id="selfinfo">
			<?php
			$this->load->view ( 'setup/selfinfo' );
			?>
			</div>
					<div class="tab-pane fade<?php if($tab==2)echo ' in active';?>"
						id="headimg">
			<?php
			$this->load->view ( 'setup/headimg' );
			?>
			</div>
					<div class="tab-pane fade<?php if($tab==3)echo ' in active';?>"
						id="changepw">
			<?php
			$this->load->view ( 'setup/account' );
			?>
			</div>
					<div class="tab-pane fade<?php if($tab==4)echo ' in active';?>"
						id="tiebbs">
			<?php
			$this->load->view ( 'setup/tiebbs' );
			?>
			</div>
					<div class="tab-pane fade<?php if($tab==5)echo ' in active';?>"
						id="star">
			<?php
			$this->load->view ( 'setup/star' );
			?>
			</div>
				</div>
			</div>
<?php if ($login_user['right_on']): ?>
	</div>
<?php endif;?>
<?php

if ($login_user ['right_on'])
	$this->load->view ( 'index/righthalf' );
else
	echo '</div>';
?>
<div class="modal fade" id="chooseschool" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width: 650px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h6 class="modal-title" id="myModalLabel" style="font-family: 微软雅黑;">选择学校</h6>
					</div>
					<div class="modal-body">
						<div id="choose-a-province"></div>
						<hr />
						<div id="choose-a-school"></div>
					</div>
					<div class="modal-footer">
						<button id="chooseover" type="button" class="btn btn-default"
							data-dismiss="modal">关闭</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>