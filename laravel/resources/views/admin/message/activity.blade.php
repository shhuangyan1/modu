<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>活动消息</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('lirary/jedate/jedate.min.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>

    <link rel="stylesheet" href="{{asset('lirary/swiper/swiper.min.css')}}">
    <script src="{{asset('lirary/swiper/swiper.jquery.min.js')}}"></script>
    <script src="{{asset('lirary/common/jquery.loadTemplate.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/msg-activity.css')}}">
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">消息管理</a> &raquo; 活动消息
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <!--全部活动 预览 轮播效果展示 -->
    <div class="activity-swiper">
        <div class="swiper-container">
            <div class="swiper-wrapper" id="list-slide-box">

                <!--<div class="swiper-slide">Slide 2</div>-->
            </div>
            <!-- 如果需要分页器 -->
            <div class="swiper-pagination"></div>

            <!-- 如果需要导航按钮 -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>
    <!--主体展示容器 详情 -->
    <div class="activity-main clear">
        <!--左侧显示活动详情-->
        <div class="act-detail-box">
            <!--template-->
        </div>

        <!--右侧显示活动的问答 -->
        <div class="act-ask-box mobile hide">
            <p>问答信息加载中。。。</p>
        </div>
    </div>

</div>
<!--模板 -->

<!--横向轮播 -->
<script id="activity-list-tmp" type="text/html">
<div class="swiper-slide">
    <img data-src="image" class="poster">
    <div class="list-opt">
        <p>
            <span data-content="title"></span>
            <a class="btn default check-btn" data-value="id">查看</a>
        </p>
    </div>
</div>
</script>

<!--选中预览 -->
<script id="activity-tmp" type="text/html">
    <div class="detail-box mobile">
        <div class="banner">
            <img class="ban-img" data-src="image">
        </div>
        <div class="title" data-content="title"></div>
        <section class="sec">
            <p class="sec-title">报名人数</p>
            <!--进度条 -->
            <div class="progress clear">
                <div class="pro-box">
                    <div class="pro-inner"></div>
                </div>
                <div class="limit">限额人数：<span data-content="limits"></span>人</div>
            </div>
            <p>已报名：<span data-content="joined"></span>人</p>
        </section>
        <section class="sec">
            <p class="act-info">活动费用：<span data-content="fee"></span></p>
            <p class="act-info">活动时间：<span data-content="time"></span></p>
            <p class="act-info">活动地点：<span data-content="address"></span></p>
        </section>
        <section class="sec">
            <p class="sec-title">活动摘要</p>
            <p data-content="description"></p>
        </section>
        <section class="sec">
            <p class="sec-title">活动详情</p>
            <div class="html" data-content="content">
            </div>
        </section>
    </div>
</script>

<!--问答-->
<script id="ask-list-tmp" type="text/html">
    <div class='com-box'>
        <div class='question clear'>
            <div class='com-left'>
                <img class='user-head' data-src="avatarUrl">
            </div>
            <div class='com-right'>
                <div class='com-name' data-content="nickName"></div>
                <div class='com-cont' data-content="content"></div>
            </div>
        </div>

        <div class='answer clear'>
            <div class='com-left'>
                <img class='user-head' src="https://tvax3.sinaimg.cn/crop.0.0.400.400.180/006VhaXvly8fiehmglbm2j30b40b4jse.jpg">
            </div>
            <div class='com-right'>
                <div class='com-name'>掌上魔都</div>
                <div class='com-cont'>
                    <input class="text" data-value="reply" placeholder="写回复">
                    <button class="btn back-btn" data-value="id">回复</button>
                </div>
            </div>
        </div>

    </div>
</script>

<script type="text/javascript" src="{{asset('js/msg-activity.js')}}"></script>
</body>
</html>