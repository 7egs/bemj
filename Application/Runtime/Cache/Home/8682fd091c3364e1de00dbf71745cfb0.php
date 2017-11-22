<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改数量窗口</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>

<body>
 <div class="main">
   <div class="top">     
   </div>
   <form action="/bmej/index.php?s=/Home/Super/updategoods/gid/<?php echo ($data["gid"]); ?>" method="post">
        修改数量为: <input type="text" name='num' value="<?php echo ($data['num']); ?>" /><br>
     <input type="submit" value="确认修改"/>
     <a href="<?php echo U('index');?>">返回</a>
   </form>
 </div>
</body>
</html>