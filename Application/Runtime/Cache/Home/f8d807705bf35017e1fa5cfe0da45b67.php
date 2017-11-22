<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
*{
margin:0;
padding:0;
}
@page{
margin:0;
}
</style>
<script>
	window.print();
	window.setTimeout("window.location='/bmej/index.php?s=/Home/Super/index'",500); 
</script>
</head>
<body style = "text-align:center;width:230px;font-size:10px;" classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" height="0" id="WebBrowser3" width="0" VIEWASTEXT>
<p><?php echo ($data["classify"]); ?></p>
<p>订单号：<?php echo ($data["orderid"]); ?></p>
<p><?php echo (date("Y-m-d H:i:s",$data["time"])); ?></p>
<p>收银员：<?php echo ($data["homename"]); ?></p>
<p>=====================================</p>
<p style = "text-align:left">&nbsp&nbsp名称&nbsp&nbsp&nbsp&nbsp单价&nbsp&nbsp数量&nbsp&nbsp小计</p>
<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><p style = "text-align:left"><span style = "display:inline-block;width:100px;text-align:center;"><?php echo ($vol["gname"]); ?></span>&nbsp&nbsp<?php echo ($vol["gsale"]); ?>&nbsp&nbsp<?php echo ($vol["num"]); ?>&nbsp&nbsp<?php echo ($vol["total"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
<p>=====================================</p>
<p>商品总数：<?php echo ($data["totalnum"]); ?></p>
<p>XX支付：<?php echo ($data["total"]); ?>元</p>
<p>=====================================</p>
<p>尊贵的客户谢谢惠顾</p>
<p>=====================================</p>
<img src = "/bmej/Public/home//img/1.png"/>
<p>扫一扫有惊喜</p>
<p>=====================================</p>
</body>
</html>