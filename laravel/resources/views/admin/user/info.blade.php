<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>会员数据分析</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <link rel="stylesheet" href="{{asset('js/user-info.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <script src="{{asset('lirary/common/echarts.common.min.js')}}" ></script>

    <style>

    </style>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">会员管理</a> &raquo; 会员数据分析
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_title">
        <h3>会员数据分析</h3>
    </div>
    <div class="result_content">

        <div class="map-box">
            <div class="map-title">累计会员数量</div>
        </div>

        <div class="map-box">
            <div class="map-title">会员增长走势图</div>
        </div>

        <div class="map-box">
            <div class="map-title">会员月度增长统计图</div>
        </div>

        <div class="map-box">
            <div class="map-title">会员数据条件对比图</div>
            <p>性别</p>
            <p>分布</p>
        </div>
    </div>
</div>

<div class="result_wrap hide">
    <div class="result_title">
        <h3>板块一</h3>
    </div>
    <div class="result_content">
        <div class="">
            内容一
        </div>
    </div>
</div>


<script src="{{asset('js/user-info.js')}}" ></script>
</body>
</html>