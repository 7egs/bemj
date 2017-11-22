<?php
/**
 * 商品订单表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model;
class GoodsFenleiModel extends Model{
    protected $_validate = array(
        array('fenlei_name','require','商品分类不能为空'),
    );
}