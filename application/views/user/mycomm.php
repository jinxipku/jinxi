<?php
$this->load->library ( 'session' );
$log_id = $this->session->userdata ( 'login_user' );
$totalpage = ceil ( $total / 20 );
$pagegroup = ceil ( $totalpage / 10 );
$stpage = ceil ( $page / 10 ) * 10 - 9;
$edpage = $stpage + 9;
if (ceil ( $page / 10 ) == $pagegroup)
	$edpage = $totalpage;
?>
<div style="height: 36px;">
<p class="numinfo pull-left">共<?=$total?>条
<?php
if ($ctype == 5)
	echo '全部';
else if ($ctype == 6)
	echo '卖家';
else
	echo '买家';
?>评论，这是第<?=$page?>页（每页20项）。</p>
<div class="btn-group pull-right" data-toggle="buttons">
	<label
		class="btn btn-default btn-sm<?php if($ctype==5)echo ' active';?>"
		onclick="showuserpage(5,<?=$cur_user['user_id']?>,1,1)"> <input
		type="radio" name="ctype" id="ctype1"> 全部
	</label> <label
		class="btn btn-default btn-sm<?php if($ctype==6)echo ' active';?>"
		onclick="showuserpage(6,<?=$cur_user['user_id']?>,1,1)"> <input
		type="radio" name="ctype" id="ctype2"> 卖家评论
	</label> <label
		class="btn btn-default btn-sm<?php if($ctype==7)echo ' active';?>"
		onclick="showuserpage(7,<?=$cur_user['user_id']?>,1,1)"> <input
		type="radio" name="ctype" id="ctype3"> 买家评论
	</label>
</div>
</div>
<hr style="margin: 0;" />
<?php
if ($totalpage == 0 || $page == 0) :
	?>
<div style="height: 240px;">
	<img src="<?=$baseurl?>img/sorry.png" alt="sorry"
		style="position: relative; float: left; width: 200px; margin: 20px;" />
	<p
		style="position: relative; float: left; margin: 40px; font-size: 23px;">sorry，今昔网木有为您找到数据~</p>
	<p
		style="position: relative; float: left; margin: 0 40px 40px 40px; font-size: 23px;">
		<?php 
		if($cur_id==$log_id)
			echo '赶快去发布信息吸引小伙伴们吧~';
		else 
			echo '赶快去评论你的小伙伴吧~';
		?></p>
</div>
<?php
endif;
?>
<?php foreach ($comms as $commitem): ?>
<div class="commhoverbox" style="width: 772px; overflow: hidden;">
	<div
		style="height: 70px; width: 70px; position: relative; float: left;">
		<a href="<?=$baseurl?>user/<?=$commitem['subject_id']?>"><img
			style="height: 70px; width: 70px;"
			src="<?=$baseurl?>img/head/<?php
	if ($commitem ['image'] == '0')
		echo '0.jpg';
	else
		echo $commitem ['subject_id'] . '_' . $commitem ['image'];
	?>"
			alt="" title="<?=$commitem['user_name']?>" /> </a>
	</div>

	<div
		style="min-height: 70px; width: 602px; position: relative; float: left;">
		<p
			style="min-height: 44px; padding: 7px; margin-bottom: 0; margin-left: 3px; font-size: 16px; font-family: 宋体;">
			&nbsp;&nbsp;&nbsp;&nbsp;<?=$commitem['ccontent']?>
		</p>
		<?php if($commitem['has_sign']==1):?>
		<hr style="margin-left: 120px;"/>
		<p style="margin-left: 150px; text-align: right; margin-bottom: 10px;" class="usersign"><?=$commitem['sign']?></p>
		<?php endif;?>
		<p class="postuser">
			<span class=" fui-user"><a
				href="<?=$baseurl?>user/<?=$commitem['subject_id']?>"
				class="<?=get_namecolor($commitem['namecolor'])?>"><?=$commitem['user_name']?></a></span>
			<span class=" fui-time" style="margin-left: 8px;"><?=$commitem['ctime']?></span>
		</p>
	</div>

	<div
		style="min-height: 70px; width: 100px; text-align: center; position: relative; float: left;">
		<p class="userstat"><?php
	if ($commitem ['ctype'] == 0)
		echo '卖家';
	else
		echo '买家';
	?>评分</p>
		<p style="margin-bottom: 0; font-size: 12px;"><?=$commitem['cscore']?>分</p>
		<a class="commreport text-danger btn-link" onclick="commreport(<?=$commitem['comment_id']?>)">举报</a>
	</div>
