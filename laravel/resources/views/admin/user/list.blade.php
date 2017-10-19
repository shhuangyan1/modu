<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>会员列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <style>

    </style>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">会员管理</a> &raquo; 会员列表
</div>
<!--面包屑导航 结束-->

<div class="search_wrap">
    <form action="#" method="post">
        <table class="search_tab">
            <tr>
                <th width="100">会员昵称：</th>
                <td><input type="text" name="username" placeholder="搜索会员"></td>
                <td><input type="submit" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->
<style>
    .user-box{
        border: 1px solid #ccc;
        margin: 15px;
        padding: 15px 10px;
        float: left;
        width: 210px;
        height: 60px;
    }
    .face{
        width: 60px;
        float: left;
    }
    .face img{
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }
    .name{
        width: 140px;
        font-size: 16px;
        margin-left: 70px;
        overflow: hidden;
    }
    .name .time{
        font-size: 14px;
        color: #666;
    }
    .outer-in{
        padding: 8px;
    }
    .outer-in .face{
        vertical-align: middle;
    }
    .outer-in .name{
        width: 130px;
        height: 60px;
        display: flex;
        align-items: center;
        font-size: 20px;
    }
    .info{
        padding: 8px 10px 0;
    }
</style>
<div class="result_wrap">
    <div class="result_content clear">

        <div class="user-box user-box-1" data-id="">
            <div class="user-inner clear">
                <div class="face"><img src="" alt="头像"></div>
                <div class="name">
                    <p></p>
                    <p class="time"></p>
                </div>
            </div>
            <div class="user-outer hide">
                <div class="outer-in">
                    <div class="face"><img src="https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJTibLpQMFX7NxuXcAB2tyboX6PdOPBme44JgxDJlrlxgoKnF28CzIowdib9UFQV58TEfCh1nySAV1w/0" alt="头像"></div>
                    <div class="name"><p></p></div>
                    <div class="info clear">
                        <p>性别：

                            </p>
                        <p>所在地：</p>
                        <p>加入时间：</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    $(function () {

        $(".user-box").on('mouseover', function () {
            var result_width =  $(".result_content").width();
            var this_width = $(this).width();
            var id = $(this).data('id')
            var classname = ".user-box-"+id;
            var cont = $(this).find(".user-outer").html();

            var this_left = $(this).offset().left;
            var direction = "right"
            if((result_width - this_left - this_width) <= this_width){
                direction = "left"
            }

            var index = jeBox.tips(classname, cont , {align: direction});
            $(this).on("mouseout", function () {
                jeBox.close(index)
            })
        })


    })
</script>
</body>
</html>