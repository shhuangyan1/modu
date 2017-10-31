$(function () {

    (function () {
        MD.ajax_get({
            url: 'admin/wx/original_article',
            dataType: 'text'
        }, function (res) {
            $(".art_num").text(res)
        })
    })()

    $(".submit-btn").on("click", function () {
        var c_new = check_newPwd();
        if(c_new && check_new_old()){
            check_origion();
        }

    })


    // 验证并提交
    var check_origion = function () {
        var that = $("#password");
        var pwd = that.val();
        if(pwd == ""){
            that.showTips("请填写密码")
            return;
        }
        MD.ajax_post({
            url: "admin/wx/pwd_modify",
            data: {"old_password": pwd, "new_password": $("#newPwd").val()}
        }, function (res) {
            if(res.fail){
                that.showTips("原始密码错误");
                return;
            }
            if(res.success){
                jeBox.msg("密码修改成功，请用新密码登录", {icon: 2, time: 2})
                setTimeout(function () {
                    window.parent.location.href = MD.url + "admin/login"
                }, 1900)
            }
        })
    }

    // 新密码匹配
    var check_newPwd = function () {
        var npwd = $("#newPwd").val().trim()
        var npwdc = $("#newPwdCopy").val().trim()

        if(npwd == ""){
            $("#newPwd").showTips("请设置新密码")
            return false;
        }
        if(npwd != "" && npwd != npwdc){
            $("#newPwdCopy").showTips("两次密码不一致");
            return false;
        }
        return true;
    }

    // 新旧密码不能一样
    var check_new_old = function () {
        var pwd = $("#password").val().trim()
        var npwd = $("#newPwd").val().trim()
        if(pwd == npwd){
            $("#newPwd").showTips("新密码不能与原密码相同")
            return false;
        }
    }


})