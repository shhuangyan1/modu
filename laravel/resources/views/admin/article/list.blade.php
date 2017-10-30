<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>文章列表</title>

    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <style>
        .search_tab select{
            border: 1px solid #ccc;
            height: 33px;
            border-radius: 3px;
        }

    </style>
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
                    <td><button type="button" class="button down-all">全部下架</button></td>
                    <td><button type="button" class="button up-all">全部恢复</button></td>
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
                            <a href="{{url('admin/article/detail')}}?id={{$v->id}}">{{$v->title}}</a>
                        </td>
                        <td class="tc">{{$v->cat_name}}</td>
                        <td class="tc">{{$v->view}}</td>
                        <td class="tc">{{$v->author}}</td>
                        <td class="tc">{{date('Y-m-d H:i',$v->time)}}</td>
                        <td class="tc">
                            <a class="to-delete" href="javascript:;" data-id="{{$v->id}}">申请删除</a>
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
    </form>
    <!--搜索结果页面 列表 结束-->
<script>
    $(function () {

        $(document).on("click",".to-delete",function () {
            var id = $(this).data("id");
            var this_ = $(this)
            jeBox.open({
                cell:"jbx",
                title:"申请删除",
                boxSize:["300px","160px"],
                padding:"25px 10px",
                content:'<p style="text-align: center;">确定要提交删除申请吗？</p>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '确定',
                        callback: function(index){
                            $.post(
                                MD.url + "/admin/shenhe",
                                {'_token':"{{csrf_token()}}","id":id},
                                function (res) {
                                    res = JSON.parse(res);
                                    if(res.status == 1001){
                                        jeBox.msg(res.msg, {icon: 3,time:1.5});
//                                        error
                                    }else{
                                        jeBox.msg("申请已提交", {icon: 2,time:1.5});
                                        this_.removeClass("to-delete").text("已申请").css("color","#f40")
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
         * 将全部文章下架
         */
        $(".down-all").on("click", function () {
            jeBox.open({
                cell:"jbx",
                title:"提示",
                padding:"25px 10px",
                content:'<div class="jeBox-iconbox jeicon1" style="text-align: center;">确定要将<span class="red">全部文章下架</span>吗？' +
                '<br><span>下架前请先<span class="red">清空</span>删除确认！</span></div>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '下架',
                        callback: function(index){
                            jeBox.close(index);
                            MD.ajax_post({url: "admin/article/undercarriage_all", dataType: 'text'}, function (res) {

                                jeBox.msg('全部文章已下架', {icon: 2,time:1.5});
                                setTimeout(function () {
                                    location.reload();
                                },1200)

                            })
                        }
                    },
                    {
                        name: '取消'
                    }
                ]
            })
        })

        /**
         * 全部恢复
         */
        $(".up-all").on("click", function () {
            jeBox.open({
                cell:"jbx",
                title:"提示",
                padding:"25px 10px",
                content:'<div style="text-align: center;">确定要将全部文章恢复吗？</div>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '恢复',
                        callback: function(index){
                            jeBox.close(index);
                            MD.ajax_post({url: "admin/article/topcarriage_all", dataType: 'text'}, function (res) {

                                jeBox.msg('全部文章已恢复', {icon: 2,time:1.5});
                                setTimeout(function () {
                                    location.reload();
                                },1200)

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