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

        /**
         * 删除消息
         */
        $(document).on("click",".delete",function () {
            var id = $(this).data("id");
            var that = $(this)
            jeBox.open({
                cell:"jbx",
                title:"提示",
                padding:"25px 10px",
                content:'<div class="jeBox-iconbox jeicon1">确定要删除该条消息吗？</div>',
                maskLock : true ,
                btnAlign:"center",
                button:[
                    {
                        name: '确定',
                        callback: function(index){
                            MD.ajax_post({
                                url: "admin/message/" + id,
                                data: {"_method":"delete"}
                            }, function (res) {
                                jeBox.close(index);
                                if(res.success){
                                    jeBox.msg(res.msg, {icon: 2,time:1});
                                    that.parent().html("<span class='red'>已删除</span>")
                                }
                            })
                        }
                    },
                    {
                        name: '取消'
                    }
                ]
            })

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
    }
    if(check_type == 2){
        result = check_edit();
    }

    if(result){
        preview_val(check_type)
        get_cover();
    }

    return result;
}

var check_txt = function () {
    if($("#myText").val().trim().length <= 0){
        return false;
    }
    $("#ueditor_textarea_message") && $("#ueditor_textarea_message").remove()
    return true;
}
var check_edit = function () {
    if(ue.getContentTxt().trim().length <= 0){
        return false;
    }
    $("#myText").remove();
    return true;
}

// 设置消息预览，图文消息，无法截取字符串，需要单独处理
var preview_val = function (type) {
    var txt = ""
    if(type == 1){
        txt = $("#myText").val().substring(0, 40)
    }
    if(type == 2){
        txt = ue.getContentTxt().substring(0, 40)
    }
    $(".preview").val(txt)
}


// 设置图文消息的封面
var get_cover = function () {

    var cont = ue.getContent()
    console.log(cont)
    var image = $(cont).find("img").get(0)
    if(image){
        var src = image.src;
        if(src.indexOf("http://") == 0 || src.indexOf("https://") == 0){
            $(".image").val(src)
        }else{
            $(".image").val(MD.url + src)
        }
    }

}