				<div id="newpost_info">
					<div class="post_img">
						<img class="passive" src="{$baseurl}img/info/info.png" alt="填写基本信息">
					</div>
					<div class="post_cont">
						<input id="brand" name="brand" type="text" class="form-control flat" placeholder="请输入物品品牌/名称" maxlength=30 />
						<input id="model" name="model" type="text" class="form-control flat" placeholder="请输入物品型号" maxlength=50 />
						<p>请选择物品状态：</p>
						<select id="class" name="class">
							<option value=0 selected>S级别（正品）</option>
							<option value=1>S级别（自制）</option>
							<option value=2>A级别</option>
							<option value=3>B级别</option>
							<option value=4>C级别</option>
						</select>
						<p>确认请按下一步。</p>
						<button type="button" class="btn btn-default" onclick="info2category()">上一步</button>
						<button type="button" class="btn btn-primary btn-hg" onclick="info2price()">下一步</button>
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
				</div>