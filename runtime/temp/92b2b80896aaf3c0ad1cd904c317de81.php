<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"E:\project\tptianyu\public/../application/admin\view\salary\topay.html";i:1550666094;s:54:"E:\project\tptianyu\application\admin\view\layout.html";i:1549008459;}*/ ?>
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



<title>待发工资 - 工资管理 - H-ui.admin v3.0</title>


<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		工资管理
		<span class="c-gray en">&gt;</span>
		待发工资 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 日期范围：
				<input type="text" onfocus="" id="datemin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" onfocus="" id="datemax" class="input-text Wdate" style="width:120px;">
				<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
				<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="10">待发工资</th>
					</tr>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value=""></th>
						<th>成员</th>
						<th>待发工资</th>
						<th>未发放的单子数</th>
						<th>起始日期</th>
						<th>截止日期</th>
						<th>天数</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($salary as $s): ?>
					<tr class="text-c">
						<td><input type="checkbox" value="1" name=""></td>
						<td><?php echo $s['nickname']; ?></td>
						<td> ￥ <?php echo $s['salary']; ?></td>
						<td><?php echo $s['count']; ?></td>
						<td><?php echo date('Y-m-d',$s['min']); ?></td>
						<td><?php echo date('Y-m-d',$s['max']); ?></td>
						<td><?php echo $s['max']/86400-$s['min']/86400 + 1; ?></td>
						<td class="td-manage">
							<a title="发放工资" href="javascript:;" 
							onclick='payoff(this,"<?php echo url("admin/salary/edit"); ?>",<?php echo $s; ?>)' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a> 
							<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','admin-add.html','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
							<a title="删除" href="javascript:;" onclick="admin_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				<?php endforeach; ?>					
				</tbody>
			</table>
		</article>
	</div>
</section>

<script type="text/javascript">

/* 发放工资 */
function payoff(obj,url,pay_data){

	var tishi = '确定发放：<b>' + pay_data.nickname + '</b>&emsp;的工资吗？';

	layer.confirm(tishi,function(index){

		var data = `id=${pay_data.manager_id}&nickname=${pay_data.nickname}&total=${pay_data.salary}&sum_order=${pay_data.count}`;
		/*发送ajax*/
		$.ajax({
			'url'		: url,
			'type'		: 'post',
			'data'		: data,
			'dataType'	: 'json',
			'success'	: function(res){

				if( res.code != 10000 ){
					layer.msg(res.msg,{icon: 5,time:1000});
					return;
				}

				$(obj).parents("tr").remove();

				var htmls = '<table class="table table-border  table-bg">';
				htmls += '<thead><tr><th scope="col" colspan="5">工资发放详情&emsp;'+res.data.create_time+'</th></tr>';
				htmls += '<tr><th>成员</th><th>单子数</th>';
				htmls += '<th>工资</th><th>发放人</th></tr></thead>';
				htmls += '<tbody><tr><td>'+ res.data.manager_name +'</td>';
				htmls += '<td>'+ res.data.sum_order +'</td>';
				htmls += '<td>'+ res.data.sum_salary +'</td>';
				htmls += '<td>'+ res.data.operator +'</td></tr></tbody></table>';			

				layer.confirm('工资已发放', {
					content: htmls,
				  	btn: ['继续发放','发送邮件'] //按钮
				}, 
				function(){
				  	layer.msg('发放成功', {icon: 1});
				}, 
				function(){
				  	layer.msg('发送邮件选项', {
				    time: 20000, //20s后自动关闭
				    btn: ['直接发送', '进入待发队列']
				  	});
				});
				
			}
		});
	});
}
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>

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


