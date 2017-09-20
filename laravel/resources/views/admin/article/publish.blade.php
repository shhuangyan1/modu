<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>发布文章</title>

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

    <link rel="stylesheet" href="{{asset('css/article-publish.css')}}">
    <script type="text/javascript" src="{{asset('js/publish.js')}}"></script>

    <style>
        @import "{{asset('css/mdForm.css')}}";
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:26px;}
        div.edui-box{overflow: hidden;}
        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
        #article_cat li{
            float: left;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 发布文章
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 结束-->
    
    <div id="publish-article" class="result_wrap section-ctrl">
        <form action="{{url('admin/article')}}" method="post"  enctype="multipart/form-data" onsubmit="return publish_article();">
            {{csrf_field()}}

            <div class="new_article">

                <section class="type clear" id="article_cat">
                    <p>选择文章所属分类</p>
                    <!--<ul>-->
                    @foreach($data as $v)
                    <!--<li>-->
                        <input class="cat_id" type="radio" name="cat_id" value="{{$v->id}}" mdtext="{{$v->_cat_name}}">
                    <!--</li>-->
                    @endforeach
                    {{--</ul>--}}
                </section>
                <section>
                    <input type="text" class="title" name="title" placeholder="请在这里输入标题" maxlength="60" >
                </section>
                <section class="no-border">
                    <input type="text" class="from" name="from" placeholder="填写文章来源，默认为原创">
                    <!--<span><i class="fa fa-exclamation-circle red"></i></span>-->
                </section>

                <section class="no-border" id="editor-box">
                </section>
                <section class="clear">

                    <div class="tabs-box clear">
                        <div class="tabs active" data-tmpId="single-tmp">
                            <input type="radio" name="compose" value="3">单图排版</div>
                        <div class="tabs" data-tmpId="banner-tmp">
                            <input type="radio" name="compose" value="1">大图排版</div>
                        <div class="tabs" data-tmpId="multi-tmp">
                            <input type="radio" name="compose" value="2">多图排版</div>
                    </div>
                    <div class="tmp-box clear">
                        <div id="single-tmp" class="compose-box">
                            <div class="compose-left">
                                <p>排版样式预览</p>
                                <!-- 单图排版 排版样式预览-->
                                <label class="">
                                    <div class="cmp single">
                                        <p>文章标题</p>
                                        <div class="cmp-img single-img"><i class="fa fa-photo"></i></div>
                                    </div>
                                </label>
                            </div>
                            <!--上传图片-->
                            <div class="compose-right">
                                <p>封面图片建议比例 10：6 （最小横宽比 160px：96px）</p>
                                <label>
                                    <input type="file" class="single-input" name="image">
                                    <div class="upload-box">
                                        <p class="p-txt">点此上传图片</p>
                                        <div class="fa-up"><i class="fa fa-x fa-cloud-upload"></i></div>
                                    </div>
                                </label>
                                <div class="img-preview-box">
                                    <span class="close"><i class="fa fa-x fa-times-circle"></i></span>
                                    <img class="img-preview single-img-prev" src="#">
                                </div>
                            </div>

                        </div>
                        <div id="banner-tmp" class="compose-box hide">
                            <div class="compose-left">
                                <p>排版样式预览</p>
                                <!-- 大图排版 排版样式预览-->
                                <label class="">
                                    <div class="cmp poster">
                                        <p>文章标题</p>
                                        <div class="cmp-img poster-img"><i class="fa fa-photo"></i></div>
                                    </div>
                                </label>
                            </div>
                            <!--上传图片-->
                            <div class="compose-right">
                                <p>封面图片建议比例 10：6 （最小横宽比 400px：240px）</p>
                                <label>
                                    <input type="file" class="banner-input" name="image">
                                    <div class="upload-box">
                                        <p class="p-txt">点此上传图片</p>
                                        <div class="fa-up"><i class="fa fa-x fa-cloud-upload"></i></div>
                                    </div>
                                </label>
                                <div class="img-preview-box">
                                    <span class="close"><i class="fa fa-x fa-times-circle"></i></span>
                                    <img class="img-preview banner-img-prev" src="#">
                                </div>
                            </div>
                        </div>
                        <div id="multi-tmp" class="compose-box hide">
                            <div class="compose-left">
                                <p>排版样式预览</p>
                                <!-- 多图排版 排版样式预览-->
                                <label class="">
                                    <div class="cmp multi">
                                        <p>文章标题</p>
                                        <div class="cmp-img multi-img"><i class="fa fa-photo"></i><i class="fa fa-photo"></i><i class="fa fa-photo"></i></div>
                                    </div>
                                </label>
                            </div>
                            <!--上传图片-->
                            <div class="compose-right">
                                <p>封面图片建议比例 10：6 （最小横宽比 150px：90px）</p>
                                <label>
                                    <input type="file" class="multi-input first-multi" name="image">
                                    <div class="upload-box">
                                        <p class="p-txt">点此上传图片</p>
                                        <div class="fa-up"><i class="fa fa-x fa-cloud-upload"></i></div>
                                    </div>
                                </label>
                                <div class="img-preview-box">
                                    <span class="close"><i class="fa fa-x fa-times-circle"></i></span>
                                    <img class="img-preview" src="#">
                                </div>
                                <label>
                                    <input type="file" class="multi-input second-multi" name="image">
                                    <div class="upload-box">
                                        <p class="p-txt">点此上传图片</p>
                                        <div class="fa-up"><i class="fa fa-x fa-cloud-upload"></i></div>
                                    </div>
                                </label>
                                <div class="img-preview-box">
                                    <span class="close"><i class="fa fa-x fa-times-circle"></i></span>
                                    <img class="img-preview" src="#">
                                </div>
                                <label>
                                    <input type="file" class="multi-input third-multi" name="image">
                                    <div class="upload-box">
                                        <p class="p-txt">点此上传图片</p>
                                        <div class="fa-up"><i class="fa fa-x fa-cloud-upload"></i></div>
                                    </div>
                                </label>
                                <div class="img-preview-box">
                                    <span class="close"><i class="fa fa-x fa-times-circle"></i></span>
                                    <img class="img-preview" src="#">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<div class="upload-img-box">
                        <input id="file_upload" name="image" type="file" accept="image/*" style="display: none;">
                        <p>封面大图片建议尺寸：900px * 500px</p>
                        <div class="add-cover add-img">
                            <i class="fa fa-photo"></i>
                            <div class="tab">上传封面</div>
                        </div>
                        <div class="add-cover hide img-preview">
                            <img src="#"  alt="封面图片" />
                            <div class="tab">
                                <span class="tab-upload">更换</span>
                                <span class="tab-delete">删除</span>
                            </div>
                        </div>
                    </div>-->

                 <!-- 排版选择 -->
                    <!--<div class="compose-box">
                        <p>排版选择</p>
                        <div class="clear">
                        <label class="disabled">
                            <input type="radio" id="poster-input" name="compose" value="1" disabled>
                            <div class="cmp poster">
                                <p>文章标题</p>
                                <div class="cmp-img poster-img"><i class="fa fa-photo"></i></div>
                            </div>
                        </label>
                        <label class="on">
                            <input type="radio" id="single-input" name="compose" value="2" checked>
                            <div class="cmp single">
                                <p>文章标题</p>
                                <div class="cmp-img single-img"><i class="fa fa-photo"></i></div>
                            </div>
                        </label>
                        </div>
                    </div>-->
                </section>
                <section class="no-border submit">
                    <input type="submit" value="确认发布">
                    <input class="hide" type="button" value="预览">
                </section>
            </div>


        </form>
    </div>

</body>

<script type="text/javascript">
    $("#editor-box").html('<script type="text/plain" id="myEditor" name="content" style="width:100%;height:240px;min-width: 800px;"><\/script>')

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
     var ue = UE.getEditor('myEditor',{
         elementPathEnabled: false
     });

    MD.Form("#article_cat",{type: "radio"})

</script>
</html>