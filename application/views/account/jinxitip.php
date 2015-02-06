<?php
$this->load->helper ( 'array' );
$gettips = show_tips ();
$strtit = $gettips ['strtit'];
$strcon = $gettips ['strcon'];
?>
<div>
	<blockquote>
		<p class="righttitle">今昔贴士</p>
	</blockquote>
	<div class="rightcontent panel panel-default">
		<p class="rightcontent" style="font-weight: 600"><?=$strtit?></p>
		<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;<?=$strcon?></p>
		<p class="rightcontent">&nbsp;&nbsp;&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
		<p class="rightlink">
			<a class="text-info btn-link">关于今昔</a><span> | </span><a
				class="text-info rightlink btn-link">帮助中心</a>
		</p>
	</div>
</div>