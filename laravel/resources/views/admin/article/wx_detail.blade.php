<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>文章详情</title>

    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
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
        .img_loading{
            max-width: 100%;
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

    <div class="result_wrap">
        <div class="result_content">
            <div id="article"></div>
            <div id="comments"></div>
        </div>
    </div>

<script>

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

        var hcontent = "<div class='content'>"+ res.content +"</div>"

        $("#article").html(htitle + hinfo + hcontent)
        console.log(res.content)
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

</script>
</body>
</html>