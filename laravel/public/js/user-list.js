// 将时间戳转换为日期
function getLocalTime(nS) {
    if(nS == 0){
        return "未获取时间"
    }
    return new Date(parseInt(nS) * 1000).toLocaleString();
}
// 将数字转换为性别
function get_sex(num) {
    if(num == 0)
        return "未知"
    if(num == 1)
        return "男"
    if(num == 2)
        return "女"
}

$(function () {
    var scope = {list: []}
    var current_page = 1

    // 加载数据
    var load_user = function (current) {
        MD.ajax_get({
            url: 'admin/user/fill',
            data: {"current": current, "pagesize": '40'}
        },function (res) {
            if(res.length>0 && scope.list.length > 0){
                jeBox.msg("加载成功",{icon: 2, time: 1})
            }
            if(res.length == 0 && scope.list.length > 0){
                jeBox.msg("暂无更多",{icon: 1, time: 1})
            }
            current_page++;
            $.extend(scope.list, res)
            show_user(res)
        })
    }

    // 加载更多
    $(".loadmore .button").on("click",function () {
        load_user(current_page)
    })

    // 点击查询
    $(".search").on("click", function () {
        var para = MD.getValue(".search_tab")
        if(para.nickname == ""){
            return;
        }
        MD.ajax_post({
            url: 'admin/user/fill',
            data: para
        },function (res) {
            if(res.length>0){
                jeBox.msg("",{icon: 2, time: 1})
            }
            if(res.length == 0 ){
                jeBox.msg("未查询到数据",{icon: 1, time: 1})
            }
            $(".result_content").html("")
            show_user(res)
        })
    })


    // 处理数据
    var show_user = function (list) {
        list = list || [];
        var result_content = $("<div></div>")

        $.each(list, function (i, v) {
            if(v.avatarUrl != ""){
                var box = '<div class="user-box user-box-'+ v.id +'" data-id="'+ v.id +'"></div>'
                //
                var addr = get_name_bypinyin(v.province, v.city);
                v.time = MD.time_format(v.time);
                // console.log(v.time);
                v.time_pre = v.time.split(" ")[0]
                v.address = addr.province + " " + addr.city;
                v.sex = get_sex(v.gender);

                $(box).loadTemplate($("#user-tmp"),v);

                $(result_content).append($(box).loadTemplate($("#user-tmp"),v))
            }
        })

        $(".result_content").append(result_content);
        show_animate()
    }

    // 悬浮动画
    var show_animate = function () {
        $(".user-box").on('mouseover', function () {
            var result_width =  $(".result_content").width();
            var this_width = $(this).width();
            var id = $(this).data('id')
            var classname = ".user-box-"+id;
            var cont = $(this).find(".user-outer").html();

            var this_left = $(this).offset().left;
            var direction = "right"
            if((result_width - this_left - this_width) <= this_width){
                direction = "left"
            }

            var index = jeBox.tips(classname, cont , {align: direction});
            $(this).on("mouseout", function () {
                jeBox.close(index)
            })
        })
    }


    load_user(current_page);
})
