				<div id="newpost_contact">
					<div class="post_img">
						<img id="img_mobile_upload" class="passive" src="{$baseurl}img/info/mail.png" alt="选择联系方式">
					</div>
					<div class="post_cont">
						<p>请选择联系方式：</p>
						<label class="checkbox" for="jinxi_check"> <input type="checkbox" value="" id="jinxi_check" data-toggle="checkbox" checked>
							站内联系
						</label>
						<label class="checkbox" for="email_check"> <input type="checkbox" value="" id="email_check" data-toggle="checkbox" {if $login_user.is_email_public == 1}checked{/if}>
							邮箱联系
						</label>
						<label class="checkbox" for="qq_check"> <input type="checkbox" value="" id="qq_check" data-toggle="checkbox" {if $login_user.is_qq_public == 1}checked{/if}>
							QQ联系
						</label>
						<label class="checkbox" for="weixin_check"> <input type="checkbox" value="" id="weixin_check" data-toggle="checkbox" {if $login_user.is_weixin_public == 1}checked{/if}>
							微信联系
						</label>
						<label class="checkbox" for="phone_check"> <input type="checkbox" value="" id="phone_check" data-toggle="checkbox" {if $login_user.is_phone_public == 1}checked{/if}>
							手机联系
						</label>
						<p>确认请按完成发布。</p>
						<button id="btn_contact_pre" type="button" class="btn btn-default">上一步</button>
						<button id="btn_confirm_post" type="button" class="btn btn-primary btn-hg" onclick="confirm_post()">完成发布</button>
					</div>
				</div>