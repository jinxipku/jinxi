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
			<div class="col-md-2" id="left_block">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">今昔-管理菜单</div>
					<!-- Table -->
					<table class="table" id="operation">
						<tr>
							<td><a id="get_info_btn" class="active" linkedtab="info" href="javascript:void(0)">统计信息</a></td>					
						</tr>
						<tr>
							<td><a id="get_report_btn" linkedtab="report" href="javascript:void(0)">举报信息</a></td>					
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-9 col-md-offset-1"  id="center_block">
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
				<div id="report" class="admin_panel">
					<h3>举报信息</h3>
					<hr/>
					<div class="panel panel-default">
						<table class="table" id="report_table">
							<tr>
								<th>举报地</th>
								<th>举报楼层</th>
								<th>楼层内容</th>
								<th>举报原因</th>
								<th>举报的其他原因</th>
								<th>处理</th>
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