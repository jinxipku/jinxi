	<div id="footer">
		<div id="footer_links" class="row">
			<p class="footer_links">
				<a href="#" class="footer">关于今昔</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="#" class="footer">今昔历程</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="#" class="footer">联系我们</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="#" class="footer">用户协议</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="#" class="footer">帮助中心</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
				<a href="#" class="footer">意见建议</a>
			</p>
		</div>

		<div id="footer_address" class="row">
			<p class="footer_address">&copy; 2013 今昔网 &middot; 版权所有&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 京ICP备13053152号</p>
			<p class="footer_address">后夏科技&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址：北京市海淀区</p>
			<p class="footer_address">Designed and Developed by JINXI</p>
		</div>
	</div>

	<img id="back_to_top" onmouseover="back_to_top1()" onmouseout="back_to_top2()" onclick="go_to_top()" src="{$baseurl}img/top.png" alt="回到顶部" />

<!--
	<div id="report_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h6 class="modal-title" id="myModalLabel">举报评论/回复</h6>
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
					<input id="report_or" type="text" class="form-control" maxlength=30 />
					<input id="report_oid" type="hidden" class="form-control"/>
					<input id="report_rtype" type="hidden" class="form-control"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="reportconfirm()" data-dismiss="modal">提交</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
-->

	{if isset($is_index)}
	<!-- 
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
	JiaThis Button BEGIN -->
	<!--
	<script type="text/javascript">
		var jiathis_config={
			url:"http://www.今昔.cn",
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
	<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?btn=r3.gif&move=0" charset="utf-8"></script>
	-->
	{/if}
	<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?uid=1427183820919265&move=0" charset="utf-8"></script>
<!-- JiaThis Button END -->

	<script src="{$baseurl}js/bootstrap.js"></script>
	<script src="{$baseurl}js/stickup.js"></script>
	<script src="{$baseurl}js/jquery.ellipsis.js"></script>
	<script src="{$baseurl}js/flatui-checkbox.js"></script>
	<script src="{$baseurl}js/flatui-radio.js"></script>
	<script src="{$baseurl}js/jinxi.js"></script>
</body>
</html>