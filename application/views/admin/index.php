<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="login for jinxi_admin">
	<meta name="author" content="jinxi">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>今昔--后台</title>

	<link rel="stylesheet" type="text/css" href="{$baseurl}css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="{$baseurl}css/admin.css">
	<link rel="shortcut icon" href="{$baseurl}img/icon/icon.png">
</head>
<body>
	<div class="container" id="main">
		<div class="row">
			<div class="col-md-3" id="left_block">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading" style="text-align:center">今昔-管理菜单<br/>
						{if $admin.auth_level > 1}<p style="color:green">({$admin.school_name})</p>{/if}
						
					</div>
					<div class="panel-heading" style="text-align:center">您以<span style="color:red">{$admin.admin_name}</span>的身份登录<br/>
						{if $admin.auth_level == 1}超级管理员{else}普通管理员{/if}<br/>
						<a href="javascript:void(0)" id="logout">注销</a>
					</div>
					<!-- Table -->
					<table class="table" id="operation">

						<tr>
							<td><a id="get_info_btn" class="active" linkedtab="info" href="javascript:void(0)">统计信息</a></td>					
						</tr>
						{if $admin.auth_level == 1}
						<tr>
							<td><a id="appoint_admin" linkedtab="appointment" href="javascript:void(0)">任命管理员</a></td>
						</tr>
						{/if}
						<tr>
							<td><a id="get_report_btn" linkedtab="report" href="javascript:void(0)">举报信息</a></td>					
						</tr>
						<tr>
							<td><a id="delete_post_btn" linkedtab="deletepost" href="javascript:void(0)">删除帖子</a></td>					
						</tr>
						<tr>
							<td><a id="delete_reply_btn" linkedtab="deletereply" href="javascript:void(0)">删除回复</a></td>
						</tr>
						<tr>
							<td><a id="user_advice_btn" linkedtab="useradvice" href="javascript:void(0)">用户建议</a></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-1"  id="center_block">
				<div id="info" class="admin_panel">
					<h3>统计信息</h3>
					<hr/>
					<div class="panel panel-default">
						<div class="panel-heading">用户相关</div>
						<div class="panel-body">
							<p>注册用户总数： <span>{$user_info.total}</span></p>
							<p>有效用户总数： <span>{$user_info.verified_total}</span></p>
							<p>今日登陆用户数量： <span>{$user_info.today_total}</span></p>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">帖子相关</div>
						<div class="panel-body">
							<p>转让贴总数： <span>{$post_info[0].total}</span></p>
							<p>开放的转让贴总数： <span>{$post_info[0].active_total}</span></p>
							<p>求购贴总数： <span>{$post_info[1].total}</span></p>
							<p>开放的求购贴总数： <span>{$post_info[1].active_total}</span></p>
						</div>
					</div>
				</div>
				
				<div id="appointment" class="admin_panel">
					<h3>任命管理员</h3>
					<hr/>
					<div class="panel panel-default">
						<div class="form-group">
							<input id="admin_name" type="text" placeholder="管理员名称" class="form-control"/>
						</div>
						<div class="form-group">
							<input id="password" type="password" placeholder="管理员密码" class="form-control"/>
						</div>
						<div class="form-group">
							<select id="auth_level" class="form-control">
								<option value=2>普通管理员</option>
								<option value=1>超级管理员</option>
							</select>
						</div>

						<div class="form-group">
							<input id="school_id" type="text" placeholder="若为普通管理员，在此输入学校id" class="form-control"/>
						</div>
						<div style="text-align:center">
							<button class="btn btn-primary" id="appoint_btn">任命</button>
						</div>
					</div>
				</div>
				
				<div id="report" class="admin_panel">
					<h3>举报信息</h3>
					<hr/>
					<div class="panel panel-default">
						<table class="table" id="report_table">
							<tr>
								<th>举报地</th>
								<th>举报原因</th>
								<th>举报的其他原因</th>
								<th>处理</th>
							</tr>
						</table>

					</div>
				</div>

				<div id="deletepost" class="admin_panel">
					<h3>删除帖子</h3>
					<hr/>
					<div class="panel panel-default">
						<div class="form-group">
							<input id="delete_post_url" type="text" placeholder="删除帖子的链接" class="form-control"/>
						</div>
						<div class="form-group">
							<input id="delete_reason" type="text" placeholder="删除帖子的原因（请简要说明）" class="form-control"/>
						</div>
						<div style="text-align:center">
							<button class="btn btn-primary" id="delete_post">删除</button>
						</div>
					</div>
				</div>

				<div id="deletereply" class="admin_panel">
					<h3>删除帖子</h3>
					<hr/>
					<div class="panel panel-default">
						<div class="form-group">
							<input id="delete_reply_url" type="text" placeholder="回复所在帖子的链接" class="form-control"/>
						</div>
						<div class="form-group">
							<input id="delete_floor" type="text" placeholder="回复楼层" class="form-control"/>
						</div>
						<div class="form-group">
							<input id="delete_reply_reason" type="text" placeholder="删除回复的原因（请简要说明）" class="form-control"/>
						</div>
						<div style="text-align:center">
							<button class="btn btn-primary" id="delete_reply">删除</button>
						</div>
					</div>
				</div>

				<div id="useradvice" class="admin_panel">
					<h3>用户建议</h3>
					<hr/>
					<div class="panel panel-default">
						<table class="table" id="advice_table">
							<tr>
								<th>建议列表</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="{$baseurl}js/jquery.js"></script>
<script src="{$baseurl}js/bootstrap.min.js"></script>
<script src="{$baseurl}js/admin.js"></script>

</html>