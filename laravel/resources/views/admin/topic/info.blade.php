<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>话题信息</title>
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
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">话题管理</a> &raquo; <a href="{{url('admin/topic')}}">话题列表</a> &raquo; 话题信息
</div>
<!--面包屑导航 结束-->
<!--<div class="search_wrap">-->
<!--</div>-->

<div class="result_wrap">
    <div class="result_content">
        <div class="banner-title">话题报名信息概览：</div>
        <table class="list_tab">
            <thead>
            <tr>
                <th>活动名称</th>
                <th>浏览量</th>
                <th>参与人数</th>
                <th>发布时间</th>
            </tr>
            </thead>
            <tbody id="statistics">
            </tbody>
        </table>




    </div>
</div>
<script>
    var id = MD.get_query('id').id

    // 加载统计数据
    MD.ajax_get({
        url: '/admin/topic/topic_detail',
        data: {'id': id}
    },function (res) {


    })

   // MD.ajax_get({
   //     url: '/admin/activity/act_ids',
   //     data: {'id': id}
    // },function (res) {

  // })
</script>
</body>
</html>