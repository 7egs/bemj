<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>进价售价窗口</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>
<body>
 <div class="main" style = "height:170px;">
   <div class="top">
     <span>修改会员级别<a href='<?php echo U("Member/member");?>' style = "float:right;margin-right:5px;">X</a></span> 
   </div>
   <form action='/bmej/index.php?s=/Home/Member/updatemembertype/memberphone/<?php echo ($memberphone); ?>' method="post">
      会员级别: <td><select name="membertype" style = "width:100px;height:30px;">
	              <option value="0">请选择</option>
              <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arr["id"]); ?>"><?php echo ($arr["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>           
                  </select>
              </td>
     <input type="submit" value="确 定"/>
   </form>
 </div>
</body>
</html>