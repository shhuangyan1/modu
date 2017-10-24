<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>信息首页</title>
    <link rel="stylesheet" href="style/css/ch-ui.admin.css">
	<link rel="stylesheet" href="style/font/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('css/info.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('lirary/common/echarts.common.min.js')}}" ></script>
    <script src="{{asset('lirary/common/moment.js')}}" ></script>  <!--时间转时间戳 -->
    <script src="{{asset('lirary/jedate/jedate.js')}}" ></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>

</head>
<body>
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap hide" style="margin-bottom: 50px;">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>发布文章</a>
                <a href="{{url('admin/topic/create')}}"><i class="fa fa-plus"></i>新增话题</a>
                <a href="{{url('admin/activity/create')}}"><i class="fa fa-plus"></i>发布活动</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap hide">
        <div class="result_title">
            <h3>掌上魔都指南</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>管理平台使用帮助：</label><span><a href="javascript:;">点击下载帮助文档</a></span>
                </li>
                <li>
                    <label>编辑交流QQ群：</label><span><a href="javascript:;"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

    <!--数据统计-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>掌上魔都整体情况</h3>
        </div>
        <div class="result_content">
            <div class="block-box">
                <div class="block">
                    <p class="block_t">文章数</p>
                    <p class="block_num">252</p>
                </div>
                <div class="block">
                    <p class="block_t">话题数</p>
                    <p class="block_num">5</p>
                </div>
                <div class="block">
                    <p class="block_t">活动数</p>
                    <p class="block_num">1</p>
                </div>
                <div class="block">
                    <p class="block_t">总用户数</p>
                    <p class="block_num">86</p>
                </div>
            </div>
        </div>
    </div>

    <div class="result_wrap">
        <div class="result_title">
            <h3>数据统计分析</h3>
        </div>
        <div class="result_content">
            <div class="echarts-box">
                <!-- 文章增长走势图 -->
                <section>
                    <div class="echarts-opt">
                        <label class="time-label"><span>起始时间：</span><input type="text" class="time" name="from" readonly></label>
                        <label class="time-label"><span>终止时间：</span><input type="text" class="time-to" name="to" readonly></label>
                        <button class="button art-line-btn"><i class="fa fa-search"></i> 查询</button>
                    </div>
                    <div class="echarts" id="article-line">
                    </div>
                </section>

                <!-- 各分类文章占比饼形图 -->
                <section>
                    <div class="echarts-opt">各分类文章占比饼形图</div>
                    <div class="echarts">

                    </div>
                </section>



            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{asset('js/info.js')}}"></script>

</body>
</html>