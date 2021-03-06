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
<div class="search_wrap">
    <div class="search_inner">
        <input type="text" id="url" name="url" placeholder="输入目标页面网址，http://...">
        <button id="start-release" class="button" >开始解析</button>
    </div>

</div>
<div class="result_wrap">

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
      <form action="{{url('admin/article/confirm_release')}}" method="post" onsubmit="return onSubmit();">
      <div class="edit-box">
        <div class="banner-title banner-result-t">解析结果
            <span class="edit-error red hide"><i class="fa fa-warning"></i>解析规则过期或暂未收录</span>
        </div>
        <div class="result-items-box">

            <div class="result-item">
                <label>
                    <span>标题：</span>
                    <input type="text" class="title" name="title" placeholder="文章标题">
                </label>
            </div>
            <div class="result-item">
                <label>
                    <span>作者：</span>
                    <input type="text" class="author" name="author" placeholder="作者">
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
                    <input type="text" id="date" class="date" readonly name="time" placeholder="文章发布日期">
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
                    <input type="text" class="number" placeholder="设置初始阅读" name="view">
                </label>
            </div>
            <div class="result-item">
                <!--编辑器-->
                <div id="editor-box"></div>
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
                      <div class="banner-title">文章图片[选择封面] </div>
                      <input type="hidden" name="image" id="images" value="">
                      <div class="imgs-box clear" id="res-img">
                          <!--<div class="imgs-item imgs-item-on" style="background: url('http://www.modu.com/image/15081246864078.jpg') center / contain no-repeat">-->
                              <!--<div class="checked-tri"><i class="fa fa-check-square-o"></i></div>-->
                          <!--</div>-->
                          <span id="imgs-name"></span>
                          <!--<div class="imgs-prev-item imgs-prev-item-on">
                              <div class="checked-tri delete-icon" data-index=""><i class="fa fa-check-square-o "></i></div>
                              <img class="imgs-pre" src="http://www.modu.com/image/15087276417045.jpg">
                              <div class="loading-cover"
                                   style="background: rgba(255,255,255, 0.5) url('http://www.modu.com/storage/icons/loading.gif') no-repeat center">
                              </div>
                          </div>-->
                          <div class="imgs-prev-item add-cover">
                              <i class="fa fa-plus"></i>
                          </div>
                      </div>
                  </div>
                  <!--排版选择-->
                  <div id="typeset" class="clear">
                      <div class="banner-title">排版选择</div>
                      <div class="typeset-box compose-box clear">
                          <p class="typeset-none hide">正文没有可选图片</p>
                          <label class="compose3 hide">
                              <input type="radio" name="compose" value="3">
                              <div class="cmp single">
                                  <p>文章标题</p>
                                  <div class="cmp-img single-img"><i class="fa fa-photo"></i></div>
                              </div>
                          </label>
                          <label class="compose1 hide">
                              <input type="radio" name="compose" value="1">
                              <div class="cmp poster">
                                  <p>文章标题</p>
                                  <div class="cmp-img poster-img"><i class="fa fa-photo"></i></div>
                              </div>
                          </label>
                          <label class="compose2 hide">
                              <input type="radio" name="compose" value="2">
                              <div class="cmp multi">
                                  <p>文章标题</p>
                                  <div class="cmp-img multi-img"><i class="fa fa-photo"></i><i class="fa fa-photo"></i><i class="fa fa-photo"></i></div>
                              </div>
                          </label>
                      </div>
                  </div>
                  <div id="aiPublishBox">
                      <button type="submit" class="button confirm-button">确定发布</button>
                  </div>
              </div>

          </div>
      </div>
      </form>
  </div>
    <section class="hide">
        <form id="coverForm" action="" method="post" enctype="multipart/form-data">
            <input id="coverInput" class="hide" type="file" accept="image/*" name="img">
        </form>
    </section>
</div>
<script>
</script>

<script src="{{asset('js/ai-publish.js')}}"></script>
</body>
</html>

