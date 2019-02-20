<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\project\tptianyu\public/../application/admin\view\index\index.html";i:1549052182;s:54:"E:\project\tptianyu\application\admin\view\layout.html";i:1549008459;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />

<link rel="stylesheet" type="text/css" href="/static/admin/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/css/style.css" />

<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/admin/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/static/admin/h-ui.admin/js/H-ui.admin.page.js"></script> 

<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="<?php echo url('admin/index/index'); ?>">L-uo.ying.admin</a><a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="<?php echo url('admin/order/add'); ?>"><i class="Hui-iconfont">&#xe616;</i> 单子</a></li>
							<li><a href="<?php echo url('admin/manager/create'); ?>"><i class="Hui-iconfont">&#xe613;</i> 成员</a></li>
							<li><a href="<?php echo url('admin/games/add'); ?>"><i class="Hui-iconfont">&#xe620;</i> 副本</a></li>
							<li><a href="<?php echo url('admin/user/add'); ?>"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li><?php echo \think\Request::instance()->session('manager_info.username'); ?></li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo \think\Request::instance()->session('manager_info.nickname'); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
							<li><a href="#">切换账户</a></li>
							<li><a href="<?php echo url('admin/login/logout'); ?>">退出</a></li>
						</ul>
					</li>
					<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>

<title>L-uo.ying.admin</title>
<script>
$(function(){
	/*给订单列表设置selected*/
	$('#menu-article dt:first').attr('class','selected');
	$('#menu-article dd:first').show();
});
</script>
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a> 
		<span class="c-999 en">&gt;</span>
		<span class="c-666">我的桌面</span> 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<p class="f-20 text-success">欢迎 <font color="red"> <?php echo \think\Request::instance()->session('manager_info.nickname'); ?></font>
				<span class="f-14 showtime"> 今天是 <?php echo date('Y年m月d日 H:i:s'); ?></span>
				</p>
			<p>  Have a good time  <span class="Hui-iconfont">&#xe68e;</span></p>
			<p>上次登录IP：<?php echo \think\Request::instance()->session('manager_info.last_login_ip'); ?> - <?php echo \think\Request::instance()->session('manager_info.last_login_city'); ?>  上次登录时间：<?php echo date('Y-m-d H:i:s',\think\Request::instance()->session('manager_info.last_login_time')); ?></p>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th colspan="7" scope="col">信息统计</th>
			</tr>
					<tr class="text-c">
						<th>统计</th>
						<th>订单总数</th>
						<th>未付款订单</th>
						<th>单子总金额</th>
						<th>实收金额</th>
						<th>应发工资</th>
						<th>已发工资</th>
			</tr>
		</thead>
				<tbody>
					<tr class="text-c">
						<td>近三个月</td>
						<td><?php echo $order_all['all_count']; ?></td>
						<td><?php echo $order_all['all_count'] - $order_all['received_count']; ?></td>
						<td> ￥ <?php echo $order_all['all_tot'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['received_real'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['real_salary'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['received_real'] / 100; ?></td>
			</tr>
					<tr class="text-c">
						<td>近一个月</td>
						<td><?php echo $order_all['d_all_count']; ?></td>
						<td><?php echo $order_all['d_all_count'] - $order_all['d_received_count']; ?></td>
						<td> ￥ <?php echo $order_all['d_all_tot'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['d_received_real'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['d_real_salary'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['d_received_real'] / 100; ?></td>
			</tr>
					<tr class="text-c">
						<td>本月</td>
						<td><?php echo $order_all['m_all_count']; ?></td>
						<td><?php echo $order_all['m_all_count'] - $order_all['m_received_count']; ?></td>
						<td> ￥ <?php echo $order_all['m_all_tot'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['m_received_real'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['m_real_salary'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['m_received_real'] / 100; ?></td>
			</tr>
					<tr class="text-c">
						<td>本周</td>
						<td><?php echo $order_all['w_all_count']; ?></td>
						<td><?php echo $order_all['w_all_count'] - $order_all['w_received_count']; ?></td>
						<td> ￥ <?php echo $order_all['w_all_tot'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['w_received_real'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['w_real_salary'] / 100; ?></td>
						<td> ￥ <?php echo $order_all['w_received_real'] / 100; ?></td>
			</tr>
		</tbody>
	</table>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col"><?php echo date('Y.m月 -- ',mktime( 0,0,0,date('m'),1,date('y') ) ); ?> 其它信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th width="30%">上个月 提成最高</th>
				<td>
					<span id="lbServerName"><?php echo $last_top_bonus['name']; ?>&emsp;￥<?php echo $last_top_bonus['bonus']; ?>&emsp;<?php echo $last_top_bonus['count']; ?>单
					</span>
				</td>
			</tr>
			<tr>
				<th width="30%">上个月 工资最高</th>
				<td>
					<span id="lbServerName"><?php echo $last_top_salary['nickname']; ?>&emsp;￥<?php echo $last_top_salary['salary']; ?>&emsp;<?php echo $last_top_salary['count']; ?>单
					</span>
				</td>
			</tr>
			<tr>
				<th width="30%">上次工资发放时间</th>
				<td><span id="lbServerName"><?php echo date('Y-m-d H:i:s',$last_grant); ?></span></td>
			</tr>			
		</tbody>
	</table>
</article>
		<footer class="footer">
			<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br> Copyright &copy;2015 H-ui.admin v3.0 All Rights Reserved.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
</footer>
</div>
</section>
<script>
$(function(){
	/*首页时间显示*/

	setInterval(function(){
		var time = clock();
		$('.showtime').html(' 今天是 '+time);

	},1000);


});
/*时间显示函数*/
function clock(){
	var thistime = new Date();
	var year = thistime.getFullYear();
	var month = thistime.getMonth() + 1;
	var day = thistime.getDate();
	var hours = thistime.getHours();
	var minutes = thistime.getMinutes();
	var seconds = thistime.getSeconds()

	if( eval(hours) < 10 ) hours = '0' + hours;
	if( eval(minutes) < 10 ) minutes = '0' + minutes;
	if( eval(seconds) < 10 ) seconds = '0' + seconds;
	if( eval(month) < 10 ) month = '0' + month;
	if( eval(day) < 10 ) day = '0' + day;

	thistime = year + '年'+ month + '月' + day + '日 ' + hours + ':' + minutes + ':' + seconds;
	return thistime;
}
</script>

<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
	<?php foreach($top_auth as $top_v): ?>
		<dl id="menu-article">
			<dt <?php if((\think\Request::instance()->controller() == $top_v['auth_c'])): ?>class='selected'<?php endif; ?>>
				<i class="Hui-iconfont"><?php echo $top_v['font_icon']; ?></i> <?php echo $top_v['name']; ?>
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd <?php if((\think\Request::instance()->controller() == $top_v['auth_c'])): ?>style='display:block;'<?php endif; ?>>
				<ul>
				<?php foreach($two_auth as $two_v): if($two_v['pid'] == $top_v['id']): ?>
					<li><a href="<?php echo url('admin/'.$two_v['auth_c'].'/'.$two_v['auth_a']); ?>" title="<?php echo $two_v['name']; ?>"><?php echo $two_v['name']; ?></a></li>
					<?php endif; endforeach; ?>
				</ul>
			</dd>
		</dl>
	<?php endforeach; ?>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>


