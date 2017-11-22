<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>会员管理</title>
		<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/member.css">
        <script src="/bmej/Public/home//js/jquery-3.2.1.min.js"></script>
        <script>
        function delmember(){ 
        	if(!confirm("是否删除会员，请确定！！！")){ 
        	window.event.returnValue = false; } } 
        function delmembertype(){ 
        	if(!confirm("是否删除这个会员权限，请确定！！！")){ 
        	window.event.returnValue = false; } } 
        </script>       
	</head>
	<body style="overflow-x:hidden;height:600px;">
	<div id='member'>
          <form action="" method="post">
			<table width="100%" height="80" border='0' cellpadding="0" cellspacing="0" id='table1'>
				<tr>
					<th>ID</th>
					<th>电话号码</th>
					<th>会员分类</th>
					<th>会员折扣</th>
					<th>开卡人</th>
					<th>余额</th>
					<th>积分</th>
					<th>出生时间</th>
					<th>性别</th>
					<th>开卡时间</th>
					<th>操作</th>
			  </tr>
			  <tbody>
			  <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr >
					<td height="20" style="text-align:center"><?php echo ($key+1); ?></td>
					<td style="text-align:center"><?php echo ($vol["memberphone"]); ?></td>
					<td style="text-align:center"><?php echo ($vol["type_name"]); ?></td>
					<td style="text-align:center"><?php echo ($vol["member_discount"]); ?></td>
					<td style="text-align:center"><?php echo ($vol["membername"]); ?></td>
					<td style="text-align:center"><?php echo ($vol["membermoney"]); ?></td>
					<td style="text-align:center"><?php echo ($vol["memberpoint"]); ?></td>
					<td style="text-align:center"><?php echo ($vol["memberbirthday"]); ?></td>
					<td style="text-align:center">
					<?php if($vol["membersex"] == 1): ?>男<?php else: ?>女<?php endif; ?>
					</td>
					<td style="text-align:center"><?php echo (date("Y-m-d H:i:s",$vol["memberdate"])); ?></td>
					<td style="text-align:center"><a href="/bmej/index.php?s=/Home/Member/updatemembershow/memberphone/<?php echo ($vol["memberphone"]); ?>">修改会员级别</a><a style="float:right;"href="/bmej/index.php?s=/Home/Member/delmember/memberphone/<?php echo ($vol["memberphone"]); ?>" onclick="return delmember()">×</a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
	    	</table>
            </form>
            </div>
            <div style = "width:500px;margin:0 auto;margin-top:20px;"><?php echo ($page); ?></div>
			<div class='member_footer'>
				<div>
					<form action = '<?php echo U("Member/member");?>' method = "post" style="margin-left:40px;float:left;"><span>卡号查询:</span><input type='text' id="searchval" name = "memberphone"/><input type='submit' value='查询' style = "width:100px;height:32px;margin-left:10px;"/></form>						
				</div>
				<ul>
					<li id="rech"><a href="#">充值、扣除管理</a></li>
					<li id="cation"><a href="#">分类管理</a></li>
					<li id="mber"><a href="#">新增会员</a></li>
				</ul>
			</div>
       <!--充值、积分管理-->
    <div id='score_manage' style="border:1px solid #999;">
			<h6>充值、积分管理<span class="erd">×</span></h6>
			<div class='content'>
					<p><span>电话号码:</span><input type='text'  id='phone' /><button id="search">查询</button></p>
				<div class="show">
                  <p>姓名：<span>尚未查询</span></p>
                  <p>余额：<span>尚未查询</span></p>
                  <p>电话：<span>尚未查询</span></p>
                  <p>积分：<span>尚未查询</span></p>
                </div>
				<div class='content_left'>
					<form action='' method="post" id="addform">
					<div class='pay'>
						<p>现金/积分充值</p>
						<ul>
							<li>现金:<input type="text" value="0" name="money"/>元</li>
							<li>积分:<input type="text" value="0" name="point"/></li>
						</ul>
						<input type="submit" value="充值">						
					</div>
					</form>
				</div>
				<div class='content_right'>
					<form action='' method="post" id="delform">
					<div class='pay'>
						<p>现金/积分扣除</p>
							<ul>
								<li>现金:<input type="text" value="0" name="money"/>元</li>
								<li>积分:<input type="text" value="0" name="point"/></li>
							</ul>
							<input type="submit" value="扣除">	
					</div>
					</form>
				</div>
					<center>建议超市使用现金与积分比例为 1:500。</center>
			</div>
		</div>
       <!--分类管理-->
     <div id="main" >
        <div class="top">
           <span>分类管理</span> 
          <p class="end">×</p>
        </div>
     <div class="mname">
      <form action="<?php echo U('addmembertype');?>" method="post">
        分类名称：
        <input type="text" name="membertype"/><br>
        分类折扣：
        <input type="text" name="memberdiscount"/>
        <input type="submit" value="新 增" style = "width:70px;font-size:20px;background:#8cd121;"/>
     </form>
     </div>
     <div id="bg" style='overflow-x:scroll;'>
     <table width="100%" border="0" >
      <tr >
        <th width="86" align="center" valign="middle" scope="col">ID</th>
        <th width="126" align="center" valign="middle" scope="col">名称</th>
        <th width="153" height="25" align="center" valign="middle" scope="col">折扣</th>
        <th width="180" align=
        "center" valign="middle" scope="col">操作</th>
      </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arr): $mod = ($i % 2 );++$i;?><tr >
        <td height="31" align="center" valign="middle"><?php echo ($key+1); ?></td>
        <td height="31" align="center" valign="middle"><?php echo ($arr["type_name"]); ?></td>
        <td height="31" align="center" valign="middle"><?php echo ($arr["member_discount"]); ?></td>
        <td align="center" valign="middle"><a href="/bmej/index.php?s=/Home/Member/delmembertype/id/<?php echo ($arr["id"]); ?>" id="del" onclick="return delmembertype()">×</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    </div>
  </div> 
    <!--新增会员-->
    <div id="gement">
    <div class="top">
           <span>新增会员</span> 
           <p class="ead">×</p>
        </div>
       <form action='<?php echo U("Member/addmember");?>' method="post">
	    	<table width="100%" border="0">
	          <tr>
	            <td width="7%" height="39">&nbsp;</td>
	            <td width="22%">电话号码：</td>
	            <td width="44%"><input type="text" name="memberphone"></td>
	            <td width="27%">*</td>
	          </tr>
	          <tr>
	            <td height="35">&nbsp;</td>
	            <td>会员分类：</td>
	            <td><select name="membertype">
	            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arr["id"]); ?>"><?php echo ($arr["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>           
	                </select>
	            </td>
	            <td>*</td>
	          </tr>
	          <tr>
	            <td height="37">&nbsp;</td>
	            <td>姓名：</td>
	            <td><input type="text" name="membername"></td>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td height="40">&nbsp;</td>
	            <td>性别：</td>
	            <td>
	            <select name="membersex"> 
		              <option value="1">男</option> 
		              <option value="2">女</option>  
	             </select></td>
	            <td>*</td>
	      	  </tr>
	          <tr>
	            <td height="37">&nbsp;</td>
	            <td>余额：</td>
	            <td><input type="text" name="membermoney"></td>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td height="42">&nbsp;</td>
	            <td>积分：</td>
	            <td><input type="text" name="memberpoint"></td>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td height="40">&nbsp;</td>
	            <td>生日：</td>
	            <td><input type="text" name="memberbirthday"></td>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td height="80">&nbsp;</td>
	            <td><input type="submit"></td>
	            <td colspan="2" align="center"><input type="reset"></td>
	          </tr>
	      	</table>
	   </form>
    </div>
