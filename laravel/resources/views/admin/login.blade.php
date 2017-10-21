<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>掌上魔都</title>

	<link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('lirary/common/jquery.particleground.min.js')}}"></script>
    <script src="{{asset('lirary/common/demo.js')}}"></script>

</head>
<body>
<div id="particles">
    <canvas class="pg-canvas" width="1920" height="923"></canvas>
    <div class="intro" style="margin-top: -120.5px;">

	<div class="login_box">
		<!--<h1></h1>-->
		<h2>掌上魔都 后台管理</h2>
		<div class="form">
			@if (session('msg'))
			<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="username" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('code')}}" alt="验证码图片" onclick="this.src='{{url('code')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登录"/>
					</li>
				</ul>
			</form>
			{{--<p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://www.houdunwang.com" target="_blank">http://www.houdunwang.com</a></p>--}}
		</div>
	</div>

    </div>
</div>


</body>
</html>