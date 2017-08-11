<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>信息首页</title>
    <link rel="stylesheet" href="style/css/ch-ui.admin.css">
	<link rel="stylesheet" href="style/font/css/font-awesome.min.css">
</head>
<body>
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap" style="margin-bottom: 50px;">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>发布文章</a>
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增话题</a>
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>发布活动</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        <div class="result_title">
            <h3>掌上魔都指南</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>管理平台使用帮助：</label><span><a href="javascript:;">点击下载帮助文档</a></span>
                </li>
                <li>
                    <label>编辑交流QQ群：</label><span><a href="javascript:;"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
    </div>
</body>
</html>