<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/Login.css">
<title>登陆系统</title>
</head>
<body>
  <div class="main">
     <div class="top"></div>
     <div class="center">
        <div class="cleft">
           <img src="/bmej/Public/home//img/login_log.png" />
        </div>
        <div class="cright">
          <form class="system" action="<?php echo U('Login/login');?>" method="post">
             <div class="sytop">
                <p>用户登陆</p>
             </div>
             <div class="number">
                <p>账号：<input type='text' placeholder="请输入用户名" name="username"/></p>
                <p>密码：<input type="password" placeholder="请输入密码" name="password"></p>
             </div>
             <div class="Ret">
                 <a href="<?php echo U('Login/password');?>">找回密码</a>
             </div>
             <input type="submit" value="立即登陆" class="button"/>
          </form>
        </div>
     </div>
  </div>
</body>
</html>