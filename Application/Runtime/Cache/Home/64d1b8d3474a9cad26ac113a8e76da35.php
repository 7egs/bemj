<?php if (!defined('THINK_PATH')) exit();?>	         <table width="600" height="80" border="0">
	            <tr>
	              <th width="151" scope="col">条码</th>
	              <th width="42" scope="col">数量</th>
	              <th width="80" scope="col">名称</th>
	              <th width="176" scope="col">时间</th>
	              <th width="53" scope="col">金额</th>
	              <th width="75" scope="col">操作</th>
	            </tr>
	            <?php if(is_array($good)): $i = 0; $__LIST__ = $good;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arr): $mod = ($i % 2 );++$i;?><tr>
				      <td><?php echo ($arr['gid']); ?></td>
				      <td><?php echo ($arr['num']); ?></td>
				      <td><?php echo ($arr['gname']); ?></td>
				      <td><?php echo (date('Y-m-d H:i:s',$arr['date'])); ?></td>
				      <td><?php echo ($arr['gsale']*$arr['num']*$arr['discount']); ?></td>
				      <td style = "text-align:center;"><a href="/bmej/index.php?s=/Home/Super/returngoods/gid/<?php echo ($arr['gid']); ?>">退货</a></td>
				    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	         </table>