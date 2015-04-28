<div class="modal-header">
	<h4 class="modal-title">消息提醒({$cnt})</h4>
</div>
<div class="modal-body">
	<div id="reminders_box">
		{foreach from = $data item = reminder}
		<a href="{$reminder.url}" target="_blank">
			<div class="reminder_box">
			  <div class="reminder_title">
			    <div>
			      <img class="passive lazy" src="{$reminder.thumb}" />
			    </div>
			    <div>
			      <div>
			        {$reminder.part1}
			      </div>
			      <div>
			        {$reminder.part2}
			      </div>
			    </div>
			  </div>
			  <div class="reminder_content">
			    {$reminder.part3}
			  </div>
			</div>
		</a>
		<hr/>
		{/foreach}
	</div>
</div>