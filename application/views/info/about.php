	<div id="body" class="row">
		<div id="main" class="about">
			<h6><strong>今昔网 关于今昔</strong></h6>
			<hr/>
			<br/>

			<blockquote class="contact"><strong>联系我们</strong></blockquote>

			<p>我们是来自海淀区若干所高校的烟酒僧，是一个致力于为广大同学们服务的高校团队。<br/>
			今昔网是一个高校二手物品信息中心，在这里你可以便捷地发布自己的二手信息或需求，也可以方便地获取丰富的二手信息！
			</p>
			<p>您可以通过以下方式联系我们：</p>
			<div id="contact_us_box">
				<div class="contact_us">
					<p><strong>微信公众号</strong></p>
					<a href="#" target="_blank" title="今昔网微信公众号"><img src="{$baseurl}img/wbewm.png" alt="今昔网微信公众号"></a>
				</div>

				<div class="contact_us">
					<p><strong>新浪微博官方账号</strong></p>
					<a href="http://weibo.com/u/3894185518" target="_blank" title="今昔二手新浪微博主页"><img src="{$baseurl}img/wbewm.png" alt="今昔二手新浪微博主页"></a>
				</div>

				<div class="contact_us">
					<p><strong>客服</strong></p>
					<p>
					邮箱： <br/>
					jinxicn2013@163.com
					</p>
					<p>
					Q Q： <br/>
					847525974<br/>
					847525974
					</p>
				</div>
			</div>

			<blockquote class="history"><strong>今昔历程</strong></blockquote>

			<div id="timeline_box">
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