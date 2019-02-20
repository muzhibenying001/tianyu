<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\project\tptianyu\public/../application/admin\view\login\index.html";i:1549973350;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ly.admin登录</title>

<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" href="/static/admin/css/loginMy.css"/>


<style>
html,body{width:100%;}

.captcha{
	position: absolute;
	height: 40px;
	margin-left: -117px;
	margin-top: 23px;
	border-radius: 3px;
}
#check{
	margin-top:30px;
	width: 15px;
	height: 15px;
}
</style>

</head>
<body>

<div class="main">

	<div class="center">
		<form action="" id="formOne" method="post">
			<i class="Hui-iconfont Cone"> &#xe62d; | </i>
			<input type="text" name="username" id="user" placeholder="用户名" onblur="checkUser()"/>
			<span id="user_pass"></span>
			<br/>
			<i class="Hui-iconfont Cone"> &#xe605; | </i>
			<input type="password" name="password" id="pwd" placeholder="密码" onblur="checkUser1()"/>
			<span id="pwd_pass"></span>
			<br/>
			<i class="Hui-iconfont Cone"> &#xe613; | </i>
			<input type="text" name="captcha" id="surePwd" placeholder="验证码" onblur="checkUser2()"/>
			<img src="<?php echo captcha_src(); ?>" class="captcha" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()" />
			<span id="surePwd_pass" ></span><br/>

			<input type="checkbox" value="rememberMe" name="rememberMe" id="check" /> 
			<label for="check">七天免登陆</label>

			<input type="submit" value="登录" id="submit" onclick="return submitB('<?php echo url('admin/index/index'); ?>','<?php echo url('admin/login/login'); ?>')">
			<br/>
		</form>
	</div>
	
</div>


<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/admin/js/loginMy.js"></script>

</body>
</html>