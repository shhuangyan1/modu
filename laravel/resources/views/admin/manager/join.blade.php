<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>添加账户</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdForm.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/join.js')}}"></script>

    <style>
        .auth{
            border: 1px solid #ccc;
            margin-top: 15px;
            padding: 15px 0;
        }
        .auth ul li{
            float: left;
            padding: 5px 8px;
            font-size: 14px;
        }
        .auth ul:after{
            content: "";
            display: block;
            clear: both;
        }
        .auth li.head{
            width: 150px;
            text-align: center;
            color: #428bca;
            line-height: 34px;
        }
        .info p{
            margin-top: 10px;
        }
        .operation label{
            display: inline-block;
            border: 1px solid #ccc;
            padding: 4px 15px;
            color: #666;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            cursor: pointer;
        }
        .operation label.on{
            color: #0e84b5;
            border: 1px solid #0e84b5;
        }
        .operation label i{
            margin-right: 5px;
        }
        .operation input{
            display: none;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">权限管理</a> &raquo; 添加账户
</div>
<!--面包屑导航 结束-->

<div id="new-manager" class="result_wrap section-ctrl">
    <form action="{{url('admin/manager')}}" id="managerform" name="form" method="post" onsubmit="return newManager();">
        <section class="info">
            <p>管理员登录名称</p>
            <input type="text" class="username" name="username" placeholder="请在这里设置新管理员登录名">
            <p>管理员登录密码</p>
            <input type="password" class="admin_pwd" name="admin_pwd" placeholder="请在这里设置新管理员密码">
            <p>确认密码</p>
            <input type="password" class="admin_pwd_cf" name="admin_pwd" placeholder="请在这里确认密码">
        </section>
        <section class="no-border">
            <div class="operation">
                <span>管理员权限设置：</span>
                <label class="on" for="level3">
                    <span><i class="fa fa-user"></i>文案编辑</span>
                </label>
                <input type="radio" id="level3" name="level" checked value="3">

                <label for="level2">
                    <span><i class="fa fa-user"></i>项目经理</span>
                </label>
                <input type="radio" id="level2" name="level" value="2">

                <label class="hide" for="level1">
                    <span><i class="fa fa-user"></i>超级管理员</span>
                </label>
                <input type="radio" id="level1" name="level" value="1">

            </div>
            <div class="auth" id="auth">
                <!--<ul>
                    <li class="head">文章管理</li>
                    <li><input type="checkbox" name="checbox" mdtext="发布文章"></li>
                </ul>-->
            </div>
            <input type="hidden" id="authority" name="auth_id" value="">
        </section>
        <section class="no-border">
            <input class="button confirm" type="submit" value="确认添加">
        </section>
    </form>
</div>
<script>


</script>
</body>
</html>