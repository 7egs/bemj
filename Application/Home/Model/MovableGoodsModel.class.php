<?php
/**
 * 商品订单表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model;
class MovableGoodsModel extends Model{
    //扣除预付款
    public function findmovablegoods($temp2)
    {    
        foreach ($_SESSION['goods'] as $key => $value)
        {
            $data[$key]['gid']=$value['gid'];
            $id['gid'] = $value['gid'];
            $listold = $this->where($id)->select();
            $data[$key]['start_time']=$listold[0]['start_time'];
            $data[$key]['end_time']=$listold[0]['end_time'];
            $data[$key]['date']=time();
            //判断是否是活动商品
            if($data[$key]['date']>=$listold[0]['start_time'] && $data[$key]['date']<=$listold[0]['end_time'])
            {
                $data[$key]['gsale']=$listold[0]['withhold']*$value['num'];
                $data[$key]['order_id']=$temp2;
                $data[$key]['boss_classify']=$_SESSION['boss_classify'];
                $data[$key]['username']=$_SESSION['username'];
                $list=M('advance_goods')->add($data[$key]);
                $total+=$data[$key]['gsale'];       
            }
        } 
            $map['username']=$_SESSION['boss_classify'];
            $boss=M('home_user')->where($map)->find();
            $data1['monney']=$boss['monney']-$total;
            $list1=M('home_user')->where($map)->save($data1);
            if($list1)
            {
               session('monney',$data1['monney']);
            }   
    }
    //退货增加预付款
    public function ismovable($temp1,$temp2,$temp3){
        $map['gid']=$temp3;
        $map['parentid']=$temp1;
        $map1['orderid']=$temp1;
        $list=$this->where($map)->find();
        $list1=M('user_order')->where($map1)->find();
        if($list1['date']>=$list['start_time'] && $list1['date']<=$list['end_time']){
            $returnmoney=$list['withhold']*$temp2;
            $map3['username']=$_SESSION['boss_classify'];
            $list2=M('home_user')->where($map3)->find();
            $data['monney']=$list2['monney']+$returnmoney;
            M('home_user')->where($map3)->save($data);
            session('monney',$data['monney']);
        }
    }   
}