<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>分类列表</title>
	<link rel="stylesheet" href="style/css/ch-ui.admin.css">
	<link rel="stylesheet" href="style/font/css/font-awesome.min.css">
    <script type="text/javascript" src="style/js/jquery.js"></script>
    <script type="text/javascript" src="style/js/ch-ui.admin.js"></script>


</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form  method="post">
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th>分类名称</th>
                        <th>更新时间</th>
                   
                        <th>操作</th>
                    </tr>

                    @foreach($data as $v)   
                    <tr>
                        <td class="tc">{{$v->cat_name}}</td>
                        <td class="tc">2017-08-15 21:11:01</td>
                        <td class="tc">
                            <a href="{{url('admin/category/'.$v->id.'/edit')}}">修改</a>
                            <a href="#">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>

    </form>
    <!--搜索结果页面 列表 结束-->



</body>
</html>