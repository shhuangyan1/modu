<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>文章详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <style>
        html,body {width:100%;margin:0;padding: 0;}
        img {border:0;max-width:100%;}
        body {background:#fff;color: #333;font-size:14px;font-family: "Microsoft Yahei",'Simsun',"Lucida Grande",Verdana,Lucida,Helvetica,Arial,sans-serif;}
        p{text-align:center;}
        .result_wrap{width: 90%;margin: auto;}
        .title{font-size: 1.6rem;margin: 1rem 0 1rem;line-height: normal;text-align: left;}
        .info{font-size: 0.9rem;color: #999;margin-bottom: 2rem;}
        .info_text{margin-right: 1rem;}
        /*问答*/
        .com-left{width: 4rem;float: left;}
        .user-head{width: 3rem;height: 3rem;display: inline-block;border-radius: 50%;}
        .com-right{margin-left: 4rem;}
        .com-name{color: #333;font-size: 1rem;margin-bottom: 5px;}
        .com-time{font-size: 0.9rem;color: #666;}
        .det-top{position: relative;}
        .thumb{position: absolute;right: 0.5rem;top: 0;font-size: 0.9rem;color: #666;}
        .com-cont{font-size: 1rem;margin: 0.8rem 0 0;color: #666;}
        #comments{padding: 1.5rem 0 3rem;}
        .question{margin-bottom: 1rem;}
        .banner-title{font-size: 1rem;color: #5892f1;border-left: 4px solid #5892f1;height: 1rem;line-height: 1rem;border-top: 1px solid #e6e6e7;
            font-weight: bold; margin: 2rem 0;padding-left:0.8rem;}
        .banner-out{}
    </style>
</head>
<body>

    <div class="result_wrap">
        <div class="result_content">
            <div id="article"></div>
            <div class="banner-out"><div class="banner-title">热门评论</div></div>
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
                "                            <div class='thumb'><i class='thumbs'></i>"+ v.thumb +"</div>\n" +
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