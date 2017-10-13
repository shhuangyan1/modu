<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>活动报名信息</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <style>
        .banner-title{
            font-size: 16px;
            margin: 25px 0 4px;
            color: #0e84b5;
        }
        .user-head{
            width: 40px;
            height: 40px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            vertical-align: middle;
        }
        .user-name{
            font-size: 14px;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">活动管理</a> &raquo; <a href="{{url('admin/activity')}}">活动列表</a> &raquo; 活动报名信息
</div>
<!--面包屑导航 结束-->
<!--<div class="search_wrap">-->
<!--</div>-->

<div class="result_wrap">
    <div class="result_content">
        <div class="banner-title">活动报名信息概览：</div>
        <table class="list_tab">
            <thead>
            <tr>
                <th>活动名称</th>
                <th>参与人数 / 限制人数</th>
                <th>发布时间</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>活动名称</td>
                <td class="tc">88 / 100</td>
                <td class="tc">2017-10-11</td>
            </tr>
            </tbody>
        </table>

        <div class="banner-title">活动报名用户列表：</div>
        <table class="list_tab">
            <thead>
            <tr>
                <th>用户信息</th>
                <th>报名表单数据</th>
                <th>报名时间</th>
            </tr>
            </thead>
            <tbody>
            {{--@foreach($join_activity as $v)--}}
            <tr>
                <td class="tc">
                    <img class="user-head" src="sss">
                    <span class="user-name">sss</span>
                </td>
                <td>
                    {{--@foreach($v->userinfo as $k)
                    <label>{{$k}}</label>
                    @endforeach--}}
                    <label>fdsf</label>
                </td>
                <td class="tc">fdsf</td>
            </tr>
            {{--@endforeach--}}
            </tbody>
        </table>

    </div>
</div>
<script>
    var id = MD.get_query('id').id

    // 加载统计数据
    MD.ajax_get({
        url: '/admin/activity/act_id',
        data: {'act_id': id}
    },function (res) {

    })

    // 加载表格数据
    
</script>
</body>
</html>