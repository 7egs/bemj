<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>店铺设置</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/system_store_settings.css">
<script src="/bmej/Public/home//js/jquery-3.2.1.min.js"></script>
<script type="text/javascript"> 
function del(){ 
if(!confirm("这个对管理十分重要，请再次确认")){ 
window.event.returnValue = false; } } 
</script> 
</head>
<body>
<div class="w">
<div class="button">
<button id="shop" class="cl">店铺修改申请</button>
<button id="worker">员工管理</button>
</div>
<div class="shop_set">
<form method="post" action='<?php echo U("System/system");?>'>
店铺名称：<input id="aa" type="text" disabled="disabled" value="<?php echo $_COOKIE['classify'];?>"><span>如要修改，请联系系统客户</span><br />
负责人电话：<input type="text" disabled="disabled" value="<?php echo $_SESSION['boss_classify'];?>"><span>如要修改，请联系系统客户</span><br />
店面电话：<input id="bb" type="text" name="shop_phone" placeholder="请输入店面电话" value="<?php echo $_COOKIE['shop_phone'];?>"><span>可选填，小票打印显示</span><br />
服务热线：<input id="cc" type="text" name="hot_phone" placeholder="请输入电话号码" value="<?php echo $_COOKIE['hot_phone'];?>"><br />
店铺地址：<input id="dd" type="text" name="address" placeholder="请输入店铺地址" value="<?php echo $_COOKIE['address'];?>"><br />
<input type="submit" value="确认提交申请" class="a">
</form>
</div>
<div class="worker_manage">
<div class="rigth">
<!--<input readonly="readonly" placeholder="1" class="readonly"><button onclick="" class="f">上一页</button><button onclick="" class="f">下一页</button>-->
</div>
<table style="cellspacing 0">
	<tr><td>ID</td>
		<td>手机号</td>
		<td>姓名</td>
		<td>底薪</td>
		<td>性别</td>
		<td>是否启用</td>
		<td>注册时间</td>
		<td>身份证号</td>
		<td>地址</td>
		<td>操作</td>
	</tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["username"]); ?></td>
        <td><?php echo ($vo["home_name"]); ?></td>
        <td><?php echo ($vo["base_pay"]); ?></td>
        <td><?php echo ($vo["sex"]); ?></td>
        <td><?php echo ($vo["status"]); ?></td>
        <td><?php echo (date('Y-m-d',$vo["start_time"])); ?></td>
        <td><?php echo ($vo["identification"]); ?></td>
        <td><?php echo ($vo["address"]); ?></td>
        <td><a href="/bmej/index.php?s=/Home/System/modify/username/<?php echo ($vo["username"]); ?>">权限</a> / <a href="/bmej/index.php?s=/Home/System/del/username/<?php echo ($vo["username"]); ?>" onclick="return del()">删除</a></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>            
</table>
<a class="add"  href="<?php echo U('System/add');?>" style = "color:#333333">新增员工</a>
</div>
</div>
</body>
</html>
<script>
$().ready(function(){
$("#shop").click(function(){
$("#shop").addClass('cl');
$("#worker").removeClass();
$(".shop_set").show();
$(".worker_manage").hide();
})
$("#worker").click(function(){
$("#worker").addClass('cl');
$("#shop").removeClass();
$(".shop_set").hide();
$(".worker_manage").show();
})
})
//$("#add").click(function(){
//	$('.addmessage').show();
//});
</script>