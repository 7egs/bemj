<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>超市管理</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/super.css">
<script src="/bmej/Public/home//js/super.js"></script>
<script src="/bmej/Public/home//js/jquery-1.8.3.min.js"></script>
</head>
<style>
.bordermessage{
  border:2px solid green;
  padding:2px;
  box-sizing:border-box;
}
</style>
<script type="text/javascript">
 
 
 function delgoods(){ 
	 if(!confirm("是否删除已选商品，请再次确认")){ 
	 window.event.returnValue = false; } } 
 function delallgoods(){ 
	 if(!confirm("是否删除所有已选商品，请再次确认")){ 
	 window.event.returnValue = false; } } 

</script>
<body style = "height:600px;">
  <!--名称内容栏-->
    <div class="main">
      <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0" id='table1'>      
          <tr>
            <th scope="col" align="center" valign="middle">商品条码</th>
            <th align="center" valign="middle">商品名称</th>
            <th align="center" valign="middle">售价</th>
            <th align="center" valign="middle">折扣</th>
            <th align="center" valign="middle">数量</th>
            <th align="center" valign="middle">小计</th>
            <th align="center" valign="middle">操作</th>
          </tr>
          <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr id="formgoods">
            <td align="center" valign="middle"><?php echo ($vol['gid']); ?></td>
            <td align="center" valign="middle"><?php echo ($vol['gname']); ?></td>
            <td align="center" valign="middle"><?php echo ($vol['gsale']); ?></td>
            <td align="center" valign="middle">
            <?php
 if($_SESSION['memberdiscount']){ echo $_SESSION['memberdiscount']; }else{ echo '1'; } ?>
            </td>
            <td align="center" valign="middle" id='num'><?php echo ($vol['num']); ?></td>
            <td align="center" valign="middle">
            <?php
 if($_SESSION['memberdiscount']){ echo $_SESSION['memberdiscount']*$vol['total']; }else{ echo $vol['total']; } ?>
            </td>
            <td><a href="/bmej/index.php?s=/Home/Super/updategoodsshow/gid/<?php echo ($vol["gid"]); ?>/num/<?php echo ($vol["num"]); ?>">修改数量</a>
            <a href="/bmej/index.php?s=/Home/Super/delgoods/gid/<?php echo ($vol["gid"]); ?>" style="float:right" onclick="return delgoods()">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table> 
       </div>
    <!--尾部-->  
    <div class="footer">
     <div class="sales">
       <form action='<?php echo U("Super/checkgoods");?>' method='post' >         
         <label style = "color:#333333;margin-right:23px;" >条 码:</label>      
         <input type="text" class="form-control" name="goodid" id="btn">
       </form>  
       <div class="cust">
       <div class="remove">
       <form action='<?php echo U("Super/index");?>' method='post'>
         <input type="submit" value="查会员" />
         <input type="text" name="memberphone" style = "border:1px solid #333333;box-sizing:border-box;width:240px;">
        </form>
       </div>
       <ul>
          <li><h4>等级</h4><h5><?php echo ($memberdata['membertype']); ?></h5></li>
          <li><h4>积分</h4><h5><?php echo ($memberdata['memberpoint']); ?></h5></li>
          <li><h4>余额</h4><h5><?php echo ($memberdata['membermoney']); ?></h5></li>
       </ul>
     </div>
     </div>
   <div class="psyment">
    <form action="" method="post">
       <div class="payleft">    
         <p><a href='<?php echo U("delsession");?>' onclick="return delallgoods()">清除商品</a></p>      
         <p><a href='' id="goodsmanage">商品管理</a></p>
         <p><a href='<?php echo U("ordermanage");?>'>订单管理</a></p>
      </div>       
      <div class="payright">
	  <?php if($_SESSION['goods']){ ?>
        <input type="button" value="挂单" id='gua' style = "cursor:pointer;">
	  <?php }else{ ?>
        <input type="button" value="挂单"  disabled="disabled" style ="background:#8c8c8c;">
	  <?php } ?>      	  
        <input type="button" value="查看挂单F1" id='showgua'>
        <input type="button" value="退货F2" id="tui">
	  <?php if($_SESSION['goods']){ ?>		
        <input type="button" value="付款F3" id='fuk' style = "cursor:pointer;">
	  <?php }else{ ?>
        <input type="button" value="付款F3" disabled="disabled" style ="background:#8c8c8c;">	  
	  <?php } ?>   	  
       </div>
     </form>    
    </div>
  </div>
  <!--快捷键弹出框F1-->
    <div id="content" style="overflow-x:scroll;">
       <div class="top">
          <span>挂单</span>
         <p class="cuo">×</p>  <!--写一个错误的框 放在content的右上角-->     
       </div> 
       <table width="540" border="0" style = "overflow-x:hidden;">
          <tr>
            <th width="228" align="center" valign="middle" scope="col">叫号</th>
            <th width="106" align="center" valign="middle" scope="col">金额</th>
            <th width="221" align="center" valign="middle" scope="col">时间</th>
            <th width="104" align="center" valign="middle" scope="col">操作</th>
          </tr>
          <?php if(is_array($formlist)): $i = 0; $__LIST__ = $formlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$formlist): $mod = ($i % 2 );++$i;?><tr>
            <td align="center" valign="middle"><?php echo ($key +1); ?></td>
            <td align="center" valign="middle"><?php echo ($formlist['formlisttotal']); ?></td>
            <td align="center" valign="middle"><?php echo (date("Y-m-d H:i",$formlist['formlisttime'])); ?></td>
            <td align="center" valign="middle"><a href="/bmej/index.php?s=/Home/Super/active/id/<?php echo ($key); ?>">激活并清除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>	
  <!--快捷键F2-->
     <div id="conter" >
       <div class="tow">
         <span>退货</span> 
         <p class="err">×</p>
         <div class="odd">
           <span>销售单号：</span>
           <input type="text" name="orderid"  id="orderid"/>
           <input type="button" value="确 定"  id="button">
         </div>
         
            <table width="570" height="40" border="0" id='replace' style = "overflow-x:hidden;">
              <tr>
                <th width="171" scope="col">条码</th>
                <th width="42" scope="col">数量</th>
                <th width="100" scope="col">名称</th>
                <th width="116" scope="col">时间</th>
                <th width="53" scope="col">金额</th>
                <th width="75" scope="col">操作</th>
              </tr>
           </table>
          
       </div>
     </div>
   <!--快捷键F3-->
     <div id="contei" style = "left:1%;">
       <div class="three">
         <span>收款</span> 
         <p class="erd">×</p>
         <div class="rmain">
           <div class="left">
              <div class="ltop">
                <table width="240" height="137" border="0">
                      <tr>
                        <td width="20"></td>
                        <td width="86" align="left">商品种类:</td>
                        <td width="120"><?php echo ($good['type']); ?></td>
                      </tr>
                      <tr>
                        <td width="20"></td>
                        <td align="left">商品总数:</td>
                        <td id='totalnum'><?php echo ($good['num']); ?></td>
                      </tr>
                      <tr>
                        <td width="20"></td>
                        <td align="left">商品总价:</td>
                        <td><?php echo ($good['total']); ?></td>
                      </tr>
                      <tr>
                        <td width="20"></td>
                        <td align="left">可获积分:</td>
                        <td>0</td>
                      </tr>
                    </table>
              </div>
              <ul>
                <h1>总 付:<span id="total"><?php echo ($good['total']); ?></span></h1>
                <h1>找 零:<span id='give'>0</span></h1>
              </ul>
              <p>
                <span>会员姓名: <span id='membername'><?php echo ($good['membername']); ?></span></span><br>
                <span>会员余额: <?php echo ($good['membermoney']); ?></span>
              </p>
           </div>
           <div class="right">       
             <div class="option">
               <ul class="nav">
                 <li class="on"><a>普通收银</a></li>
                 <li><a>扫码收银</a></li>
               </ul> 
               <ul class="cont">
                <li class="active">
                 <p>
                   <a id='xj'><img src="/bmej/Public/home//img/xj.png"  /></a>
                   <a id='zfb'><img src="/bmej/Public/home//img/zfb.png"  /></a>
                   <a id='ylk'><img src="/bmej/Public/home//img/ylk.png"  /></a>
                   <a id='wx'><img src="/bmej/Public/home//img/wx.png"   /></a>
                   <a id='hyk'><img src="/bmej/Public/home//img/hyk.png" /></a>
                   <span>现金支付</span>
                   <span style ="margin-left:10px;">支付宝</span>
                   <span>银联卡</span>
                   <span style ="margin-left:18px;">微信</span>
                   <span>会员支付</span>
                 </p>
                     <a>实       付:</a><input type="text" id="screenName" name="screenName" class="screen"></li>
                 <li><a>条码支付:</a><input type="text" />
                 <h4>该功能正在开发中</h4></li>
               </ul>
             </div>
             <div class="yes">
               <form action="" method="post" id="payorder"> 
               <ul> 
                 <li>
                 <input type="button" value="抹 零" id='intvalue'/><br>
                 <input type="button" value="免 单" id='payfree'/>
                 </li>
                 <li><input type="submit" id="money"  value="确认收款"/></li>
                 <li><input type="checkbox" id='yesbill' name="da" checked value="1"><a>打印小票</a><br>
                     <input type="checkbox" id="nobill" name="da" value="2"><a>无需打印</a></li>
               </ul> 
               </form>
             </div> 
           </div>
         </div>
       </div>
       <div class="number">
        <form action="" method="post">
         <ul>
           <li><input type="button" id="7" onclick="jsq(this.id)" value="7" class="buttons"></li>
           <li><input type="button" id="8" onclick="jsq(this.id)" value="8" class="buttons"></li>
           <li><input type="button" id="9" onclick="jsq(this.id)" value="9" class="buttons"></li>
           <li><input type="button" id="0" onclick="jsq(this.id)" value="0" class="buttons"></li>
           <li><input type="button" id="4" onclick="jsq(this.id)" value="4" class="buttons"></li>
           <li><input type="button" id="5" onclick="jsq(this.id)" value="5" class="buttons"></li>
           <li><input type="button" id="6" onclick="jsq(this.id)" value="6" class="buttons"></li>
           <li><input type="button" id="*" onclick="jsq(this.id)" value="." class="buttons"></li>
           <li><input type="button" id="1" onclick="jsq(this.id)" value="1" class="buttons"></li>
           <li><input type="button" id="2" onclick="jsq(this.id)" value="2" class="buttons"></li>
           <li><input type="button" id="3" onclick="jsq(this.id)" value="3" class="buttons"></li>
           <li><input type="button" id="Back" onclick="tuiGe()" value="←" class="buttons"></li> 
         </ul>
        </form>
       </div>
     </div>
