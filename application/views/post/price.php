				<div id="newpost_price">
					<div class="post_img">
						<img class="passive" src="{$baseurl}img/info/price.png" alt="填写价格">
					</div>
					<div class="post_cont">
						<p>请选择成交方式：</p>
						<select id="deal" name="deal">
							<option value=1 selected>一口价</option>
							<option value=2>接受砍价</option>
							<option value=3>一元赠送</option>
							<option value=4>面议</option>
						</select>
						<div class="input-group">
      						<input id="price" name="price" type="number" class="form-control flat" placeholder="请输入心理价格" onpaste="return false" onkeyup="this.value=this.value.replace('[^0-9]*','')" maxlength=10 />
      						<div class="input-group-addon">元</div>
   						 </div>
						
						<p>确认请按下一步。</p>
						<button type="button" class="btn btn-default" onclick="price2info()">上一步</button>
						<button type="button" class="btn btn-primary btn-hg" onclick="price2detail()">下一步</button>
						<script src="{$baseurl}js/bootstrap-select.js"></script>
						<script type="text/javascript">
							$("select").selectpicker(
								{
									style: 'btn-primary',
									menuStyle: 'dropdown'
								}
							);
							$("#deal").change(function(){
								var len = $("#deal>option").last().val();
								if ($("#deal").val() == 3) {
									$("#price").val(1);
									$("#price").attr("disabled", true);
									$("div.input-group-addon").show();
								} else if ($("#deal").val() < len) {
									$("#price").val("");
									$("#price").attr("placeholder", "请输入心理价格");
									$("#price").attr("disabled", false);
									$("div.input-group-addon").show();
								} else {
									$("#price").val("");
									$("#price").attr("placeholder", "面议");
									$("#price").attr("disabled", true);
									$("div.input-group-addon").hide();
								}
							});
						</script>
					</div>
				</div>