<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>话题列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>



</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">话题管理</a> &raquo; 话题列表
</div>
<!--面包屑导航 结束-->

<div class="search_wrap">
    <form action="" method="get">
        {{csrf_field()}}
        <table class="search_tab">
            <tr>
                <th width="120">话题状态：</th>
                <td>
                    <select>
                        <option value="">--全部--</option>
                        <option value="1">正在讨论</option>
                        <option value="0">已经结束</option>
                    </select>
                </td>
                <th width="70">关键字：</th>
                <td><input type="text" name="title" placeholder="搜索话题标题关键字"></td>
                <td><input type="submit" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<div class="result_wrap">
    <div class="result_content">
        <table class="list_tab">
            <thead>
            <tr>
                <th>标题</th>
                <th>互动回答量</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
            <tr>
                <td>
                    <a href="#">{{$v->title}}</a>
                </td>
                <td class="tc">{{$v->view}}</td>
                <td class="tc">{{$v->time}}</td>
                <td class="tc">
                    <a href="javascript:;">结束话题</a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
        <div class="page_list">
            {{$data->appends(Request::all())->render()}}
        </div>
    </div>
</div>
</body>
</html>