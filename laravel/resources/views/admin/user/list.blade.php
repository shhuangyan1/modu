<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>会员列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <style>

    </style>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">会员管理</a> &raquo; 会员列表
</div>
<!--面包屑导航 结束-->

<div class="search_wrap">
    <form action="#" method="post">
        <table class="search_tab">
            <tr>
                <th width="100">会员昵称：</th>
                <td><input type="text" name="username" placeholder="搜索会员"></td>
                <td><input type="submit" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<div class="result_wrap">
    <div class="result_content">
        <div class="user-box">
            
        </div>
    </div>
</div>

<script>

</script>
</body>
</html>