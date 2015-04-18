<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="jinxi">
	<meta name="author" content="fabkxd">
	<link rel="shortcut icon" href="{$baseurl}img/icon/icon.png">
	<title>{$title}</title> <!-- Bootstrap core CSS -->
	<link href="{$baseurl}css/bootstrap.css" rel="stylesheet"/>
	<link href="{$baseurl}css/font-awesome.css" rel="stylesheet"/>
	<link href="{$baseurl}css/flat-ui.css" rel="stylesheet"/>
	<link href="{$baseurl}css/school.css" rel="stylesheet"/>
	<link href="{$baseurl}css/jinxi.css" rel="stylesheet"/>
	<link href="{$baseurl}css/Jcrop.css" rel="stylesheet"/>
	<script src="{$baseurl}js/jquery.js"></script>

</head>

<body>
	<div id="header" class="row">
		<div>
			<a href="{$baseurl}">
				<img class="passive" src="{$baseurl}img/icon/header.png" alt="header.png"/>
			</a>
		</div>
		<div class="form-group">
			<input type="text" placeholder="请输入关键词搜索" class="form-control flat"/>
			<a href="#">
				<span href="#" class="fui-search input-search"></span>
			</a>
		</div>
		<div>
			<img class="passive" src="{$baseurl}img/icon/invite.png" alt="invite.png"/>
		</div>
		<div>
			{if isset($login_user)}
			<a type="button" class="btn btn-primary" href="" onclick="add_favorite('今昔网', '{$baseurl}');return false;">收藏本站</a>
			{else}
			<a type="button" class="btn btn-primary" href="{$baseurl}account/register">立即注册</a>
			{/if}
		</div>
	</div>

	<div id="navbar" class="navbar-wrapper row">
		<div class="navbar navbar-inverse">
			<div class="mycontainer">
				<div>
					<ul class="nav">
						<li {if $nav_tab == 1}class=" active"{/if}>
							<a href="{$baseurl}">首页</a>
						</li>
						<li {if $nav_tab == 2}class=" active"{/if}>
							<a href="{$baseurl}user/profile/0">个人中心</a>
						</li>
						<li {if $nav_tab == 3}class=" active"{/if}>
							<a href="{$baseurl}display/sell{if isset($area)}/{$area}{/if}{if isset($sort)}/{$sort}{/if}">商品大厅</a>
						</li>
					</ul>
					<ul class="nav pull-right">
						{if isset($login_user)}
						<li>
							<a href="{$baseurl}user/profile/{$login_user.id}">
								<img id="user_headimg_thumb" class="passive" src="{$baseurl}img/head/{$login_user.thumb}"/>
								{$login_user.nick}
							</a>
						</li>
						{/if}
						<li {if $nav_tab == 4}class=" active"{/if}>
							<a href="#">关于</a>
						</li>
						<li {if $nav_tab == 5}class=" active"{/if}>
							<a href="#">帮助</a>
						</li>
						<li {if $nav_tab == 6}class=" active"{/if}>
							<a href="{$baseurl}user/setup">设置</a>
						</li>
						{if isset($login_user)}
						<li>
							<a href="" onClick="logout();return false;">退出</a>
						</li>
						{elseif isset($is_index)}						
						<li>
							<a href="" onClick="pre_login();return false;">登录</a>
						</li>
						{elseif $nav_tab == 7}
						<li class=" active">
							<a  href="{$baseurl}account/login">登录</a>
						</li>
						{elseif $nav_tab == 8}
						<li class=" active">
							<a  href="{$baseurl}account/register">注册</a>
						</li>
						{else}
						<li>
							<a  href="{$baseurl}account/login">登录</a>
						</li>
						{/if}
					</ul>
				</div>
			</div>
		</div>
	</div>