<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理员个人中心</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <link rel="stylesheet" href="{{asset('css/info.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

</head>
<body>
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 个人中心
</div>

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_content" style="margin: 15px 0 0 30px;">
        <section>
            <div class="sec-title">数据统计</div>
            <div class="person-num">
                <span>累计发文（原创）：</span>
                <span class="art_num">0</span>
            </div>
        </section>
        <section>
            <div class="sec-title">信息维护</div>

            <div class="step-box">
                <!--<div class="step_title">修改密码</div>-->
                <div class="step_cont">
                   <!-- <div class="step_wrap">
                        <label>
                            <span>登录名:</span>
                            <input type="text" id="username" name="username" value="bra" readonly>
                        </label>
                    </div>-->
                    <div class="step_wrap">
                        <label>
                            <span>原始密码:</span>
                            <input type="password" id="password" name="password" placeholder="请输出原始密码进行身份校验">
                        </label>
                    </div>
                    <div class="step_wrap">
                        <label>
                            <span>新密码:</span>
                            <input type="password" id="newPwd" name="password" placeholder="请设置新密码">
                        </label>
                    </div>
                    <div class="step_wrap">
                        <label>
                            <span>确认密码:</span>
                            <input type="password" id="newPwdCopy" name="password" placeholder="请确认新密码">
                        </label>
                    </div>
                    <div class="step_wrap">
                        <button type="submit" class="button submit-btn">确认修改</button>
                    </div>

                </div>
            </div>

        </section>

    </div>
</div>


<script type="text/javascript" src="{{asset('js/person.js')}}"></script>
</body>
</html>