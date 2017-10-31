$(function () {
    var scope = {}

    var load_all = function () {
        MD.getMenusJson(function (list) {
            list = MD.menu_result(list);
            show_pages(list)
        })
    }

    // 显示页面
    var show_pages = function (list) {
        var all = ""
        $.each(list, function (i, v) {
            var item = ' <section>\n' +
                '        <div class="table_opt">\n' +
                '            <span class="p_name"><i class="'+ v.cls +'"></i>'+ v.pname +'</span>\n' +
                '            <button class="button add_cpage" data-id="'+ v.id +'">新建子页面</button>'+
                '        </div>\n' +
                '        <table class="list_tab">\n' +
                '            <tr>\n' +
                '                <th width="25%">菜单名称</th>\n' +
                '                <th width="60%">菜单链接地址</th>\n' +
                '                <th width="15%">操作</th>'+
                '            </tr>'
            var trs = ""
            $.each(v.child, function (_, k) {
                trs += '<tr class="no-edit"><td class="tc"><input type="text" class="name" name="name" value="'+ k.name +'" readonly></td>' +
                    '<td class="tc"><input type="text" name="url" value="'+ k.url +'" readonly></td>' +
                    '<td class="tc"><a class="edit" data-id="'+ k.id +'">编辑</a></td></tr>'
            })

            all += item + trs + '</table></section>'
        })

        // 输出
        $(".result_wrap").html(all);
        resize_index();
    }

    var bind_event = function () {
        /**
         * 点击添加新的父级菜单
         */
        $("#add_parent").on("click", function () {
            $(".add_pform").slideDown(400);
            setTimeout(function () {
                resize_index();
            },500)
        })
        $(".add_cancel").on("click", function () {
            $(".add_pform").slideUp(400)
        })
        // 确认添加
        $(".add_pbtn").on("click", function () {
            var data = $(".add_pform").getValue();
            console.log(data)
            if(data.name != "" && data.cls != "")
            MD.ajax_post({
                url: 'admin/manager/add_pmenus',
                data: data
            }, function (res) {
                if(res.success){
                    $(".add_pform").slideUp(400);
                    jeBox.msg("添加成功",{icon: 2, time: 1});
                    load_all();
                }
            })
        })

        /**
         * 添加子页面
         */
        $(document).on("click",".add_cpage", function (e) {
            scope.pid = $(this).data("id");
            var $tr = $($("#add-cpage-tmp").html())
            $(this).parent().next().append($tr)
        })
        // 确认添加
        $(document).on("click", ".c_confirm", function (e) {
            var data = $(this).parent().parent().getValue()
            data.pid = scope.pid;
            MD.ajax_post({
                url: 'admin/manager/add_cmenus',
                data: data
            }, function (res) {
                if(res.success){
                    jeBox.msg("添加成功",{icon: 2, time: 1});
                    load_all();
                }
            })
        })


        var edit_recover = function (that, html) {
            that.parent().parent().addClass("no-edit")
            that.parent().parent().find("input").attr("readonly",true)
            that.parent().html(html)
        }
        /**
         * 编辑
         */
        $(document).on("click", ".edit", function (e) {
            var cid = $(this).data("id");

            $(this).parent().parent().removeClass("no-edit")
            $(this).parent().parent().find("input").removeAttr("readonly")
            // 恢复
            var opt_html = '<a class="edit_cpage" data-id="'+ cid +'">完成</a> <a class="edit_cancel" data-id="'+ cid +'">取消</a>'
            $(this).parent().html(opt_html);

        })
        // 完成
        $(document).on("click", ".edit_cpage", function (e) {
            var data = $(this).parent().parent().getValue()
            data.id = $(this).data("id");
            var that = $(this)
            MD.ajax_get({
                url: 'admin/manager/editmenus',
                data: data
            }, function (res) {
                if(res.success){
                    jeBox.msg("编辑成功",{icon: 2, time: 1});
                    // 恢复
                    var opt_html = '<a class="edit" data-id="'+ data.id +'">编辑</a>'
                    edit_recover(that,opt_html)
                }
            })
        })
        // 取消
        $(document).on("click", ".edit_cancel", function (e) {
            var id = $(this).data("id")
            // 恢复
            var opt_html = '<a class="edit" data-id="'+ id +'">编辑</a>'
            edit_recover($(this),opt_html)
        })

    }


    load_all()
    bind_event();
})