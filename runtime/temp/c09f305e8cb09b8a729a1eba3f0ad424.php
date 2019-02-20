<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\project\tptianyu\public/../application/admin\view\order\excelbutton.html";i:1549040950;}*/ ?>
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
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/h-ui.admin/css/style.css" />

<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>订单excel生成 - 单子管理</title>

</head>
<body>
<article class="cl pd-20">
	<a href="<?php echo url('admin/order/edit',['mouth'=>1]); ?>" onclick="" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe640;</i> 下载全部</a>

<?php foreach($order_mouth as $o): ?>
	<a class="btn btn-primary radius" href="<?php echo url('admin/order/edit',['mouth'=>$o['m']]); ?>"><i class="Hui-iconfont">&#xe645;</i> <?php echo $o['m']; ?></a>
<?php endforeach; ?>
</article>

<script type="text/javascript">

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>