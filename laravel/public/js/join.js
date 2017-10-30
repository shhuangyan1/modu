$(function () {

    var init = function () {
        MD.getMenusJson(function (all) {
            var result = MD.menu_result(all)

            show_choose(result);
            format_position(3)
            // MD.Form("#auth",{type:"checkbox"})
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

    var format_position = function (val) {
        var menu;
        if(val == 3){
            menu = [9,10,11,14,15,16,17,18,19,21,26,27]
        }
        if(val == 2){
            menu = [9,10,11,12,14,15,16,17,18,19,20,21,22,23,24,26,27]
        }
        if(val == 1){
            menu = [9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29]
        }
        checked_authority(menu)
    }

    // arr 目标子菜单的id
    var checked_authority = function (arr) {
        var inputs = $("#auth").find("input")
        $.each(inputs, function (i, v) {
            $.each(arr, function (_, k) {
                if(parseInt(v.value) == k){
                    $(v).attr("checked",true)
                    console.log(v)
                }
            })
        })
    }

    var bind_event = function () {
        $(".admin_pwd_cf").on("blur",function () {
            if(!($(".admin_pwd").val() == $(this).val())){
                $(".admin_pwd_cf").showTips("两次密码不一致")
            }
        });

        // 点击切换权限
        $(".operation label").on("click", function () {
            $(this).addClass("on")
            $(this).siblings().removeClass("on");

            format_position($(this).find('input').val())
        })



    }

    init();
    bind_event();

})
function newManager() {
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
    return check_info() && check_pwd()
}