</body>
</html>
<script>
//挂单
$('#gua').click(function(){
    var a=document.getElementById('formgoods').getElementsByTagName("td")[0].innerHTML;
    if(a==""){
    }else{
      var msg = "是否将当前信息挂单？\n\n请确认！"; 
      if (confirm(msg)==true){ 
        window.open('/bmej/index.php?s=/Home/Super/formlist','_self');
       } 
    } 
});
//快捷键 F1 查看挂单
$('#showgua').click(function(){
  $('#conter').hide();
  $('#contei').hide();
  $('#content').show();
});
$(document).keydown(function(e){ 
  //alert(e.which)  //返回所按键的键盘代码   F10 121 
  if(e.which == 112){  //判断按下的键是否是F10  如果是F10  就让box框显示
    e.preventDefault();
    $('#content').show();
  }
  if(e.which == 116){  //判断是否是′F5键 116   如果是F5 禁止刷新
    return false;  
    } 
});
//点击× 让box框隐藏
$('.cuo').click(function(){
  $('#content').hide();
  });
//快捷键 F2
$('#tui').click(function(){
    $('#conter').show();
    $('#content').hide();
    $('#contei').hide();
    }); 
$(document).keydown(function(e){
  if(e.which == 113){
    e.preventDefault();  //阻止该事件的默认操作
     $('#conter').show();
    }
    if(e.which == 116){
      return false;
      }
  });
