<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>智能发布文章</title>
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
    <script src="{{asset('lirary/jedate/jedate.min.js')}}"></script>


    <link rel="stylesheet" href="{{asset('css/ai-publish.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdForm.css')}}">
</head>

<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 智能发布
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
        <input type="text" id="url" name="url" placeholder="输入目标页面网址，http://...">
        <button id="start-release" class="button" >开始解析</button>
  <!--解析框-->
  <div class="result-box clear">
    <div class="release-box-posi">
    <div class="release-box">
        <div class="banner-title">解析显示</div>
        <div class="error-box hide ">
            <p>解析失败，请重试！</p>
            <p><input type="button" value="重新解析"></p>
        </div>
        <div class="preview-box">
            <div class="preview-back"></div>
            <iframe id="preview" name="preview" class="preview" src=""></iframe>
            <!--<iframe id="preview" name="preview" class="preview" src="{{url('admin/category/create')}}"></iframe>-->
            <div class="prev-cover hide"></div>
        </div>
    </div>
    </div>
    <!--编辑框-->
    <div class="edit-box">
        <div class="banner-title banner-result-t">解析结果
            <span class="edit-error red hide"><i class="fa fa-warning"></i>解析规则过期或暂未收录</span>
        </div>
        <div class="result-items-box">
            <div class="result-item">
                <label>
                    <span>标题：</span>
                    <input type="text" name="title" placeholder="文章标题">
                </label>
            </div>
            <div class="result-item">
                <label>
                    <span>作者：</span>
                    <input type="text" name="author" placeholder="作者">
                </label>
            </div>
            <div class="result-item">
                <label>
                    <span>文章来源：</span>
                    <input type="text" class="from" name="from" placeholder="文章来源">
                </label>
            </div>
            <div class="result-item">
                <label>
                    <span>日期：</span>
                    <input type="text" id="date" class="date" readonly name="date" placeholder="文章发布日期">
                </label>
            </div>
            <div class="result-item" id="category-box">
                <label>
                    <span>设置分类：</span>
                </label>
                <div style="margin-left: 90px;">
                    @foreach($category as $v)
                    <input class="cat_id" type="radio" name="cat_id" value="{{$v->id}}" mdtext='{{$v->cat_name}}'>
                    @endforeach
                </div>
            </div>
            <div class="result-item recommend-item">
                <label>
                    <span>是否推荐：</span>
                    <input type="checkbox" name="recommend" value="true" mdtext="推荐">
                </label>
            </div>
            <div class="result-item">
                <!--编辑器-->
                <div id="editor-box"></div>
            </div>
        </div>
    </div>
  </div>

    <div id="publish-btn-box" class="publish-btn-box">
        <div class="publish-inner">
            <div class="pb-arrow pb-up-arrow">
                <i id="pb-opt-arrow" class="fa fa-caret-up"></i>  <!--fa-caret-down-->
            </div>
            <!--隐藏的主体内容 -->
            <div class="pb-main">
                <div class="images-box">
                    <div class="banner-title">文章图片</div>
                    <div class="imgs-box clear">
                        <div class="imgs-item" style="background: url('http://www.modu.com/image/15079742197598.jpg') center / contain no-repeat"></div>
                        <div class="imgs-item" style="background: url('http://www.modu.com/image/15079742233892.jpg') center / contain no-repeat"></div>
                        <div class="imgs-item" style="background: url('http://www.modu.com/image/15079742255663.jpg') center / contain no-repeat"></div>
                    </div>
                </div>
                <!--排版选择-->
                <div id="typeset">
                    <div class="banner-title">排版选择</div>
                    <div class="typeset-box">
                        <div class="typeset-item"></div>
                    </div>
                </div>
                <button class="button confirm-button">确定发布</button>
            </div>

        </div>
    </div>
</div>
<script>
</script>

<script src="{{asset('js/ai-publish.js')}}"></script>
</body>
</html>

