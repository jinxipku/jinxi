<?php
$totalpage = ceil ( $total / 20 );
$pagegroup = ceil ( $totalpage / 10 );
$stpage = ceil ( $page / 10 ) * 10 - 9;
$edpage = $stpage + 9;
if (ceil ( $page / 10 ) == $pagegroup)
	$edpage = $totalpage;
?>
<p class="numinfo">共<?=$total?>篇帖子，这是第<?=$page?>页（每页20项）。</p>
<hr style="margin-top: 1px; margin-bottom: 1px;" />
<?php
if ($totalpage == 0 || $page == 0) :
	?>
<div style="height: 240px;">
	<img src="<?=$baseurl?>img/sorry.png" alt="sorry"
		style="position: relative; float: left; width: 200px; margin: 20px;" />
	<p
		style="position: relative; float: left; margin: 40px; font-size: 23px;">sorry，今昔网木有为您找到数据~</p>
	<p
		style="position: relative; float: left; margin: 0 40px 40px 40px; font-size: 23px;">立刻去发布一些帖子把~</p>
</div>
<?php
	return;

endif;
?>
<?php foreach ($mys as $myitem): ?>
<div class="leftrow">
	<div class="postitembig">
		<div class="postimage">
			<a href="<?=$baseurl?>item/viewpost/<?=$myitem['post_id']?>"
				target="_blank"> <img class="postimage"
				src="<?=$baseurl?>img/post/<?php
	if ($myitem ['pimage'] == 1 || $myitem ['pimage'] == 3 || $myitem ['pimage'] == 5 || $myitem ['pimage'] == 7)
		echo $myitem ['post_id'] . '_1.jpg';
	else if ($myitem ['pimage'] == 2 || $myitem ['pimage'] == 6)
		echo $myitem ['post_id'] . '_2.jpg';
	else if ($myitem ['pimage'] == 4)
		echo $myitem ['post_id'] . '_3.jpg';
	else {
		$imgnum = $myitem ['class'] + 1;
		echo $imgnum . '.png';
	}
	?>"
				alt="" /></a>
		</div>

		<div class="postinfo">
			<div class="titlewraper">
				<norb
					title="<?=get_title_str ( $myitem ['ptype'], $myitem ['pgtype'], $myitem ['pstype'], $myitem ['class'], $myitem ['brand'], $myitem ['modal'], $myitem ['pimage'] )?>">
				<a href="<?=$baseurl?>item/viewpost/<?=$myitem['post_id']?>"
					target="_blank" class="posttitle text-primary"><?=get_title_full ( $myitem ['ptype'], $myitem ['pgtype'], $myitem ['pstype'], $myitem ['class'], $myitem ['brand'], $myitem ['modal'], $myitem ['pimage'] )?></a>
				</norb>
			</div>
			<p class="postaddress"><?=$myitem['school']?></p>
			<p class="postuser">
				<span class=" fui-user"><a
					href="<?=$baseurl?>user/<?=$myitem['user_id']?>"
					class="<?=get_namecolor($myitem['namecolor'])?>"><?=$myitem['user_name']?></a></span>
				<span class=" fui-time" style="margin-left: 8px;"><?=$myitem['ptime']?></span>
				<span class=" fui-heart" style="margin-left: 8px;"><?=$myitem['focus']?></span>
				<span class=" fui-new" style="margin-left: 8px;"><?=$myitem['reply']?></span>
				<span class=" fui-eye" style="margin-left: 8px;"><?=$myitem['view']?></span>
			</p>
		</div>

		<div class="postquality">
			<img class="quality"
				src="<?=$baseurl?>img/class/<?=$myitem['status']?>.png" alt="" />
			<div
				style="max-width: 100px; margin-left: auto; margin-right: auto; text-align: center;">
				<p class="postprice">￥<?=$myitem['price']?></p>
			</div>
		</div>
	</div>
</div>
<hr style="margin-top: 1px; margin-bottom: 1px;" />
<?php endforeach; ?>
<center>
	<div class="pagination">
		<ul>
			<li class="previous"><a href="#" style="margin: 0;"
				onclick="showuserpage(2,<?=$cur_user['user_id']?>,1,1);return false;">首页</a></li>
		<?php if($page>1):?>
			<li class="previous"><a href="#" class="fui-arrow-left"
				onclick="showuserpage(2,<?=$cur_user['user_id']?>,<?=$page-1?>,1);return false;"></a></li>
		<?php endif;?>
		<?php for($i = $stpage;$i<=$edpage;$i++):?>
			<li <?php if($i==$page)echo ' class="active"';?>><a href="#"
				onclick="showuserpage(2,<?=$cur_user['user_id']?>,<?=$i?>,1);return false;"><?=$i?></a></li>
		<?php endfor;?>
		<?php if($page<$totalpage):?>
			<li class="next"><a href="#" class="fui-arrow-right"
				onclick="showuserpage(2,<?=$cur_user['user_id']?>,<?=$page+1?>,1);return false;"></a></li>
		<?php endif;?>
		<li class="next" style="margin: 0;"><a href="#" style="margin: 0;"
				onclick="showuserpage(2,<?=$cur_user['user_id']?>,<?=$totalpage?>,1);return false;">末页</a></li>
		</ul>
	</div>
</center>
<script type="text/javascript">    
	$('img.postimage').each(function(){
		var oimg = $(this);
		var nimg = new Image();
		nimg.src = oimg.attr("src");
		setTimeout(function() { 
			var w = nimg.width;
			var h = nimg.height;
			if(w>h){
				var del = -(114*w/h-114)/2;
				oimg.css('height','114px');
				oimg.css('margin-left',del+'px');
			}
			else if(w<h){
				var del = -(114*h/w-114)/2;
				oimg.css('width','114px');
				oimg.css('margin-top',del+'px');
			}
			else
				oimg.css('width','114px');
		},100);
	});    
</script>
