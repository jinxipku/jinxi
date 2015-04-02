<p class="set_title">修改资料</p>
<div class="set_content">
	<div class="set_table">
		<hr/>
		<p class="set_table_title">基本信息</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="set_label">
					<p>姓 名</p>
				</div>
				<div class="set_input">
					<input id="nick" name="nick" type="text" value="{$login_user.nick}" class="form-control flat" maxlength=10/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>性 别</p>
				</div>
				<div class="set_input">
					<label class="radio{if $login_user.sex == '兔星人'} checked{/if}">
						<input type="radio" id="sex0" name="sex" value="0" data-toggle="radio"{if $login_user.sex == '兔星人'} checked{/if}/>兔星人
					</label>
					<label class="radio{if $login_user.sex == '汪星人'} checked{/if}">
						<input type="radio" id="sex1" name="sex" value="1" data-toggle="radio"{if $login_user.sex == '汪星人'} checked{/if}/>汪星人
					</label>
					<label class="radio{if $login_user.sex == '喵星人'} checked{/if}"> 
						<input type="radio" id="sex2" name="sex" value="2" data-toggle="radio"{if $login_user.sex == '喵星人'} checked{/if}/>喵星人
					</label> 
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>签 名</p>
				</div>
				<div class="set_input">
					<textarea rows="4" id="signature" name="signature" class="form-control flat" maxlength=80>{$login_user.signature}</textarea>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">学校信息</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="set_label">
					<p>学 校</p>
				</div>
				<div class="set_input">
					<input id="school" name="school" type="text" value="{$login_user.school_name}" class="form-control flat" disabled/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>身 份</p>
				</div>
				<div class="set_input">
					<select id="type" name="type">
						<option value="0"{if $login_user.type == '未选择'} selected{/if}>未选择</option>
						<option value="1"{if $login_user.type == '本科生'} selected{/if}>本科生</option>
						<option value="2"{if $login_user.type == '硕士生'} selected{/if}>硕士生</option>
						<option value="3"{if $login_user.type == '博士生'} selected{/if}>博士生</option>
						<option value="4"{if $login_user.type == '教职工'} selected{/if}>教职工</option>
						<option value="5"{if $login_user.type == '校友'} selected{/if}>校友</option>
						<option value="6"{if $login_user.type == '校外合作者'} selected{/if}>校外合作者</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>年 份</p>
				</div>
				<div class="set_input">
					<select id="year">
						<option value="0"{if $login_user.year == 0} selected{/if}>未选择</option>
					{assign var="loop" value="8"}
					{section name="loop" loop=$loop}
　　						<option value="{$smarty.section.loop.index + 2008}"{if $login_user.year == $smarty.section.loop.index + 2008} selected{/if}>
						{$smarty.section.loop.index + 2008}级
						</option>
　　					{/section}
						<option value="1"{if $login_user.year == 1} selected{/if}>其他</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>

	<script src="{$baseurl}js/bootstrap-select.js"></script>
	<script type="text/javascript">
		$("select").selectpicker({
			style: 'btn-primary',
			menuStyle: 'dropdown'
		});
	</script>

	<div class="set_table">
		<hr/>
		<p class="set_table_title">联系方式</p>
		<div class="set_table_content">
			<div class="set_row">
				<div class="set_label">
					<p>邮 箱</p>
				</div>
				<div class="set_input">
					<input id="email" name="email" type="text" value="{$login_user.email}" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>Q Q</p>
				</div>
				<div class="set_input">
					<input id="qq" name="qq" type="text" value="{$login_user.qq}" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>微 信</p>
				</div>
				<div class="set_input">
					<input id="weixin" name="weixin" type="text" value="{$login_user.weixin}" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="set_row">
				<div class="set_label">
					<p>手 机</p>
				</div>
				<div class="set_input">
					<input id="phone" name="phone" type="text" value="{$login_user.phone}" class="form-control flat"/>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<hr/>
<button id="btn_saveinfo" class="set_save btn btn-lg btn-primary" type="button" onclick="save_info()"> 保 存 </button>