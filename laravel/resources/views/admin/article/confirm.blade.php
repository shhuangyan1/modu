<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>确认删除文章</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <script type="text/javascript" src="{{asset('js/confirm.js')}}"></script>


</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 删除确认
</div>
<!--面包屑导航 结束-->

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>分类</th>
                    <th>发布人</th>
                    <th>申请时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($info as $v)
                <tr>
                    <td>
                        <a href="#">{{$v->title}}</a>
                    </td>
                    <td class="tc">{{$v->cat_name}}</td>
                    <td class="tc">{{$v->author}}</td>
                    <td class="tc">{{date('Y-m-d H:i',$v->time)}}</td>
                    <td class="tc">
                        <a class="delete" data-id="{{$v->article_id}}" href="javascript:;">同意删除</a>
                        <a class="refuse" data-id="{{$v->article_id}}" href="javascript:;">继续展示</a>
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>
            <div class="page_list">
            </div>
        </div>
    </div>
<script>
    MD.token = "{{csrf_token()}}"
</script>
</body>
</html>