	<div id="body" class="row">
        <div id="main">
			<div id="set_tabs">
				<ul class="nav nav-pills nav-stacked">
					<li {if $set_tab == 1}class="active"{/if}>
						<a href="#set_info" data-toggle="tab">修改资料</a>
					</li>
					<li {if $set_tab == 2}class="active"{/if}>
						<a href="#set_head" data-toggle="tab">修改头像</a>
					</li>
					<li {if $set_tab == 3}class="active"{/if}>
						<a href="#set_pw" data-toggle="tab">账户设置</a>
					</li>
					<li {if $set_tab == 4}class="active"{/if}>
						<a href="#set_star" data-toggle="tab">星级用户</a>
					</li>
				</ul>
			</div>
			<div id="set_panels" class="panel panel-default">
				<div class="tab-content">
					<div id="set_info" class="tab-pane fade{if $set_tab == 1} in active{/if}">
						{$this->display ( 'setup/setinfo.php' )}
					</div>
					<div id="set_head" class="tab-pane fade{if $set_tab == 2} in active{/if}">
						{$this->display ( 'setup/sethead.php' )}
					</div>
					<div id="set_pw" class="tab-pane fade{if $set_tab == 3} in active{/if}">
						{$this->display ( 'setup/setaccount.php' )}
					</div>
					<div id="set_pw" class="tab-pane fade{if $set_tab == 4} in active{/if}">
						{$this->display ( 'setup/setinfo.php' )}
					</div>
				</div>
			</div>
	</div>