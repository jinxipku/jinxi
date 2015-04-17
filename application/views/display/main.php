	<div id="body" class="row">
        <div id="main">
        	<input type="hidden" id="type" name="type" value="{$type}" />
        	<input type="hidden" id="area" name="area" value="{$area}" />
        	<input type="hidden" id="category1" name="category1" value="{$category1}" />
        	<input type="hidden" id="category2" name="category2" value="{$category2}" />
			<div id="post_directory">
				<ol class="breadcrumb">
					{if $category1 > 0}
					<li><a href="{$baseurl}display/{$type}/{$area}">商品大厅[{if $type == 'sell'}转让{else}求购{/if}]</a></li>
					{if $category2 > -1}
					<li>
						<a href="{$baseurl}display/{$type}/{$area}/{$category1}">{$category1_name}</a>
					</li>
					{else}
					<li class="active">
						{$category1_name}
					</li>
					{/if}
					{else}
					<li class="active">商品大厅[{if $type == 'sell'}转让{else}求购{/if}]</li>
					{/if}
					{if $category2 > -1}
					<li class="active">{$category2_name}</li>
					{/if}
				</ol>
				{if isset($login_user)}
				<a class="pull-right" href="{$baseurl}display/{$type}/{$another_area}{if $category1 > 0}/{$category1}{if $category2 > -1}/{$category2}{/if}{/if}" title="点击切换到{if $area == 'school'}全站{else}本校{/if}">
					切换到{if $area == 'school'}全站{else}本校{/if}
				</a>
				{/if}
				<span class="pull-right">{if $area == 'school'}{$login_user.school_name}{else}全站{/if}</span>
			</div>
			<div id="category_selection_box" class="panel">
				<p>一级分类</p>
				<div id="btng_category1">
					<ul class="nav nav-pills">
					  	<li{if $category1 == 0} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/" onmouseover="show_category2(0)">全部</a></li>
					  	<li{if $category1 == 1} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/1" onmouseover="show_category2(1)">电脑数码</a></li>
					  	<li{if $category1 == 2} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/2" onmouseover="show_category2(2)">日用百货</a></li>
					  	<li{if $category1 == 3} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/3" onmouseover="show_category2(3)">服饰箱包</a></li>
					  	<li{if $category1 == 4} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/4" onmouseover="show_category2(4)">运动户外</a></li>
					  	<li{if $category1 == 5} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/5" onmouseover="show_category2(5)">图书</a></li>
					  	<li{if $category1 == 6} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/6" onmouseover="show_category2(6)">音像</a></li>
					  	<li{if $category1 == 7} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/7" onmouseover="show_category2(7)">美容化妆</a></li>
					  	<li{if $category1 == 8} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/8" onmouseover="show_category2(8)">其他</a></li>
					</ul>
				</div>
				<p>二级分类</p>
				<div id="btng_category2">
				</div>
				<script type="text/javascript" src="{$baseurl}js/bootstrap.js"></script>
				<script type="text/javascript" src="{$baseurl}js/show_category2.js"></script>
			</div>


			<div id="post_items_box" class="panel">
				<div class="post_item_box">
					<div class="post_item_img">
						<a href="{$baseurl}post/viewpost/sell/3">
							<img class="lazy" data-original="http://www.xn--wmqr18c.cn/img/picture/1/thumb_nm4QQNuu1RUjsEyjp1428943080.jpg" alt="tiezibiaoti" />
						</a>
					</div>
					<div class="post_item_content">
						<div>
							<a href="{$baseurl}post/viewpost/sell/3" title='[转让][图]电脑数码>手机:苹果 iphone5s手机'>
								<span class="tag bg-primary">转让</span>
								<span class="tag bg-purple">图</span>
								电脑数码 > 手机 : 苹果 iphone5s手机 : 苹果 iphone5s
							</a>
						</div>
						<div>
							大神的三大大神的三大大神的三大大神的三大大神的三大大神的三大大神的三大大神的三大大神的三大大神的三大...
						</div>
						<div>
							<div>
								<a href="{$baseurl}user/profile/1">
									<img class="lazy" data-original="http://www.xn--wmqr18c.cn/img/head/svxvkeeS1xmvThxME1429093424.jpg" alt="一剑轻安"/>
								</a>
							</div>
							<div>
								<div onmouseover="$(this).find('button').show();" onmouseout="$(this).find('button').hide();">
									<a href="{$baseurl}user/profile/1" class="text-primary">一剑轻安</a>
									<button type="button" class="btn btn-info pull-right">我有类似需求</button>
								</div>
								<div>
									<span class="fui-location">
										北京航天航空大学空
									</span>
									<span class="fui-time">
										2015-04-14 00:38:15
									</span>
									<span class="fui-new">
										12
									</span>
									<span class="fui-heart">
										3
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="post_item_price">
						<div>
							<img class="lazy" data-original="http://www.xn--wmqr18c.cn/img/class/3.png" alt="物品状态" />
						</div>
						<div>
							￥3500.00
						</div>
					</div>
				</div>
			</div>
			
		</div>