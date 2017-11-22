<?php 
/**
 * 用户订单表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class UserOrderModel extends RelationModel{
    protected $_link = array(
        'order_goods'=>array(
             'mapping_type'=>self::HAS_MANY,
             'foreign_key'=>'parentid',
        )
    );
    //查询订单方法
    public function selectdata()
    {
            $map['boss_classify']=$_SESSION['boss_classify'];
            $map1['date']=date('Y-m-d',time());
            $list=$this->where($map)->order('date desc')->select();
            foreach ($list as $value){
                $date1=date('Y-m-d',$value['date']);  
                if($date1==$map1['date']){
                    $map['date']=$value['date'];
                    $list1[]=$this->where($map)->order('date desc')->find();
                }
            }
            if(is_array($list1)){
                return $list1;
            }else{
                echo "<script>alert('今天暂未订单');</script>";
            }
    }
    //查询订单其他信息
    public function selectdetaildata($temp){
        if(is_array($temp)){ 
            foreach ($temp as $value){
             $map['boss_classify']=$_SESSION['boss_classify'];
             $map['orderid']=$value;
             $data[]=$this->where($map)->find();
            }
        }else{
          $map['boss_classify']=$_SESSION['boss_classify'];
          $map3['date']=date('Y-m-d',time());
          $list=$this->where($map)->order('date desc')->select();
          foreach ($list as $value){
              $date1=date('Y-m-d',$value['date']);
              if($date1==$map3['date']){
                  $map['date']=$value['date'];
                  $data[]=$this->where($map)->order('date desc')->find();
              }
          } 
        }
        
        $detail['order_totalnum']=count($data);
        foreach ($data as $key =>$value){
           $detail['totalsale']+=$value['order_money'];
           if($value['oways']==1){
               $detail['total1']+=$value['order_money'];
           }else if($value['oways']==2){
               $detail['total2']+=$value['order_money'];
           }else if($value['oways']==3){
               $detail['total3']+=$value['order_money'];
           }else if($value['oways']==4){
               $detail['total4']+=$value['order_money'];
           }else if($value['oways']==5){
               $detail['total5']+=$value['order_money'];
           }
           $arr[]=$value['orderid'];
        }
        foreach($arr as $key => $val){
            $map1['parentid']=$val;
            $listold[]=M('order_goods')->where($map1)->select(); 
        }
        $i=0;
        foreach($listold as $value){
           foreach($value as $key=>$val){
             $arr1[$i]['num']=$val['num'];
             $map1[$i]['gid']=$val['gid'];
             $map1[$i]['boss_classify']=$_SESSION['boss_classify'];
             $list1[$i][]=M('user_goods')->where($map1[$i])->find();
             $arr1[$i]['gbid']=$list1[$i][0]['gbid'];
             $arr1[$i]['total']=$arr1[$i]['gbid']*$arr1[$i]['num'];
             $detail['totalgbid']+=$arr1[$i]['total'];
             $i++;
           }
        }
        $detail['profits']=$detail['totalsale']-$detail['totalgbid'];
        if($detail){
            return $detail;
        }else{
            return false;
        }
    }
    //保存订单方法
    public function addorder($temp)
    {   
        $data['oways']=$temp['oways']; 
        if($temp['membername'])
        {
            $data['member']=1;
            $data['identity']=$_SESSION['memberphone'];
        }else
        {
            $data['member']=2;
            $data['identity']="游客";
        }
        $data['date']=time();
        $data['orderid']=$data['date'].substr($_SESSION['username'],7,4);
        $data['order_money']=$temp['total'];
        $data['boss_classify']=$_SESSION['boss_classify'];
        $data['username']=$_SESSION['username'];
        $list=$this->add($data);
        if($list)
        {   
            return $data;
        }else{
            echo "<script>alert('保存订单失败');</script>";
        }
    }    
    //找到对应的会员折扣方法
    public function ismember($orderid)
    {
        $data1=$this->find($orderid);
        if($data1['member']==1){
            $member=M('user_member');
            $map['boss_classify']=$_SESSION['boss_classify'];
            $map['memberphone']=$data1['identity'];
            $data2=$member->where($map)->find();
            $membertypenum=$data2['membertype'];
            $membertype=M('member_type');
            $data3=$membertype->where("id=$membertypenum")->find();
            $discount=$data3['member_discount'];
            return $discount;
        }else{
             $discount=1;
             return $discount;
         }
    }
    //时间段查询订单方法
    public function ordersearch($temp){
        $startime=$temp['start_time'];
        $endtime=$temp['end_time']."23:59:59";
        $startime1=strtotime($temp['start_time']);
        $endtime1=strtotime($endtime);
        $map['boss_classify']=$_SESSION['boss_classify'];
        $list=$this->where($map)->order('date desc')->select();
        foreach ($list as $value){
           if($value['date']>=$startime1 && $value['date']<=$endtime1){
                $map1['date']=$value['date'];
                $map1['boss_classify']=$_SESSION['boss_classify'];
               $list1[]=$this->where($map1)->find();
           } 
        }
        if(is_array($list1)){
            return $list1;
        }else{
             echo "<script>alert('无此时间段的订单，请重新查询！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        } 
    }
    //订单详情方法
    public function findordetail($temp){
        $map['orderid']=$temp['id'];
        $list=$this->where($map)->find();
        if(is_array($list)){
            return $list;
        }else{
            return false;
        }
        
       
    }

}
?>