</body>
</html>
<script>
  //充值、积分管理
  $('#rech').click(function(){
	  $('#score_manage').show();
	  $('#main').hide();
	  $('#gement').hide();
	  });
  $('.erd').click(function(){
	$('#score_manage').hide();
	});
  //分类管理
  $('#cation').click(function(){
	  $('#main').show();
	  $('#score_manage').hide();
	  $('#gement').hide();
	  });
  $('.end').click(function(){
	$('#main').hide();
	});
	//新增会员
  $('#mber').click(function(){
	  $('#gement').show();
	  $('#score_manage').hide();
	  $('#main').hide();
	  });
  $('.ead').click(function(){
	$('#gement').hide();
	});
  $("#search").click(function(){
	  phone=$('#phone').val();
	  $('.show').empty();
	  $.ajax({
          type:'POST',
          url : '<?php echo U("Member/membermessage");?>',
          datatype:'json',
          data:{
            phone:phone,
          },
          success:function(data){
        	  var result=eval("("+data+")");  
              //alert(result['membername']);  
              var html='';
              	html+='<p>姓名：<span>'+result['membername']+'</span></p>'
                html+='<p>余额：<span>'+result['membermoney']+'</span></p>'
                html+='<p>电话：<span>'+result['memberphone']+'</span></p>'
                html+='<p>积分：<span>'+result['memberpoint']+'</span></p>'
              $('.show').append(html); 
          },
		  
	 	});
	  //$("#addform").attr("action",'<?php echo U("Member/addmoney/phone/'+phone+'");?>');
	  //$("#delform").attr("action",'<?php echo U("Member/delmoney/phone/'+phone+'");?>');
	  $("#addform").attr("action","/bmej/index.php?s=/Home/Member/addmoney/phone/"+phone+"");
	  $("#delform").attr("action","/bmej/index.php?s=/Home/Member/delmoney/phone/"+phone+"");
  });
</script>