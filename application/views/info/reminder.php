<div class="modal-header">
	<h4 class="modal-title">消息提醒({$cnt})<small><a href="" onclick="delete_all_reminder();return false;" title="删除全部提醒">&nbsp;&nbsp;<i class="icon-trash"></i></a></small></h4>
</div>
<div class="modal-body">
	<div id="reminders_box">
		{foreach from = $data item = reminder}
		<a href="{$reminder.url}" target="_blank" onclick="go_to_reminder('{$reminder.url}')">
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
			<hr/>
		</a>
		{/foreach}
	</div>
</div>