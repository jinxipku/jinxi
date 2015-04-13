	<div id="body" class="row">
        <div id="main">
			<div id="post_directory">
				<ol class="breadcrumb">
					<li><a href="{$baseurl}display/hall">商品大厅</a></li>
					<li><a href="{$baseurl}display/hall/{$thispost.category1}">{$thispost.category1_name}</a></li>
					<li><a href="{$baseurl}display/hall/{$thispost.category2}">{$thispost.category2_name}</a></li>
				</ol>
				<ol class="breadcrumb">
					<li></li>
					<li class="active breadwraper">
						<norb title="{$thispost.plain_title}">{$thispost.plain_title}</norb>
					</li>
				</ol>
			</div>

			<hr  />
			<h6 style="font-family: 微软雅黑; line-height: 100%; vertical-align: center;">
				{$thispost.title}
			</h6>
			<div style="width: 772px; height: 65px;">
				<div
					style="position: relative; float: left; height: 65px; width: 65px;">
					<a href="{$baseurl}user/profile/1"><img src="{$baseurl}img/head/JhdIR6yg1HJzxSYcE1428120756.jpg"
						style="height: 65px; width: 65px;" alt="" /></a>
				</div>
				<div
					style="position: relative; float: left; height: 65px; width: 707px; padding-left: 15px;">
					<a class="<?=get_namecolor($thispost['namecolor'])?>"
						href="{$baseurl}user/<?=$thispost['user_id']?>"><?=$thispost['user_name']?></a>
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
			<img src="{$baseurl}img/post/<?=$thispost['post_id'].'_1.jpg'?>"
				alt="" style="width: 772px;" />
			<?php endif;?>
			<?php if($thispost['pimage']==2||$thispost['pimage']==3||$thispost['pimage']==6||$thispost['pimage']==7):?>
			<img src="{$baseurl}img/post/<?=$thispost['post_id'].'_2.jpg'?>"
				alt="" style="width: 772px;" />
			<?php endif;?>
			<?php if($thispost['pimage']==4||$thispost['pimage']==5||$thispost['pimage']==6||$thispost['pimage']==7):?>
			<img src="{$baseurl}img/post/<?=$thispost['post_id'].'_3.jpg'?>"
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