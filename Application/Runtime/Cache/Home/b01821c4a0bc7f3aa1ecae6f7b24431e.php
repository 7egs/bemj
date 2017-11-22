<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品管理</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/management.css">
<script type="text/javascript" src="/bmej/Public/home//js/layDate-v5.0.5/laydate/laydate.js"></script> 
<script src="/bmej/Public/home//js/jquery-3.2.1.min.js"></script>
<script>
function delgoods(){ 
	 if(!confirm("是否删除商品，请再次确认")){ 
	 window.event.returnValue = false; } } 
function delsupplier(){ 
	 if(!confirm("是否删除商品，请再次确认")){ 
	 window.event.returnValue = false; } } 
function delgoodsfenlei(){ 
	 if(!confirm("是否删除商品分类，请再次确认")){ 
	 window.event.retuarnValue = false; } }
</script>
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
</head>
<body>
  <div class="main" style = "font-size:12px;height:400px;overflow-x: hidden;">
    <table width="100%" height="80" border="0" cellpadding="0" cellspacing="0" id="table1">
      <tr>
        <th width="34" height="31" align="center" valign="bottom" scope="col">ID</th>
        <th width="107" align="center" valign="bottom" scope="col">商品条码</th>
        <th width="84" align="center" valign="bottom" scope="col">商品名称</th>
        <th width="77" align="center" valign="bottom" scope="col">商品分类</th>
        <th width="49" align="center" valign="bottom" scope="col">规格</th>
        <th width="70" align="center" valign="bottom" scope="col">供货商</th>
        <th width="70" align="center" valign="bottom" scope="col">生产日期</th>
        <th width="54" align="center" valign="bottom" scope="col">单位</th>
        <th width="65" align="center" valign="bottom" scope="col">进货价</th>
        <th width="68" align="center" valign="bottom" scope="col">销售价</th>
        <th width="66" align="center" valign="bottom" scope="col">库存量</th>
        <th width="74" align="center" valign="bottom" scope="col">保质期</th>
        <th width="85" align="center" valign="bottom" scope="col">商品状态</th>
        <th width="72" align="center" valign="bottom" scope="col">操作</th>
      </tr>
      
      <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td align="center" valign="middle"><?php echo ($key+1); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["gid"]); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["gname"]); ?></td>
        <td align="center" valign="middle">
        <?php if($vol['fenlei_id'] == '0'): ?>无分类
        <?php else: ?>
              <?php echo ($vol["fenlei_name"]); endif; ?>
       
        </td>
        <td align="center" valign="middle"><?php echo ($vol["guige"]); ?></td>
        <td align="center" valign="middle">
        <?php if($vol['supplier_id'] == '0'): ?>无供应商
        <?php else: ?>
              <?php echo ($vol["supplier_name"]); endif; ?>        
        </td>
        <td align="center" valign="middle"><?php echo ($vol["production"]); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["unit"]); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["gbid"]); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["gsale"]); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["gnum"]); ?></td>
        <td align="center" valign="middle"><?php echo ($vol["quality"]); ?></td>
        <td align="center" valign="middle">
        <?php if($vol['state'] == '0'): ?>启用
        <?php else: ?>
                    禁用<?php endif; ?>
        </td>
        <td align="center" valign="middle">
        <a href="/bmej/index.php?s=/Home/GoodsManage/updategoodsshow/gid/<?php echo ($vol["gid"]); ?>" style="float:left">修改</a>
        <a href="/bmej/index.php?s=/Home/GoodsManage/delgoodsshow/gid/<?php echo ($vol["gid"]); ?>" style="float:right" onclick="return delgoods()">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    </div>
    <!--尾部-->
    <div class="footer">
     <div class="sales">	 
      <div class="sp" style = "width:700px;margin:0 auto; font-size:20px;margin-top: 10px;"> 
         <span>商品条码</span>          
         <input type="text" class="form-control" id='searchval'/>
         <input type="button" value="查询" id='goodssearch' style = "width:58px; height:32px;"/>
		 	 <div style = "width:240px;float:right;font-size:16px;line-height:35px;">
	         <?php echo ($page); ?>
	        </div>	
       </div>  
        </div>      
         <ul style = "width:100%; margin-top: 30px;"> 
           <li id="warehou" style = "width:19%;cursor:pointer;"><span>商品入库</span></li>
           <li style = "width:19%;cursor:pointer;"><a href="<?php echo U('ruku_find');?>">入库查询</a></li>
           <li id="suppli" style = "width:19%;cursor:pointer;"><span>供应商管理</span></li>
           <li style = "width:19%;cursor:pointer;"><a href="<?php echo U('commodityinventory');?>">销售查询</a></li>
           <li id="fenl" style = "width:19%;cursor:pointer;"><span>分类管理</span></li>
           <li id="clear" style = "width:19%;cursor:pointer;"><a>查询清空</a></li>
           <li id="addto" style = "width:19%;cursor:pointer;"><span>商品添加</span></li>
           <li style = "width:19%;cursor:pointer;"><a href="<?php echo U('commodityinventory');?>">商品盘点</a></li>
           <li style = "width:19%;cursor:pointer;"><a href="<?php echo U('export');?>">商品导出</a></li>
           <li id='import' style = "width:19%;cursor:pointer;"><a>商品导入</a></li>
         </ul>       
    </div>
    <!-- 商品导入-弹出框 -->
    <div id='importgoods' >
    <div  style="background:#ccc;height:40px;">
	    <p style="font-size:30px; float:left; padding-left:10px;">商品导入</p>
	    <p style="font-size:30px; float:right; padding-right:10px;" class="close">X</p>
    </div>
     <form action="<?php echo U('import');?>" enctype="multipart/form-data" method="post" style='margin:22px 0;'>
		<input type="file" name="excel" style = "margin-left:20px;"/>
		<input type="submit" value="开始导入">
     </form>
	 提示：商品导入必须使用百米一家专用导入模版,不能直接用导出后的表直接导入,请下载文件并将数据添加进模版,进行导入,否则无法导入。
	 <div style = "margin-top:5px;text-align:center;"><a href="/bmej/Public/home/excel/导入商品表.xlsx" download="导入商品表(模版).xlsx">点击下载模版</a></div>
    </div>
    <!--商品入库-弹出框-->
    <div id="amain" style = "height:560px;font-size:12px;">
     <div class="top">
       <span>商品入库</span> 
       <p class="erd">×</p>
     </div>
       <form action="<?php echo U('goodsstorehouse1');?>" method="post">
          <table width="100%" height="400" border="0">
          <tr>
            <td width="127" height="60" align="center" valign="middle">&nbsp;</td>
            <td width="81" align="left" valign="middle">商品条码：</td>
            <td width="350" align="left" valign="middle">
            <input type="text" value="" name="goodsid" id="goodsid1" style = "width:260px;"/></td>
            <td width="70" align="left" valign="middle">单进价：</td>
            <td width="396" align="left" valign="middle">
            <input type="text" value="" name='goodsbid' id='goodsbid' style = "width:260px;"/></td>
          </tr>
          <tr>
            <td height="62" align="center" valign="middle">&nbsp;</td>
            <td align="left" valign="middle" >商品名称：</td>
            <td align="left" valign="middle">
            <input type="text" value="" name="goodsname" id='goodsname' style = "width:260px;"/>
            </td>
            <td align="left" valign="middle">进货量：</td>
            <td align="left" valign="middle">
            <input type="text" value="" name='goodsnum' id='totalnum' style = "width:260px;"/>
            </td>
          </tr>
          <tr>
            <td height="56" align="center" valign="middle">&nbsp;</td>
            <td align="left" valign="middle">商品分类：</td>
            <td align="left" valign="middle">
            <select name="goodsfenlei" id='goodsfenlei' style = "width:270px;">
            <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vol["id"]); ?>'><?php echo ($vol["fenlei_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </td>
            <td align="left" valign="middle">保质期：</td>
            <td align="left" valign="middle">
            <input type="text" value="" name='goodsquality' id='goodsquality' style = "width:260px;"/></td>
          </tr>
          <tr>
            <td height="54" align="center" valign="middle">&nbsp;</td>
            <td align="left" valign="middle">规 格：</td>
            <td align="left" valign="middle">
            <input type="text" value="" name='goodsguige' id='goodsguige' style = "width:260px;"/></td>
            <td align="left" valign="middle"><span >总进价：</span></td>
            <td align="left" valign="middle">
            <input type="text" value="0" disabled  id='total' style = "width:260px;"/></td>
          </tr>
          <tr>
            <td height="60" align="center" valign="middle">&nbsp;</td>
            <td align="left" valign="middle">供货商：</td>
            <td align="left" valign="middle">
              <select name='goodssupplier' id='goodssupplier' style = "width:270px;">
              <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if($vol['status'] == '1'): ?><option value="<?php echo ($vol['id']); ?>"><?php echo ($vol['supplier_name']); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </select>
            </td>
            <td align="left" valign="middle">单售价：</td>
            <td align="left" valign="middle">
            <input type="text" value="" name='goodssale' id='goodssale' style = "width:260px;"/></td>
          </tr>
          <tr>
            <td height="60" align="center" valign="middle">&nbsp;</td>
            <td align="left" valign="middle">生产日期：</td>
            <td align="left" valign="middle">
            <input type="text" value="" name="goodsproduction" id='goodsproduction' style = "width:260px;"/></td>
            <td align="left" valign="middle">单位：</td>
            <td align="left" valign="middle">           
            <input type="text" value="" name='goodsunit' id='goodsunit' style = "width:260px;"/>
            </td>
          </tr>
          <tr>
            <td height="152" align="center" valign="middle">&nbsp;</td>
            <td align="left" valign="middle">&nbsp;</td>
            <td align="left" valign="middle" style = "text-align:center;">
               <input type="submit" value="确 定" />
            </td>
            <td align="left" valign="middle">&nbsp;</td>
            <td align="left" valign="middle" style = "text-align:center;">
               <input type="reset" value="清 空" style = "width: 160px;height: 60px;border-radius: 0px;"/></td>
          </tr>
        </table>
      </form>
    </div>
    <!--供应商管理-弹出框-->
    <div id="bmain" style = "height:460px;font-size:12px;">
     <div class="top">
       <span>供应商管理</span> 
       <p class="end">×</p>
     </div>
     <div class="naw" >
      <form action="<?php echo U('suppliershow');?>" method="post">
      
       <table width="100%" border="0">
          <tr>
            <td width="70">&nbsp;</td>
            <td width="200">&nbsp;</td>
            <td width="70">&nbsp;</td>
            <td width="200">&nbsp;</td>
          </tr>
          <tr>
            <td>供应商名称：</td>
            <td><input type="text" name='suppliername' style ="width:200px;"/></td>
            <td>联系地址：</td>
            <td><input type="text" name='supplieraddr' style ="width:200px;"/></td>
          </tr>
          <tr>
            <td>联系人：</td>
            <td><input type="text" name='suppliermen' style ="width:200px;"/></td>
            <td>联系人电话：</td>
            <td><input type="text" name='supplierphone' style ="width:200px;"/></td>
          </tr>
          <tr>
            <td>是否启用：</td>
            <td>
            <select  name='supplierstatus' style = "width:210px;height:30px;">
            <option value='1'>启用</option>
            <option value='0'>禁用</option>
            </select>
            </td>
            <td>&nbsp;</td>
            <td><input type="submit" value="新 增" style = "width:100px;height:45px;background:#8cd121;color:#ffffff;"></td>
          </tr>
        </table>
       </form>
     </div>  
     <div class="but" style="overflow-x:scroll;margin-top:40px;">
      <form action="" method="post">
       <table width="100%" border="0">
          <tr>
            <th width="17%" scope="col">供应商名称</th>
            <th width="17%" scope="col">联系人</th>
            <th width="22%" scope="col">联系人电话</th>
            <th width="34%" scope="col">联系地址</th>
            <th width="10%" scope="col">操作</th>
          </tr>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vol['supplier_name']); ?></td>
            <td><?php echo ($vol['supplier_men']); ?></td>
            <td><?php echo ($vol['supplier_phone']); ?></td>
            <td><?php echo ($vol['addr']); ?>;</td>
            <td><a href="/bmej/index.php?s=/Home/GoodsManage/updatesuppliershow/id/<?php echo ($vol['id']); ?>">修改</a><a href="/bmej/index.php?s=/Home/GoodsManage/delsupplier/id/<?php echo ($vol['id']); ?>" style="float:right" onclick="return delsupplier()">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
       </form>
     </div>
  </div>
  <!--分类管理-弹出框-->
  <div id="cmain" style = "height:400px;">
     <div class="top">
      <span>分类管理</span> 
      <p class="ebd">×</p>
     </div>
   <div class="mname">
    <form action="<?php echo U('addfenlei');?>" method="post" style = "margin-top:20px;">
       类别名称:<input type="text" name='fenleiname'/>
       <input type="submit" value="新 增" style = "width:150px;background:#8cd121;margin-top:10px;margin-left:100px;color:#ffffff;"/>
    </form>
   </div>
   <div class="bg" style="overflow-x:scroll;">
   <table width="100%" border="0">
      <tr>
        <th width="376" height="25" align="center" valign="middle" scope="col">名称</th>
        <th width="173" align="center" valign="middle" scope="col">操作</th>
      </tr>
      <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="31" align="center" valign="middle"><?php echo ($vol["fenlei_name"]); ?></td>
        <td align="center" valign="middle"><a href="/bmej/index.php?s=/Home/GoodsManage/delfenlei/id/<?php echo ($vol["id"]); ?>" onclick="return delgoodsfenlei()">X</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    </div>
     
  </div> 
  <!--商品添加-弹出框-->
   <div id="dmain" style = "font-size:12px;height:530px;">
     <div class="top">
       <span>商品添加</span> 
       <p class="ewd">×</p>
     </div>
    <div class="add">
      <form action="<?php echo U('goodsstorehouse2');?>" method="post">
       <table border="0" width="100%">
          <tr>
            <td width="15%" align = "center">商品条码：</td>
            <td width="35%">           
            <input type="text" id="goodsid2" name='goodsid' style = "width:150px;"/></td>
            <td width="15%"  align = "center">单进价：</td>
            <td width="35%">
            <input type="text"  name='goodsbid' id='goodsbid2' style = "width:150px;"/></td>
          </tr>
          <tr>
            <td align = "center">商品名称：</td>
            <td>
            <input type="text" name='goodsname' id='goodsname2' style = "width:150px;"/></td>
            <td align = "center">单位：</td>
            <td><input type="text" name='goodsunit' id='goodsunit2' style = "width:150px;"/></td>
          </tr>
          <tr>
            <td align = "center">商品分类：</td>
            <td><select name="goodsfenlei" id='goodsfenlei2' style = "width:150px;">
            <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vol["id"]); ?>'><?php echo ($vol["fenlei_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </td>
            <td align = "center">保质期：</td>
            <td><input type="text" name='goodsquality' id='goodsquality2' style = "width:150px;"/></td>
          </tr>
          <tr>
            <td align = "center">规 格：</td>
            <td><input type="text" name='goodsguige' id='goodsguige2' style = "width:150px;"/></td>
            <td align = "center">单售价：</td>
            <td><input type="text"  name='goodssale' id='goodssale2' style = "width:150px;"/></td>
          </tr>
          <tr>
            <td align = "center">供应商：</td>
            <td><select name='goodssupplier' id='goodssupplier2' style = "width:150px;">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if($vol['status'] == '1'): ?><option value="<?php echo ($vol['id']); ?>"><?php echo ($vol['supplier_name']); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>    
            </td>
            <td align = "center">关联商品条码：</td>
            <td><input type="text" name='goodscorrelation_gid' style = "width:150px;"/></td>
          </tr>
          <tr>
            <td align = "center">生产日期：</td>
            <td><input type="text" name='goodsproduction' id='goodsproduction2' style = "width:150px;"/></td>
            <td align = "center">关联商品数量：</td>
            <td><input type="text"  name='goodscorrelation_num' style = "width:150px;"/></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>		
        <section class='other' style ="display:none;">
		  <div class='other-left'>
            <p style = "margin:0 auto;">商品状态：
            <span><input type='radio' value='1' name='goodsstate'/>
            禁用</span><span><input type='radio' value='0' name='goodsstate' checked />
            允许</span></p>
			
             <p style = "margin:0 auto;">计算积分：<span><input type='radio' value='1' checked name='goodsintegration'/>
             禁用</span><span><input type='radio' value='0' name='goodsintegration'  />
             允许</span></p>
			 
             <p style = "margin:0 auto;">允许打折：<span><input type='radio' value='1' name='goodsissale'/>
              禁用</span><span><input type='radio' value='0' name='goodsissale' checked />
              允许</span></p>
			  
          </div>
          <div class='other-right'>           
             <p style = "margin:0 auto;">会员余额支付：<span><input type='radio' value='1' name='goodsuser_member'/>
             禁用</span><span><input type='radio' value='0' name='goodsuser_member' checked />
             允许</span></p>
			 
          <p style = "margin:0 auto;">是否条码余额扣款：<span><input type='radio' value='1' name='balance'/>
              禁用</span><span><input type='radio' value='0' name='balance' checked />
              允许</span></p>
          </div>
        </section>	
        <p class='button' style = "margin-top:20px;">
          <input type='submit' value='确定' style = "background:#8cd121;margin-left:155px;">
          <input type='reset' value='取消' style = "background:#8cd121;margin-left:20px;">
        <p>
       </form>
       
    </div>
  </div>
