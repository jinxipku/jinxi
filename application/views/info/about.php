	<div id="body" class="row">
		<div id="main">
			<h6><strong>今昔网 关于今昔</strong></h6>
			<hr/>
			<br/>

			<blockquote class="contact"><strong>联系我们</strong></blockquote>

			<hr/>
			<p>{$about_us}</p>
			<p>微信公众号及二维码，微博官方账号及二维码，客服QQ，地址</p>

			<blockquote class="history"><strong>今昔历程</strong></blockquote>

			<hr/>
			<div class="row">
				<div id="timeline">
				</div>
			</div>
			<div style="overflow:display;height:auto;position:relative;display:inline-block !important; display:inline;">
				
			</div>
			<hr/>

			<blockquote class="suggest"><strong>意见建议</strong></blockquote>
			<p class="heading">给我们的建议</p>
			<div class="form-group">
				<input type="text" placeholder="请输入你们的建议" class="form-control flat"/>
			</div>
			
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
			<script type="text/javascript" src="{$baseurl}js/timeline-min.js"></script>
			<script>
				var timeline = new VMM.Timeline();
				timeline.init("{$baseurl}resource/timeline.json");
			</script>

		</div>