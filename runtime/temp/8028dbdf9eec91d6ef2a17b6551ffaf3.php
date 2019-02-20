<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\project\tptianyu\public/../application/admin\view\order\index.html";i:1550125411;s:54:"E:\project\tptianyu\application\admin\view\layout.html";i:1549008459;}*/ ?>
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

<title>L-uo.ying.单子管理</title>
<link rel="stylesheet" type="text/css" href="/lib/My97DatePicker/4.8/skin/WdatePicker.css" />

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		单子管理
		<span class="c-gray en">&gt;</span>
		单子列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 日期范围：

				<input type="text" id="datemin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" id="datemax" class="input-text Wdate" style="width:120px;">

				<input type="text" class="input-text" style="width:250px" placeholder="输入需要查询的区、服、老板信息" id="" name="">
				<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜 索</button>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
<!-- 				<span class="l"> <a href="<?php echo url('admin/order/edit'); ?>" class="btn btn-danger radius">下载单子表</a> <a href="<?php echo url('admin/order/add'); ?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加单子</a> </span> -->
<span class="l"> <a href="javascript:;" onclick="down('下载单子表','<?php echo url('admin/order/edit'); ?>')" class="btn btn-danger radius">下载单子表</a> <a href="<?php echo url('admin/order/add'); ?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加单子</a> </span>
				<span class="r">共有数据：<strong><?php echo $order_total; ?></strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg table-hover">
				<thead>
					<tr>
						<td scope="col" colspan="3">
							<span class="select-box">
								<select class="select" size="1" name="demo1" id="">
									<option value="" selected>近三个月订单</option>
									<option value="1">近三十天</option>
									<option value="2">本月</option>
									<option value="3">全部</option>
								</select>
							</span>
						</td>
						<td scope="col" colspan="3">
							<span class="select-box">
								<select class="select" size="1" name="demo1">
									<option value="">选择提成人员</option>
									<option value="1">菜单一</option>
									<option value="2">菜单二</option>
									<option value="3">菜单三</option>
								</select>
							</span>
						</td>
						<td scope="col" colspan="2">
							<span class="select-box">
								<select class="select" size="1" name="demo1">
									<option value="" selected>选择参与成员</option>
									<option value="1">菜单一</option>
									<option value="2">菜单二</option>
									<option value="3">菜单三</option>
								</select>
							</span>
						</td>
						<td scope="col" colspan="2">
							<span class="select-box">
								<select class="select" size="1" name="demo1">
									<option value="" selected>选择副本</option>
									<option value="1">菜单一</option>
									<option value="2">菜单二</option>
									<option value="3">菜单三</option>
								</select>
							</span>
						</td>
						<td scope="col" colspan="2">
							<span class="select-box">
								<select class="select" size="1" name="demo1">
									<option value="" selected>选择状态</option>
									<option value="1">已收款</option>
									<option value="2">未收款</option>
									<option value="3">工资已发放</option>
									<option value="3">工资未发放</option>
								</select>
							</span>
						</td>
					</tr>
					<tr class="text-c">
							<th>日期</th>
							<th>副本名称</th>
							<th>总金额</th>
							<th>提成人员</th>
							<th>提成金额</th>
							<th>人数</th>
							<th>成员</th>
							<th>平均工资</th>
							<th>区服</th>
							<th>老板</th>
							<th>是否付款</th>
							<th>收款,查看,删除</th>
						</tr>

				</thead>
				<tbody>
				<?php foreach($order as $o): ?>
					<tr class="text-c">
						<td><?php echo date('Y-m-d',$o['date']); ?></td>
						<td><?php echo $o['game_name']; ?></td>
						<td> ￥ <?php echo $o['total']; ?></td>
						<td><?php echo $o['bonus_name']; ?></td>
						<td> ￥ <?php echo $o['bonus_tot']; ?></td>
						<td><?php echo $o['member']; ?></td>
						<td><?php echo $o['person']; ?></td>
						<td> ￥ <?php echo $o['salary']; ?></td>
						<td><?php echo $o['area']; ?></td>
						<td><?php echo $o['boss']; ?></td>
						<?php if($o['received'] == 1): ?>
						<td class="td-status"><span class="label label-success radius">已收款</span></td>
						<td class="td-manage">
							<a style="text-decoration:none" onClick="admin_stop(this,'<?php echo url('admin/order/update'); ?>','<?php echo $o['id']; ?>')" href="javascript:;" title="未收款">
								<i class="Hui-iconfont">&#xe631;</i></a> 
							<a title="查看详情" href="javascript:;" class="ml-5" style="text-decoration:none"  onclick="particulars('详情查看','<?php echo url('admin/order/read',['id'=>$o['id']]); ?>')">
								<i class="Hui-iconfont">&#xe725;</i></a>
							<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo url('admin/order/delete'); ?>','<?php echo $o['id']; ?>')" class="ml-5" style="text-decoration:none">
								<i class="Hui-iconfont">&#xe6e2;</i></a>
						</td>
						<?php else: ?>
						<td class="td-status"><span class="label label-default radius">未收款</span></td>
						<td class="td-manage">
							<a style="text-decoration:none" onClick="admin_start(this,'<?php echo url('admin/order/update'); ?>','<?php echo $o['id']; ?>')" href="javascript:;" title="已收款">
								<i class="Hui-iconfont">&#xe615;</i></a> 
							<a title="查看详情" href="javascript:;" class="ml-5" style="text-decoration:none" onclick="particulars('详情查看','<?php echo url('admin/order/read',['id'=>$o['id']]); ?>')">
								<i class="Hui-iconfont">&#xe725;</i></a>
							<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo url('admin/order/delete'); ?>','<?php echo $o['id']; ?>')" class="ml-5" style="text-decoration:none">
								<i class="Hui-iconfont">&#xe6e2;</i></a>
						</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; ?>	
				</tbody>
			</table>
				<?php echo $order->render(); ?>
		</article>
	</div>
