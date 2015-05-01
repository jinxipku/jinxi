	<div id="footer">
		<div id="footer_links" class="row">
			<p class="footer_links">
				<a href="{$baseurl}" class="footer">今昔主页</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="{$baseurl}info/about/contact" class="footer">联系我们</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="{$baseurl}info/about/history" class="footer">今昔历程</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="{$baseurl}info/about/suggest" class="footer">意见建议</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="{$baseurl}info/help" class="footer">帮助中心</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="{$baseurl}info/agreement" class="footer">用户协议</a>
			</p>
		</div>

		<div id="footer_address" class="row">
			<p class="footer_address">&copy; 2013 今昔网 &middot; 版权所有&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 京ICP备13053152号</p>
			<p class="footer_address">后夏天火科技&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址：北京市海淀区</p>
			<p class="footer_address">Designed and Developed by JINXI</p>
		</div>
	</div>

	<img id="back_to_top" onmouseover="back_to_top1()" onmouseout="back_to_top2()" onclick="go_to_top()" src="{$baseurl}img/top.png" alt="回到顶部" />

	<div id="reminder_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
			</div>
		</div>
	</div>

	{if isset($thispost)}
	<div id="report_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h6 class="modal-title" id="myModalLabel">举报回复</h6>
				</div>
				<div class="modal-body">
					<p>请选择举报理由：</p>
					<label class="radio">
						<input type="radio" name="report_reason" value="垃圾广告"
						data-toggle="radio" checked/>垃圾广告
					</label> 
					<label class="radio">
						<input type="radio" name="report_reason"
						value="敏感词汇" data-toggle="radio"/>敏感词汇
					</label> 
					<label class="radio"> 
						<input type="radio" name="report_reason"
						value="淫秽色情信息" data-toggle="radio"/>淫秽色情信息
					</label> 
					<label class="radio">
						<input type="radio" name="report_reason"
						value="人身攻击" data-toggle="radio"/>人身攻击
					</label> 
					<label class="radio">
						<input type="radio" name="report_reason"
						value="抄袭或版权问题" data-toggle="radio"/>抄袭或版权问题
					</label>
					<label class="radio"> 
						<input type="radio" name="report_reason"
						value="其他" data-toggle="radio"/>其他
					</label>
					<input id="report_other_reason" type="text" placeholder="其他" class="form-control flat" maxlength=30 />
					<input id="report_reply_id" type="hidden" class="form-control"/>
					<input id="report_floor" type="hidden" class="form-control"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" onclick="confirm_report()" data-dismiss="modal">提交</button>
				</div>
			</div>
		</div>
	</div>
	{/if}

	<script type="text/javascript" src="{$baseurl}js/bootstrap.js"></script>
	<script type="text/javascript" src="{$baseurl}js/stickup.js"></script>
	<script type="text/javascript" src="{$baseurl}js/jquery.ellipsis.js"></script>
	<script type="text/javascript" src="{$baseurl}js/flatui-checkbox.js"></script>
	<script type="text/javascript" src="{$baseurl}js/flatui-radio.js"></script>
	<script type="text/javascript" src="{$baseurl}js/jquery.lazyload.min.js"></script>
	<script type="text/javascript" src="{$baseurl}js/jinxi.js"></script>
	{if isset($user_tab)}
	<script type="text/javascript">
		{if $user_tab == 'mine'}
		show_user_page_display('#user_post', 1);
		{elseif $user_tab == 'best'}
		show_user_page_display('#user_best', 1);
		{elseif $user_tab == 'message'}
		show_user_page_display('#user_mess', 1);
		{/if}
	</script>
	{elseif isset($about_part)}
	<script type="text/javascript">
		$("html,body").animate(
			{
				scrollTop: $("blockquote.{$about_part}").offset().top - 50
			},
			700
		);
	</script>
	{elseif isset($reply_id)}
	<script type="text/javascript">
		$("html,body").animate(
			{
				scrollTop: $("div.reply_box[data-rid={$reply_id}]").offset().top 
			},
			700
		);
	</script>
	{/if}

	{if isset($is_index)}
	<script type="text/javascript">
		var ujian_config = {
			num: 6,
			target: 1,
			itemTitle: '相关链接：',
			picSize: 120,
			textHeight: 45,
			mouseoverColor: '#1ABC9C'
		};
	</script>
	<script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js?uid=1867235"></script>
	<a id="ujian" href="http://www.ujian.cc">
		<img src="http://img.ujian.cc/pixel.png" alt="友荐云推荐"/>
	</a>
	<script type="text/javascript">
		var jiathis_config={
			url:"http://www.今昔.cn",
			summary:"亲，有闲置不用的小物件么？想要便宜实用的二手商品？快加入今昔吧，加入专属大学生的二手交易世界^-^",
			title:"今昔网欢迎您！ #今昔二手#",
			pic:"http://jinxi.net/img/jinxibig.jpg",
			marginTop:500,
			ralateuid:{
				"tsina":"3894185518"
			},
			showClose:true,
			shortUrl:false,
			hideMore:false
	}
	</script>
	<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?btn=r3.gif&move=0" charset="utf-8"></script>
	{/if}
</body>
</html>