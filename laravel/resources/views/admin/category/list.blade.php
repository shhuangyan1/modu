<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>分类列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form  method="post">
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th>分类名称</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>

                    @foreach($data as $v)   
                    <tr>
                        <td class="tc">{{$v->cat_name}}</td>
                        <td class="tc">{{date("Y-m-d H:i:s",$v->cat_time)}}</td>
                        <td class="tc">
                            <a href="{{url('admin/category/'.$v->id.'/edit')}}">修改</a>
                            <a class="delete" data-id="{{$v->id}}" href="javascript:void(0);">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>

    </form>
    <!--搜索结果页面 列表 结束-->

<script>
    $(function () {
        $(document).on("click",".delete",function () {
            var id = $(this).data("id");
            var this_ = $(this)
            jeBox.open({
                cell:"jbx",
                title:"删除",
//                boxSize:["300px","160px"],
                padding:"25px 10px",
                content:'<div class="jeBox-iconbox jeicon1">确定要删除分类吗？<br>删除后不可恢复，其下文章划入待分类</div>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '确定',
                        callback: function(index){
                            $.post(
                                MD.url + "/admin/category/" + id,
                                {'_token':"{{csrf_token()}}","_method":"delete"},
                                function (res) {
                                    res = JSON.parse(res);
                                    if(res.status == 1001){
                                        jeBox.msg(res.msg, {icon: 3,time:1.5});
//                                        error
                                    }else{
                                        jeBox.msg(res.msg, {icon: 2,time:1});
                                        setTimeout(function () {
                                            location.reload();
                                        },1000)
                                    }
                                    jeBox.close(index);
                                }
                            )

                        }
                    },
                    {
                        name: '取消'
                    }
                ]
            })

        })
    })
</script>

</body>
</html>