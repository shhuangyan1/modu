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
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 文章列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->

<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="" method="get">

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <thead>
                <tr>
                    <th>已领取苹果</th>
                    <th>电话号码</th>
                    <th>小区</th>
                    <th>详细地址</th>
                    <th>剩余苹果箱数</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="tc">孙慧杰</td>
                    <td class="tc">15987455448</td>
                    <td class="tc">普陀区</td>
                    <td class="tc">铜川路2188弄27单元202</td>
                    <td class="tc">199</td>
                </tr>
                <tr>
                    <td class="tc">孙慧杰</td>
                    <td class="tc">15987455448</td>
                    <td class="tc">普陀区</td>
                    <td class="tc">铜川路2188弄27单元202</td>
                    <td class="tc">199</td>
                </tr>
                <tr>
                    <td class="tc">孙慧杰</td>
                    <td class="tc">15987455448</td>
                    <td class="tc">普陀区</td>
                    <td class="tc">铜川路2188弄27单元202</td>
                    <td class="tc">199</td>
                </tr>


           </tbody>

            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    $(function () {
        $.ajax({
            url:'{url("admin/pingguo/showaddr")}',
            dataType: json,
            success: function (res) {
                console.log(res);
            }

        })
    })
</script>
</body>
</html>