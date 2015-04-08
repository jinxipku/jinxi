				<div id="newpost_detail">
					<div class="post_img">
						<img class="passive" src="{$baseurl}img/info/detail.png" alt="填写详细信息">
					</div>
					<div class="post_cont">
						<textarea rows="8" id="description" name="description" class="form-control flat" placeholder="请填写您对商品的详细需求：" maxlength=300></textarea>
						<p id="p_confirm_post">确认请按下一步。</p>
						<button type="button" class="btn btn-default" onclick="detail2price()">上一步</button>
						<button id="btn_confirm_post_buy" type="button" class="btn btn-primary btn-hg" onclick="detail2picture()">下一步</button>
					</div>
				</div>