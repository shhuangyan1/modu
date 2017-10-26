$(function () {

    var bind_event = function () {

        $(".opt-select .type").on("click", function () {
            var type = this.value;
            $(this).parent().addClass("on");
            $(this).parent().siblings().removeClass("on");

            //
            choose_edit(type)
        })
        // 输入统计
        $("#myText").on("keyup", function () {
            var len = this.value.length;
            $("#curNum").text(len)
        })
    }


    /**
     * 切换编辑框
     * @param type
     */
    var choose_edit = function (type) {
        if(type == 1){ // 文字
            $(".editor-box").addClass("hide");
            $(".text-box").removeClass("hide");
        }else if(type == 2){
            $(".editor-box").removeClass("hide");
            $(".text-box").addClass("hide");
        }
    }


    bind_event();
})

/**
 * 消息预览？
 *
 */
function sysSend() {
    var result = false;
    var check_type = $(".type:checked").val();

    if(check_type == 1){
        result = check_txt();
        // $(".editor-box").remove();  // 清除编辑器
    }
    if(check_type == 2){
        result = check_edit();
        // $(".text-box").remove();  // 清除文本框
    }

    if(result){
        preview_val(check_type)
    }

    return false;
}

var check_txt = function () {
    if($("#myText").val().trim().length <= 0){
        return false;
    }
    return true;
}
var check_edit = function () {
    if(ue.getContentTxt().trim().length <= 0){
        return false;
    }
    return true;
}

// 设置消息预览，图文消息，无法截取字符串，需要单独处理
var preview_val = function (type) {
    var txt = ""
    if(type == 1){
        txt = $("#myText").val().substring(0, 100)
    }

    if(type == 2){
        txt = ue.getContentTxt().substring(0, 100)
    }
    $(".preview").val(txt)
}
