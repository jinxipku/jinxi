	<div id="body" class="row">
		<div id="main" class="help">
			<h6><strong>今昔网 帮助中心</strong></h6>
			<hr/>
			<br/>

			{foreach from = $helps item = help}
			<blockquote><strong>{$help.strtit}</strong></blockquote>
			<p>
				{$help.strcon}
    		</p>
			{/foreach}
    				
		</div>