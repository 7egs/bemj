<?php
/**
 * 商品订单表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model;
class SupplierModel extends Model{
    protected $_validate = array(
        array('supplier_name','require','供应商名称不能为空'),
        array('supplier_men','require','联系人不能为空'),
        array('supplier_phone','/^1(3[0-9]|47|5((?!4)[0-9])|7(0|1|[6-8])|8[0-9])\d{8,8}$/','手机号必须为11位'),
        array('addr','require','地址不能为空'),
        
    );
}