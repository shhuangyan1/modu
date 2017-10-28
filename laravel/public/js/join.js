$(function () {

    var init = function () {

    }

    var bind_event = function () {
        $(".admin_pwd_cf").on("blur",function () {
            if(!($(".admin_pwd").val() == $(this).val())){
                $(".admin_pwd_cf").showTips("两次密码不一致")
            }
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