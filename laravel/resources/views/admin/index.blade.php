<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>掌上魔都</title>
	<link rel="stylesheet" href="style/css/ch-ui.admin.css">
	<link rel="stylesheet" href="style/font/css/font-awesome.min.css">
		
	<script type="text/javascript" src="style/js/jquery.js"></script>
    <script type="text/javascript" src="style/js/ch-ui.admin.js"></script>
	<script type="text/javascript" src="{{asset('js/util.js')}}"></script>

</head>
<body>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">掌上魔都</div>
			<ul>
				<li><a href="{{url('admin/info')}}"  target="main" class="active">首页</a></li>
				<!--<li><a href="#">管理页</a></li>-->
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：{{session('user')->username}}</li>
				<li><a href="#" target="main">修改密码</a></li>
				<li><a href="{{url('admin/logout')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>文章管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/article/create')}}" target="main">发布文章</a></li>
					<li><a href="{{url('admin/article/ai_publish')}}" target="main">智能发布文章</a></li>
					<li><a href="{{url('admin/article')}}" target="main">文章列表</a></li>
					<li><a href="{{url('admin/confirm')}}" target="main">删除确认</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>文章分类管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/category/create')}}" target="main">添加分类</a></li>
					<li><a href="{{url('admin/category')}}" target="main">分类列表</a></li>

				</ul>
			</li>
			<li>
            	<h3><i class="fa fa-fw fa-weixin"></i>话题管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/topic/create')}}" target="main">新增话题</a></li>
                    <li><a href="{{url('admin/topic')}}" target="main">话题列表</a></li>
                </ul>
            </li>
			<li>
            	<h3><i class="fa fa-fw fa-flag"></i>活动管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/activity/create')}}" target="main">发布活动</a></li>
                    <li><a href="{{url('admin/activity')}}" target="main">活动列表</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-user"></i>管理员管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/manager/create')}}" target="main">添加管理员</a></li>
                    <li><a href="{{url('admin/manager')}}" target="main">管理员列表</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main">图标调用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main">Jquery手册</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main">配色板</a></li>
					<!--<i class="fa fa-fw fa-tags">-->
                </ul>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2015. Powered By <a href="http://www.houdunwang.com"></a>.
	</div>
	<!--底部 结束-->

</body>
</html>