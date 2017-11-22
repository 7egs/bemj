<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>进价售价窗口</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/purchase.css">
</head>
<body>
 <div class="main" style="width: 700px;height: 370px;"> 
   <div class="top">
     <span>修改商品信息</span> 
     <a href="javascript:history.back(-1)" style="float: right;cursor: pointer;margin-right: 10px;margin-top: 4px;color: #333333;">X<a>
   </div>
   <form action='/bmej/index.php?s=/Home/GoodsManage/updategoods/goodsgid/<?php echo ($goodsgid); ?>' method="post" style="width: 700px;height: 320px;font-size: 14px;">
     	商品条形码: <input type="text" value="<?php echo ($goodsgid); ?>" disabled style="width: 30%;margin-top: 5px;">
     	商品名称：<input type='text' name="gname" value="<?php echo ($list["gname"]); ?>" style="width: 30%;margin-top: 5px;"></br>
     	商品售价：<input type='text' name="gsale" value='<?php echo ($list["gsale"]); ?>' style="width: 30%;margin-top: 5px;margin-left: 34px;">
     	商品进价：<input type='text' name="gbid" value='<?php echo ($list["gbid"]); ?>' style="width: 30%;margin-top: 5px;"></br>
     	商品库存：<input type='text' name="gnum" value='<?php echo ($list["gnum"]); ?>' style="margin-left: 34px;width: 30%;margin-top: 5px;">
     	<spana style = "display: none;">
     	商品状态：
		<?php if($list['state'] == '0'): ?><input type='radio' value='1' name='state' style="margin-top: 5px;"/>禁用
		<input type='radio' value='0' checked name='state' style="margin-top: 5px;"/>允许
		<?php else: ?>
		<input type='radio' value='1' checked name='state' style="margin-top: 5px;"/>禁用
		<input type='radio' value='0' name='state'  style="margin-top: 5px;"/>允许<?php endif; ?>
		</spana>
     	商品规格：<input type='text' name="guige" value='<?php echo ($list["guige"]); ?>' style="width: 30%;margin-top: 5px;"></br>
     	商品单位：<input type='text' name="unit" value='<?php echo ($list["unit"]); ?>' style="margin-left: 34px;width: 30%;margin-top: 5px;">
     	保质期：<input type='text' name="quality" value='<?php echo ($list["quality"]); ?>' style="margin-left: 34px;width: 30%;margin-top: 5px;"></br>
     	生产日期：<input type='text' name="production" value='<?php echo ($list["production"]); ?>' style="margin-left: 34px;width: 30%;margin-top: 5px;">
     	分类：<select name="goodsfenlei" style="width: 80px;height: 31px;margin-left: 15px;">
	            <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vol["id"]); ?>'><?php echo ($vol["fenlei_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
     	供应商：<select name='goodssupplier' style="width: 100px;height: 31px;margin-left: 10px;">
              <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if($vol['status'] == '1'): ?><option value="<?php echo ($vol['id']); ?>"><?php echo ($vol['supplier_name']); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </select>
              </br>
        <spana style = "display: none;">      
     	是否积分产品：
     	<?php if($list['integration'] == '0'): ?><input type='radio' value='1' name='integration'/>禁用
		<input type='radio' value='0' checked name='integration'/>允许
		<?php else: ?>
		<input type='radio' value='1' checked name='integration'/>禁用
		<input type='radio' value='0' name='integration'  />允许<?php endif; ?>
     	是否使用余额/积分：
     	<?php if($list['user_member'] == '0'): ?><input type='radio' value='1' name='user_member'/>禁用
		<input type='radio' value='0' checked name='user_member'/>允许
		<?php else: ?>
		<input type='radio' value='1' checked name='user_member'/>禁用
		<input type='radio' value='0' name='user_member'  />允许<?php endif; ?>
     	是否使用会员打折：
     	<?php if($list['sale'] == '0'): ?><input type='radio' value='1' name='sale'/>禁用
		<input type='radio' value='0' checked name='sale'/>允许
		<?php else: ?>
		<input type='radio' value='1' checked name='sale'/>禁用
		<input type='radio' value='0' name='sale'  />允许<?php endif; ?>
		</spana>
     	关联商品条码：      <input type='text' name="correlation_gid" value="<?php echo ($list['correlation_gid']); ?>" style="width: 30%;margin-top: 20px;">
     	关联个数：        <input type='text' name="correlation_num" value="<?php echo ($list['correlation_num']); ?>" style="width: 30%;margin-top: 20px;">
     <input type="submit" value="确 定" style="width: 200px;height: 50px;background: #8cd121;color: #ffffff;" />
   </form>
 </div>
</body>
</html>