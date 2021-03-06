<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>菜单页列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/menus.js')}}"></script>

    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>

    <style>
        .search_wrap{
            padding-left: 20px;
        }
        .table_opt{
            margin-bottom: 10px;
        }
        .p_name{
            display: inline-block;
            padding: 4px 15px;
            border: 1px solid #ccc;
            margin-right: 15px;
        }
        .result_wrap>section{
            margin-bottom: 30px;
        }
        .add_pform{
            margin-top: 15px;
        }
        .add_pform input{
            width: 270px;
            margin-bottom: 15px;
        }
        table.list_tab tr td input[type='text']{
            width: 300px;
        }
        table.list_tab tr td input.name{
            width: 90%;
        }
        .list_tab .no-edit td input{
            border: none;
            background: transparent;
            box-shadow: none;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">权限管理</a> &raquo; 菜单列表
</div>
<!--面包屑导航 结束-->
<div class="search_wrap">
    <button class="button primary" id="add_parent"><i class="fa fa-plus"></i>添加新的父级菜单项</button>
    <div class="add_pform hide">
        <label>
            <span>父级菜单项名称：</span>
            <input type="text" name="name">
        </label>
        <label>
            <span>菜单项Icon：</span>
            <input type="text" name="cls" placeholder="http://www.yeahzan.com/fa/facss.html">
        </label>
        <div>
            <button class="button add_pbtn">确认添加</button>
            <button class="button add_cancel">取消</button>
        </div>

    </div>
</div>
<!--结果页快捷搜索框 结束-->
<div class="result_wrap">
    <!--<section>
        <div class="table_opt">
            <span class="p_name">文章管理</span>
            <button class="button">新建子页面</button>
        </div>
        <table class="list_tab">
            <tr>
                <th>菜单名称</th>
                <th>菜单链接地址</th>
                <th>操作</th>
            </tr>
            <tr>
                <td class="tc">发布文章</td>
                <td class="tc">admin/article/create</td>
                <td class="tc">
                    <a>编辑</a>
                </td>
            </tr>
        </table>
    </section>-->

</div>
<script type="text/template" id="add-cpage-tmp">
    <tr>
        <td class="tc"><input type="text" class="name" name="name" value="" placeholder="如：发布文章"></td>
        <td class="tc"><input type="text" name="url" value="" placeholder="如：admin/article/create"></td>
        <td class="tc">
            <a class="c_confirm">确定</a>
            <a class="c_cancel">取消</a>
        </td>
    </tr>
</script>
<script>
   /* $(function () {
        MD.getMenusJson(function (data) {
           var res =  MD.menu_result(data);
//           console.log(res)
            var all = ""
            $.each(res, function (i, v) {
                var item = ' <section>\n' +
                    '        <div class="table_opt">\n' +
                    '            <span class="p_name">'+ v.pname +'</span>\n' +
                    '            <button class="button">新建子页面</button>'+
                    '        </div>\n' +
                    '        <table class="list_tab">\n' +
                    '            <tr>\n' +
                    '                <th width="25%">菜单名称</th>\n' +
                    '                <th width="60%">菜单链接地址</th>\n' +
                    '                <th width="15%">操作</th>'+
                    '            </tr>'
                var trs = ""
                $.each(v.child, function (_, k) {
                    trs += '<tr><td class="tc">'+ k.name +'</td><td class="tc">'+ k.url +'</td>' +
                        '<td class="tc"><a class="edit" data-id="'+ k.id +'">编辑</a></td></tr>'
                })

                all += item + trs + '</table></section>'
            })

            // 输出
            $(".result_wrap").html(all);
           resize_index();
        })
    })*/

</script>
</body>
</html>