<?php 

namespace Home\Model;
use Think\Model;
class StaffAuthorityModel extends Model{
	public function modify($data,$username){
		$save['authority_member_jifen'] = '0';
		$save['authority_member_fenlei'] = '0';
		$save['authority_member_add'] = '0';
		$save['authority_member_save'] = '0';
		$save['authority_member_del'] = '0';
		$save['authority_member_out'] = '0';
		$save['authority_member_addr'] = '0';
		$save['shop_supplier'] = '0';
		$save['shop_fenlei'] = '0';
		$save['shop_ruku'] = '0';
		$save['shop_save'] = '0';
		$save['shop_daochu'] = '0';
		$save['shop_daoru'] = '0';
		$save['authority_order'] = '0';		
		$where['username'] = $username;
			foreach ($data as $key => $value){
				$save[$key] = $value;
			}
			$list = M("staff_authority")->where($where)->save($save);
			return $list;			
	}
}