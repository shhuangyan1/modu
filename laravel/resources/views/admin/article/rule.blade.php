<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>智能抓取规则设置</title>

    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <style>
        .text{
            display: block;
        }
        .text input{
            border: none;
            outline: none;
            box-shadow: none;
            background: transparent;
        }
        .edit input{
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        }
        table.list_tab tr td input[type='text']{
            width: 250px;
            text-align: left;
        }
        #createNewRule{
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 智能抓取规则设置
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <!--<form action="" method="get">-->
            <!--{{csrf_field()}}-->
            <!--<table class="search_tab">-->
                <!--<tr>-->
                    <!--<th width="70">关键字：</th>-->
                    <!--<td><input type="text" name="title" placeholder="搜索文章标题关键字"></td>-->
                    <!--<td><input type="submit"  value="查询"></td>-->
                <!--</tr>-->
            <!--</table>-->
        <!--</form>-->

        <button class="button primary" id="createNewRule">
            <i class="fa fa-plus"></i>新建规则
        </button>

    </div>
    <!--结果页快捷搜索框 结束-->

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <thead>
                <tr>
                    <th>所属平台</th>
                    <th>解析规则</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="tbody">
                <tr>
                    <td class="tc">
                        <label class="text">
                            <input type="text" disabled name="webname" value="" placeholder="平台名称，如微信公众平台">
                        </label>
                        <label class="text">
                            <input type="text" disabled name="url" value="" placeholder="平台网址：如https://mp.weixin.qq.com">
                        </label>
                    </td>
                    <td class="tc">
                        <label class="text">
                            <span>标题：</span>
                            <input type="text" name="container1" disabled placeholder="标题标签，如#title或.title">
                            <input type="text" name="index1" class="number" disabled placeholder="标签索引，如0或1，默认为0">
                        </label>
                        <label class="text">
                            <span>作者：</span>
                            <input type="text" name="container2" disabled placeholder="标题标签，如#author或.author">
                            <input type="text" name="index2" disabled class="number" placeholder="标签索引，如0或1，默认为0">
                        </label>
                        <label class="text">
                            <span>来源：</span>
                            <input type="text" name="container3" disabled placeholder="标题标签，如#from或.from">
                            <input type="text" name="index3" class="number" disabled placeholder="标签索引，如0或1，默认为0">
                        </label>
                        <label class="text">
                            <span>日期：</span>
                            <input type="text" name="container4" disabled placeholder="标题标签，如#date或.date">
                            <input type="text" name="index4" class="number" disabled placeholder="标签索引，如0或1，默认为0">
                        </label>
                        <label class="text">
                            <span>正文：</span>
                            <input type="text" name="container5" disabled placeholder="标题标签，如#content或.content">
                            <input type="text" name="index5" class="number" disabled placeholder="标签索引，如0或1，默认为0">
                        </label>
                    </td>
                    <td class="tc opt">
                        <a data-id="1" class="rule-edit">编辑</a>
                        <a data-id="1" class="rule-confirm hide">完成</a>
                        <a data-id="1" class="rule-cancel hide">取消</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<script src="{{asset('js/rule.js')}}"></script>
<script type="text/html" id="create-template">
    <tr>
        <td class="tc">
            <label class="text edit">
                <input type="text"  name="webname" value="" placeholder="平台名称，如微信公众平台">
            </label>
            <label class="text edit">
                <input type="text"  name="url" value="" placeholder="平台网址：如https://mp.weixin.qq.com">
            </label>
        </td>
        <td class="tc value-box">
            <label class="text edit">
                <span>标题：</span>
                <input type="text" name="container1"  placeholder="标题标签，如#title或.title">
                <input type="text" name="index1" class="number"  placeholder="标签索引，如0或1，默认为0">
            </label>
            <label class="text edit">
                <span>作者：</span>
                <input type="text" name="container2"  placeholder="标题标签，如#author或.author">
                <input type="text" name="index2"  class="number" placeholder="标签索引，如0或1，默认为0">
            </label>
            <label class="text edit">
                <span>来源：</span>
                <input type="text" name="container3"  placeholder="标题标签，如#from或.from">
                <input type="text" name="index3" class="number"  placeholder="标签索引，如0或1，默认为0">
            </label>
            <label class="text edit">
                <span>日期：</span>
                <input type="text" name="container4"  placeholder="标题标签，如#date或.date">
                <input type="text" name="index4" class="number"  placeholder="标签索引，如0或1，默认为0">
            </label>
            <label class="text edit">
                <span>正文：</span>
                <input type="text" name="container5"  placeholder="标题标签，如#content或.content">
                <input type="text" name="index5" class="number"  placeholder="标签索引，如0或1，默认为0">
            </label>
        </td>
        <td class="tc opt">
            <a class="create-rule-confirm">完成</a>
            <a class="create-rule-cancel">取消</a>
        </td>
    </tr>
</script>
</body>
</html>