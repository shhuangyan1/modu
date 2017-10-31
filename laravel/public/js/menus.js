$(function () {

    var load_all = function () {

    }

    var bind_event = function () {

        // 点击添加新的父级菜单
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
                }
            })
        })


    }




    bind_event();
})