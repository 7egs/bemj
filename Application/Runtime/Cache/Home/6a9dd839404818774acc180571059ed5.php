<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>帮助</title>
<style type="text/css">
body{
	width: 100%;
	height: 600px;
	font-size: 1.2em;
}
.div{
	text-align: center;
	margin-top: 109px;
}
.div>button{
    width: 170px;
    height: 55px;
    margin-left: 10px;
    background: #8cd121;
    border-radius: 10px;
    font-size: 24px;
}

.ul>li{
    text-align: center;
    background: #dcdddd;
    background-size: 100%;	
    height: 425px;
    display: none;
}
.ul>li:nth-child(1){
	display: block;
}
*{
	text-decoration: none;
	list-style: none;
	padding: 0;
	margin: 0;
}
</style>
<script src="/bmej/Public/home//js/jquery-3.2.1.min.js"></script>
</head>
<body>
<ul class="ul">
<li>
	<P>详细请咨询公司总部</P>
</li>
<li>
	<P>详细请咨询公司总部</P>
</li>
<li>
    <P>百米一家</P>    
    <P>黑马者软件技术有限公司   技术支持</P>
</li>
</ul>
<div class="div">
	<button onclick="nuxe(1)">使用说明</button>
	<button onclick="nuxe(2)">快捷键注释</button>
	<button onclick="nuxe(3)">关于我们</button>		
</div>
</body>
</html>
<script type="text/javascript">
function nuxe(num){
	var li = $('.ul>li');
	for (var i = 0; i <= li.length; i++){
		li[i].style['display'] = "none";
		if(num){li[num-1].style['display'] = "block";}
	    }
}
</script>