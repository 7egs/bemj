<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改数量窗口</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>
<body>
 <div class="main" style="height:500px">
   <div class="top">     
   </div>
   <form action="/bmej/index.php?s=/Home/GoodsManage/updatesupplier/id/<?php echo ($list['id']); ?>" method="post">
      供应商名字: <input type="text" name='suppliername' value="<?php echo ($list['supplier_name']); ?>"/><br>
      联系人: <input type="text" name='suppliermen' value="<?php echo ($list['supplier_men']); ?>"/><br>
      联系人电话: <input type="text" name='supplierphone' value="<?php echo ($list['supplier_phone']); ?>"/><br>
      联系人地址: <input type="text" name='supplieraddr' value="<?php echo ($list['addr']); ?>"/><br>
      是否启用: <select name='supplierstatus'>
      <option value='1'>启用</option>
      <option value='0'>禁用</option>
      </select>
     <input type="submit" value="确认修改"/>
     <a href="<?php echo U('goodsmanageshow');?>">返回</a>
   </form>
 </div>
</body>
</html>