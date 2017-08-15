<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>发布活动</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/release.js')}}"></script>

    <script src="{{asset('lirary/jedate/jedate.min.js')}}"></script>

    <style>
        @import "{{asset('css/mdForm.css')}}";
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
            height: 150px;
            font-size: 14px;
            border-bottom: 1px solid #e7e7eb;
            resize: none;
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
        /*input::-webkit-outer-spin-button,*/
        /*input::-webkit-inner-spin-button {*/
            /*-webkit-appearance: none !important;*/
            /*margin: 0;*/
        /*}*/
    </style>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">活动管理</a> &raquo; 发布活动
</div>
<!--面包屑导航 结束-->

<div id="new-activity" class="result_wrap section-ctrl">
    <form action="{{url('admin/activity')}}" method="post" enctype="multipart/form-data" name="form" onsubmit="return newActivity();">
        {{csrf_field()}}
        <section>
            <input type="text" class="title" name="title" placeholder="请在这里填写活动名称" maxlength="60" >
        </section>
        <section class="no-border">
            <textarea class="description" name="description" placeholder="请在这里填写活动描述"></textarea>
        </section>

        <section class="sec clear inputs">
            <div class="sec-left">
                <p>活动限制人数 / 人</p>
                <input type="text" class="limit" name="limits" min="1" placeholder="请在这里填写活动限制人数" >
            </div>
            <div class="sec-left">
                <p>活动开始时间</p>
                <p class="datep"> <input type="text" class="time datainp" name="time" readonly placeholder="请在这里填写活动时间" ></p>
            </div>
            <div class="sec-left">
                <p>活动参与费用（默认免费） / 元</p>
                <input type="text" class="fee " name="fee" value="免费"  placeholder="请在这里填写活动参与费用" >
            </div>
            <div class="clear"></div>
            <div style="margin-top: 15px;">
                <p>请填写活动地址</p>
                <input type="text" style="width: 480px;" class="address" name="address" placeholder="请在这里填写活动地址">
            </div>
        </section>
        <section class="no-border sec clear">
            <div style="margin-bottom: 15px;"><p>上传活动海报 或 宣传视频 （只能选择海报和视频中的一种）</p></div>
                <div class="sec-opt">
                    <input type="radio" class="up-image" checked name="restype" value="image" mdtext="上传活动海报">
                    <input type="radio" class="up-video" name="restype" value="video" mdtext="上传活动视频">
                </div>
                <div class="upload-img-box">
                    <input id="file_upload" name="image" type="file" accept="image/*" style="display: none;">
                    <p>活动海报建议尺寸：900px * 500px</p>
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
                <div class="upload-img-box">
                    <input id="video_upload" name="video" type="file" accept="video/3gpp,video/mp4,video/mpeg" style="display: none;">
                    <p>活动视频建议5分钟以内</p>
                    <div class="add-cover add-video">
                        <i class="fa fa-youtube-play"></i>
                        <div class="tab">上传活动视频</div>
                    </div>
                    <div class="video-preview">
                        <video id="myVideo" width="400" height="160" src="{{asset('storage/videos/test2.mp4')}}" controls></video>
                        <!--<div class="tab">更换视频</div>-->
                    </div>
                </div>
        </section>

        <section class="no-border">
            <input class="button default confirm" type="submit" value="确认发布">
            <input class="button primary btn-preview" type="button" value="预览">
        </section>

    </form>

</div>
<script>

    jeDate({
        dateCell:".time",
        format:"YYYY-MM-DD hh:ss",
//        isinitVal:true,
        isTime:true,
        minDate:"2015-10-19 00:00",
        maxDate:"2099-01-01 00:00"
    });
    MD.Form(".sec-opt",{type:'radio'})

</script>
</body>
</html>