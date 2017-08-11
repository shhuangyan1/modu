<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('lirary/ueditor2/themes/default/css/ueditor.css')}}" type="text/css" rel="stylesheet">
    <!--<script type="text/javascript" src="{{asset('lirary/umeditor/third-party/jquery.min.js')}}"></script>-->
    <!--<script type="text/javascript" src="{{asset('lirary/ueditor2/third-party/template.min.js')}}"></script>-->
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('lirary/ueditor2/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('lirary/ueditor2/lang/zh-cn/zh-cn.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/publish.js')}}"></script>

    <style>
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:26px;}
        div.edui-box{overflow: hidden;}

        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
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
        <form action="{{url('admin/article')}}" method="post"  enctype="multipart/form-data" onsubmit="return publish_article();">
            {{csrf_field()}}

            <div class="new_article">
                <section class="clear">
                    @foreach($data as $v)
                    <label>
                        <span class="label-cat" data-value="{{$v->id}}">{{$v->_cat_name}}</span>
                        <input class="cat_id" type="radio" name="cat_id" value="{{$v->id}}" style="display: none;">
                    </label>
                    @endforeach
                </section>
                <section>
                    <input type="text" class="title" name="title" placeholder="请在这里输入标题" maxlength="60" >
                </section>
                <section class="no-border">
                    <input type="text" class="from" name="from" placeholder="填写文章来源，默认为原创">
                    <!--<span><i class="fa fa-exclamation-circle red"></i></span>-->
                </section>

                <section class="no-border">
                    <script type="text/plain" id="myEditor" name="content" style="width:100%;height:240px;min-width: 800px;"></script>
                </section>
                <section>
                    <input id="file_upload" name="image" type="file" accept="image/*" style="display: none;">
                    <p>封面 大图片建议尺寸：900像素 * 500像素</p>
                    <div class="add-cover">
                        <i class="fa fa-photo"></i>
                        <div class="tab">封面图片</div>
                    </div>
                </section>
                <section class="no-border submit">
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </section>
            </div>


        </form>
    </div>

</body>

<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
     var ue = UE.getEditor('myEditor',{
         elementPathEnabled: false
     });

</script>
</html>