</body>
</html>
<script type="text/javascript">
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

    //商品入库-弹出框
  $('#warehou').click(function(){
    $('#amain').show();
     $('#bmain').hide();
     $('#cmain').hide();
      $('#dmain').hide();
      document.getElementById("goodsid1").focus();
    });
  $('.erd').click(function(){
  $('#amain').hide();
  });
   //供应商管理-弹出框
  $('#suppli').click(function(){
    $('#bmain').show();
    $('#amain').hide();
    $('#cmain').hide();
    $('#dmain').hide();
    });
  $('.end').click(function(){
  $('#bmain').hide();
  });  
   //分类管理-弹出框
  $('#fenl').click(function(){
    $('#cmain').show();
    $('#bmain').hide();
    $('#amain').hide();
    $('#dmain').hide();
    });
  $('.ebd').click(function(){
  $('#cmain').hide();
  });  
   //商品添加-弹出框
  $('#addto').click(function(){
    $('#dmain').show();
    $('#cmain').hide();
    $('#bmain').hide();
    $('#amain').hide();
    document.getElementById("goodsid2").focus();
    });
  $('.ewd').click(function(){
  $('#dmain').hide();
  });  
  //查询商品
  window.onload=function(){
    var a=document.getElementById("table1");
    var b=document.getElementById("searchval");
    document.getElementById('goodssearch').onclick=function(){
     for(var i=1;i<a.rows.length+1;i++)
     {
        var str1=a.rows[i].cells[1].innerHTML;
        var str2=b.value;
        if(str1==str2){
          a.rows[i].style.display='table-row';
        }
        else{
          a.rows[i].style.display='none';
        }
     }
    }
   }
   //ajax实现商品入库呈现
   $('#goodsid1').change(function(){
	   $('#goodsname').val(''); 
       $('#goodsbid').val(''); 
       $('#goodsunit').val(''); 
       $('#goodsfenlei').val(''); 
       $('#goodsquality').val(''); 
       $('#goodsguige').val(''); 
       $('#goodssupplier').val(''); 
       $('#goodssale').val(''); 
       $('#goodsproduction').val(''); 
    goodsid1=$('#goodsid1').val();
    $.ajax({
          type:'POST',
          url : '<?php echo U("goodsmessageajax");?>',
          datatype:'json',
          data:{
            goodsid1:goodsid1,
          },
          success:function(data){
            var result=eval("("+data+")");  
              $('#goodsname').val(result['gname']); 
              $('#goodsbid').val(result['gbid']); 
              $('#goodsunit').val(result['unit']); 
              $('#goodsfenlei').val(result['fenlei_id']); 
              $('#goodsquality').val(result['quality']); 
              $('#goodsguige').val(result['guige']); 
              $('#goodssupplier').val(result['supplier_id']); 
              $('#goodssale').val(result['gsale']); 
              $('#goodsproduction').val(result['production']); 
          },
    });
   });
   //ajax实现商品添加功能
   $('#goodsid2').change(function(){
	   $('#goodsname2').val(''); 
       $('#goodsbid2').val(''); 
       $('#goodsunit2').val(''); 
       $('#goodsfenlei2').val(''); 
       $('#goodsquality2').val(''); 
       $('#goodsguige2').val(''); 
       $('#goodssupplier2').val(''); 
       $('#goodssale2').val(''); 
       $('#goodsproduction2').val(''); 
    goodsid1=$('#goodsid2').val();
    $.ajax({
          type:'POST',
          url : '<?php echo U("goodsmessageajax");?>',
          datatype:'json',
          data:{
            goodsid1:goodsid1,
          },
          success:function(data){
            var result=eval("("+data+")");  
              $('#goodsname2').val(result['gname']); 
              $('#goodsbid2').val(result['gbid']); 
              $('#goodsunit2').val(result['unit']); 
              $('#goodsfenlei2').val(result['fenlei_id']); 
              $('#goodsquality2').val(result['quality']); 
              $('#goodsguige2').val(result['guige']); 
              $('#goodssupplier2').val(result['supplier_id']); 
              $('#goodssale2').val(result['gsale']); 
              $('#goodsproduction2').val(result['production']); 
          },
    });
   });
   //总价jquery实现
   $("#goodsbid").change(function(){
	      $('#total').val($('#goodsbid').val()*$('#totalnum').val());
   }); 
   $("#totalnum").change(function(){
		  $('#total').val($('#goodsbid').val()*$('#totalnum').val());
	   }); 
   //清除table
   $("#clear").click(function(){
	   $('#table1 tr').not($('tr').eq(0)).css({
		   'display':'none'
	   });
   });
   //弹出导入框
   $('#import').click(function(){
	   $('#importgoods').show();
   });
   $('.close').click(function(){
	   $('#importgoods').hide();
   });
   
   
  
</script>