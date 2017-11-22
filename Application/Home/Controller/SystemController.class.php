<?php
/**
 * 员工模块
 * 廖海峰
 * 
 */
namespace Home\Controller;
use Think\Controller;
class SystemController extends CommonController {
	public function index(){
	    $this->display();
	}
	//执行加载页面与店面修改申请方法
    public function system(){
    	if(I('post.')){   	
    	$pass = D('home_user')->shopsave(I('post.'));//调用模型层修改店面信息方法
    	if(is_array($pass)){    	
     	$this->error('您已经于'.date("Y-m-d H:i",$pass['date']).'提交申请,还在审核中,请耐心等待5个工作日内的审核,详情请拨打客服电话咨询。','',10);
    	}
    	}    
    	$list = D('shop_staff')->shopstaff($_SESSION['boss_classify']);//调用模型层获取员工信息方法
    	$this->assign('date',$date);
    	$this->assign('list',$list);
        $this->display();      
    }
    //执行员工删除方法
    public function del(){
    	$username = $_GET['username'];
    	$list = D('shop_staff')->del($username);
    	$this->redirect('system');
    }
    //执行员工添加方法
    public function add(){
    	if(I('post.')){
    		$data = D('shop_staff')->add(I('post.'));//调用模型层添加员工方法
    		if(is_numeric($data)){
    			$this->success('添加成功',U('system'));
    		}else{
    			$this->error($data);
    		}    		
    	}else{
    		$this->display();
    	}   
    	     
    }
    //执行员工权限修改方法
    public function modify(){
    	$username = $_GET['username'];
    	if(I('post.')){
    		$data = D('staff_authority')->modify(I('post.'),$username);
    		if(is_numeric($data)){
    			$this->success('更新权限成功',U('system'));
    		}else{
    			$this->error('更新超时，请重新提交');
    		}
    	}else{
    		$this->assign('username',$username);    		
    		$this->display();
    	}   	
    }   
}