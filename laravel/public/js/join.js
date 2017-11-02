$(function () {

    var init = function () {
        MD.getMenusJson(function (all) {
            var result = MD.menu_result(all)

            show_choose(result);
            format_position(3);  // 页面加载完成，初始化默认选项
        })
    }

    var show_choose = function (res) {
        console.log(res)
        var chose_html = ""
        $.each(res, function (j, k) {
            var ul = '<ul><li class="head">'+ k.pname +'</li>';
            var li = ''
            $.each(k.child, function (i, v) {
                li += '<li><input type="checkbox" name="authority" value="'+ v.id +'" mdtext="'+ v.name +'"></li>'
            })
            ul += li + '</ul>'

            chose_html += ul;
        })

        $("#auth").html(chose_html);
        MD.Form("#auth",{type:"checkbox"})
    }

    // 格式化职位选择
    // 此处采用id会存在不稳定性，id依赖数据库，当数据库发生变化，id也可能会变化
    // 解决方案：为每个页面添加code字符串，通过code匹配
    var format_position = function (val) {
        var menu;
        if(val == 3){
            menu = [3,4,11,14,15,16,17,18,19,21]
        }
        if(val == 2){
            menu = [3,4,11,12,14,15,16,17,18,19,20,21,22,23,24,25,26,27]
        }
        if(val == 1){
            menu = [3,4,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29]
        }
        checked_authority(menu)
    }

    // arr 目标子菜单的id
    // 选中权限选项
    var checked_authority = function (arr) {

        var inputs = $("#auth").find("input")
        $.each(inputs, function (i, v) {
            $.each(arr, function (_, k) {
                if(parseInt(v.value) == k){
                    // $(v).click()
                    $(v).prop("checked", true)
                    $(v).parent().addClass("on")
                }
            })
        })
    }

    // 清除全部选项
    var clear_checked = function () {
        var inputs = $("#auth").find("input")
        $.each(inputs, function (i, v) {
            // 清除选项
            $(v).prop("checked",false)
            $(v).parent().removeClass("on")
        })
    }

    var bind_event = function () {
        $(".admin_pwd_cf").on("blur",function () {
            if(!($(".admin_pwd").val() == $(this).val())){
                $(".admin_pwd_cf").showTips("两次密码不一致")
            }
        });

        // 点击切换权限
        $(".operation label").on("click", function (e) {
            // e.stopPropagation();
            // e.bubbles = false;
            $(this).addClass("on")
            $(this).siblings().removeClass("on");

            // 先清除
            clear_checked();
            // 再选中
            format_position($(this).next('input').val());

        })



    }

    init();
    bind_event();

})
function newManager() {
    authority_();
    return check_info() && check_pwd()
}

var check_info = function () {
    var inputs = $(".info input");
    var inputs_bl = true;
    inputs.each(function (i, v) {
        if(v.value == ""){
            inputs_bl = false;
            $(v).showTips(this.placeholder)
        }
    })
    return inputs_bl
}
var check_pwd = function () {
    var pws_bl = true;
    if($(".admin_pwd").val() != $(".admin_pwd_cf").val()){

        $(".admin_pwd_cf").showTips("两次密码不一致");
        pws_bl = false
    }
    return pws_bl
}

// 选中权限id拼接
var authority_ = function () {
    var checked = $("#auth").find(":checked")
    var ids = "";
    $.each(checked, function (_, v) {
        ids += v.value + ","
    })

    ids = ids.substring(0,ids.length-1)
    $("#authority").val(ids)
}

