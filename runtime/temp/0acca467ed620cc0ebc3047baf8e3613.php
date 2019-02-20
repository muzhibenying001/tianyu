<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"E:\project\tptianyu\public/../application/admin\view\order\add.html";i:1550591278;s:54:"E:\project\tptianyu\application\admin\view\layout.html";i:1549008459;}*/ ?>
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

<title>L-uo.ying.单子添加</title>
<link rel="stylesheet" type="text/css" href="/lib/My97DatePicker/4.8/skin/WdatePicker.css" />
<style>
.dropDown-pos{
	position: relative;
}
.dropDown-mymenu{
	display: none;
	position: absolute;
	left: 177px;
	top: 32px;
	z-index: 100;
	width: 400px;
}
</style>
<section class="Hui-article-box">
	<nav class="breadcrumb">
		<i class="Hui-iconfont">&#xe67f;</i> 首页 
		<span class="c-gray en">&gt;</span> 订单管理 
		<span class="c-gray en">&gt;</span> 订单添加 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
			<i class="Hui-iconfont">&#xe68f;</i>
		</a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20 container-fluid">
	<form action="" method="post" class="form form-horizontal" id="form-admin-add">
		<div class="leftapp col-xs-6">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>日期：</label>
			<div class="formControls col-xs-8 col-sm-8">

				<input type="text" class="input-text Wdate" placeholder="格式：2018-01-01" id="date" value="<?php echo date('Y-m-d'); ?>" name="date">	
				<?php echo token(); ?>	
				<!-- onclick="WdatePicker()"  -->
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>副本名称：</label>
			<div class="formControls col-xs-8 col-sm-8"> 
				<span class="select-box">
					<select class="select" name="gameid" size="1" id="game">
						<option value="" selected disabled> --- 请选择 --- </option>
						<?php foreach($game as $g): ?>
							<option value="<?php echo $g['id']; ?>" disabled> ★----- <?php echo $g['name']; ?> -----</option>
							<?php if((isset($g['son']) )): foreach($g['son'] as $s): ?>
							<option value="<?php echo $s['id']; ?>"> &emsp; <?php echo $s['name']; ?></option>
							<?php endforeach; endif; endforeach; ?>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-6 col-sm-3"><span class="c-red">*</span>总金额：</label>
			<div class="formControls col-xs-8 col-sm-6">
				<input type="text" class="input-text" autocomplete="off" placeholder="￥ 副本总金额" id="total" name="total" id="total">		
			</div>
			<div class="switch" data-on="danger" data-off="primary" data-on-label="未收" data-off-label="已收" id="mySwitch">
				<input type="checkbox" checked id="is_receive" name="received" value="未收"/>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>参与人员：</label>
			<div class="formControls col-xs-8 col-sm-8 skin-minimal">

				<div class="check-box">
					<input type="checkbox" id="check-qx" >
					<label for="check-qx" style="cursor: pointer;">全选</label>
				</div>
				<div class="check-box">
					<input type="checkbox" id="check-qk" >
					<label for="check-qk" style="cursor: pointer;">清空</label>
				</div>
				<div class="check-box">
					<input type="checkbox" id="check-gd" >
					<label for="check-gd" style="cursor: pointer;">更多</label>
				</div>

			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"></label>
			<div class="formControls col-xs-8 col-sm-8 skin-minimal" style="border: 1px solid #eee;" id="mymanagermore">
			<?php foreach($manager as $m): if($m['id'] != 0): ?>
				<div class="check-box mem-box" style="padding: 6px 0;<?php if(($m['role_id'] >= 7)): ?>display: none;<?php endif; ?>">
					<input name="person[<?php echo $m['id']; ?>]" type="checkbox" id="mem-<?php echo $m['id']; ?>" value="<?php echo $m['nickname']; ?>" style="<?php if(($m['role_id'] >= 7)): ?>display: none;<?php endif; ?>">
					<label for="mem-<?php echo $m['id']; ?>" style="cursor: pointer;"> <?php echo $m['nickname']; ?> </label>
				</div>
				<?php endif; endforeach; ?>
			</div>
		</div>
		<div class="row cl bonusinfo" id="bonusinfo" data-number="0">
			<label class="form-label col-xs-4 col-sm-3">提成：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text bonus_price" placeholder="￥ 金额" name="bonus[0]">				
			</div>
			<div class="formControls col-xs-8 col-sm-3" > 
				<span class="select-box">
					<select class="select"  id="bonusselect" name="bonus_info[0]" size="1" >
						<option value="0"> --- 请选择 --- </option>
						<?php foreach($manager as $m): if($m['id'] != 0): ?>
						<option value="<?php echo $m['nickname']; ?>"> <?php echo $m['nickname']; ?> </option>		
						<?php endif; endforeach; ?>
						<option value="more"> --- 手动填写 --- </option>
					</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-1"> 
				<input class="btn btn-secondary-outline radius" id="bonusbtn" type="button" value="再加一个">
			</div>
		</div>
		<div class="row cl bonusinfo" style="display: none;">
			<label class="form-label col-xs-4 col-sm-3"></label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text bonus_price" placeholder="￥ 金额">				
			</div>
			<div class="formControls col-xs-8 col-sm-3" > 
				<span class="select-box">
					<select class="select" size="1" >
						<option value="0"> --- 请选择 --- </option>
						<?php foreach($manager as $m): if($m['id'] != 0): ?>
						<option value="<?php echo $m['nickname']; ?>"> <?php echo $m['nickname']; ?> </option>		
						<?php endif; endforeach; ?>
						<option value="more"> --- 手动填写 --- </option>
					</select>
				</span> 
			</div>
		</div>
		
		<div class="row cl dropDown-pos">
			<label class="form-label col-xs-4 col-sm-3">所在区服：</label>
			<div class="formControls col-xs-8 col-sm-8">
				<input type="text" class="input-text" placeholder="哪个区的副本" id="area" name="area">
			</div>
			<ul class="dropDown-menu menu radius box-shadow dropDown-mymenu">
			</ul>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">老板信息：</label>
			<div class="formControls col-xs-8 col-sm-8">
				<input type="text" class="input-text" placeholder="老板游戏信息" id="boss" name="boss">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-8">
				<textarea name="remark" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-3 col-xs-offset-4 col-sm-offset-2">
				<input class="btn btn-success-outline radius" id="achievebtn" lay-filter="formDemo" type="button" value="&nbsp;&nbsp;完成，右侧确认提交&nbsp;&nbsp;">
			</div>
		</div>
		</div>
		<div class="reright col-xs-6">
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">日期：</b>
				<span id="redate"><span class="c-red">*</span></span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">副本名称：</b>
				<span id="regame">未选择</span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">总金额：</b>
				<span id="retotal"></span>
				<span id="re_receive"></span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">参与人员：</b>
				<span id="reperson">未选择</span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">人数：</b>
				<span id="remember">0</span>
			</div>		
			<div class="row cl">
				<b class="col-xs-4 col-sm-3" id="rebonus">提成：</b>
				<span data-number="0"><i class="rebonus_info">无</i>  -  <i class="rebonus"> ￥ 0</i> </span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">所在区服：</b>
				<span id="rearea">未填写</span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">老板信息：</b>
				<span id="reboss">未填写</span>
			</div>
			<hr class="row cl col-xs-4 col-sm-8" style="margin-top: 20px;">
			<br>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3" color='red'>注意事项：</b>
				<span id="attention" style="color:red;"></span>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">实收金额：</b>
				<div class="formControls col-xs-8 col-sm-3">
					<input type="text" class="input-text" placeholder="￥  实收金额" id="rerealmoney" name="rerealmoney">
				</div>
			</div>
			<div class="row cl">
				<b class="col-xs-4 col-sm-3">平均工资：</b>
				<div class="formControls col-xs-8 col-sm-3">
					<input type="text" class="input-text" placeholder="￥  平均工资" id="resalary" name="resalary">
				</div>
			</div>
			
		</div>
	</form>