</section>
<script src="/static/admin/js/laydate.js"></script>
<script type="text/javascript">
$(function(){

	//执行一个laydate实例
	var month = new Date();
	laydate.render({
	  elem: '#datemin', //指定元素
	  max: 0
	  });
	  
});


/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

/*单子-删除*/
function admin_del(obj,url,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		/*发送ajax*/
		$.ajax({
			'url'		: url,
			'type'		: 'post',
			'data'		: 'id=' + id,
			'dataType'	: 'json',
			'success'	: function(res){
				if( res.code != 10000 ){
					layer.msg(res.msg,{icon: 5,time:1000});
					return;
				}

				$(obj).parents("tr").remove();
				layer.msg(res.msg,{icon:1,time:1000});
				
			}
		});
	});
}

/*单子未收款*/
function admin_stop(obj,url,id){
	layer.confirm('还未付款吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		/*发送ajax*/
		$.ajax({
			'url'		: url,
			'type'		: 'post',
			'data'		: 'id=' + id + '&received=0',
			'dataType'	: 'json',
			'success'	: function(res){
				if( res.code == 10000 ){
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,\'<?php echo url("admin/order/update"); ?>\',id)" href="javascript:;" title="未付款" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">未收款</span>');
					$(obj).remove();
					layer.msg('未收款!',{icon: 5,time:1000});
				}else{
					layer.msg(res.msg,{icon: 2,time:1000});
				}
			}
		});
	});
}

/*单子已收款*/
function admin_start(obj,url,id){
	layer.confirm('确认收到款了吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		/*发送ajax*/
		$.ajax({
			'url'	: url,
			'type'	: 'post',
			'data'	: 'id='+ id + '&received=1',
			'dataType' : 'json',
			'success':function(res){
				if(res.code == 10000){
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,\'<?php echo url("admin/order/update"); ?>\',id)" href="javascript:;" title="已收款" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已收款</span>');
					$(obj).remove();
					layer.msg('已收款!', {icon: 6,time:1000});
				}else{
					layer.msg(res.msg, {icon: 2,time:1000});
				}
			}
		});
	});
}

/*详情查看*/
function particulars(title,url){
	layer_show(title,url);
}

/*详情查看*/
function down(title,url){
	layer_show(title,url);
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


