<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="login for jinxi_admin">
    <meta name="author" content="jinxi">
    <title>今昔后台登陆</title>
    <link rel="shortcut icon" href="{$baseurl}img/icon/icon.png">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="{$baseurl}admin/dologin" method="post">
        <h2 class="form-signin-heading">今昔-后台权限认证</h2>
        <input type="text" class="form-control" placeholder="管理员账号" name="admin_name" required autofocus>
        <input type="password" class="form-control" placeholder="管理员密码" name="password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
      </form>

    </div>
  </body>
</html>
