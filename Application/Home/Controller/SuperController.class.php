<?php
/**
 * 超市模块
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Controller;
use Think\Controller;
class SuperController extends CommonController {
    //主页面方法
    public function index()
    {  
        if(IS_POST)
        {
           $member = D ('user_member');
           $data1=$member->selectmember(I('post.memberphone'));
           if(is_array($data1)){
               $membertype=$data1['membertype'];
               $member2=M('member_type');
			   $where["id"] = $membertype;
               $data2=$member2->where($where)->find(); 
			   if($data2){
                   $memberdata['memberpoint']=$data1['memberpoint'];
                   $memberdata['membermoney']=$data1['membermoney'];
                   $memberdata['membertype']=$data2['type_name'];
                   $memberdata['memberdiscount']=$data2['member_discount'];
                   $_SESSION['memberdiscount']=$memberdata['memberdiscount'];
                   $_SESSION['membername']=$data1['membername'];
                   $_SESSION['membermoney']=$memberdata['membermoney'];
                   $this->assign('memberdata',$memberdata);
			   }else{
    			   $memberdata['memberpoint']=$data1['memberpoint'];
                   $memberdata['membermoney']=$data1['membermoney'];
                   $memberdata['membertype']='此会员未分类';
                   $memberdata['memberdiscount']='1';
                   $_SESSION['memberdiscount']='1';
                   $_SESSION['membername']=$data1['membername'];
                   $_SESSION['membermoney']=$memberdata['membermoney'];
                   $this->assign('memberdata',$memberdata);   
			   }
           }else{
				   echo "<script>alert('会员不存在，请添加会员');window.history.back(-1);</script>";
			   }       
        }
        $goodsother=D('user_goods');
        $list=$goodsother->othergoods();
        $this->assign('formlist',$_SESSION['formlist']);
        $this->assign('good',$list);
        $this->assign('arr',$_SESSION['goods']);
        $this->display();
    }
    //主页面扫码窗口
    public function checkgoods()
    {
            $goodid=$_REQUEST['goodid'];
            $goods = D('user_goods');
            $list=$goods->checkgoods($goodid);
            if(is_array($list))
            {
                $this->redirect('index');
            }else{
                $this->redirect('purchase',array('gid'=>$goodid));
            }     
    }
    //显示修改商品页面
    public function updategoodsshow()
    {
        $data['gid']=$_GET['gid'];
        $data['num']=$_GET['num'];
        $this->assign('data',$data);
        $this->display();
    }
    //修改商品数量
    public function updategoods()
    {
         $a=$_GET['gid'];
         $b=$_POST['num'];
		 if((floor($b) - $b)!=0){
			 echo "<script>alert('数量必须大于0且为整数');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";			
		}else{
          if($b>=1){
			$_SESSION['goods'][$a]['num']=$b;
			$_SESSION['goods'][$a]['total']=$_SESSION['goods'][$a]["gsale"]*$b;
			$this->redirect('index');   
		  }else{
			echo "<script>alert('数量必须大于0且为整数');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		  }
		}       
    }
    //删除已选商品
    public function delgoods()
    {
        $id=$_GET['gid'];
        unset($_SESSION['goods']["$id"]);
        $this->redirect('index');
    }
    //清除所有已选商品
    public function delsession()
    {
        unset($_SESSION['goods']);
        unset($_SESSION['memberdiscount']);
        $this->redirect('index');
    }
    //商品添加页面(当主仓库有时，显示商品添加页面)
    public function purchase()
    {
        $goodsid=$_GET['gid'];
        $managegoods=D('mamage_goods');
        $list=$managegoods->findgoods($goodsid);
        if(is_array($list)){
            $this->assign('list',$list);
            $this->display();//purchase页面
        }else{
            $this->redirect('purchase1',array('gid'=>$goodsid));
        }
    } 
    //主页面扫码添加(当user的表中没有时,调取我们的数据表mamage_goods,并保存其竞价，售价到数据库)
    public function addgoods()
    {
        $mgoods= D('mamage_goods');
        $goodid=$_GET['gid'];
        $list=$mgoods->addgoods(I('get.'),I('post.'));
        if($list)
        {
            $this->redirect('checkgoods',array('goodid'=>$goodid));
        }else{
            $this->error('添加失败');
            $this->redirect('index');
        }   
    }
    //商品添加页面(当主仓库没有时，显示增加商品页面)
    public function purchase1()
    {
        $gid=$_GET['gid'];
        $this->assign('gid',$gid);
        $this->display();
    }
    //主页面扫码添加(当user表中和仓库中都没有时，保存其竞价，售价到仓库和商店数据库)
    public function addgoods1(){
        $mgoods=D('mamage_goods');
        $goodid=$_GET['gid'];
        $list=$mgoods->addgoods1(I('get.'),I('post.'));
        if($list){
            $this->redirect('checkgoods',array('goodid'=>$goodid));
        }else{
            $this->error('添加失败');
            $this->redirect('index');
        }
    }
    //挂单功能
    public function formlist()
    {		
		$dataformlist['formlisttotal']=$_SESSION['formlisttotal'];
        $dataformlist['formlisttime']=time();
        $dataformlist['formlistdetal']=$_SESSION['goods'];
        $_SESSION['formlist'][]=$dataformlist;
        unset($_SESSION['goods']);
        $this->redirect('index');        
    }
    //激活挂单
    public function active()
    {
        $i=$_GET['id'];
        $_SESSION['goods']=$_SESSION['formlist'][$i]['formlistdetal'];
        unset($_SESSION['formlist'][$i]);
        $this->redirect('index');
    }
    //小票打印
    public function bill()
    {
        $data['orderid']=time().substr($_SESSION['username'],7,4);
        $data['time']=time();
        $data['totalnum']=I('get.totalnum');
        $data['total']=I('get.total');
        $data['classify']=$_COOKIE['classify'];
        $data['homename']=$_COOKIE['home_name'];
        $this->assign('goods',$_SESSION['goods']);
        $this->assign('data',$data);
        $this->display();
        unset($_SESSION['goods']);
        unset($_SESSION['memberdiscount']);
        unset($_SESSION['membername']);
        unset($_SESSION['membermoney']);
        unset($_SESSION['memberphone']);
    }
    //订单支付
    public function payorder(){
		if(!$_SESSION['goods']){
			echo "<script>alert('请先选择商品！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";exit;
		}
    //判断活动商品扣款，预付款是否足够支付
		$cat_new = '0';
		foreach($_SESSION['goods'] as $v){
			$jk['gid'] = $v['gid'];
			$bss = M('movable_goods')->where($jk)->find();
			if($bss){
				if($bss['start_time']<=time()&&time()<=$bss['end_time']){
				$cat_bss = $bss['withhold']*$v['num'];
				$cat_new = $cat_bss+$cat_new;
			}
			}
		}
        $mon_by['username']=$_SESSION['boss_classify'];
        $mon_mo=M('home_user')->where($mon_by)->find();
        $mon = $mon_mo['monney']-$cat_new;
        if($mon<=0){
            session('monney',$mon_mo['monney']);
			echo "<script>alert('店铺余额不足支付活动扣款商品，请及时充值！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}else{		
        $a=$_REQUEST['da'];
        $order=D('user_order');
        $data=$order->addorder(I('get.')); 
        if(is_array($data)){
            $data1=$_SESSION['goods'];
            //保存order_goods
            foreach($data1 as $key => $value)
            {
                $data2[$key]['gid']=$value['gid'];
                $data2[$key]['num']=$value['num'];
                $data2[$key]['date']=$data['date'];
                $data2[$key]['username']= $_SESSION['username']; 
                $data2[$key]['parentid']=$data['orderid'];
                $ordergoods=M('order_goods');
                $list=$ordergoods->add($data2[$key]);
            }		
            if($list)
            {
                //减少库存，增加销量
                $map['parentid']=$data['orderid'];
                $map['boss_classify']=$_SESSION['boss_classify'];
                $list1=M('order_goods')->where($map)->select();
                foreach ($list1 as $key=>$value)
                {
                    $map1['gid']=$value['gid'];
                    $map1['boss_classify']=$_SESSION['boss_classify'];
                    $goods=M('user_goods');
                    $list2[$key]=$goods->where($map1)->select();
                    $data1[$key]['gnum']=$list2[$key][0]['gnum']-$value['num'];
                    $data1[$key]['snum']=$list2[$key][0]['snum']+$value['num'];
                    $goods->where($map1)->save($data1[$key]);
                    if($list2[$key][0]['correlation_gid']){
                        $cat_where['gid'] = $list2[$key][0]['correlation_gid'];
                        $cat_where['boss_classify']=$_SESSION['boss_classify'];
                        $cat_path=M('user_goods')->where($cat_where)->find();
                        if($cat_path){
                    if($data1[$key]['gnum']<0){
                        //判断关联商品，件数的减少，零售商品的增加
                        $a=ceil(abs($data1[$key]['gnum'])/$list2[$key][0]['correlation_num']);
                        $b=abs($data1[$key]['gnum'])%$list2[$key][0]['correlation_num'];
                        $map2['gid']=$list2[$key][0]['correlation_gid'];
                        $map2['boss_classify']=$_SESSION['boss_classify'];
                        $list3=$goods->where($map2)->find();
                        $list3['gnum']-=$a;
                        $list3['snum']+=$a;
                        $goods->where($map2)->save($list3);
                        $data2['gnum']=$list2[$key][0]['correlation_num']-$b;
                        $goods->where($map1)->save($data2);
                    }
                    }
                    }
                }  
		    //判断是否是活动商品,是否扣预付款
		if($_SESSION['isleague']=='1'){	
		foreach ($data1 as $key => $value){
                $data3[$key]['gid']=$value['gid'];
        }
        $movablegoods=D('movable_goods');
        $data4=$movablegoods->findmovablegoods($data['orderid']);
		}				
                if($a==1){
                    $this->redirect('bill',I('get.'));
                }else{
                    unset($_SESSION['goods']);
                    unset($_SESSION['memberdiscount']);
                    unset($_SESSION['membername']);
                    unset($_SESSION['membermoney']);
                    unset($_SESSION['memberphone']);
                    $this->redirect('index');
                }
            }
        }
	}
    }
   //订单管理
    public function ordermanage()
    {  
        $order=D('user_order');
        if(IS_POST){
            $list2=$order->ordersearch(I('post.'));
            if(is_array($list2)){
                foreach ($list2 as $value){
                    $arr[]=$value['orderid'];
                }
                $list3=$order->selectdetaildata($arr);
                $this->assign('list2',$list2);
                $this->assign('id','1'); 
                $this->assign('list3',$list3);			
            }
        }else{
            $list=$order->selectdata();
                if(is_array($list)){
                    $list1=$order->selectdetaildata();
                $this->assign('list',$list);
                $this->assign('list1',$list1);                
            }
        }        
        $this->display();
    }
    //订单详情
    public function orderdetail(){
        $orderdetail=D('user_order');
        $list=$orderdetail->findordetail(I('get.'));
        if(is_array($list)){
            $orderdetail=M('order_goods');
            $map['parentid']=$_GET['id'];
            $map['boss_classify']=$_SESSION['boss_classify'];
            $list1=$orderdetail->where($map)->select();
            foreach($list1 as $key=>$value){
                $data[$key]['num']=$value['num'];
                $map1[$key]['gid']=$value['gid'];
                $map1[$key]['boss_classify']=$_SESSION['boss_classify'];
                $list2[$key]=M('user_goods')->where($map1[$key])->find(); 
                $data[$key]['gid']=$list2[$key]['gid'];  
                $data[$key]['gname']=$list2[$key]['gname'];
                $data[$key]['gsale']=$list2[$key]['gsale'];
                $data[$key]['gbid']=$list2[$key]['gbid'];
            }
            $this->assign('data',$data);
            $this->assign('list',$list);
        }
        $this->display();
    }
    //商品退货处理页面
    public function returngoodsshow()
    {   
        if(empty($_POST))
        {
        }else
        {
            $orderid=I("post.orderid");
            $_SESSION['orderid']=$orderid;
            $user=D('user_order');
            $discount=$user->ismember($orderid);
            $list = $user->relation(true)->select($orderid);
            $data=$list[0]['order_goods'];
            $date=$list[0]['date'];     
            foreach ($data as $key => $value)
            {
                $good[$key]['date']=$date;
                $good[$key]['gid']=$value['gid'];
                $good[$key]['phone']=$_SESSION['username'];
                $good[$key]['num']=$value['num'];
                foreach ($good as $key => $value)
                {
                    $arr[]=$value['gid'];
                }
            }
            $cat=array_unique($arr);
            foreach ($cat as $key => $value)
            {
                $map['gid']=$value;
                $map['boss_classify']=$_SESSION['boss_classify'];
                $goods[]=M('user_goods')->where($map)->select();
            }
            foreach ($data as $key => $value)
            {
                $good[$key]['gname']=$goods[$key][0]['gname'];
                $good[$key]['gsale']=$goods[$key][0]['gsale']; 
                $good[$key]['discount']=$discount;
                $good[$key]['total']=$discount*$good[$key]['gsale']*$good[$key]['num'];
               
            }
           
           
            $this->assign('good',$good);
            $this->display();
        }
    }
    //退货处理文本框
    public function returngoods()
    {
        $data['gid']=I('get.gid');
        $this->assign('data',$data);
        $this->display();
    }
    //退货处理功能
    public function goodsreturnresult()
    {
           $map['gid'] = I('get.gid');
           $map['parentid'] = $_SESSION['orderid'];
           $map1['gid']=I('get.gid');
           $map1['boss_classify']=$_SESSION['boss_classify'];
           $orderid=$_SESSION['orderid'];
           $returnnum = $_POST['num'];
		   if((floor($returnnum) - $returnnum)!=0){
			 echo "<script>alert('请输入大于0且为整数的数量');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";			
		   }else{
			if($returnnum>=1){
			   $ruturnmessage=M('order_goods');
			   $list=$ruturnmessage->where($map)->find();
			   $lastnum=$list['num']-$returnnum;
               if($lastnum<0){
             echo "<script>alert('退货失败，退货数量大于购买数量，无法执行退货');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";							   
			   }else{
			   $data['num']=$lastnum;
			   $data['returnnum']=$returnnum;
			   $ruturnmessage->where($map)->save($data);
			   $goods=M('user_goods');
			   $list1=$goods->where($map1)->find();
			   $list1['gnum']+=$returnnum;
			   $list1['snum']-=$returnnum;
			   $list2=$goods->where($map1)->save($list1);
			   $orderid=$_SESSION['orderid'];
			   $user=D('user_order');
			   $list2=$user->where($orderid)->find();
			   $discount=$user->ismember($orderid);
			   $data2['order_money']=$list2['order_money']-$list1['gsale']*$discount*$returnnum;
			   $list3=$user->where("orderid=$orderid")->save($data2);
			   //判断是否是活动产品，是否扣预付款功能
			   if($_SESSION['isleague']==1){
				$movable=D('movable_goods');
				$movable->ismovable($_SESSION['orderid'],$returnnum,$map['gid']);   
			   }
			   unset($_SESSION['orderid']);
			   if($list3){
				   $this->redirect('index');
			   }  
		  }
		} else{
			echo "<script>alert('请输入大于0且为整数的数量');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}  
		}
          
    }
    
}