$('.err').click(function(){
  $('#conter').hide();
  });
//快捷键 F3
if('<?php echo ($_SESSION["goods"]); ?>'){
$('#fuk').click(function(){
  $('#contei').show();
  $('#content').hide();
  $('#conter').hide();
    });
$(document).keydown(function(e){
  if(e.which == 114){
    e.preventDefault();
     $('#contei').show();
    }
    if(e.which == 116){
     return false;
      }
  });
$('.erd').click(function(){
  $('#contei').hide();
  });
  }
//收银选项卡
$('.nav li').click(function(){
  $('.nav li').removeClass('on');
  $('.cont li').removeClass('active');
  $(this).addClass('on');
  var i= $(this).index();  //获取标签的位置数
  $('.cont li').eq(i).addClass('active');
  });
//聚焦窗口
document.getElementById("btn").focus();
   $("#button").click(function(){
       var url="<?php echo U('Super/returngoodsshow');?>";
       var orderid=$('#orderid').val(); 
       $.post(url,{orderid:orderid},function(data){
          $('#replace').html(data);
       }); 
     });
   //支付订单
   $('#screenName').change(function(){
	   var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);});
     $('#intvalue').click(function(){
       b=Math.floor($('#total').html());
       $('#total').html(b);
	   var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);	   	   
     });
     $('#payfree').click(function(){
       $('#total').html(0);
	   var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);	   
     });
     function getmessage(){
       total=$('#total').html();
       totalnum=$('#totalnum').html();
       membername=$('#membername').html();
       return total;
       return totalnum;
       return membername;    
     }
   $('#xj').click(function(){    
     $('#xj img').addClass('bordermessage');
       $('#zfb img').removeClass('bordermessage');
       $('#ylk img').removeClass('bordermessage');
       $('#wx img').removeClass('bordermessage');
       $('#hyk img').removeClass('bordermessage');
       getmessage();
   $("#payorder").attr("action","/bmej/index.php?s=/Home/Super/payorder/oways/1/total/"+total+"/totalnum/"+totalnum+"/membername/"+membername+"");
   });
   $('#zfb').click(function(){
     $('#zfb img').addClass('bordermessage');
       $('#xj img').removeClass('bordermessage');
       $('#ylk img').removeClass('bordermessage');
       $('#wx img').removeClass('bordermessage');
       $('#hyk img').removeClass('bordermessage');
       getmessage();
       $("#payorder").attr("action","/bmej/index.php?s=/Home/Super/payorder/oways/2/total/"+total+"/totalnum/"+totalnum+"/membername/"+membername+"");
   });
   $('#ylk').click(function(){
     $('#ylk img').addClass('bordermessage');
       $('#zfb img').removeClass('bordermessage');
       $('#wx img').removeClass('bordermessage');
       $('#xj img').removeClass('bordermessage');
       $('#hyk img').removeClass('bordermessage');
       getmessage();
   $("#payorder").attr("action","/bmej/index.php?s=/Home/Super/payorder/oways/3/total/"+total+"/totalnum/"+totalnum+"/membername/"+membername+"");
   });
   $('#wx').click(function(){
     $('#wx img').addClass('bordermessage');
       $('#zfb img').removeClass('bordermessage');
       $('#ylk img').removeClass('bordermessage');
       $('#xj img').removeClass('bordermessage');
       $('#hyk img').removeClass('bordermessage');
       getmessage();
       $("#payorder").attr("action","/bmej/index.php?s=/Home/Super/payorder/oways/4/total/"+total+"/totalnum/"+totalnum+"/membername/"+membername+"");
   });
   $('#hyk').click(function(){
     $('#hyk img').addClass('bordermessage');
       $('#zfb img').removeClass('bordermessage');
       $('#ylk img').removeClass('bordermessage');
       $('#wx img').removeClass('bordermessage');
       $('#xj img').removeClass('bordermessage');
       getmessage();
       $("#payorder").attr("action","/bmej/index.php?s=/Home/Super/payorder/oways/5/total/"+total+"/totalnum/"+totalnum+"/membername/"+membername+"");
   });
   $('#yesbill').click(function(){
     $('#nobill').prop("checked",false);
   });
   $('#nobill').click(function(){
     $('#yesbill').prop("checked",false);
   });
   $('#money').click(function(){
     if(document.getElementsByClassName('bordermessage')[0]){    
     }else{
       alert("请选择支付方式");
       return false;
     }
   });
   $('#goodsmanage').click(function(){
     parent.location.href='<?php echo U("GoodsManage/index");?>';
   });
   
        var num = 0;  // 定义第一个输入的数据
        function jsq(num) {
            //获取当前输入
            if(num=="%"){
                document.getElementById('screenName').value=Math.round(document.getElementById('screenName').value)/100;
		  var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);
            }else{
                document.getElementById('screenName').value += document.getElementById(num).value;
		  var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);				
            }
        }
        function eva() {
            //计算输入结果
            document.getElementById("screenName").value = eval(document.getElementById("screenName").value);
		  var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);	
        }
        function clearNum() {
            //清0
            document.getElementById("screenName").value = null;
            document.getElementById("screenName").focus();
		  var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);		
        }
        function tuiGe() {
            //退格
            var arr = document.getElementById("screenName");
            arr.value = arr.value.substring(0, arr.value.length - 1);
		  var t=$('#screenName').val();
		  var m=$('#total').html();
	      arr = t.split(".");
	      amm = m.split(".");
		  if(arr[arr.length - 1]=='1'){
	      if(amm[arr.length - 1]=='1'){a = parseInt(t-m,10);}else{a = parseInt(t-m,10)+'.1';}	  
		  }else{a=t-m;}
	      $('#give').html(a);			
        }

</script>