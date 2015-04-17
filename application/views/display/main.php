	<div id="body" class="row">
        <div id="main">
        	<input type="hidden" id="type" name="type" value="{$type}" />
        	<input type="hidden" id="area" name="area" value="{$area}" />
        	<input type="hidden" id="category1" name="category1" value="{$category1}" />
        	<input type="hidden" id="category2" name="category2" value="{$category2}" />
			<div id="post_directory">
				<ol class="breadcrumb">
					<li><a href="{$baseurl}display/{$type}/{$area}">商品大厅[{if $type == 'sell'}转让{else}求购{/if}]</a></li>
					{if $category1 > 0}
					<li><a href="{$baseurl}display/{$type}/{$area}/{$category1}">{$category1_name}</a></li>
					{/if}
					{if $category2 > -1}
					<li><a href="{$baseurl}display/{$type}/{$area}/{$category2}">{$category2_name}</a></li>
					{/if}
				</ol>
			</div>
			<div id="category_selection_box" class="panel">
				<div id="btng_category1">
					<p>一级分类</p>
					<ul class="nav nav-pills">
					  	<li{if $category1 == 0} class="active"{/if}><a href="{$baseurl}display/{$type}/{$area}/">全部</a></li>
					  	<li{if $category1 == 1} class="active"{/if}><a href="" onclick="show_category2(1, 0);return false;">电脑数码</a></li>
					  	<li{if $category1 == 2} class="active"{/if}><a href="" onclick="show_category2(2, 0);return false;">日用百货</a></li>
					  	<li{if $category1 == 3} class="active"{/if}><a href="" onclick="show_category2(3, 0);return false;">服饰箱包</a></li>
					  	<li{if $category1 == 4} class="active"{/if}><a href="" onclick="show_category2(4, 0);return false;">运动户外</a></li>
					  	<li{if $category1 == 5} class="active"{/if}><a href="" onclick="show_category2(5, 0);return false;">图书</a></li>
					  	<li{if $category1 == 6} class="active"{/if}><a href="" onclick="show_category2(6, 0);return false;">音像</a></li>
					  	<li{if $category1 == 7} class="active"{/if}><a href="" onclick="show_category2(7, 0);return false;">美容化妆</a></li>
					  	<li{if $category1 == 8} class="active"{/if}><a href="" onclick="show_category2(8, 0);return false;">其他</a></li>
					</ul>
				</div>
				<div id="btng_category2">
				</div>
				<script type="text/javascript" src="{$baseurl}js/bootstrap.js"></script>
				<script type="text/javascript" src="{$baseurl}js/show_category2.js"></script>
			</div>
			
		</div>