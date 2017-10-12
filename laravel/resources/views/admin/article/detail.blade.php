<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>文章详情</title>

    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <style>
        .title{
            font-size: 30px;
            margin: 15px 0 20px;
            line-height: normal;
        }
        .info{
            font-size: 14px;
            color: #999;
            margin-bottom: 25px;
        }
        .info_text{
            margin-right: 15px;
        }
        .opt-bar{
            padding: 0 0 15px;
            text-align: right;
        }
        .opt-bar button.default{
            color: #ff9800;
        }
        .preview-img{
            width: 100%;
        }
        /*问答*/
        .com-left{
            width: 60px;
            float: left;
        }
        .user-head{
            width: 45px;
            height: 45px;
            display: inline-block;
            border-radius: 50%;
        }
        .com-right{
            margin-left: 60px;
        }
        .com-name{
            color: #333;
            font-size: 16px;
        }
        .com-time{
            font-size: 14px;
            color: #666;
        }
        .det-top{
            position: relative;
        }
        .thumb{
            position: absolute;
            right: 40px;
            top: 0;
        }
        .com-cont{
            font-size: 14px;
            margin: 8px 0 0;
            color: #666;
        }
        #comments{
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .question{
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; <a id="history" href="#">文章列表</a> &raquo; 文章详情
    </div>
    <!--面包屑导航 结束-->

    <div class="result_wrap">
        <div class="result_content">
            <div id="article"></div>
            <div id="comments"></div>
        </div>
    </div>

<script>
    $("#history").attr('href', document.referrer)
    var para = MD.get_query('id')
    para = MD.merger(para,{openid: ''});

    /**
     * 加载文章主题信息
     */
    MD.ajax_get({
        url: '/admin/article/article_detail',
        data: para
    }, function (res) {
        var htitle = "<p class='title'>"+ res.title +"</p>"
        var hinfo = "<div class='info'>" +
            "<span class='info_text'>发布者："+ res.author +"</span>" +
            "<span class='info_text'>来源："+ res.from +"</span>" +
            "</div>"
        var hopt = '<div class="opt-bar">' +
                '<span>阅读模式：</span>'+
            '            <button class="button default wechat"><i class="fa fa-wechat"></i>微信</button>' +
            '            <button class="button default desktop"><i class="fa fa-desktop"></i>全屏</button>' +
            '        </div>'

        var hcontent = "<div class='content'>"+ res.content +"</div>"

        $("#article").html(htitle + hinfo + hopt + hcontent)

    })

    /**
     * 加载文章评论列表
     */
    MD.ajax_get({
        url: '/admin/wx/article_commentlist',
        data: {article_id: para.id, current: ''}
    },function (res) {
        var hcomments = ''
        $.each(res, function (i, v) {
            hcomments += "<div class='question clear'>\n" +
                "                    <div class='com-left'>\n" +
                "                        <img class='user-head' src='"+ v.avatarUrl +"'>\n" +
                "                    </div>\n" +
                "                    <div class='com-right'>\n" +
                "                        <div class='det-top'>\n" +
                "                            <div class='com-name'>"+ v.nickName +"</div>\n" +
                "                            <div class='com-time'>"+ v.time +"</div>\n" +
                "                            <div class='thumb'><i class='fa fa-thumbs-o-up'></i>"+ v.thumb +"</div>\n" +
                "                        </div>\n" +
                "                        <div class='com-cont'>"+ v.comment +"</div>\n" +
                "                    </div>\n" +
                "                </div>"
        })

        if(hcomments == ''){
            $("#comments").html("<p style='line-height: 30px; color: #999; text-align: center;'>暂无评论</p>")
        }else{
            $("#comments").html(hcomments)
        }
    })

    /**
     * 点击切换阅读模式
     */
    $(document).on("click", '.wechat', function () {
        $(".result_content").css({width: '414px'});

        //图片处理
        var imgs = $('.content').find('img')
        $.each(imgs, function (i, v) {
            if($(v).width() >= 414){
                $(v).addClass("preview-img")
            }
        })

    })
    $(document).on("click", '.desktop', function () {
        $(".result_content").css({width: 'auto'})

        // 图片还原
        $('.content').find('img').removeClass('preview-img')
    })

    MD.scrollTop();
</script>
</body>
</html>