<?php 
/**
 * 会员用户表
 * 廖海峰
 * 2017.9.1-2017.9.2
 */
namespace Home\Model;
use Think\Model;
use Think\Page;
class UserMemberModel extends Model{
    protected $_validate = array(
        array('membername','require','会员名字不能为空'),
        array('memberphone','require','会员手机号码不能为空'),  
        array('memberphone','/^1(3[0-9]|47|5((?!4)[0-9])|7(0|1|[6-8])|8[0-9])\d{8,8}$/','手机号码不存在'),
    );
    //增加会员方法
	public function addmember($temp)
	{
	    $map['memberphone'] = $temp['memberphone'];
	    $map['membertype'] = $temp['membertype'];
	    $map['membername'] = $temp['membername'];
	    $map['membersex'] = $temp['membersex'];
	    $map['membermoney'] = $temp['membermoney'];
	    $map['memberpoint'] = $temp['memberpoint'];
		if(!is_numeric($map['membermoney'])){
			$map['membermoney']=0;			
		}
		if(!is_numeric($map['memberpoint'])){
			$map['memberpoint']=0;			
		}		
	    $map['memberbirthday'] = $temp['memberbirthday'];
	    $map['memberdate']=time();
	    $map['boss_classify']=$_SESSION['boss_classify'];
		$data['boss_classify']=$_SESSION['boss_classify'];
		$data['memberphone']=$temp['memberphone'];
	    if (!$this->create($map)){ // 创建数据对象
	        // 如果创建失败 表示验证没有通过 输出错误提示信息
	        return $this->getError(); 
	    }else{
	        $list=$this->where($data)->find();
			if(is_array($list)){
				 echo "<script>alert('会员已存在');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			}else{
		    // 验证通过 写入新增数据
	       $data=$this->add($map);
		    if($data){
	        return $data;
	        }else{
	        return '添加失败';
	        }
			}			
	    }		
	}
	//搜索引擎
	public function ske($temp){	       	
		if(!$this->create($temp)){
			return $this->getError(); 
		}
	    $temp['boss_classify']=$_SESSION['boss_classify'];  		
		$list = $this->where($temp)->find();
			//dump($list);exit;		
		if(is_array($list)){
            $id['id'] = $list['membertype'];
            $listold = M('member_type')->where($id)->select();
            $data['0']['memberphone']=$list['memberphone'];
            $data['0']['membername']=$list['membername'];
            $data['0']['membermoney']=$list['membermoney'];
            $data['0']['memberpoint']=$list['memberpoint'];
            $data['0']['memberbirthday']=$list['memberbirthday'];
            $data['0']['membersex']=$list['membersex'];
            $data['0']['memberdate']=$list['memberdate'];
            $data['0']['type_name']=$listold[0]['type_name'];            
            $data['0']['member_discount']=$listold[0]['member_discount'];
            if($data['0']['type_name']==""){
                $data['0']['type_name']="此会员未分类";
                $data['0']['member_discount']=1;
       }        
			return $data;
	   }else{
			echo "<script>alert('手机号码不存在');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	   }
		
	}
	//ajax查询会员信息方法
	public function selectmember($phone)
	{
	    $map['boss_classify']=$_SESSION['boss_classify'];
	    $map['memberphone']=$phone;
	    $list=$this->where($map)->find();
	    if($list)
	    {
            $_SESSION['memberphone']=$phone;
			return $list;
		}else{
			 $catch['membername'] ="查无此会员";
             $catch['membermoney'] ="查无此会员";
             $catch['memberphone'] ="查无此会员";
             $catch['memberpoint'] ="查无此会员";
			return $catch;
		}
	}
    //显示会员信息
	public function showmemebermessage()
	{
	    $map['boss_classify']=$_SESSION['boss_classify'];    
        $list=$this->where($map)->select();
        foreach($list as $key=>$val){
            $id['id'] = $val['membertype'];
            $listold = M('member_type')->where($id)->select();
            $data[$key]['memberphone']=$val['memberphone'];
            $data[$key]['membername']=$val['membername'];
            $data[$key]['membermoney']=$val['membermoney'];
            $data[$key]['memberpoint']=$val['memberpoint'];
            $data[$key]['memberbirthday']=$val['memberbirthday'];
            $data[$key]['membersex']=$val['membersex'];
            $data[$key]['memberdate']=$val['memberdate'];
            $data[$key]['type_name']=$listold[0]['type_name'];            
            $data[$key]['member_discount']=$listold[0]['member_discount'];
            if($data[$key]['type_name']==""){
                $data[$key]['type_name']="此会员未分类";
                $data[$key]['member_discount']=1;
            }
       }      
	   if(is_array($data)){
	       return $data;
	   }else{
	       return false;
	   }

    	}
	//修改会员权限方法
	public function savemembermessage($a,$b)
	{
	    $map['memberphone']=$b;
	    $map['boss_classify']=$_SESSION['boss_classify'];
	    $data['membertype']=$a;
	    $list=$this->where($map)->save($data);
	    if($list){
	        return $list;
	    }else{
	        echo "<script>alert('会员权限未进行任何修改');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";   
	    }
	    
	}
	//金钱，积分充值方法
	public function addmoney($temp1,$temp2)
	{
	    $map['memberphone']=$temp1['phone'];
	    $map['boss_classify']=$_SESSION['boss_classify'];
	    $money=$temp2['money'];
	    $point=$temp2['point'];
		if($point==0 && $money==0){
			 echo "<script>alert('充值失败，请确认充值数额');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}		
	    $data=$this->where($map)->find();
	    $data['membermoney']+=$money;
	    $data['memberpoint']+=$point;
	    $list=$this->where($map)->save($data);						
		$data2['convert_money']=$money;
		$data2['convert_point']=$point;
		$data2['boss_classify']=$_SESSION['boss_classify'];
		$data2['username']=$_SESSION['username'];
		$time = time();
		$data2['convert_money_date'] = $time;
		$data2['convert_point_date'] = $time;
		$data2['parentphone']=$temp1['phone'];
		
		if($point!=0){
			$list1=M('point_save')->add($data2);
		}
		if($money!=0){
			$list1=M('money_save')->add($data2);
		}
		
		
		
	    if($list){
	        return $list;
	    }else{
	        echo "<script>alert('充值失败，请输入积分和金钱');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	    }
	   
	} 
	//金钱,积分扣除方法
	public function delmoney($temp1,$temp2)
	{
	    $map['memberphone']=$temp1['phone'];
	    $map['boss_classify']=$_SESSION['boss_classify'];
	    $money=$temp2['money'];
	    $point=$temp2['point'];
		if($point==0 && $money==0){
			 echo "<script>alert('扣除失败，请确认充值数额');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}	
	    $list=$this->where($map)->find();
		$list['membermoney']-=$money;
	    $list['memberpoint']-=$point;
		if($list['membermoney']<0||$list['memberpoint']<0){
			 echo "<script>alert('账户不足以支付，请重新确认');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}else{
	    $data=$this->where($map)->save($list);
		}	   
		$data2['convert_money'] = "-".$money;
		$data2['convert_point'] = "-".$point;
		$data2['boss_classify'] = $_SESSION['boss_classify'];
		$data2['username'] = $_SESSION['username'];
		$time = time();
		$data2['convert_money_date'] = $time;
		$data2['convert_point_date'] = $time;
		$data2['parentphone'] = $temp1['phone'];
		
		if($point!=0){
			$list1=M('point_save')->add($data2);
		}
		if($money!=0){
			$list1=M('money_save')->add($data2);
		}
	    if($data){
	        return $data;
	    }else{
	        echo "<script>alert('扣除失败，请输入积分和金钱');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	    }
	}
}
?>