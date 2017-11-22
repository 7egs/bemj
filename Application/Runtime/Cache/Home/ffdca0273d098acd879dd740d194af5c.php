<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>订单管理</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/commodity.css">
</head>
<style type="text/css">
::-webkit-scrollbar  
{  
    width: 10px;  
    height: 10px;  
    background-color: #ffffff;  
}  
  
/*瀹氫箟婊氬姩鏉¤建閬�鍐呴槾褰�鍦嗚*/  
::-webkit-scrollbar-track  
{  
    -webkit-box-shadow: inset 0 0 6px #ffffff;  
    background-color: #ffffff;  
}  
  
/*瀹氫箟婊戝潡 鍐呴槾褰�鍦嗚*/  
::-webkit-scrollbar-thumb  
{  
    -webkit-box-shadow: inset 0 0 6px #ffffff;  
    background-color: #8cd121;  
} 
</style>
<body>
 <div class="main" style="overflow-x: hidden;">
    <table id="box" width="100%" height="80" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th width="62" height="31" align="center" >ID</th>
        <th width="297" align="center" >订单号</th>
        <th width="121" align="center">金额</th>
        <th width="92" align="center">支付方式</th>
        <th width="101" align="center">是否会员</th>
        <th width="249" align="center">时间</th> 
           
      </tr>
      <?php if($id == 1): if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td align="center" valign="middle" style="color:black"><?php echo ($key+1); ?></td>
        <td align="center" valign="middle" style="color:black" ><a href="/bmej/index.php?s=/Home/Super/orderdetail/id/<?php echo ($vol["orderid"]); ?>" ><?php echo ($vol["orderid"]); ?></a></td>
        <td align="center" valign="middle" style="color:black"><?php echo ($vol["order_money"]); ?></td>
        <td align="center" valign="middle" style="color:black">
       <?php if($vol["oways"] == 1): ?>现金
    <?php elseif($vol["oways"] == 2): ?>
    支付宝
    <?php elseif($vol["oways"] == 3): ?>
    银联卡
    <?php elseif($vol["oways"] == 4): ?>
    微信
    <?php else: ?>
    会员卡<?php endif; ?>
        </td>
        <td align="center" valign="middle" style="color:black">
        <?php if($vol["member"] == 1): ?>会员<?php else: ?>游客<?php endif; ?>
        </td>
        <td align="center" valign="middle" style="color:black"><?php echo (date("Y-m-d H:i:s",$vol["date"])); ?></td>
       
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr >
        <td align="center" valign="middle" style="color:black"><?php echo ($key+1); ?></td>
        <td align="center" valign="middle" style="color:black" ><a href="/bmej/index.php?s=/Home/Super/orderdetail/id/<?php echo ($vol["orderid"]); ?>"><?php echo ($vol["orderid"]); ?></a></td>
        <td align="center" valign="middle" style="color:black"><?php echo ($vol["order_money"]); ?></td>
        <td align="center" valign="middle" style="color:black">
       <?php if($vol["oways"] == 1): ?>现金
    <?php elseif($vol["oways"] == 2): ?>
    支付宝
    <?php elseif($vol["oways"] == 3): ?>
    银联卡
    <?php elseif($vol["oways"] == 4): ?>
    微信
    <?php else: ?>
    会员卡<?php endif; ?>
        </td>
        <td align="center" valign="middle" style="color:black">
        <?php if($vol["member"] == 1): ?>会员<?php else: ?>游客<?php endif; ?>
        </td>
        <td align="center" valign="middle" style="color:black"><?php echo (date("Y-m-d H:i:s",$vol["date"])); ?></td>
       
      </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
      
    </table>
    </div>
  <div class="footer">
  <div style ="width:400px;margin: 0 auto;">
  <?php echo ($page); ?>
   </div>  
     <div class="cle"></div>
     <form action="<?php echo U('ordermanage');?>" method="post">
     <p>开始时间：
       <input type="text" name="start_time" id='test1' value="" placeholder="点击选择时间" />
       <input type="text"  name="end_time" id='test' value="" placeholder="点击选择时间" />
       <input type="submit" value="查询"> 
     </p>
     </form>
     <!--现金支付等框-->
     <div class="details">
      <form action="" method="post">
         <ul>
         <?php if($id == 1): ?><li>现金:<input id='cash' type='text' value="<?php echo ($list3["total1"]); ?>"/></li>
           <li>支付宝:<input id='Alipay' type='text' value="<?php echo ($list3["total2"]); ?>"/></li>
           <li>银 联 卡 :<input id='UnionpayCard' type='text' value="<?php echo ($list3["total3"]); ?>"/></li>
           <li>微 信:<input id='WeChat' type='text' value="<?php echo ($list3["total4"]); ?>"/></li>
           <li>会员卡:<input id='Membershipcard' type='text' value="<?php echo ($list3["total5"]); ?>"/></li>
           <li>订单数量:<input id='ordernum' type='text' value="<?php echo ($list3["order_totalnum"]); ?>"/></li> 
           <li>总进价:<input id='Grossprofit' type='text' value="<?php echo ($list3["totalgbid"]); ?>"/></li>
           <li>总售价:<input id='Grossprofit' type='text' value="<?php echo ($list3["totalsale"]); ?>"/></li>
           <li>总利润:<input id='Grossprofit' type='text' value="<?php echo ($list3["profits"]); ?>"/></li> 
         <?php else: ?>
         <li>现金:<input id='cash' type='text' value="<?php echo ($list1["total1"]); ?>"/></li>
           <li>支付宝:<input id='Alipay' type='text' value="<?php echo ($list1["total2"]); ?>"/></li>
           <li>银 联 卡 :<input id='UnionpayCard' type='text' value="<?php echo ($list1["total3"]); ?>"/></li>
           <li>微 信:<input id='WeChat' type='text' value="<?php echo ($list1["total4"]); ?>"/></li>
           <li>会员卡:<input id='Membershipcard' type='text' value="<?php echo ($list1["total5"]); ?>"/></li>
           <li>订单数量:<input id='ordernum' type='text' value="<?php echo ($list1["order_totalnum"]); ?>"/></li> 
           <li>总进价:<input id='Grossprofit' type='text' value="<?php echo ($list1["totalgbid"]); ?>"/></li>
           <li>总售价:<input id='Grossprofit' type='text' value="<?php echo ($list1["totalsale"]); ?>"/></li>
           <li>总利润:<input id='Grossprofit' type='text' value="<?php echo ($list1["profits"]); ?>"/></li><?php endif; ?>
         </ul>      
       </form>  
     </div>
  </div>
   
     
<script src="/bmej/Public/home//js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/bmej/Public/home//js/layDate-v5.0.5/laydate/laydate.js"></script> 
</body>
</html>
<script>



lay('#version').html('-v'+ laydate.v);

//执行一个laydate实例
laydate.render({
elem: '#test1' //指定元素
});

lay('#version').html('-v'+ laydate.v);

//执行一个laydate实例
laydate.render({
elem: '#test' //指定元素
});
</script>