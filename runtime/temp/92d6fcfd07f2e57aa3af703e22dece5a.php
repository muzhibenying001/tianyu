<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"E:\project\tptianyu\public/../application/admin\view\games\add.html";i:1547098511;s:54:"E:\project\tptianyu\application\admin\view\layout.html";i:1549008459;}*/ ?>
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

<section class="Hui-article-box">
	<nav class="breadcrumb">
		<i class="Hui-iconfont">&#xe67f;</i> 首页 
		<span class="c-gray en">&gt;</span> 副本管理 
		<span class="c-gray en">&gt;</span> 副本分类 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
			<i class="Hui-iconfont">&#xe68f;</i>
		</a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
	<form action="<?php echo url('admin/games/save'); ?>" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>副本名：</label>
			<div class="formControls col-xs-8 col-sm-4">
				<input type="text" class="input-text" value="" placeholder="" id="username" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">副本分类：</label>
			<div class="formControls col-xs-8 col-sm-4"> <span class="select-box">
				<select class="select" size="1" name="parent_id">
					<option value="0" selected>顶级分类</option>
					<?php foreach($games as $g): ?>
					<option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
					<?php endforeach; ?>
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<div class="col-xs-4 col-sm-4 col-xs-offset-2 col-sm-offset-2">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>
	</div>
</section>

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


