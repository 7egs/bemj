<?php if (!defined('THINK_PATH')) exit();?>		<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<title>收银系统</title>
<link rel="stylesheet" type="text/css" href="/bmej/Public/home//css/index.css">
</head>
<body style = "min-width:950px;height:700px">
<!--头部-->
	<div class="top">
      <div class="logo">
          <img src="/bmej/Public/home//img/logo.png" width="90" style="margin-top:15px;"/>
       </div>
       <div class="name">     
          <ul style = "float:left;">
            <li style = "width:200px;margin-top:20px;"> <p>店铺ID：<?php echo $_COOKIE['id']?></p></li>
            <li style = "width:200px;margin-top:20px;"><p>店铺名称：<?php echo $_COOKIE['classify']?></p></li>
          </ul >
          <ul style = "float:left;">
            <li style = "width:200px;margin-top:20px;"><p>店铺管理员：<?php echo $_COOKIE['home_name']?></p></li>
            <li style = "width:200px;margin-top:20px;">
			<?php if($_SESSION['isleague']=="1"){?>
			<p>店铺余额：<?php echo $_SESSION['monney'] ?><a href = "##" style = "color:blue;font-size:12px;">充值</a></p>
			<?php  }else{ ?>
			<p>店铺地址：<?php echo $_COOKIE['address']?>  </p>
			<?php  } ?>
			</li> 
		  </ul>	
          <ul style = "float:left;">
            <li style = "width:250px;margin-top:20px;"> <a href="javascript:location.reload();" style ="margin-right:10px;">刷新页面</a><a href = '<?php echo U("Common/outback");?>' onClick="return confirm('确定退出?');">退出</a></li>		  
            <li style = "width:250px;margin-top:20px;"><p>当前时间：<span id="show"></span></p>
 <script type="text/javascript">
  var show = document.getElementById("show");
  setInterval(function() {
   var time = new Date();
   // 程序计时的月从0开始取值后+1
   var m = time.getMonth() + 1;
   var t = time.getFullYear() + "-" + m + "-"
     + time.getDate() + " " + time.getHours() + ":"
     + time.getMinutes() + ":" + time.getSeconds();
   show.innerHTML = t;
  }, 1000);
</script>
            </li>
          </ul>
		  <ul>
		     <a></a>
			 <a></a>
		  </ul>
       </div>
         
     </div>
    <div class="option">
    	<div class="left">
            <ul style = "height:580px;overflow-x:hidden;">
            	<li><a href='<?php echo U("Index/index");?>'>
                  <p><img src = "/bmej/Public/home//img/ico/chaoshi.png"/>超市管理</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                  <p><img src = "/bmej/Public/home//img/ico/jiazheng.png"/>家政服务</p>             
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                  <p><img src = "/bmej/Public/home//img/ico/dinggou.png"/>订购服务</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                  <p><img src = "/bmej/Public/home//img/ico/kuaidi.png"/>快递管理</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                   <p><img src = "/bmej/Public/home//img/ico/guanggao.png"/>广告业务</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                   <p><img src = "/bmej/Public/home//img/ico/xiyi.png"/>洗衣服务</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                   <p><img src = "/bmej/Public/home//img/ico/fangwu.png"/>房屋查询</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                   <p><img src = "/bmej/Public/home//img/ico/lvyou.png"/>旅游业务</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                   <p><img src = "/bmej/Public/home//img/ico/qiche.png"/>汽车租赁</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' style = "cursor:pointer">
                   <p><img src = "/bmej/Public/home//img/ico/chongzhi.png"/>充值业务</p>
                </a></li>
                <li><a onclick ='javascript:alert("此功能正在研发中,敬请期待...");' >
                   <p><img src = "/bmej/Public/home//img/ico/duanxin.png"/>短信管理</p>
                </a></li>
                <li><a href='<?php echo U("Member/index");?>'>
                   <p><img src = "/bmej/Public/home//img/ico/huiyuan.png"/>会员管理</p>
                </a></li>
                <li><a href='<?php echo U("System/index");?>'>
                   <p><img src = "/bmej/Public/home//img/ico/xitong.png"/>系统设置</p>
                </a></li>
                <li><a href='<?php echo U("Help/index");?>'>
                   <p><img src = "/bmej/Public/home//img/ico/bangzhu.png"/>帮助</p>
                </a></li>              
            </ul>
        </div>
        <div class="right">
        	<!--右边用iframe标签分一个浏览器出来 宽度和高度是class=r的宽度高度
            frameborder="0" 是去掉分出来的额浏览器的边框
            scrolling="auto" 给浏览器自动加滚动条
            src='' 是；浏览器现实的页面的地址
            -->
        <iframe src='<?php echo U("GoodsManage/goodsmanageshow");?>' frameborder="0" scrolling="auto" style="width:100%">
        </iframe>    	
        </div>
          <div class="cle"></div>
        </div>


</body>
</html>
<script src="/bmej/Public/home//js/jquery.js"></script>
<script>
/*然后给左边的导航点击事件  点击就改变src属性的地址*/
function change_url(i){  //相当于 将aa.html 传值给了i  在函数中i的值就等于传来的值 aa.html  传的值不同 i就不同
  $('iframe').attr('src',i); // 将iframe标签的src属性值该为i     
	}


</script>这是尾部</div>