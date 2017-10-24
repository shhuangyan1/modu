<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>新增话题</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/new.js')}}"></script>


    <style>
        #new-topic input[type=text],#new-topic .content{
            border: none;
            box-shadow: none;
            outline: none;
        }
        #new-topic .content:focus{
            box-shadow: none;
            outline: none;
            border-bottom: 1px solid #337ab7;
        }
        #new-topic .content{
            width: 100%;
            height: 200px;
            font-size: 16px;
            border-bottom: 1px solid #e7e7eb;
            resize: none;
        }
        input.button{
            width: 150px;
            height: 30px;
        }
        .upload-img-box{
            width: auto;
        }
        .add-cover{
            width: 240px;
        }
        .content-nums{
            color: #666;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">话题管理</a> &raquo; 新增话题
</div>
<!--面包屑导航 结束-->
<div id="new-topic" class="result_wrap section-ctrl">
    <form action="{{url('admin/topic')}}" name="form" method="post" enctype="multipart/form-data" onsubmit="return newTopic();">
        {{csrf_field()}}
    <section>
        <input type="text" class="title" name="title" placeholder="请在这里填写话题标题" maxlength="60" >
    </section>
    <section class="no-border">
        <textarea class="content" name="content" maxlength="300" placeholder="请填写话题描述"></textarea>
        <div class="content-nums">字数统计</div>
    </section>
        <section class="clear no-border">
            <div class="upload-img-box">
                <input id="file_upload" name="image" type="file" style="display: none;">
                <p>话题海报建议尺寸10：6 （最小横宽比 400px：200px）</p>
                <div class="add-cover add-img">
                    <i class="fa fa-photo"></i>
                    <div class="tab">上传海报</div>
                </div>
                <div class="add-cover hide img-preview">
                    <img src="#"  alt="海报图片" />
                    <div class="tab">更换海报</div>
                </div>
            </div>

    </section>
        <section class="no-border">
            <input class="button submit confirm" type="submit" value="确认发布">
            <!--<input class="button primary btn-preview" type="button" value="预览">-->
        </section>
    </form>
</div>
</body>
</html>