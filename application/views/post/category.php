				<div id="newpost_category">
					<div class="post_img">
						<img class="passive" src="{$baseurl}img/info/category.png" alt="选择类别">
					</div>
					<div class="post_cont">
						<p>请选择商品所属大类：</p>
						<select id="category1" name="category1">
							<option value=1 selected>电脑数码</option>
							<option value=2>日用百货</option>
							<option value=3>服饰箱包</option>
							<option value=4>运动户外</option>
							<option value=5>图书</option>
							<option value=6>音像</option>
							<option value=7>美容化妆</option>
							<option value=8>其他</option>
						</select>
						<p>请选择商品所属小类：</p>
						<select id="category2" name="category2">
						</select>
						<p>确认请按下一步。</p>
						<button type="button" class="btn btn-default" onclick="category2type()">上一步</button>
						<button type="button" class="btn btn-primary btn-hg" onclick="category2info()">下一步</button>
						<script src="{$baseurl}js/classselect.js"></script>
						<script src="{$baseurl}js/bootstrap-select.js"></script>
						<script type="text/javascript">
							$("select").selectpicker(
								{
									style: 'btn-primary',
									menuStyle: 'dropdown'
								}
							);
						</script>
					</div>
					<div class="clear"></div>
				</div>