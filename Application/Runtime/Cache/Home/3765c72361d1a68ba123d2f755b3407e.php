<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>总库有窗口</title>
</head>
<style>
table{
	text-align:center;
}
</style>
<body>

       <div class=""> 
         <a style = "cursor:pointer;color:blue;" onclick ="window.history.back();">返回商品管理</a>
            <table width='100%' border="1" cellspacing="0" cellpadding="0" >
              <tr>
                <th >商品条码</th>
                <th >商品名称</th>
                <th >商品进价</th>
                <th >商品售价</th>
                <th >商品个数</th>
              </tr>
              <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
              	<td ><?php echo ($vol["gid"]); ?></td>
                <td ><?php echo ($vol["gname"]); ?></td>
                <td ><?php echo ($vol["gbid"]); ?></td>
                <td ><?php echo ($vol["gsale"]); ?></td>
                <td ><?php echo ($vol["num"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
           </table>
       </div>
     <div>
	     <span>总计:<?php echo ($list["order_money"]); ?></span>&nbsp;&nbsp;&nbsp;
	     <span>操作人员:<?php echo ($list["username"]); ?></span>&nbsp;&nbsp;&nbsp;
	     <span>订单时间:<?php echo (date('Y-m-d H:i:s',$list["date"])); ?></span>
     </div>
</body>
<script>



</script>
</html>