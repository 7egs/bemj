<?php 
/**
 * BOSS表
 * 向赠霖——天空骑士
 * QQ：449713926
 */
namespace Home\Model;
use Think\Model;
//member_type表
class MemberTypeModel extends Model{
	protected $_validate = array(
			array('type_name','require','分类名字不能为空'),
	        array('member_discount','require','分类折扣不能为空'),
	        array('member_discount','/^(0\.\d*[1-9]+\d*)$/','分类折扣在0-1之间'),
	);
	
}
	
	
?>