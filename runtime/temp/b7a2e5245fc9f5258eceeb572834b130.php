<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\project\tptianyu\public/../application/admin\view\games\index.html";i:1550666400;s:54:"E:\project\tptianyu\application\admin\view\layout.html";i:1549008459;}*/ ?>
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
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		副本管理
		<span class="c-gray en">&gt;</span>
		副本列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="16">副本列表</th>
					</tr>
					<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="30">ID</th>
							<th width="800">副本分类</th>
							<th>操作</th>
						</tr>

				</thead>
				<tbody id="Huifold1" class="Huifold">

					<?php foreach($games as $g): ?>
					<tr class="item">
						<td class="text-c"><input type="checkbox" value="<?php echo $g['id']; ?>" name=""></td>
						<td class="text-c"><?php echo $g['id']; ?></td>
						<td><h4 style="background: none;font-weight: 500;font-size: 12px;">★----- <?php echo $g['name']; ?> <b> + </b> </h4></td>
						<td class="td-manage text-c">
							<a title="编辑" href="javascript:;" onclick="admin_edit('副本编辑','<?php echo url('admin/games/edit',['id'=>$g['id']]); ?>')" class="ml-5" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe6df;</i> </a>  
							<a title="删除" href="javascript:;"  class="ml-5" style="text-decoration:none"> 
							<i class="Hui-iconfont">&#xe6e2;</i> </a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</article>
	</div>
</section>
<!-- 分类列表结束 -->
<!-- 脚部信息 -->

<!-- 脚部信息结束 -->
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*副本-编辑*/
function admin_edit(title,url){

	layer.open({
      type: 2,
      title: title,
      area: ['600px', '360px'],
      shadeClose: true, //点击遮罩关闭
      content: url,
    });
}
/*5个参数顺序不可打乱，分别是：相应区,隐藏显示的内容,速度,类型,事件*/

jQuery.Huifold = function(obj,obj_c,speed,obj_type,Event){

	$(obj).bind(Event,function(){
		$(this).attr('class','selected');
		var id = $(this).closest('tr').find('input:checkbox').val();
		var that = $(this);
		if( $('table').find('.info').is(':visible') ){
			$(that).find("b").html("+");
			$('table').find('.info').remove();
			return;
/*					// $(that).closest('tr').next().slideUp(speed).end().removeClass("selected");
			$(that).closest('tr').find("b").html("+")*/
		}		
		/*发送ajax*/
		$.ajax({
			'url'	: "<?php echo url('admin/AjaxApi/gameread'); ?>",
			'type'	: 'post',
			'data'	: 'parent_id='+id,
			'dataType'	: 'json',
			'success'	: function(res){
				if( res.code != 10000 ) return;
				var data = res.data; //外层数组。里层是多个json对象
				var html = '';
				$(that).find("b").html("-");
				$.each(data, function(i,v){					
					html += '<tr class="info" parent_id="2">';
					html += '<td class="text-c"><input type="checkbox" value="'+ v.id +'" name=""></td>';
					html += '<td class="text-c">'+ v.id +'</td>';
					html += '<td>---> '+ v.name +' ☆</td>';
					html += '<td class="td-manage text-c">';
					html += '<a title="编辑" href="javascript:;" onclick="admin_edit(\'副本编辑\',\"<?php echo url('admin/games/edit'); ?>\?id="'+ v.id +')" class="ml-5" style="text-decoration:none">';
					html += '<i class="Hui-iconfont">&#xe6df;</i> </a>';
					html += '<a title="删除" href="javascript:;"  class="ml-5" style="text-decoration:none"> ';
					html += '<i class="Hui-iconfont">&#xe6e2;</i> </a> ';
					html += '</td>';
					html += '</tr>';
				});

				$(that).closest('tr').after(html);
			}
		});
	});
}



$(function(){
	$.Huifold("#Huifold1 .item h4","#Huifold1 .info","fast",1,"click"); 

});

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


