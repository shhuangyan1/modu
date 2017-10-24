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
    <script type="text/javascript" src="{{asset('js/pinyin.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <script src="{{asset('lirary/common/jquery.loadTemplate.js')}}"></script>

    <style>
        .user-box{
            border: 1px solid #ccc;
            margin: 15px 12px 0 0;
            padding: 15px 10px;
            float: left;
            width: 210px;
            height: 60px;
        }
        .face{
            width: 60px;
            float: left;
        }
        .face img{
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        .name{
            width: 140px;
            font-size: 16px;
            margin-left: 70px;
            overflow: hidden;
        }
        .name .time{
            font-size: 14px;
            color: #666;
        }
        .outer-in{
            padding: 8px;
        }
        .outer-in .face{
            vertical-align: middle;
        }
        .outer-in .name{
            width: 130px;
            height: 60px;
            display: flex;
            align-items: center;
            font-size: 20px;
        }
        .info{
            padding: 8px 10px 0;
        }
        .loadmore{
            text-align: center;
            padding: 20px;
        }
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
        <table class="search_tab">
            <tr>
                <th width="100">会员昵称：</th>
                <td><input type="text" name="nickname" placeholder="搜索会员"></td>
                <td><button class="button search"><i class="fa fa-search"></i>查询</button></td>
            </tr>
        </table>
</div>
<!--结果页快捷搜索框 结束-->

<div class="result_wrap">
    <div class="result_content clear">

    </div>

    <p class="loadmore"><button class="button">加载更多</button></p>
</div>

<script type="text/html" id="user-tmp">
    <div class="user-inner clear">
        <div class="face"><img data-src="avatarUrl" alt="头像"></div>
        <div class="name">
            <p data-content="nickName"></p>
            <p class="time" data-content="time_pre"></p>
        </div>
    </div>
    <div class="user-outer hide">
        <div class="outer-in">
            <div class="face"><img data-src="avatarUrl" alt="头像"></div>
            <div class="name"><p data-content="nickName"></p></div>
            <div class="info clear">
                <p>性别：<span data-content="sex"></span></p>
                <p>所在地：<span data-content="address"></span></p>
                <p>加入时间：<span data-content="time"></span></p>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript" src="{{asset('js/user-list.js')}}"></script>

</body>
</html>