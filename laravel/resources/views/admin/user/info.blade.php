<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>会员数据分析</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/jquery.jedate.css')}}">

    <link rel="stylesheet" href="{{asset('css/info.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('lirary/common/moment.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pinyin.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <script src="{{asset('lirary/jedate/jquery.jedate.min.js')}}" ></script>  <!-- 此处的jedate为最新版 -->

    <script src="{{asset('lirary/common/echarts.common.min.js')}}" ></script>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">会员管理</a> &raquo; 会员数据分析
</div>
<!--面包屑导航 结束-->

<div class="result_wrap">

    <div class="result_content">
    <div class="echarts-box">
        <section>
            <div class="block-box">
                <div class="block">
                    <p class="block_t">累计会员数量</p>
                    <p class="block_num all-num">0</p>
                </div>
                <div class="block">
                    <p class="block_t">今日新增会员</p>
                    <p class="block_num add-num">0</p>
                </div>
            </div>
        </section>

        <!--会员增长统计图-->
        <section>
            <div class="result_title">
                <h3>掌上魔都会员增长数据分析</h3>
            </div>
            <div class="echarts-opt">
                <label class="time-label range-label"><span>日期范围：</span><input type="text" id="range" name="range" readonly></label>
                <button class="button user-add-btn"><i class="fa fa-search"></i> 查询</button>
            </div>
            <div class="echarts" id="user-add-line">
            </div>
        </section>

        <section>
            <div class="result_title">
                <h3>掌上魔都会员条件匹配对比分析</h3>
            </div>
            <div class="echarts-opt"></div>
            <!--会员数据条件对比图-->
            <div class="echarts" id="user-sex-pie">
                <!--性别-->
            </div>

            <div class="echarts" id="user-area">
                <!--区域分布-->
            </div>
        </section>


    </div>
    </div>
</div>

<div class="result_wrap hide">
    <div class="result_title">
        <h3>板块一</h3>
    </div>
    <div class="result_content">
        <div class="">
            内容一
        </div>
    </div>
</div>


<script src="{{asset('js/user-info.js')}}" ></script>
</body>
</html>