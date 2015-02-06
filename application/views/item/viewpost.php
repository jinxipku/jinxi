<div class="row" style="margin-top: 20px;">
	<div class=" leftpart">
		<div style="width: 772px;">
			<div style="width: 772px; height: 50px;">
				<div
					style="position: relative; float: left; height: 50px; width: 600px;">
					<ol class="breadcrumb"
						style="font-size: 13px; position: relative; float: left; padding-right: 0px; padding-left: 0px;">
						<li><a href="#">商品大厅</a></li>
						<li><a href="#">运动户外</a></li>
						<li><a href="#">其他</a></li>
					</ol>
					<ol class="breadcrumb"
						style="font-size: 13px; position: relative; float: left; padding-left: 0px;">
						<li></li>
						<li class="active breadwraper"><norb
								title="<?=get_title_str ( $thispost ['ptype'], $thispost ['pgtype'], $thispost ['pstype'], $thispost ['class'], $thispost ['brand'], $thispost ['modal'], $thispost ['pimage'] )?>">
				<?=get_title_str ( $thispost ['ptype'], $thispost ['pgtype'], $thispost ['pstype'], $thispost ['class'], $thispost ['brand'], $thispost ['modal'], $thispost ['pimage'] )?></norb>
						</li>
					</ol>
				</div>
				<div
					style="position: relative; float: left; height: 50px; width: 172px;">
					<div id="focusbox"
						style="position: relative; float: right; height: 50px;">
					<?php if(!isset($login_user)):?>
					<a type="button" class="btn btn-sm btn-info"
							href="<?=$baseurl?>account/loginfo"><span class="fui-heart"></span>收藏</a>
				<?php elseif($thispost ['post_user']==$login_user['user_id']):?>
					<button type="button" class="btn btn-sm btn-info"
							onclick="deletepost()">
							<span class="fui-cross"></span>删除
						</button>
				<?php elseif($has_focus > 0):?>
					<button id="focusbt" type="button" class="btn btn-sm btn-info"
							onclick="deletefocus(<?=$login_user['user_id']?>,<?=$thispost ['post_id']?>,<?=$thispost ['focus']?>)"
							onmouseover="change2df()" onmouseout="change2af()">已收藏</button>
				<?php else:?>
					<button type="button" class="btn btn-sm btn-info"
							onclick="addfocus(<?=$login_user['user_id']?>,<?=$thispost ['post_id']?>,<?=$thispost ['focus']?>)">
							<span class="fui-heart"></span>收藏
						</button>
				<?php endif;?>
				</div>
				</div>
			</div>

			<hr style="margin-top: 8px; border-top: 1px solid #e0e0e0;" />
			<h6 style="font-family: 微软雅黑"><?=get_title_full ( $thispost ['ptype'], $thispost ['pgtype'], $thispost ['pstype'], $thispost ['class'], $thispost ['brand'], $thispost ['modal'], $thispost ['pimage'] )?></h6>
			<div style="width: 772px; height: 65px;">
				<div
					style="position: relative; float: left; height: 65px; width: 65px;">
					<a href="<?=$baseurl?>user/<?=$thispost['user_id']?>"><img
						src="<?=$baseurl?>img/head/<?=$thispost ['user_id'].'_'.$thispost ['image']?>"
						style="height: 65px; width: 65px;" alt="" /></a>
				</div>
				<div
					style="position: relative; float: left; height: 65px; width: 707px; padding-left: 15px;">
					<a class="<?=get_namecolor($thispost['namecolor'])?>"
						href="<?=$baseurl?>user/<?=$thispost['user_id']?>"><?=$thispost['user_name']?></a>
					<h6>
						<small style="color: #7F8C8D; font-family: 微软雅黑, 黑体, 宋体;"><?=$thispost['school'].' '?></small><small
							style="color: #7F8C8D"><?=$thispost['ptime']?></small>
					</h6>
				</div>
			</div>

			<hr style="border-top: 1px solid #e0e0e0;" />
			<p style="color: #7F8C8D;">基本信息</p>
			<p class="postcontent">帖子类型：<?php
			if ($thispost ['ptype'] == 0)
				echo '商品转让';
			else
				echo '商品求购'?></p>
			<p class="postcontent">一级分类：<?=get_class1($thispost['class'])?></p>
			<p class="postcontent">二级分类：<?=get_class2($thispost['class'])?></p>
			<p class="postcontent">品牌型号：<?=$thispost['brand'].$thispost['modal']?></p>
			<p class="postcontent">商品状态：<?php
			if ($thispost ['status'] == 1)
				echo '全新S级别';
			else if ($thispost ['status'] == 2)
				echo '九成新A级别';
			else if ($thispost ['status'] == 3)
				echo '七成新B级别';
			else if ($thispost ['status'] == 4)
				echo '五成新C级别';
			?></p>
			<p class="postcontent">心理价位：<?php
			if ($thispost ['price'] == 0 || $thispost ['price'] == 99999999)
				echo '价格面议';
			else
				echo '￥' . $thispost ['price'];
			?></p>


			<hr style="border-top: 1px solid #e0e0e0;" />
			<p style="color: #7F8C8D;">详细描述</p>
			<p class="postcontent">&nbsp;&nbsp;&nbsp;&nbsp;<?=$thispost['pcontent']?></p>
			
			<?php if($thispost['pimage']>0):?>
			<hr style="border-top: 1px solid #e0e0e0;" />
			<p style="color: #7F8C8D;">图片展示</p>
			<?php if($thispost['pimage']==1||$thispost['pimage']==3||$thispost['pimage']==5||$thispost['pimage']==7):?>
			<img src="<?=$baseurl?>img/post/<?=$thispost['post_id'].'_1.jpg'?>"
				alt="" style="width: 772px;" />
			<?php endif;?>
			<?php if($thispost['pimage']==2||$thispost['pimage']==3||$thispost['pimage']==6||$thispost['pimage']==7):?>
			<img src="<?=$baseurl?>img/post/<?=$thispost['post_id'].'_2.jpg'?>"
				alt="" style="width: 772px;" />
			<?php endif;?>
			<?php if($thispost['pimage']==4||$thispost['pimage']==5||$thispost['pimage']==6||$thispost['pimage']==7):?>
			<img src="<?=$baseurl?>img/post/<?=$thispost['post_id'].'_3.jpg'?>"
				alt="" style="width: 772px;" />
			<?php endif;?>
			<?php endif?>
			
			<hr style="border-top: 1px solid #e0e0e0;" />
			<p style="color: #7F8C8D;">联系方式</p>
			<p class="postcontent">站内：回复本贴</p>
			<?php if($thispost['mail_on']==1):?>
			<p class="postcontent">邮箱：<?=$thispost['mail']?></p>
			<?php endif;?>
			<?php if($thispost['qq_on']==1):?>
			<p class="postcontent">QQ：<?=$thispost['qq']?></p>
			<?php endif;?>
			<?php if($thispost['phone_on']==1):?>
			<p class="postcontent">手机：<?=$thispost['phone']?></p>
			<?php endif;?>
			
			<hr style="border-top: 1px solid #e0e0e0;" />
		</div>
	</div>
	<div class=" rightpart">
	<?php
	$this->load->view ( 'item/right' );
	?>
	</div>
</div>