<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\project\tptianyu\public/../application/admin\view\manager\auth_add.html";i:1546268119;}*/ ?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="favicon.ico" >
<link rel="Shortcut Icon" href="favicon.ico" />

<link rel="stylesheet" type="text/css" href="/static/admin/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/css/style.css" />


<title>添加权限 - 管理员管理</title>

</head>
<body>
<article class="cl pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>模块名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">上级权限：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="pid" size="1">
					<option value="0">顶级权限</option>
				<?php foreach($role as $v): ?>
					<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
				<?php endforeach; ?>
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" autocomplete="off" value="" id="auth_c" name="auth_c">
			</div>
		</div>
		<div class="row cl"  id="fort_or_action">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字体图标：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" autocomplete="off" id="font_icon" name="font_icon">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否作为项菜单：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="is_nav" type="radio" id="is_nav-1" value="1" checked>
					<label for="is_nav-1">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="is_nav-2" name="is_nav" value="0">
					<label for="is_nav-2">否</label>
				</div>
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/static/admin/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/admin/h-ui.admin/js/H-ui.admin.page.js"></script> 

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	/*设置下拉菜单改变样式*/
	$('select[name=pid]').change(function(){
		/*获取当前value*/
		var value = $(this).val();
		/*初始式样式*/
		var html = '<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字体图标：</label><div class="formControls col-xs-8 col-sm-9"><input type="text" class="input-text" autocomplete="off" id="font_icon" name="font_icon"></div>';
		/*跟据value的不同，生成不同的页面样式*/
		if( value > 0 ){
			/*替换字体图标行*/
			var html = '<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>方法名：</label>';
			html += '<div class="formControls col-xs-8 col-sm-9">';
			html += '<input type="text" class="input-text" autocomplete="off" id="auth_a" name="auth_a">';
			html += '</div>';
		}
		$('#fort_or_action').html(html);
	});

	/*
		<div class="row cl">
			
			
				
			</div>
		</div>
		
	*/
	
	$("#form-admin-add").validate({
		rules:{
			name:{
				required:true,
				minlength:4,
				maxlength:16
			},
			auth_c:{
				required:true,
			},
			auth_a:{
				required:true,
			},
		},
		onkeyup:false,
		focusInvalid:true,
		success:"valid",
		submitHandler:function(form){
			/*发送ajax*/
			$.ajax({
				'url'	: '<?php echo url("admin/manager/auth_insert"); ?>',
				'type'	: 'post',
				'data'	: $('form').serializeArray(),
				'dataType' : 'json',
				'success'  : function(res){
					if( res.code != 10000 ){
						alert(res.msg);
						return;
					}
					alert(res.msg);
					var index = parent.layer.getFrameIndex(window.name);
					parent.location.reload();
					parent.layer.close(index);				
				}
			});
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>