</div>
<hr style="margin: 0;" />
<?php endforeach; ?>
<?php
if ($totalpage > 0 && $page > 0) :
?>
<center>
	<div class="pagination">
		<ul>
			<li class="previous"><a href="#" style="margin: 0;"
				onclick="showuserpage(<?=$ctype?>,<?=$cur_user['user_id']?>,1,1);return false;">首页</a></li>
		<?php if($page>1):?>
			<li class="previous"><a href="#" class="fui-arrow-left"
				onclick="showuserpage(<?=$ctype?>,<?=$cur_user['user_id']?>,<?=$page-1?>,1);return false;"></a></li>
		<?php endif;?>
		<?php for($i = $stpage;$i<=$edpage;$i++):?>
			<li <?php if($i==$page)echo ' class="active"';?>><a href="#"
				onclick="showuserpage(<?=$ctype?>,<?=$cur_user['user_id']?>,<?=$i?>,1);return false;"><?=$i?></a></li>
		<?php endfor;?>
		<?php if($page<$totalpage):?>
			<li class="next"><a href="#" class="fui-arrow-right"
				onclick="showuserpage(<?=$ctype?>,<?=$cur_user['user_id']?>,<?=$page+1?>,1);return false;"></a></li>
		<?php endif;?>
		<li class="next" style="margin: 0;"><a href="#" style="margin: 0;"
				onclick="showuserpage(<?=$ctype?>,<?=$cur_user['user_id']?>,<?=$totalpage?>,1);return false;">末页</a></li>
		</ul>
	</div>
</center>
<?php endif;?>
<?php if($log_id==''):?>
<hr style="margin: 0;" />
<div id="docommentbox" style="padding: 20px; height: 268px;">
	<p class="con">发表评论</p>
	<textarea rows="6" id="commcont" name="replycont" class="form-control"
		placeholder="请先登录......"
		style="border-radius: 1px; margin-bottom: 10px;" disabled></textarea>
	<select id="ctype" disabled>
		<option value=0>卖家</option>
		<option value=1>买家</option>
	</select> <select id="cscore" disabled>
		<option value=1>1分</option>
		<option value=2>2分</option>
		<option value=3>3分</option>
		<option value=4>4分</option>
		<option value=5>5分</option>
	</select> <span>
		<button type="button" class=" pull-right btn btn-primary"
			style="border-radius: 1px; margin-left: 10px;"
			onclick="$('#navbarlogin').click()">去登录</button>
	</span> <span>
		<button type="button" class=" pull-right btn btn-default"
			style="border-radius: 1px;" onclick="$('#commcont').val('')" disabled>清空</button>
	</span>
</div>
<?php elseif($cur_id!=$log_id):?>
<hr style="margin: 0;" />
<div id="docommentbox" style="padding: 20px; height: 268px;">
	<p class="con">发表评论</p>
	<textarea rows="6" id="commcont" name="replycont" class="form-control"
		placeholder="评论TA......"
		style="border-radius: 1px; margin-bottom: 10px;"></textarea>
	<select id="ctype">
		<option value=0>卖家</option>
		<option value=1>买家</option>
	</select> <select id="cscore">
		<option value=1>1分</option>
		<option value=2>2分</option>
		<option value=3>3分</option>
		<option value=4>4分</option>
		<option value=5>5分</option>
	</select> <span>
		<button type="button" class=" pull-right btn btn-primary"
			style="border-radius: 1px; margin-left: 10px;"
			onclick="docomment(<?=$log_id?>,<?=$cur_id?>)">发布</button>
	</span> <span>
		<button type="button" class=" pull-right btn btn-default"
			style="border-radius: 1px;" onclick="$('#commcont').val('')">清空</button>
	</span>
</div>
<?php endif;?>
<script src="<?=$baseurl?>js/bootstrap-select.js"></script>
<script>
	$("select").selectpicker({style: 'btn-primary', menuStyle: 'dropdown'});
</script>
<script>
$(".commhoverbox").mouseover(function(){
	$(this).find(".commreport").show();
})
$(".commhoverbox").mouseout(function(){
	$(this).find(".commreport").hide();
})
</script>