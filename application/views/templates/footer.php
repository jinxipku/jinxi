<div id="footer">
	<div class="row"
	style="height: 35px; background-color: #999933; text-align: center;">
	<p class="footer">
		<a href="#" class="footer">关于今昔</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">今昔历程</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">联系我们</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">用户协议</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">帮助中心</a><span> &nbsp;&nbsp;| &nbsp;&nbsp;</span>
		<a href="#" class="footer">意见建议</a>
	</p>
</div>

<div id="scrollfoot"
style="text-align: center;background-color: #999999;">
<p class="footerinfo">&copy; 2013 今昔网 &middot;
	版权所有&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 京ICP备13053152号</p>
	<p class="footerinfo">后夏科技&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址：北京市海淀区</p>
	<p class="footerinfo">Designed and Developed by FABKXD</p>
</div>
</div>
<img id="backtotop" onmouseover="totop1()" onmouseout="totop2()"
onclick="gototop(0)"
style="display: none; width: 50px; position: fixed; bottom: 20px; right: 20px;"
src="{$baseurl}img/top.png" alt="回到顶部" />



<div class="modal fade" id="reportmodal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width: 500px; margin-top: 70px;">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
			<h6 class="modal-title" id="myModalLabel" style="font-family: 微软雅黑;">举报评论/回复</h6>
		</div>
		<div class="modal-body">
			<p>请选择举报理由：</p>
			<label class="radio">
				<input type="radio" name="reportreason" value="垃圾广告"
				data-toggle="radio" checked/>垃圾广告
			</label> 
			<label class="radio">
				<input type="radio" name="reportreason"
				value="敏感词汇" data-toggle="radio"/>敏感词汇
			</label> 
			<label class="radio"> 
				<input type="radio" name="reportreason"
				value="淫秽色情信息" data-toggle="radio"/>淫秽色情信息
			</label> 
			<label class="radio">
				<input type="radio" name="reportreason"
				value="人身攻击" data-toggle="radio"/>人身攻击
			</label> 
			<label class="radio">
				<input type="radio" name="reportreason"
				value="抄袭或版权问题" data-toggle="radio"/>抄袭或版权问题
			</label>
			<label class="radio"> 
				<input type="radio" name="reportreason"
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
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<!-- /.container -->
<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{$baseurl}js/bootstrap.js"></script>
	<script src="{$baseurl}js/stickup.js"></script>
	<script src="{$baseurl}js/jquery.ellipsis.js"></script>
	<script src="{$baseurl}js/flatui-checkbox.js"></script>
	<script src="{$baseurl}js/flatui-radio.js"></script>
	<script src="{$baseurl}js/jinxi.js"></script>
</body>
</html>