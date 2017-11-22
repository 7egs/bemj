<?php
/**
 * 公共控制器
* 廖海峰
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
       $this->checkLogin();
    }
    protected function checkLogin(){
        //判断是否有登录
        if(!session('?boss_classify')){
            $this->redirect('Login/index');        
        }   
    }
	public function outback(){
		$_SESSION = array(); //清除SESSION值.  
          if(isset($_COOKIE[session_name()])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.  
                setcookie(session_name(),'',time()-1,'/');  
            }  
                session_destroy();  //清除服务器的sesion文件  
			$this->success('退出成功',U('Login/index'));	
	}
}

?>