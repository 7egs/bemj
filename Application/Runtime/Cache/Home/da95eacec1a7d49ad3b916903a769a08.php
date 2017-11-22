<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>退货</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>
<body>
 <div class="main">
   <div class="top">
请输入退货数量   
   </div>
   <form action="/bmej/index.php?s=/Home/Super/goodsreturnresult/gid/<?php echo ($data['gid']); ?>" method="post">
           <input type="text" name='num'/><br>
     <input type="submit" value="确认"/>
     <a href="<?php echo U('index');?>">返回</a>
   </form>
 </div>
</body>
</html>