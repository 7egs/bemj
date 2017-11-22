<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品盘点</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/commodity-inventory.css">
<script src="/bmej/Public/home//calendar/tcal.js"></script>
</head>
<style>
#importgoods{
  width:50%; height:200px; border:1px solid #999; background:#ffffff; position:fixed; top:30%; left:30%; display:none;
}
.close{
  cursor:pointer;
}
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
<!--中间表格-->
  <div class="main" style="height: 450px;overflow-x: hidden;font-size: 12px;color: #333333;">
    <table width="100%" height="80" border="0" id="table1">
  <tr>
    <th align="center" valign="middle" scope="col">商品条码</th>
    <th align="center" valign="middle" scope="col">商品名称</th>
    <th align="center" valign="middle" scope="col">规格</th>
    <th align="center" valign="middle" scope="col">现在进价</th>
    <th align="center" valign="middle" scope="col">现在售价</th>
    <th align="center" valign="middle" scope="col">进货量</th>
    <th align="center" valign="middle" scope="col">销售量</th>
    <th align="center" valign="middle" scope="col">现在库存</th>    
    <th align="center" valign="middle" scope="col">这段时间利润</th>
  </tr>
  <?php if(is_array($catch)): $i = 0; $__LIST__ = $catch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
    <td align="center" valign="middle"><?php echo ($vol["gid"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["gname"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["guige"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["gbid"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["gsale"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["gnum"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["snum"]); ?></td>
    <td align="center" valign="middle"><?php echo ($vol["gnum_new"]); ?></td>    
    <td align="center" valign="middle"><?php echo ($vol["lirun"]); ?></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div>
<!--尾部-->
<div class="footer" style="background: #CCC;height: 150px;">
  <span style='color:black;padding-top: 10px;display: inline-block;'>收到金额：<?php echo ($shoujia); ?></span>
  <span style='color:black;padding-top: 10px;display: inline-block;'>卖出商品的总进价：<?php echo ($jinjia); ?></span>
  <span style='color:black;padding-top: 10px;display: inline-block;'>获得利润：<?php echo ($zonglirun); ?></span>
<form action="" method="post" style='color:black'>
开始时间：
<input type="text"  value="" placeholder="点击选择时间" id="test" style="width:120px;" name="start_time" />
结束时间：
<input type="text"  value="" placeholder="点击选择时间"  id="test1" style="width:120px;" name="end_time"/>
<input type="submit" value="查询" />
     </form>  
    <span style="margin-left: 0px;">商品编码：</span><input type="text" id='searchval'/>
    <input type="submit" value="查询" style="margin-top: 0px;" id="goodssearch" /></br>
</div>
</body>
<script type="text/javascript" src="/bmej/Public/home//js/layDate-v5.0.5/laydate/laydate.js"></script> 
<script type="text/javascript">
  //查询商品
  window.onload=function(){
    var a=document.getElementById("table1");
    var b=document.getElementById("searchval");
    document.getElementById('goodssearch').onclick=function(){
     for(var i=1;i<a.rows.length+1;i++){
        var str1=a.rows[i].cells[0].innerHTML;
        var str2=b.value;
        if(str1==str2){
          a.rows[i].style.display='table-row';
        }
        else{
          a.rows[i].style.display='none';
        }
     }
    }
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
   }
</script>
</html>