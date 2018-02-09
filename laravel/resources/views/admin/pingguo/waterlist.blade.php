<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>添加分类</title>
    <meta charset="utf-8">
    <title>分类列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <style>
        .result_wrap section{
            margin: 25px;
        }
        .result_wrap .title{
            margin: 5px;
        }
        .head{
            width:50px;
            height:50px;
            float:left;
            display:block;
        }
        .head img{
            width:50px;
            height:50px;
            display:block;
            border-radius:50%;
            padding:0 40px;
        }
        .tt{
            line-height:50px;
            float:left;
            display:block;
            padding-left:50px;

        }
        .clearfix:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
    </style>
</head>
<body>

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->
    <div class="search_wrap">
        <form action="waterlist" method="post">
            {{csrf_field()}}
            <table class="search_tab">
                <tr>

                 </td>
                    <th width="70">关键字：</th>
                    <td><input type="text" name="water" placeholder="搜索浇水次数"></td>
                    <td><input type="submit"  value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--搜索结果页面 列表 开始-->
    <form  method="post">
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th>已浇水好友</th>
                        <th>性别</th>
                        <th>已浇水次数</th>
                    </tr>
                    @foreach($info as $v)
                    <tr>
                        <td class="tc clearfix" style="text-align: center;"><div class="head clearfix"><img src="{{$v->avatarUrl}}" alt=""></div><div class="tt">{{$v->nickName}}</div></td>
                        <td class="tc">{{$v->gender}}</td>
                        <td class="tc">{{$v->water}}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{$info->appends(Request::all())->render()}}
                </div>
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
                content:'<div class="jeBox-iconbox jeicon1">确定要删除该分类吗？删除后不可恢复！</div>',
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
        });

        /**
         * 下架分类，下架前需要确认文章是否下架
         */
        $(document).on("click",".down",function () {
            var id = $(this).data("id");
            var this_ = $(this)
            jeBox.open({
                cell:"jbx",
                title:"提示",
                padding:"25px 10px",
                content:'<div class="jeBox-iconbox jeicon1">确定要将该分类下架吗？</div>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '确定',
                        callback: function(index){
                            MD.ajax_get({
                                url: "admin/category/off_category",
                                dataType: 'text',
                                data: {"id": id}
                            }, function (res) {
                                if(res == 'success'){
                                    jeBox.close(index);
                                    jeBox.msg("下架成功", {icon: 2, time: 1})
                                    this_.addClass("cate_up").removeClass("down").text("恢复")
                                }
                            })
                        }
                    },
                    {
                        name: '取消'
                    }
                ]
            })
        });

        /**
         * 恢复
         */
        $(document).on("click", ".cate_up", function () {
            var id = $(this).data("id");
            var this_ = $(this)
            jeBox.open({
                cell:"jbx",
                title:"提示",
                padding:"25px 10px",
                content:'<div class="jeBox-iconbox jeicon1">确定要将该分类恢复吗？</div>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '确定',
                        callback: function(index){
                            MD.ajax_get({
                                url: "admin/category/recover_category",
                                dataType: 'text',
                                data: {"id": id}
                            }, function (res) {
                                if(res == 'success'){
                                    jeBox.close(index);
                                    jeBox.msg("恢复成功", {icon: 2, time: 1})
                                    this_.addClass("down").removeClass("cate_up").text("下架")
                                }
                            })
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