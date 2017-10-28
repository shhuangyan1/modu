<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>群发系统消息</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>

    <link href="{{asset('lirary/ueditor2/themes/default/css/ueditor.css')}}" type="text/css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/ueditor2/lang/zh-cn/zh-cn.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/system.css')}}">
    <script type="text/javascript" src="{{asset('js/system.js')}}"></script>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">消息管理</a> &raquo; 群发系统消息
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">
    <div class="result_content">
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return sysSend();">
        <p class="attention">注意：群发消息将通过小程序中 【我的】 — 【系统消息】 栏显示</p>
        <div class="msg-opt">
            <div class="opt-inner">
                <span class="opt-select on">
                    <i class="fa fa-font"></i>文字
                    <input class="type" type="radio" checked name="type" value="1">
                </span>
                <span class="opt-select">
                    <i class="fa fa-picture-o"></i>图文
                    <input class="type" type="radio" name="type" value="2">
                </span>
            </div>
        </div>
        <div class="msg-box">
            <div id="editor-box" class="editor-box hide"></div>
            <div class="text-box">
                <textarea id="myText" name="messageText" maxlength="800"></textarea>
                <div class="nums-box">
                    <p>当前输入<span id="curNum">0</span>个字符，最多输入800字符</p>
                </div>
            </div>
        </div>
            <textarea class="preview hide" name="preview"></textarea>
            <button type="submit" class="button primary"><i class="fa fa-paper-plane-o"></i>&nbsp;群&nbsp;发</button>
        </form>

        <!-- 系统消息列表 -->
        <div id="list-table">
            <table class="list_tab">
                <thead><tr>
                    <th>消息内容</th>
                    <th>发送时间</th>
                    <th>发送人</th>
                    <th>操作</th>
                </tr></thead>
                <tbody>
                @foreach($data as $v)
                <tr>
                    <td><a>{{$v->words}}</a></td>
                    <td class="tc">{{date("Y-m-d H:i:s",$v->time)}}</td>
                    <td class="tc">{{$v->sendby}}</td>
                    <td class="tc" value="{{$v->id}}">删除</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="page_list">
                {{$data->appends(Request::all())->render()}}
            </div>
        </div>

    </div>
</div>
<script>
    $("#editor-box").html('<script type="text/plain" id="myEditor" name="message" style="width:100%;height:240px;"><\/script>')
    var ue = UE.getEditor('myEditor',{
        elementPathEnabled: false
    });
</script>
</body>
</html>