</article>
	</div>
</section>

<script src="/static/admin/js/orderadd.js"></script>
<script src="/static/admin/js/laydate.js"></script>
<script>
$(function(){

//执行一个laydate实例
var month = new Date();
laydate.render({
  elem: '#date', //指定元素
  max: 0,
	done: function(value, date, endDate){
    $('#redate').html(value);
  }
  
});
var check_gd = $('#mymanagermore').html();
/*给更多checkbox绑定事件*/
$('#check-gd').change(function(){
	if( $(this).prop('checked') ){
		$('.mem-box').show();
		$('.mem-box').find('input').show();
	}else{
		$('#mymanagermore').html(check_gd);
	}
});

var dothing = true;

$('#area').on({
	compositionstart: function(){ dothing = false },
	compositionend: function(){ dothing = true },
	input :function(){
		var that = this;
        setTimeout(function(){

			if( $(that).val() && dothing ){

				$('.dropDown-mymenu').show();
				/*发送ajax 获取所输入的大区推荐*/
				$.ajax({
					'url'	: '<?php echo url("admin/AjaxApi/selectarea"); ?>',
					'type'	: 'post',
					'data'	: 'areaname='+ $(that).val(),
					'dataType': 'json',

					'success':function(res){

						if(res.code != 10000){
							return false;
						}else if(res.code == 10000){

							let html = '';

							for( i of res.data ){

								html += '<li><a href="javascript:;">'+ i +'</a></li>';
							}
							
							$('.dropDown-mymenu').html(html);
						}
					}
				});
			}else{

				$('.dropDown-mymenu').hide();
			}

        },0);

        $('#rearea').html( $(this).val() );
	}
});

$('.dropDown-mymenu').on('click','a',function(){

	$('#area').val( $(this).html() );
	$('#rearea').html( $(this).html() );

	$('.dropDown-mymenu').hide();
})

$('#area').bind('blur', function(){
	setTimeout(function(){
		$('.dropDown-mymenu').hide();
	},300);
});
/*老板信息*/
$('#boss').bind('input propertychange' , function(){
	$('#reboss').html( $(this).val() );
});

/*给提交按钮绑定事件*/
	$('.reright').on('click','#btnsub',function(){
		/*防止重复提交*/
		var flog = false;

		if( flog == false ){

			$('.leftapp :input').attr('disabled',false);
			$('form').append('<?php echo token(); ?>');
			/*发送ajax*/
			$.ajax({
				'url' : '<?php echo url("admin/order/save"); ?>',
				'type': 'post',
				'data': $('form').serializeArray(),
				'dataType': 'json',

				'success':function(res){

					if(res.code != 10000){
						alert(res.msg);
						flog = true;
						window.location.reload();
						return flog;
					}else if(res.code == 10000){						
						$('.leftapp :input').attr('disabled',true);
						layer.msg(res.msg, {icon: 6,time:1000});
						$(window).attr('location','<?php echo url("admin/order/index"); ?>');
						return flog;
					}
				}
			});
		}

		return flog;
	});
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


