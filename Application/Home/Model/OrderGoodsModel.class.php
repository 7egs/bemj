<?php
/**
 * 商品订单表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model\RelationModel;
class OrderGoodsModel extends RelationModel{
    //一对一，不过是从属关系belongs_to
    protected $_link=array(
        'user_order'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'orderid',//BELONGS_TO是从属于的user_order的表，所以必须连接user_order的主键
        ),
    );
}