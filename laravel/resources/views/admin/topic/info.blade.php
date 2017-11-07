<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>话题信息</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <script src="{{asset('lirary/common/jquery.loadTemplate.js')}}"></script>

    <style>
        .banner-title{
            font-size: 16px;
            margin: 25px 0 4px;
            color: #0e84b5;
        }
        .main-box{
            margin-top: 30px;
        }
        .detail-box{
            width: 414px;
            height: 600px;
            overflow-x: hidden;
            overflow-y: scroll;
            float: left
        }
        .title{
            font-size: 22px;
            color: #333;
            margin: 15px 10px;
            text-align: center;
        }
        .content p{
            font-size: 16px;
            margin-bottom: 15px;
            line-height: 20px;
        }
        .banner{
            height: 220px;
            width: 100%;
        }
        .ban-img{
            width: 100%;
            height: 100%;
        }
        .act-info{
            font-size: 13px;
            color: #666;
            line-height: 24px;
            margin-left: 5px;
        }
        .preview-box{
            float: left;
        }

    </style>
    <style>
        .comments-box{
            margin-left: 20px;
            width: 400px;
            float: left;
            border: 1px solid #ccc;
            padding: 15px;
        }
        .top-left{
            float: left;
        }
        .com-top{
            position: relative;
        }
        .top-right{
            float: left;
            margin-left: 10px;
        }
        .com-name{
            font-size: 16px;
        }
        .com-thumb{
            position: absolute;
            right: 0;
            top: 5px;
            font-size: 12px;
            color: #666;
        }
        .user-head{
            width: 45px;
            height: 45px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        .com-btm{
            margin-left: 50px;
            font-size: 16px;
        }
        .comment-item{
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">话题管理</a> &raquo; <a href="{{url('admin/topic')}}">话题列表</a> &raquo; 话题信息
</div>
<!--面包屑导航 结束-->
<!--<div class="search_wrap">-->
<!--</div>-->

<div class="result_wrap">
    <div class="result_content">
        <div class="banner-title">话题报名信息概览：</div>
        <table class="list_tab">
            <thead>
            <tr>
                <th>话题名称</th>
                <th>浏览量</th>
                <th>参与人数</th>
                <th>发布时间</th>
            </tr>
            </thead>
            <tbody id="statistics">
            </tbody>
        </table>

        <div class="main-box clear">
            <div class="preview-box">
            </div>
            <!---->
            <div class="comments-box"></div>
        </div>
    </div>
</div>
<script type="text/html" id="preview-tmp">
    <div class="detail-box mobile">
        <div class="banner">
            <img class="ban-img" data-src="image">
        </div>
        <div class="title" data-content="title"></div>
        <section class="sec content">
            <p data-content="content"></p>
        </section>
        <section class="sec">
            <p class="act-info">浏览量：<span data-content="view"></span></p>
            <p class="act-info">评论数：<span data-content="join"></span></p>
        </section>
    </div>
</script>
<script type="text/html" id="comment-tmp">
    <div class='comment-item'>
        <div class='com-top clear'>
            <div class="top-left">
                <img class='user-head' data-src="avatarUrl">
            </div>
            <div class="top-right">
                <div class='com-name' data-content="nickName"></div>
                <div class="com-time" data-content="time"></div>
                <div class="com-thumb">点赞：<span data-content="thumb"></span></div>
            </div>
        </div>
        <div class='com-btm'>
            <div class='com-cont' data-content="comment"></div>
        </div>
    </div>
</script>

<script>
    var id = MD.get_query('id').id

    // 加载统计数据
    MD.ajax_get({
        url: '/admin/topic/topic_detail',
        data: {'id': id}
    },function (res) {
        var data = res[0]

        var tr = '<tr>\n' +
            '                    <td>'+ data.title+'</td>\n' +
            '                    <td class="tc">'+data.view+'</td>\n' +
            '                    <td class="tc">'+data.join+'</td>\n' +
            '                    <td class="tc">'+data.time+'</td>\n' +
            '                </tr>'
        $("#statistics").html(tr)

        $(".preview-box").loadTemplate($("#preview-tmp"),data);
    })

    var show_commonts = function () {
        MD.ajax_get({
            url: 'admin/wx/topic_commentlist',
            data: {"top_id": id, "current": ""}
        }, function (res) {
            if(res.length <= 0){
                $(".comments-box").html("<p>暂无更多评论……</p>")
                return;
            }
            var $div = $("<div></div>")
            $div.loadTemplate($("#comment-tmp"),res);
            $(".comments-box").html("").append($div)
        })
    }
    show_commonts();
</script>
</body>
</html>