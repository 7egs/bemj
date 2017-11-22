<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>总库无窗口</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>
<body>
 <div class="main" style = "height:450px;">
   <div class="top">
     <span>收款</span> 
     <p class="erd"><a href="/bmej/index.php?s=/Home/Super/index">×</a></p>
   </div>
    <p style="color:black;font-size:20px;" >您好，该商品未记录，请输入商品名称，进价和售价，若需修改详细信息请到商品管理。</p>
   <form action="/bmej/index.php?s=/Home/Super/addgoods1/gid/<?php echo ($gid); ?>" method="post">
     商 品: <input type="text" name="goodsname" /><br>
     进 价: <input type="text" name='goodsbid' /><br>
     售 价: <input type="text"  name='goodssale'/>
     <input type="submit" value="确 定"/>
   </form>
 </div>
</body>
</html>