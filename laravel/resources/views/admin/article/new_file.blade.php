<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript"  src="{{asset('lirary/uploadify/jquery.uploadify.min.js')}}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('lirary/uploadify/uploadify.css')}}">
   

    <!-- <link href="themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="third-party/jquery.min.js"></script>
    <script type="text/javascript" src="third-party/template.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="umeditor.min.js"></script>
    <script type="text/javascript" src="lang/zh-cn/zh-cn.js"></script> -->

    <link href="{{asset('lirary/umeditor/themes/default/css/umeditor.css')}}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{asset('lirary/umeditor/third-party/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/umeditor/third-party/template.min.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/umeditor/umeditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/umeditor/umeditor.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/umeditor/lang/zh-cn/zh-cn.js')}}"></script>


</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; newfile
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post"  enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="cat_id">
                                <option value="">==请选择==</option>
                            @foreach($data as $v)
                                <option value="{{$v->id}}">{{$v->_cat_name}}</option>
                            @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" class="lg" name="title">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                 
                    <tr>
                        <th><i class="require">*</i>缩略图：</th>
                        <td><div id="queue"></div>
                            <input type="text" size="50" name="image">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">

                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
                                },
                                'swf'      : 'uploadify.swf',
                                'uploader' : 'uploadify.php'
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
                        <th></th>
                        <td>
                            <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                        </td>
                    </tr>


                    <tr>
                        <th>作者：</th>
                        <td>
                            <input type="text" name="author">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
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
                        <th>详细内容：</th>
                        <td>
                           <script type="text/plain" id="myEditor" name="content" style="width:1000px;height:240px;">
                                <p>这里我可以写一些输入提示</p>
                            </script>
                            <style>
                                .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                            </style>
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
     var um = UM.getEditor('myEditor');


</script>
</html>