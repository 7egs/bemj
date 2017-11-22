<?php
/**
 * 登录模块
 * 廖海峰
 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	//加载登录页面
	protected $model;
	public function _initialize(){
	    $this->check();
		$this->model = D('home_user');//user是表名
	}
	protected function check(){
	    if(session('?boss_classify')){
	        $this->redirect('Index/index');
	    }
	}
    public function index(){                
    		$this->display();    		
    }
    //登陆处理
    public function login(){
    	if(IS_POST){
    		//查询数据库            
            $data = $this->model->login(I('post.'));
     		if(is_array($data)){
     			$this->success('登陆成功',U('Index/index'));
     		}else{
     			$this->error($data);
     		}
    	}
    }
    //找回密码操作
    public function password(){
    	if(IS_POST){
    		$data = $this->model->back(I('post.'));  
    		if(is_array($data)){
    			$this->success('修改成功，请登录',U('Login/index'));
    		}else{
    			$this->error($data);
    		}  	   		
    	}else{
    		$this->display();
    	}
    }
    //验证码生成
    public function ajax(){
    	$id['username'] = $_POST['id'];
    	$pass = rand(100000,999999);
    	$boss = M('home_user')->where($id)->find(); 
    	$staff = M('shop_staff')->where($id)->find(); 
    	if($boss){
    		$this->duanxin($_POST['id'],$pass);
    		session('pass',$pass,300);  
    	}else{
    		if($staff){
    		$this->duanxin($_POST['id'],$pass);
    		session('pass',$pass,300);
    		}else{
    			echo '手机号不存在';
    		}  		
    	}   	
    }
    //发送短信操作
    public function duanxin($phone,$cat){
        header("content-Type: text/html; charset=Utf-8");
        $post_data = array();
        $post_data['userid'] = 3015;
        $post_data['account'] = 'xzlxzl';
        $post_data['password'] = 'zhang987';
        $post_data['content'] = '【百米e家】您的验证码为'.$cat.'请在5分钟内输入。'; //短信内容需要用urlencode编码下
        $post_data['mobile'] = $phone;
        $post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
        $url='http://114.55.11.126:8888/sms.aspx?action=send';
        $o='';
        foreach ($post_data as $k=>$v)
        {
           $o.="$k=".urlencode($v).'&';
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
         $result = curl_exec($ch);
         echo "发送成功";
    }   
}
?>