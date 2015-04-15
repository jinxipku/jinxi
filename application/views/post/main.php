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
							<span class="fui-play"></span>打开
						</button>
						{/if}
						{elseif !isset($login_user)}
						<a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo">
							<span class="fui-plus"></span>收藏
						</a>
						{elseif isset($mypost)}
						<button id="btn_close_post" type="button" class="btn btn-sm btn-info" onclick="close_post({$thispost.post_id}, {$thispost.type})">
							<span class="fui-lock"></span>关闭
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
					<p class="post_user_nick">
						<a class="{$thispost.user.nick_color}" href="{$baseurl}user/profile/{$thispost.user_id}">{$thispost.user.nick}</a>
					</p>
					<p>
						<small class="post_user_school">{$thispost.user.school_name}</small>
						<small class="post_user_date">{$thispost.createat}</small>
					</p>
				</div>
			</div>

			<hr/>
			<p class="p_post_section affix-top">基本信息</p>
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
					<p class="p_post_content">成交方式： {$thispost.deal}</p>
					<p class="p_post_content">心理价位： {if $thispost.price == 0}面议{else}{$thispost.price} 元{/if}</p>
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
				<button id="btn_cancel_edit_des" type="button" class="btn btn-default pull-right" onclick="cancel_edit_des()">取消</button>
			</div>
			{/if}
			
			{if isset($thispost.picture)}
			<hr/>
			<p class="p_post_section">图片展示</p>
			<div id="post_picture">
				{foreach from = $thispost.picture item = pic} 
				<img class="lazy" data-original="{$pic.picture_url}" alt="图片展示"/>
				<pre class="p_picture_des">{$pic.picture_des}</pre>
				{/foreach}
			</div>
			{/if}
			
			<hr/>
			<p class="p_post_section">联系方式</p>
			<div id="post_contact">
				{foreach from = $thispost.contactby item = cont}
				<p class="p_post_content">{$cont}</p>
				{/foreach}
			</div>
			
			<hr/>
			<p class="p_post_section">分享页面</p>
			<div id="post_share">
				<div class="jiathis_style_32x32">
					<a class="jiathis_button_weixin"></a>
					<a class="jiathis_button_tsina"></a>
					<a class="jiathis_button_renren"></a>
					<a class="jiathis_button_qzone"></a>
					<a class="jiathis_button_douban"></a>
					<a class="jiathis_button_cqq"></a>
				</div>
				<div>
			    	<p><span class=" fui-new"></span> {$thispost.reply_num} <span class=" fui-heart"></span> {$thispost.favorite_num} </p>
			    	<button type="button" class="btn btn-primary" onclick="go_to_reply(0, {$thispost.user_id}, '{$thispost.user.nick}')">回复楼主</button>
			    </div>
				<script type="text/javascript" >
					var jiathis_config={
						url:"http://www.xn--wmqr18c.cn",
						summary:"这是来自今昔网的大学生二手商品信息，快加入今昔，加入大学生二手交易世界^-^",
						title:"今昔网 #今昔二手#",
						pic:"http://www.xn--wmqr18c.cn/img/jinxi.jpg",
						ralateuid:{
							"tsina":"3894185518"
						},
						shortUrl:false,
						hideMore:true
					}
				</script>
				<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>   
			</div>

			<hr/>
			<p class="p_post_section">帖子回复</p>
			<div id="post_reply">

				<div class="reply_box well">
					<div class="reply_header">
						<div>
							<a href="{$baseurl}user/profile/1">
								<img class="lazy" data-original="{$baseurl}img/head/default_thumb.jpg" alt="fabkxd"/>
							</a>
						</div>
						<div>
							<p class="post_user_nick">
								<a class="text_purple" href="{$baseurl}user/profile/1">fabkxd1</a>
							</p>
							<p>
								<small class="post_user_school">北京大学</small>
								<small class="post_user_date">2015-04-14 00:38:15</small>
							</p>
						</div>
						<div>
							<p>
								#1楼 | <a href="" onclick="go_to_reply(1, 2, 'fabkxd1');return false;">回复</a>
							</p>
						</div>
					</div>
					<div class="reply_content" onmouseover="$(this).find('button.btn_report').show();" onmouseout="$(this).find('button.btn_report').hide();">
						<button  type="button" class="btn btn-warning btn-sm btn_report" onclick="go_to_report(1,2)"><span class="fui-eye"></span>举报</button>
						<blockquote>
							<strong>回复 楼主： 今昔兔</strong>
						</blockquote>
						<pre>楼主你的手机不错，我想要，我加你QQ私信你吧~</pre>
					</div>
					<div class="reply_footer">
						<hr/>
						<p>山穷水绝处，回眸一遍你。</p>
					</div>
				</div>

				<div class="reply_box well">
					<div class="reply_header">
						<div>
							<a href="{$baseurl}user/profile/1">
								<img class="lazy" data-original="{$baseurl}img/head/default_thumb.jpg" alt="fabkxd"/>
							</a>
						</div>
						<div>
							<p class="post_user_nick">
								<a class="text_purple" href="{$baseurl}user/profile/1">fabkxd</a>
							</p>
							<p>
								<small class="post_user_school">北京大学</small>
								<small class="post_user_date">2015-04-14 00:38:15</small>
							</p>
						</div>
						<div>
							<p>
								#2楼 | <a href="" onclick="go_to_reply(2, 3, 'fabkxd2');return false;">回复</a>
							</p>
						</div>
					</div>
					<div class="reply_content" onmouseover="$(this).find('button.btn_report').show();" onmouseout="$(this).find('button.btn_report').hide();">
						<button  type="button" class="btn btn-warning btn-sm btn_report" onclick="go_to_report(2,3)"><span class="fui-eye"></span>举报</button>
						<blockquote>
							<strong>回复 楼主： 今昔兔</strong>
						</blockquote>
						<pre>楼主你的手机不错，我想要，我加你QQ私信你吧~</pre>
					</div>
					<div class="reply_footer">
						<hr/>
						<p>山穷水绝处，回眸一遍你。</p>
					</div>
				</div>
			</div>

			<div id="post_doreply">
				<form>
		      		<textarea rows="6" id="reply_content" name="reply_content" class="form-control flat" placeholder="发表回复......" maxlength=140></textarea>
		      		<div>
					    <blockquote class="pull-left">
					    	<strong>回复 楼主： {$thispost.user.nick}</strong>
					    </blockquote>
					    <input type="hidden" id="reply_to_id" name="reply_to_id" value="{$thispost.user_id}" />
					    <input type="hidden" id="reply_to_floor" name="reply_to_floor" value=0 />
		      			<button id="btn_confirm_reply" type="button" class=" pull-right btn btn-primary" onclick="confirm_reply()">发布</button>
					    <input type="reset" class=" pull-right btn btn-default" value="清空" />
					</div>
				</form>
			</div>
		</div>