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
				<a class="pull-right" href="{$baseurl}display/{$type}/{$another_area}{if $category1 > 0}/{$category1}{if $category2 > -1}/{$category2}{/if}{/if}">
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
			
		</div>