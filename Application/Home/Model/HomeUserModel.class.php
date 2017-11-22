<?php 
/**
 * BOSS表
 * 向赠霖——天空骑士
 * QQ：449713926
 */
namespace Home\Model;
use Think\Model;
//User是表名
class HomeUserModel extends Model{
	protected $_validate = array(
			array('username','/^1(3[0-9]|47|5((?!4)[0-9])|7(0|1|[6-8])|8[0-9])\d{8,8}$/','用户名或者密码输入错误，请重新输入'),
			array('password','/^\w{5,18}$/','用户名或者密码输入错误，请重新输入'),
	);
	//登陆处理
	public function login($temp){
		if(!$this->create($temp)){
			//返回错误信息
			return $this->getError();//字符串信息
		}else{
			unset($_SESSION['username_home']);
	    	unset($_SESSION['supplier_name']);
			$map['username'] = $temp['username'];
			$map['password'] = md5($temp['password']);
			$data = $this->where($map)->find();
			if($data){
				//老板登录
				session('isleague',$data['isleague']);//是否加盟门店
				session('username',$map['username']);//用户名
				session('boss_classify',$data['username']);//超市序列号
				cookie('classify',$data['classify']);//站点名称
				cookie('home_name',$data['home_name']);//操作人员名字
				cookie('shop_phone',$data['shop_phone']);//店铺电话
				cookie('start_time',$data['start_time']);//营业开始时间
				cookie('end_time',$data['end_time']);//营业结束时间
				cookie('province',$data['province']);//省
				cookie('city',$data['city']);//市
				cookie('area',$data['area']);//区
				cookie('address',$data['address']);//详细地址
				session('monney',$data['monney']);//预付款余额
				cookie('hot_phone',$data['hot_phone']);//服务热线				
// 				session('dimension_code',$data['dimension_code']);//二维码图片
// 				session('point',$data['point']);//积分比例	
				cookie('id',$data['id']);//id段			
				return $data;
			}else{
				$datastaff = M('shop_staff')->where($map)->find();
				if(is_array($datastaff) && $datastaff['status']=='是'){
					//员工登录					
					session('username',$map['username']);//用户名
					cookie('home_name',$datastaff['home_name']);//操作人员名字
					$doss['username'] = $datastaff['parentid'];
					$boss = $this->where($doss)->find();
					session('isleague',$boss['isleague']);//是否加盟门店
					cookie('classify',$boss['classify']);//站点名称
					session('boss_classify',$boss['username']);//超市序列号
					cookie('shop_phone',$boss['shop_phone']);//店铺电话
					cookie('start_time',$boss['start_time']);//营业开始时间
					cookie('end_time',$boss['end_time']);//营业结束时间
					cookie('province',$boss['province']);//省
					cookie('city',$boss['city']);//市
					cookie('area',$boss['area']);//区
					cookie('address',$boss['address']);//详细地址
					session('monney',$boss['monney']);//预付款余额
					cookie('hot_phone',$boss['hot_phone']);//服务热线
					// 				session('dimension_code',$boss['dimension_code']);//二维码图片
					// 				session('point',$boss['point']);//积分比例
					cookie('id',$boss['id']);//id段
					$authority = M('staff_authority')->where($map)->find();
					cookie('authority_member_jifen',$authority['authority_member_jifen']);//会员-充值丶积分管理权限
					cookie('authority_member_fenlei',$authority['authority_member_fenlei']);//会员-分类管理权限
					cookie('authority_member_add',$authority['authority_member_add']);//会员-新增会员权限
					cookie('authority_member_save',$authority['authority_member_save']);//会员-修改会员信息权限
					cookie('authority_member_del',$authority['authority_member_del']);//会员-删除会员权限
					cookie('authority_member_out',$authority['authority_member_out']);//会员-导出会员权限
					cookie('authority_member_addr',$authority['authority_member_addr']);//会员-导入会员权限
					cookie('shop_supplier',$authority['shop_supplier']);//商品管理—供货商管理权限
					cookie('shop_fenlei',$authority['shop_fenlei']);//商品管理—分类管理权限
					cookie('shop_ruku',$authority['shop_ruku']);//商品管理—商品入库权限
					cookie('shop_save',$authority['shop_save']);//商品管理—修改商品信息权限
					cookie('shop_daochu',$authority['shop_daochu']);//商品管理—导出商品权限	
					cookie('shop_daoru',$authority['shop_daoru']);//商品管理—导入商品权限
					cookie('authority_order',$authority['authority_order']);//订单管理权限
					return $datastaff;
				}else if($datastaff['status']=='否'){
					return '用户已经被禁用';
				}else{
					return '用户名或者密码输入错误，请重新输入';
				}
			}			 
		}	
	}
	//店铺申请提交方法
    public function shopsave($temp){
    	$temp['username'] = $_SESSION['boss_classify'];    	
		$pass = M('home_user')->where($temp)->find();
		if(is_array($pass)){
     			echo "<script>alert('您未进行任何修改')</script>";
     		}else{
     			$where['boss_classify'] = $shop['username'];
     			$passold = M('boss_shop_save')->where($where)->find();     			
     			if($passold['state'] = '1'){
     			     return $passold;
     			}else{
     			$add['boss_classify'] = $shop['username'];
     			$add['date'] = time();
     			$add['shop_phone'] = $shop['shop_phone'];
      			$add['hot_phone'] = $shop['service_phone'];
      			$add['address'] = $shop['address'];
      			$add['state'] = '1';
     			$passing = M('boss_shop_save')->add($add);
     			echo "<script>alert('申请成功，请耐心等待5个工作日内的审核，请拨打客服电话咨询核实。')</script>";
     			}
     		}
	}
	//找回密码方法
	public function back($temp){
		if(!$this->create($temp)){
			//返回错误信息
			return $this->getError();//字符串信息
		}else{
			if($temp['pass']!=$_SESSION['pass']){
				return '验证码错误';
			}
			$id['username'] = $temp['username'];
			$word['password'] = md5($temp['password']);
			$boss = M('home_user')->where($id)->find();
			if($boss){
				M('home_user')->where($id)->save($word);
				return $boss;
			}else{
				$staff = M('shop_staff')->where($id)->find();
				if($staff){
					M('shop_staff')->where($id)->save($word);
					return $staff;
				}
			}
		}
	}	
}
	
	
?>