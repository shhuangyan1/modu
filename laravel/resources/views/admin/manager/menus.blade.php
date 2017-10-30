<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>菜单页列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <style>
        .search_wrap{
            padding-left: 20px;
        }
        .table_opt{
            margin-bottom: 10px;
        }
        .p_name{
            display: inline-block;
            padding: 4px 15px;
            border: 1px solid #ccc;
            margin-right: 15px;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">权限管理</a> &raquo; 菜单列表
</div>
<!--面包屑导航 结束-->
<!--<div class="search_wrap">-->
    <!--<button class="button primary"><i class="fa fa-plus"></i>添加新的父级菜单项</button>-->
<!--</div>-->
<!--结果页快捷搜索框 结束-->
<div class="result_wrap">
    <section>
        <div class="table_opt">
            <span class="p_name">文章管理</span>
            <!--<button class="button">新建子页面</button>-->
        </div>
        <table class="list_tab">
            <thead>
            <tr>
                <th>菜单名称</th>
                <th>菜单链接地址</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>发布文章</td>
                <td>admin/article/create</td>
                <td class="tc">
                    <!--<a>编辑</a>-->
                </td>
            </tr>
            </tbody>
        </table>
    </section>
</div>
<script>

</script>
</body>
</html>