<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript"  src="{{asset('lirary/uploadify/jquery.uploadify.min.js')}}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('lirary/uploadify/uploadify.css')}}">
   

    <link href="{{asset('lirary/ueditor2/themes/default/css/ueditor.css')}}" type="text/css" rel="stylesheet">

    <!--<script type="text/javascript" src="{{asset('lirary/umeditor/third-party/jquery.min.js')}}"></script>-->
    <script type="text/javascript" src="{{asset('lirary/ueditor2/third-party/template.min.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/ueditor2/lang/zh-cn/zh-cn.js')}}"></script>

    <style>
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:26px;}
        div.edui-box{overflow: hidden;}
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
    
    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post"  enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <td class="td_lab"><i class="require">*</i>分类：</td>
                        <td>
                            @foreach($data as $v)
                            <label>
                                <span class="label-cat">{{$v->_cat_name}}</span>
                                <input class="cat_id" type="radio" name="cat_id" value="{{$v->id}}">
                            </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="td_lab"><!--<i class="require">*</i>标题：--></td>
                        <td>
                            <input type="text" class="lg" name="title" placeholder="请输入标题" style="border: none; border-bottom: 1px solid #ccc;" >
                            <p>标题不得超过30个字</p>
                        </td>
                    </tr>
                    <script type="text/javascript"  src="{{asset('lirary/uploadify/jquery.uploadify.min.js')}}" ></script>
                    <link rel="stylesheet" href="{{asset('lirary/uploadify/uploadify.css')}}">
                    <tr>
                        <td class="td_lab"><i class="require">*</i>缩略图：</td>
                        <td><div id="queue"></div>
                            <input type="text" size="50" name="image">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">

                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText' : '图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    'token'     : '{{csrf_token()}}'
                                },
                                'swf'      : "{{asset('lirary/uploadify/uploadify.swf')}}" ,

                                'uploader' : "{{url('admin/upload')}}",
                                'onUploadSuccess' : function(file, data, response) {
                                    $('input[name=image]').val(data);
                                    $('#art_thumb_img').attr('src', '/' + data);
                                }
                            });
                        });
                    </script>
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="td_lab">来源：</td>
                        <td>
                            <input type="text" name="author">
                            <span><i class="fa fa-exclamation-circle red"></i>默认为原创</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_lab">详细内容：</td>
                        <td>
                           <script type="text/plain" id="myEditor" name="content" style="width:1000px;height:240px;"></script>

                        </td>
                    </tr>
                    {{--<tr>--}}
                        {{--<th>作者：</th>--}}
                        {{--<td>--}}
                            {{--<input type="text" name="author">--}}
                            {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>

<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
     var ue = UE.getEditor('myEditor',{
         elementPathEnabled: false,
     });


</script>
</html>