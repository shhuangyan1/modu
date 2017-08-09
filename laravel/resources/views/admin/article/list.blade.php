<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('admin/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/style/js/ch-ui.admin.js')}}"></script>

</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>审核状态</th>
                        <th>点击</th>
                        <th>发布人</th>
                        <th>更新时间</th>
                        <th>评论</th>
                        <th>操作</th>
                    </tr>
                    
                    @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">
                            <input type="text" name="ord[]" value="0">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->title}}</a>
                        </td>
                        <td>0</td>
                        <td>2</td>
                        <td>{{$v->author}}</td>
                        <td>2014-03-15 21:11:01</td>
                        <td></td>
                        <td>
                            <a href="{{url('admin/article/'.$v->id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delarticle({{$v->id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
             <div class="page_list">
                {{$data->links()}}
            </div>

    </form>
    <!--搜索结果页面 列表 结束-->

</body>
<script>
    {{--function delarticle($id){--}}
        {{--$.ajax({--}}
            {{--url:"{{url('admin/article')}}}",--}}
            {{--type:'get',--}}
         {{--//   data:{'id':$id,'_token':{{csrf_token()}},'_method':'delete'},--}}
            {{--data:{'id':$id,'_method':'delete'},--}}
            {{--success:function(msg){--}}
                {{--if(msg.status==1){--}}
                    {{--location.href=location.href;--}}
                {{--}else{--}}
                    {{--console.log('删除错误!');--}}
                {{--}--}}
            {{--}--}}
        {{--})--}}
    {{--}--}}

        //删除分类
    function delarticle(art_id) {

            $.post("{{url('admin/article/')}}/"+art_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if (data.status == 1) {
                    location.href = location.href;

                } else {

                }
            });

        }

</script>




</html>