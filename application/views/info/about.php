	<div id="body" class="row">
		<div id="main">
			<p class="heading">联系方式</p>
			<hr/>
			<p>{$about_us}</p>
			<p>微信公众号及二维码，微博官方账号及二维码，客服QQ，地址</p>
			<p class="heading">时间轴(发展历程)</p>
			<hr/>
	
				<div id="timeline">
				</div>
			
			<hr/>

			<p class="heading">给我们的建议</p>
			<div class="form-group">
				<input type="text" placeholder="请输入你们的建议" class="form-control flat"/>
			</div>
			
		</div>
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="{$baseurl}js/timeline-min.js"></script>
		<script>
			var timeline = new VMM.Timeline();
			timeline.init("{$baseurl}resource/timeline.json");
		</script>