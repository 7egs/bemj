<?php 
/**
* 员工表模型层 
* 向赠霖——天空骑士
* QQ：449713926
*/
namespace Home\Model;
use Think\Model;
class ShopStaffModel extends Model{	
	//正则方法（xzl）	
	protected $_validate = array(
			array('home_name','/\S/','员工姓名不能为空'),
			array('identification','/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/','身份证号码不存在，请核实并输入18位身份证号码'),
			array('username','/^1(3[0-9]|47|5((?!4)[0-9])|7(0|1|[6-8])|8[0-9])\d{8,8}$/','手机号不存在'),
			array('password','/^\w{5,18}$/','密码不符合规范，请输入5到18位常规数字或者字符'),
	);
	//员工查询方法（xzl）
	public function shopstaff($temp){
		$where['parentid']= $temp;	
		$list = M('shop_staff')->where($where)->select();
		return $list;
	}
	//员工删除方法（xzl）	
	public function del($username){
		$where['username'] = $username;
		$list = M('shop_staff')->where($where)->delete();
		M('staff_authority')->where($where)->delete();
	}
	//添加员工方法（xzl）
	public function add($temp){
		if(!$this->create($temp)){
			//返回错误信息
			return $this->getError();//字符串信息
		}else{
			$map['username'] = $temp['username'];
			$list = $this->where($map)->find();	
			$listold = M('home_user')->where($map)->find();
			if(is_array($list)||is_array($listold)){
				return '手机号已经存在，请联系客服人员';
			}else{			
			$temp['parentid'] = $_SESSION['boss_classify'];
			$temp['start_time'] = time();
			$temp['password'] = md5($temp['password']);
			$data = M("shop_staff")->add($temp);
			$data = M("staff_authority")->add($map);
			if($data){
				return $data;
			}else{
				return '添加失败请联系客服人员';
			}
			}
		}		
	}	
}	
?>