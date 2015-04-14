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
			<h5>
				{$thispost.title}
			</h5>
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
						{if isset($mypost)}
						<button id="btn_open_post" type="button" class="btn btn-sm btn-info" onclick="open_post({$thispost.post_id}, {$thispost.type})">
							<span class="fui-check"></span>打开
						</button>
						{/if}
						{elseif !isset($login_user)}
						<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo">
							<span class="fui-plus"></span>收藏
						</a>
						{elseif isset($mypost)}
						<button id="btn_close_post" type="button" class="btn btn-sm btn-info" onclick="close_post({$thispost.post_id}, {$thispost.type})">
							<span class="fui-cross"></span>关闭
						</button>
						{elseif isset($has_collect)}
						<button id="btn_collcet" type="button" class="btn btn-sm btn-info" onclick="delete_collect({$thispost.post_id}, {$thispost.type})" onmouseover="change2dc()" onmouseout="change2ac()">
							已收藏
						</button>
						{else}
						<button id="btn_collcet" type="button" class="btn btn-sm btn-info" onclick="add_collect({$thispost.post_id}, {$thispost.type})">
							<span class="fui-plus"></span>收藏
						</button>
						{/if}
					</div>
					<p id="post_user_nick"><a class="{$thispost.user.nick_color}" href="{$baseurl}user/profile/{$thispost.user_id}">{$thispost.user.nick}</a></p>
					<p>
					<small id="post_user_school">{$thispost.user.school_name}</small>
					<small id="post_user_date">{$thispost.createat}</small>
					</p>
				</div>
			</div>

			<hr/>
			<p class="p_post_section">基本信息</p>
			<div id="post_content">
				<div id="post_content_left">
					<p class="p_post_content">帖子类型： {$post_type}</p>
					<p class="p_post_content">一级分类： {$thispost.category1_name}</p>
					<p class="p_post_content">二级分类： {$thispost.category2_name}</p>
					<p class="p_post_content">品牌型号： {$thispost.brand} {$thispost.model}</p>
					<p class="p_post_content">物品状态： 
					{if $thispost.class == 0}S级别（正品）
					{elseif $thispost.class == 1}S级别（自制）
					{elseif $thispost.class == 2}A级别（九成新）
					{elseif $thispost.class == 3}B级别（七成新）
					{elseif $thispost.class == 4}C级别（五成新）
					{/if}
					</p>
					<p class="p_post_content">成交方式：{$thispost.deal}</p>
					<p class="p_post_content">心理价位：{if $thispost.price == 0}面议{else}{$thispost.price} 元{/if}</p>
				</div>
				<div id="post_content_right">
					<div>
						<img class="passive" src="{$baseurl}img/class/{$thispost.class}.png" alt="物品状态">
					</div>
					<div>
						<p id="p_post_deal">{if $thispost.price == 0}面议{else}￥ {$thispost.price}{/if}</p>
					</div>
				</div>
			</div>


			<hr/>
			<p class="p_post_section">详细描述</p>
			{if isset($mypost)}
			<div id="post_description" onmouseover="$('#btn_edit_description').show();" onmouseout="$('#btn_edit_description').hide();">
				<button id="btn_edit_description" type="button" class="btn btn-info btn-sm" onclick="edit_description()"><span class="fui-gear"></span>编辑</button>
			{else}
			<div id="post_description">
			{/if}
				<pre>{$thispost.description}</pre>
			</div>
			{if isset($mypost)}
			<div id="post_editor" class="clearfix">
				<textarea rows="8" id="edit_description" name="edit_description" class="form-control flat" placeholder="修改描述" maxlength=300>{$thispost.description}</textarea>
				<button id="btn_confirm_edit_des" type="button" class="btn btn-primary pull-right" onclick="confirm_edit_des({$thispost.post_id}, {$thispost.type})">确认修改</button>
			</div>
			{/if}
			
			{if isset($thispost.picture)}
			<hr/>
			<p class="p_post_section">图片展示</p>
			<div id="post_picture">
				{foreach from = $thispost.picture item = pic} 
				<img class="passive" src="{$pic.picture_url}" alt="图片展示"/>
				<pre class="p_picture_des">{$pic.picture_des}</pre>
				{/foreach}
			</div>
			{/if}
			
			<hr/>
			<p class="p_post_section">联系方式</p>
			<div id="post_contact">
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
			</div>
			
			<hr/>

		</div>