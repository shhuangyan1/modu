<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>用户反馈消息</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>



</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">消息管理</a> &raquo; 用户反馈
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_content">
        <table class="list_tab">
            <tr>
                <th>反馈内容</th>
                <th>用户昵称</th>
                <th>时间</th>
            </tr>
            @foreach($data as $v)
            <tr>
                <td class="tc">{{$v->content}}</td>
                <td class="tc">{{$v->nickName}}</td>
                <td class="tc">{{date("Y-m-d H:i:s",$v->time)}}</td>
            </tr>
            @endforeach
        </table>
    </div>

</div>
</body>
</html>