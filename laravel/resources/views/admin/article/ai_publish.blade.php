<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>智能抓取文章</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>

    <link href="{{asset('lirary/ueditor2/themes/default/css/ueditor.css')}}" type="text/css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/ueditor2/lang/zh-cn/zh-cn.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <link rel="stylesheet" href="{{asset('css/ai-publish.css')}}">
</head>

<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 智能抓取
</div>
<!--面包屑导航 结束-->

<div  class="result_wrap">
    <form action="{{url('admin/article/ai_article')}}" onsubmit="return analyze()">
        <input type="text" id="url" name="url" placeholder="输入目标页面网址，http://...">
        <input type="submit" value="开始解析">
    </form>
    <!--解析框-->
  <div class="result-box clear">
    <div class="release-box">
        <div class="error-box hide ">
            <p>解析失败，请重试！</p>
            <p><input type="button" value="重新解析"></p>
        </div>
        <div class="preview-box">
            <iframe id="preview" class="preview" src=""></iframe>
            <div class="prev-cover"></div>
        </div>
    </div>

    <!--编辑框-->
    <div class="edit-box">

    </div>
  </div>
</div>


<script src="{{asset('js/ai-publish.js')}}"></script>
</body>
</html>

