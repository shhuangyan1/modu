<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>添加管理员</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/join.js')}}"></script>

    <style>
        @import "{{asset('css/mdForm.css')}}";
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
        .auth tr td{
            border-bottom: 1px solid #ccc;
        }
        #category li{
            float: left;
        }
        .info p{
            margin-top: 10px;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">管理员管理</a> &raquo; 添加管理员
</div>
<!--面包屑导航 结束-->

<div id="new-manager" class="result_wrap section-ctrl">
    <form action="{{url('admin/manager')}}" id="managerform" name="form" method="post" onsubmit="return newManager();">
        <section class="info">
            <p>管理员登录名称</p>
            <input type="text" class="username" name="username" placeholder="请在这里设置新管理员登录名">
            <p>管理员登录密码</p>
            <input type="text" class="admin_pwd" name="admin_pwd" placeholder="请在这里设置新管理员密码" value="123456">
            <p>确认密码</p>
            <input type="text" class="admin_pwd_cf" name="admin_pwd" placeholder="请在这里确认密码">
        </section>
        <section class="hide">
            <p>管理员权限设置</p>
            <div class="auth" id="auth">
                <ul>
                    <li class="head">文章管理</li>
                    <li><input type="checkbox" class="publish" name="checbox" mdtext="发布文章"></li>
                    <li><input type="checkbox" name="checbox2"  mdtext="文章列表"></li>
                    <li><input type="checkbox" name="checbox3"  mdtext="删除确认"></li>
                </ul>
                <ul>
                    <li class="head">文章分类管理</li>
                    <li><input type="checkbox" name="checbox"  mdtext="添加分类"></li>
                    <li><input type="checkbox" name="checbox"  mdtext="分类列表"></li>

                </ul>
                <ul>
                    <li class="head">话题管理</li>
                    <li><input type="checkbox" name="checbox"  mdtext="新增话题"></li>
                    <li><input type="checkbox" name="checbox"  mdtext="话题列表"></li>

                </ul>
                <ul>
                    <li class="head">活动管理</li>
                    <li><input type="checkbox" name="checbox"  mdtext="发布活动"></li>
                    <li><input type="checkbox" name="checbox"  mdtext="活动列表"></li>

                </ul>
            </div>
        </section>
        <section class="clear hide article_cat">
            <p>文章发布分类设置</p>
            <div id="category">
                <ul>
                    <li><input type="checkbox" name="checbox" mdtext="好玩情报"></li>
                    <li><input type="checkbox" name="checbox2"  mdtext="掌上办事"></li>
                    <li><input type="checkbox" name="checbox3"  mdtext="上海景点"></li>
                </ul>
            </div>
        </section>
        <section class="no-border">
            <input class="button confirm" type="submit" value="确认添加">
        </section>
    </form>
</div>
<script>
    MD.Form("#auth",{type:"checkbox"})
    MD.Form("#category",{type:"checkbox"})

</script>
</body>
</html>