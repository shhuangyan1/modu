<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>账户列表</title>
    <link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('lirary/jedate/skin/default.css')}}">

    <script src="{{asset('lirary/uploadify/jquery1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/util.js')}}"></script>
    <script src="{{asset('lirary/jedate/jquery.jebox.js')}}" ></script>
    <style>
        .auth_name{
            display: inline-block;
            padding: 0 8px;
            border: 1px solid #ccc;
            margin: 0 5px 5px 0;
        }
    </style>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">权限管理</a> &raquo; 账户列表
</div>
<!--面包屑导航 结束-->
<div class="search_wrap">
    <!--<form action="" method="get">-->
        <table class="search_tab">
            <tr>
                <th width="120">管理员登录名：</th>
                <td><input type="text" class="username" name="username" placeholder="搜索管理员"></td>
                <td><input type="submit" id="search" value="查询"></td>
            </tr>
        </table>
    <!--</form>-->
</div>
<!--结果页快捷搜索框 结束-->
<div class="result_wrap">
    <section>
        <table class="list_tab">
            <thead>
            <tr>
                <th>账户登录名</th>
                <th>权限列表</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="res">

            <!--<tr>
                <td></td>
                <td></td>
                <td class="tc"><a data-id="" class="delete">删除</a></td>
            </tr>-->

            </tbody>
        </table>
    </section>
</div>
<script>

   $(function () {

       // 加载
       var load_list = function (name) {
           name = name || ""
           MD.ajax_get({
               url: 'admin/manager/grantlist',
               data: {"username": name}
           }, function (res) {
                show_list(res.data);
           })
       }

       // 显示
       var show_list = function (list) {
           var trs = "";
           MD.getMenusJson(function (res) {
               $.each(list, function (_, v) {
                   var ids = v.auth_id.split(",");
                   var spans = get_id_name(res.child, ids)
                   trs += '<tr>\n' +
                       '                <td>'+ v.username +'</td>'+
                       '                <td>'+ spans +'</td>\n' +
                       '                <td class="tc"><a data-id="'+ v.id +'" class="delete">删除</a></td>\n' +
                       '            </tr>'
               })

               $("#res").html(trs);
           })

       }

       var get_id_name = function (all, ids) {
           var aut_name = ""
           $.each(all, function (i, k) {
                $.each(ids, function (_, v) {
                    if(v == k.id){
                        aut_name += '<span class="auth_name">'+ k.name +'</span>';
                        return;
                    }
                })
           });
           return aut_name;
       }

       $(document).on("click",".delete",function () {
           var id = $(this).data("id");
           jeBox.open({
               cell:"jbx",
               title:"提示",
               padding:"25px 10px",
               content:'<div class="jeBox-iconbox jeicon1">确定要删除该账号吗？</div>',
               maskLock : true ,
               btnAlign:"center",
               button:[
                   {
                       name: '确定',
                       callback: function(index){
                           $.post(
                                   MD.url + "/admin/manager/" + id,
                                   {"_method":"delete"},
                                   function (res) {
                                       jeBox.close(index);
                                       res = JSON.parse(res)
                                        if(res.success){
                                            jeBox.msg(res.msg, {icon: 2,time:1});
                                            setTimeout(function () {
                                                location.reload();
                                            },1000)
                                        }
                                   }
                           )

                       }
                   },
                   {
                       name: '取消'
                   }
               ]
           })

       });

       $("#search").on("click", function () {
           var name = $(".username").val();
           load_list(name)
       })

       load_list();
   })
</script>
</body>
</html>