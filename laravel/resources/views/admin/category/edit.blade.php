<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>编辑分类</title>

    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>

    <style>
        .result_wrap section{
            margin: 25px;
        }
        .result_wrap .title{
            margin: 5px;
        }
    </style>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; <a href="#">分类列表</a> &raquo; 编辑分类
    </div>
    <!--面包屑导航 结束-->

    
    <div class="result_wrap">
        <form action="{{url('admin/category/'.$info->id)}}" method="post" onsubmit="return add_category();">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <section CLASS="clear">
                <p class="title">已有分类：</p>

                @foreach($data as $d)
                <label class="category-list">
                    <span class="label-cat" data-value="{{$d->id}}">{{$d->cat_name}}</span>
                </label>
                @endforeach
            </section>
            <section>
                <p class="title">分类名称：</p>
                <input type="text" class="cat_name" name="cat_name" value="{{$info->cat_name}}" placeholder="输入新的文章分类名称">
                <input type="hidden" name="id" value="{{$info->id}}">
            </section>
            <section>
                <input type="submit" value="提交修改">
                <input type="button" class="back" onclick="history.go(-1)" value="取消并返回">
            </section>
        </form>
    </div>
    <script>
        var category = [];
        $(function () {

            $.each($(".category-list"),function (i, v) {
                category.push(v.innerText);
            })
            console.log(category)

        })
        function add_category() {
            var name = $(".cat_name").val().trim();
            var name_bl = false;
            if(name.length > 0){
                name_bl = category.indexOf(name) >= 0 ? false : true;
                if(!name_bl){
                    $(".cat_name").showTips("分类名已存在")
                }
            }else{
                $(".cat_name").showTips("请填写分类名")
            }

            return name_bl;
        }
    </script>
</body>
</html>