	<div id="body" class="row">
		<div id="main">
			<div id="info_img">
				<img class="passive" src="{$baseurl}img/info/info.png" alt="choose category">
			</div>
			<div id="info_cont">
				<form id="info_form" action="{$baseurl}post/newpost/content/price" method="post">
					<p>请输入{if $category1 == 5}图书书名{else}物品品牌/名称{/if}：</p>
					<input id="brand" name="brand" type="text" value="{$brand}" class="form-control" maxlength=30/>
					<p>请输入{if $category1 == 5}图书出版社和作者，空格隔开{else}物品型号{/if}：</p>
					<input id="modal" name="modal" type="text" value="{$model}" class="form-control" maxlength=30/>
					<p>请选择物品状态：</p>
					<select id="class" name="class">
						<option value=1{if $class == 1}selected{/if}>S级别</option>
						<option value=1{if $class == 1}selected{/if}>S级别</option>
						<option value=2{if $class == 2}selected{/if}>A级别</option>
						<option value=3{if $class == 3}selected{/if}>B级别</option>
						<option value=4{if $class == 4}selected{/if}>C级别</option>
					</select>
					<p style="font-size: 22px; margin-bottom: 15px;">请输入您的心理最<?php
					
	if ($this->session->userdata ( 'ptype' ) == 1)
						echo '高';
					else
						echo '低';
					?>价位（人民币），若欲面议价格，请输入0：</p>
					<input id="price" name="price" type="text"
						value="<?php
						if ($this->session->userdata ( 'price' ))
							echo $this->session->userdata ( 'price' );
						else
							echo 0;
						?>"
						class="form-control"
						style="width: 250px; background-color: #f4f4f4;" maxlength=10 />
					<p style="font-size: 22px; margin-bottom: 15px;">确认请按下一步。</p>
					<a type="button" href="{$baseurl}post/newpost/category" class="btn btn-default btn-hg">上一步</a>
					<input type="submit"
						class="btn btn-primary btn-hg btn-wide"
						onclick="$('#infoform').attr('action','{$baseurl}item/newpost/content/0')"
						value="下一步" />
				</form>
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
		<div id="side">
			<div id="side_tips">
				<blockquote>
					<p class="side_title">今昔贴士</p>
				</blockquote>
				<div class="side_content panel panel-default">
					<p class="p_song_title">{$tips.strtit}</p>
					<p class="p_song_content">&nbsp;&nbsp;{$tips.strcon}</p>
					<p class="p_song_content">&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
					<p class="p_song_link">
						<a class="text-info btn-link">关于今昔</a>
						<span> | </span>
						<a class="text-info btn-link">帮助中心</a>
					</p>
				</div>
			</div>
		</div>
	</div>