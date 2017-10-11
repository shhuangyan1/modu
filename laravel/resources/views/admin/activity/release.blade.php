<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>发布活动</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>

    <link href="{{asset('lirary/ueditor2/themes/default/css/ueditor.css')}}" type="text/css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/ueditor2/lang/zh-cn/zh-cn.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/activity-release.css')}}">
    <script type="text/javascript" src="{{asset('js/release.js')}}"></script>

    <script src="{{asset('lirary/jedate/jedate.min.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}"></script>


    <style>
        @import "{{asset('css/mdForm.css')}}";
        body{
            font-family: "Microsoft YaHei";
        }
    </style>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">活动管理</a> &raquo; 发布活动
</div>
<!--面包屑导航 结束-->

<div id="new-activity" class="result_wrap section-ctrl">
    <form id="act-form" action="{{url('admin/activity')}}" method="post" enctype="multipart/form-data" name="form" onsubmit="return newActivity();">
        {{csrf_field()}}
        <section>
            <input type="text" class="title" name="title" placeholder="请在这里填写活动名称" maxlength="60" >
        </section>
        <section class="no-border">
            <textarea class="description" name="description" maxlength="300" placeholder="请在这里填写活动摘要"></textarea>
            <div class="description-nums">字数统计</div>
        </section>

        <!--活动详情 -->

        <p class="banner-title" style="margin: 0 50px 10px;">请在这里填写活动详细描述</p>
        <section class="no-border" id="editor-box">
        </section>

        <section class="sec clear">
            <div class="upload-opt-box" style="margin-bottom: 15px;">
                <span class="banner-title">上传活动海报 或 宣传视频 （二选一）</span>
                <div class="sec-opt">
                    <input type="radio" class="up-image" checked name="restype" value="image" mdtext="上传活动海报">
                    <input type="radio" class="up-video" name="restype" value="video" mdtext="上传活动视频">
                </div>
            </div>

            <div class="upload-img-box">
                <input id="file_upload" name="image" type="file" style="display: none;">
                <p>话题海报建议尺寸10：5 ~ 10：6 （最小横宽比 400px：200px）</p>
                <div class="add-cover add-img">
                    <i class="fa fa-photo"></i>
                    <div class="tab">上传活动海报</div>
                </div>
                <div class="add-cover hide img-preview">
                    <img src="#"  alt="海报图片" />
                    <div class="tab">更换海报</div>
                </div>
            </div>
            <!--上传视频-->
            <div class="upload-video-box hide">
                <input class="video" type="hidden" name="video" value="">
                <p>活动视频建议5分钟以内</p>
                <div class="add-cover add-video">
                    <i class="fa fa-youtube-play"></i>
                    <div class="tab">上传活动视频</div>
                </div>
                <div class="video-preview hide">
                    <video id="myVideo" width="330" height="160" src="" controls autoplay></video>
                    <!--<div class="tab">更换视频</div>-->
                </div>
            </div>
        </section>
        <section class="sec clear inputs">
            <div class="sec-left">
                <p>活动限制人数 / 人</p>
                <input type="text" class="limit number" name="limits" min="1" placeholder="请填写活动限制人数">
            </div>
            <div class="sec-left">
                <p>活动开始时间</p>
                <p class="datep"> <input type="text" class="time datainp" name="time" readonly placeholder="请填写活动时间"></p>
            </div>
            <div class="sec-left">
                <p>活动参与费用（默认免费） / 元</p>
                <input type="text" class="fee number" name="fee" value="0"  placeholder="请填写活动参与费用">
            </div>
            <div class="clear"></div>
            <div class="sec-left">
                <p>关键词</p>
                <input type="text" class="key" name="key" value="" maxlength="8" placeholder="请填写活动关键词">
            </div>
            <div>
                <p>请填写活动地址</p>
                <input type="text" style="width: 480px;" class="address" name="address" placeholder="请填写活动地址">
            </div>
        </section>
        <section class="no-border collect-box">
            <div class="sec-banner">
                <p class="banner-title" style="margin-bottom: 15px;">设置报名表单</p>
                <input type="checkbox" id="collect" name="collect" value="true" mdtext="是否收集参与活动的用户信息">
            </div>
            <div class="cl-items-box hide">

                <input type="checkbox" id="name" checked  name="name" value="name" mdtext="姓名">
                <input type="checkbox" id="phone" checked  name="phone" value="phone" mdtext="手机号">
                <input type="checkbox" id="email" checked name="email" value="email" mdtext="邮箱">
                <input type="checkbox" id="sex" name="sex" value="sex" mdtext="性别">
                <input type="checkbox" id="age" name="age" value="age" mdtext="年龄">
                <input type="checkbox" id="wechat" name="wechat" value="wechat" mdtext="微信">
                <input type="checkbox" id="qq" name="qq" value="qq" mdtext="QQ">
                <input type="checkbox" id="address" name="useraddress" value="useraddress" mdtext="联系地址">
                <input type="checkbox" id="company" name="company" value="company" mdtext="工作单位">
                <input type="checkbox" id="position" name="position" value="position" mdtext="职位">
                <input type="checkbox" id="education" name="education" value="education" mdtext="学历">
                <input type="checkbox" id="hobby" name="hobby" value="hobby" mdtext="爱好">
                <input type="checkbox" id="blood" name="blood" value="blood" mdtext="血型">

            </div>
        </section>

        <section class="no-border">
            <input class="button default confirm" type="submit" value="确认发布">
            <!--<input class="button primary btn-preview" type="button" value="预览">-->
        </section>

    </form>
    <section class="hide">
        <form id="video-form" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <input id="video_upload" name="video" type="file" accept="video/3gpp,video/mp4,video/mpeg">
        </form>
    </section>
</div>
<script>
    $("#editor-box").html('<script type="text/plain" id="myEditor" name="content" style="width:100%;height:240px;"><\/script>')

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor',{
        elementPathEnabled: false
    });
    ue.addListener('ready',function () {
        MD.wechat();
    })

    jeDate({
        dateCell:".time",
        format:"YYYY-MM-DD hh:ss",
//        isinitVal:true,
        isTime:true,
        minDate:"2015-10-19 00:00",
        maxDate:"2099-01-01 00:00"
    });
    MD.Form(".sec-opt",{type:'radio'});
    MD.Form(".collect-box",{type:'checkbox'});


</script>
</body>
</html>