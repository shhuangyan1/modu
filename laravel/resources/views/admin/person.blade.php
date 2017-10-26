<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理员个人中心</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>

</head>
<body>
<!--结果集标题与导航组件 开始-->
<div class="result_wrap" style="margin-bottom: 50px;">
    <div class="result_content">
        <div class="step_title">1、确认密码</div>
        <div class="step_cont">
            <label>
                <span>登录名:</span>
                <input type="text" name="username" value="">
            </label>
            <label>
                <span>原始密码:</span>
                <input type="text" name="password">
            </label>
        </div>
    </div>
</div>

</body>
</html>