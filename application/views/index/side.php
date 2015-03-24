<div class="side">
	<div id="login_box" class="rightcontent panel panel-default">
		<button type="button" class="close" onClick="prelogin(1)">&times;</button>
		<form method="post" id="loginform">
			<div class="form-group">
				<input id="mail" name="mail" type="mail" placeholder="校园邮箱" class="form-control" onblur="checkmail(0)">
				<span class="check" id="checkmail"></span>
			</div>
			<div class="form-group">
				<input id="password" name="password" type="password" placeholder="密码" class="form-control" onblur="checkpw()"> 
				<span class="check" id="checkpw"></span>
			</div>
			<button type="button" class="btn btn-primary" style=" border-radius: 1px; width: 100%;" onClick="login('{$baseurl}')">登录</button>
			<p style=" font-size: 15px; margin-top: 8px; margin-bottom: 8px; color: #7F8C8D;">还木有账号？</p>
			<a href="http://jinxi.net/account/regidit" type="button" class="btn btn-info" style=" border-radius: 1px; width: 100%;">立即注册</a>
		</form>
	</div>
	<a href="{$baseurl}display/hall" type="button"
		class="btn btn-primary btn-hg btn-block" style="margin-bottom: 10px; ">商品大厅
	</a> <a href="{$baseurl}item/newpost/type" type="button"
		class="btn btn-primary btn-hg btn-block" style="margin-bottom: 20px;">发布信息
	</a>
	<?php
		$this->load->helper('array');
		$gettips = show_tips();
		$strtit = $gettips['strtit'];
		$strcon = $gettips['strcon'];
	?>
	<div>
		<blockquote>
			<p class="righttitle">今昔贴士</p>
		</blockquote>
		<div class="rightcontent panel panel-default">
			<p class="rightcontent" style=" font-weight: 600"><?=$strtit?></p>
			<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;<?=$strcon?></p>
			<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
			<p class="rightlink">
				<a class="text-info btn-link">关于今昔</a><span> | </span><a
					class="text-info rightlink btn-link">帮助中心</a>
			</p>
		</div>
	</div>


	<div>
		<blockquote>
			<p class="righttitle">商品品质</p>
		</blockquote>
		<div class="panel panel-default">
			<img src="{$baseurl}img/quality.jpg" alt="" style="width: 100%;" />
		</div>
	</div>

	<div>
		<blockquote>
			<p class="righttitle">商品标签</p>
		</blockquote>
		<div class="rightcontent panel panel-default"
			style="padding: 0 10px 0 10px;">
			<ul class="list-group" style="margin-top: -1px;">
				<li class="list-group-item">
					<p class="text-primary righttag" data-toggle="collapse" data-target="#tag1">【转让】：适用于待售商品</p>
					<p id="tag1" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此商品为转让商品，有需求的用户可以关注并回复此帖。</p>
				</li>
				<li class="list-group-item">
					<p class="text-primary righttag" data-toggle="collapse" data-target="#tag2">【求购】：适用于欲求商品</p>
					<p id="tag2" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此商品为求购商品，有响应货品的用户可以关注并回复此帖。</p>
				</li>
				<li class="list-group-item">
					<p class="text-warning righttag" data-toggle="collapse"
						data-target="#tag3">【自制】：适用于普通商品</p>
					<p id="tag3" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此商品为楼主手工自制，商品品质为S级别。</p>
				</li>
				<li class="list-group-item">
					<p class="text-warning righttag" data-toggle="collapse"
						data-target="#tag4">【正品】：适用于普通商品</p>
					<p id="tag4" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此商品为低价未拆封正品，商品品质为S级别。</p>
				</li>
				<li class="list-group-item">
					<p class="text-warning righttag" data-toggle="collapse"
						data-target="#tag5">【多】：适用于待售商品</p>
					<p id="tag5" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此转让商品楼主有多件存货，欲购者可以一次购买多件。</p>
				</li>
				<li class="list-group-item">
					<p class="text-warning righttag" data-toggle="collapse"
						data-target="#tag6">【特】：适用于欲求商品</p>
					<p id="tag6" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此求购商品楼主有特殊需求，详情见帖子内容中的详细描述部分。</p>
				</li>
				<li class="list-group-item">
					<p class="text-purple righttag" data-toggle="collapse"
						data-target="#tag7">【图】：适用于待售商品</p>
					<p id="tag7" class="collapse righttagcon">&nbsp;&nbsp;&nbsp;&nbsp;标明此商品附带展示图片。</p>
				</li>
			</ul>
		</div>
	</div>
	
	<img src="<?=$baseurl?>img/jinxibig.jpg" alt="www.今昔.cn" style=" width: 264px;"/>
</div>
</div>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript">var ujian_config = {num:6,target:1,itemTitle:'相关链接：',picSize:120,textHeight:45,mouseoverColor:'#1ABC9C'};</script>
<script type="text/javascript"
	src="http://v1.ujian.cc/code/ujian.js?uid=1867235"></script>
<a href="http://www.ujian.cc" style="border: 0;"><img
	src="http://img.ujian.cc/pixel.png" alt="友荐云推荐"
	style="border: 0; padding: 0; margin: 0;" /></a>
<script type="text/javascript">
var jiathis_config={
	url:"http://今昔.cn",
	summary:"亲，有闲置不用的小物件么？想要便宜实用的二手商品？快加入今昔吧，加入专属大学生的二手交易世界^-^",
	title:"今昔网欢迎您！ #今昔二手#",
	pic:"http://jinxi.net/img/jinxibig.jpg",
	marginTop:350,
	ralateuid:{
		"tsina":"3894185518"
	},
	showClose:true,
	shortUrl:false,
	hideMore:false
}
</script>
<script type="text/javascript"
	src="http://v3.jiathis.com/code/jiathis_r.js?btn=r3.gif&move=0"
	charset="utf-8"></script>
<!-- JiaThis Button END -->