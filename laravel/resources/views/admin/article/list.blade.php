<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>文章列表</title>

    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>

    <!--<script type="text/javascript" src="{{asset('admin/style/js/ch-ui.admin.js')}}"></script>-->

</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 文章列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="" method="get">
            {{csrf_field()}}
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类：</th>
                    <td>
                        <select name="cat_id">
                            <option value="">-请选择-</option>
                            @foreach($info as $v)
                            <option value="{{$v->id}}">{{$v->cat_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <th width="70">关键字：</th>
                    <td><input type="text" name="title" placeholder="搜索文章标题关键字"></td>
                    <td><input type="submit"  value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="" method="get">

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>分类</th>
                        <th>浏览量</th>
                        <th>发布人</th>
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
                        <td class="tc"></td>
                        <td class="tc">{{$v->author}}</td>
                        <td class="tc"></td>
                        <td class="tc">
                            <!--<a href="javascript:;" onclick="delarticle({{$v->id}})">申请删除</a>-->
                            <a href="javascript:;">申请删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                <div class="page_list">
                    {{--{{$data->links()}}--}}
                    {{$data->appends(Request::all())->render()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

</body>
<script>

    function delarticle(art_id) {

            $.post("{{url('admin/article/')}}/"+art_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if (data.status == 1) {

                } else {

                }
            });

        }

</script>




</html>