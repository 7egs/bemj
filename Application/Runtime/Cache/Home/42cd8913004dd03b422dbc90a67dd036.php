<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改入库信息</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>
<body>
 <div class="main" style="width: 500px;">
   <div class="top" style="font-size: 20px;line-height: 30px;">
     修改入库信息      <a href="javascript:history.back(-1)" style="width: 60px;height: 30px;float: right;text-align: center;color: #ffffff;">返回</a>
   </div>
   <form action="/bmej/index.php?s=/Home/GoodsManage/ruku_save/id/<?php echo ($id); ?>" method="post" style="font-size: 15px;">
      进价: <input type="text" name='gbid' value=""/><br>
      入库量: <input type="text" name='gnum' value=""/><br>
     <input type="submit" value="确认修改" style="cursor: pointer;background: #8cd121;color: #ffffff;"/>
   </form>
 </div>
</body>
</html>