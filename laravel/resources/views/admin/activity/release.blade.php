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
    <script type="text/javascript" src="{{asset('js/release.js')}}"></script>

    <script src="{{asset('lirary/jedate/jedate.min.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}"></script>


    <style>
        @import "{{asset('css/mdForm.css')}}";
        body{
            font-family: "Microsoft YaHei";
        }
        #new-activity input.title,#new-activity .description{
            border: none;
            box-shadow: none;
            outline: none;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }
        #new-activity .description:focus{
            box-shadow: none;
            outline: none;
            border-bottom: 1px solid #337ab7;
        }
        #new-activity .description{
            width: 100%;
            height: 130px;
            font-size: 16px;
            border-bottom: 1px solid #e7e7eb;
            resize: none;
        }
        #act-form{
            min-width: 1039px;
            overflow: hidden;
        }
        input.button{
            width: 150px;
            height: 30px;
        }
        .sec-left,.sec-right{
            width: 30%;
            float: left;
            min-width: 240px;
        }
        .sec input{
            width: 240px;
        }
        .sec input[type=radio]{
            width: 100%;
        }
        .sec p{
            color: #666;
            font: 14px "Microsoft Yahei";
        }
        .sec-opt{
            display: inline-block;
        }
        .cl-items-box{
            margin: 15px 50px 0;
        }
        /*input::-webkit-outer-spin-button,*/
        /*input::-webkit-inner-spin-button {*/
            /*-webkit-appearance: none !important;*/
            /*margin: 0;*/
        /*}*/
        .add-cover{
            width: 222px;
        }
        .upload-img-box{
            width: auto;
        }
        .description-nums{
            font-size: 12px;
            color: #666;
        }
        .inputs div{
            margin-top: 15px;
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

        <p style="margin: 0 50px 10px; color: #333;font-size: 16px;">请在这里填写活动详细描述</p>
        <section class="no-border" id="editor-box">
        </section>

        <section class="sec clear">
            <div style="margin-bottom: 15px;">
                <span>上传活动海报 或 宣传视频 （二选一）</span>
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
                <input type="text" class="limit number" name="limits" min="1" placeholder="请在这里填写活动限制人数" >
            </div>
            <div class="sec-left">
                <p>活动开始时间</p>
                <p class="datep"> <input type="text" class="time datainp" name="time" readonly placeholder="请在这里填写活动时间" ></p>
            </div>
            <div class="sec-left">
                <p>活动参与费用（默认免费） / 元</p>
                <input type="text" class="fee number" name="fee" value="0"  placeholder="请在这里填写活动参与费用" >
            </div>
            <div class="clear"></div>
            <div class="sec-left">
                <p>关键词</p>
                <input type="text" class="key" name="key" value=""  placeholder="请在这里填写活动关键词">
            </div>
            <div>
                <p>请填写活动地址</p>
                <input type="text" style="width: 480px;" class="address" name="address" placeholder="请在这里填写活动地址">
            </div>
        </section>
        <section class="no-border collect-box">
            <input type="checkbox" id="collect" name="collect" value="true" mdtext="是否收集参与活动的用户信息">
            <div class="cl-items-box hide">
                <input type="checkbox" id="phone" name="phone" mdtext="手机号">
                <input type="checkbox" id="name" name="name" mdtext="姓名">

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
    $("#editor-box").html('<script type="text/plain" id="myEditor" name="content" style="width:100%;height:240px;min-width: 800px;"><\/script>')

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor',{
        elementPathEnabled: false
    });

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