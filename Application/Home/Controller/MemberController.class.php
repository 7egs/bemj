<?php
/**
 * 会员模块
 * 廖海峰
 * 2017.9.2-2017.9.3
 */
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class MemberController extends CommonController {
    public function index()
    {
        $this->display();
    }
    //显示会员功能
    public function member()
    {
		if(IS_POST){
			$data1 = D("user_member")->ske(I('post.'));
			if(!is_array($data1)){
               echo "<script>alert('会员不存在');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
            }
		}else{
        $data=D('user_member')->showmemebermessage();
        //$data分页
        $count=count($data);
        $p = getpage($count,15);
        $data1=array_slice($data,$p->firstRow,$p->listRows);
//        $data1['show'] =$page->show();
        $this->assign('data',$data1);
        $this->assign( 'page', $p->show());
		}
		$map['boss_classify'] = $_SESSION['boss_classify'];
		 $list = M('member_type')->where($map)->select();
		 $this->assign('data',$data1);
		 $this->assign('list',$list);
		 $this->display();
    }
    //新增会员功能
    public function addmember()
    {
        if(IS_POST)
        {
            $member = D("user_member");
            $list=$member->addmember(I('post.'));
            if(is_numeric($list)){
                $this->success('添加成功',U('member'));
            }else{
                $this->error($list,U('member'));
            }
               
        }else{
            $this->redirect('member');
        }
    } 
    //删除会员功能
    public function delmember()
    {
        $member=M('user_member');
        $map['memberphone']=$_GET['memberphone'];
        $map['boss_classify']=$_SESSION['boss_classify'];
        $member->where($map)->delete();
        $this->redirect('member');
    }
    //修改会员页面
    public function updatemembershow()
    {
        $memberphone=$_GET['memberphone'];
        $map['memberphone']=$_GET['memberphone'];
        $map['boss_classify']=$_SESSION['boss_classify'];
        $membertype=M('member_type');
        $list=$membertype->where($map)->select();
        $this->assign('memberphone',$memberphone);
        $this->assign('list',$list);
        $this->display();         
    }
    //修改会员权限
    public function updatemembertype()
    {
        $membermessage=D('user_member');
        $data=$membermessage->savemembermessage(I('post.membertype'),I('get.memberphone'));
        if($data){
            $this->success('会员权限修改成功',U('member'));
        }
        
    }
    //新增会员分类功能
    public function addmembertype()
    {  
        if(IS_POST)
        {
            $membertype=D('member_type');
			$map['type_name']=$_POST['membertype'];
			$map['boss_classify']=$_SESSION['boss_classify'];
            $data['type_name']=$_POST['membertype'];
            $data['member_discount']=$_POST['memberdiscount']; 
            $data['boss_classify']=$_SESSION['boss_classify'];
			$list=$membertype->where($map)->find();
			if(is_array($list)){
				 echo "<script>alert('会员分类已存在');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			}
            if (!$membertype->create($data)){ // 创建数据对象
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $asd = $membertype->getError();
                $this->error($asd);
            }else{
                // 验证通过 写入新增数据
                $membertype->add($data);
                $this->success('添加成功',U('member'));
            }
        }
    }
    //删除会员分类功能
    public function delmembertype()
    {
        $membertype=M('member_type');
        $map['id']=$_GET['id'];
        $membertype->where($map)->delete();
        $this->redirect('member');
    }
    //ajax显示会员信息
    public function membermessage()
    {
        if(IS_POST)
        {
           $message=D('user_member');
           $list=$message->selectmember(I('post.phone'));
           echo json_encode($list);
          }  
    }   
    //金钱,积分充值功能
    public function addmoney()
    {
        $member=D('user_member');
        $list=$member->addmoney(I('get.'),I('post.'));
        if($list){
            $this->success('充值成功，请稍后',U('member'));
        }
    }
    //金钱，积分扣除功能
    public function delmoney()
    {
        $member=D('user_member');
        $data=$member->delmoney(I('get.'),I('post.'));
        if($data){
            $this->success('扣除成功，请稍后',U('member'));
        }
    }
}