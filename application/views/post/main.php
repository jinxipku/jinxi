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

			<hr/>
			<h6>
				{$thispost.title}
			</h6>
			<div id="post_author">
				<div>
					<a href="{$baseurl}user/profile/{$thispost.user_id}">
						<img src="{$thispost.user.thumb}" alt="{$thispost.user.nick}" />
					</a>
				</div>
				<div>
					<div id="post_collect_box">
						{if $thispost.active == 0}
						<p class="p_post_close">贴子已关闭</p>
						{elseif !isset($login_user)}
						<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo">
							<span class="fui-plus"></span>收藏
						</a>
						{elseif isset($mypost)}
						<button type="button" class="btn btn-sm btn-info" onclick="close_post({$thispost.post_id}, {$thispost.type})">
							<span class="fui-cross"></span>关闭
						</button>
						{elseif isset($has_collect)}
						<button id="btn_collcet" type="button" class="btn btn-sm btn-info" onclick="delete_collect({$login_user.id}, {$thispost.post_id}, {$thispost.type})" onmouseover="change2dc()" onmouseout="change2ac()">
							已收藏
						</button>
						{else}
						<button id="btn_collcet" type="button" class="btn btn-sm btn-info" onclick="delete_collect({$login_user.id}, {$thispost.post_id}, {$thispost.type})">
							<span class="fui-plus"></span>收藏
						</button>
						{/if}
					</div>
					<a class="{$thispost.user.nick_color}" href="{$baseurl}user/profile/{$thispost.user_id}">
						<p id="post_user_nick">{$thispost.user.nick}</p>
					</a>
					<p>
					<small id="post_user_school">{$thispost.user.school_name}</small>
					<small id="post_user_date">{$thispost.createat}</small>
					</p>
				</div>
			</div>

			<hr/>
			<p class="p_post_section">基本信息</p>
			<p class="p_post_content">帖子类型： {$post_type}</p>
			<p class="p_post_content">一级分类： {$thispost.category1_name}</p>
			<p class="p_post_content">二级分类： {$thispost.category2_name}</p>
			<p class="p_post_content">品牌型号： {$thispost.brand} {$thispost.model}</p>
			<p class="p_post_content">商品状态：
			{if $thispost.class == 0}S级别（正品）
			{elseif $thispost.class == 1}S级别（自制）
			{elseif $thispost.class == 2}A级别（九成新）
			{elseif $thispost.class == 3}B级别（七成新）
			{elseif $thispost.class == 4}C级别（五成新）
			{/if}
			<p class="p_post_content">成交方式：{$thispost.deal}</p>
			<p class="p_post_content">心理价位：{$thispost.price} 元</p>


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