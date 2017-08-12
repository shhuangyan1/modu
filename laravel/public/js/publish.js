$(function () {
    var bind_event = function () {
        $(".label-cat").on("click",function () {
            $(this).parent().addClass("label-active")
            $(this).parent().siblings().removeClass("label-active")
        })

        $(".add-img").on("click",function () {
            $("#file_upload").click();
        })

        $(".tab-upload").on("click",function () {
            $("#file_upload").click();
        })
        $(".tab-delete").on("click",function () {
            $("#file_upload").val("");
            $(".img-preview img").attr("src","#");
            $(".img-preview").addClass("hide");
            $(".add-img").removeClass("hide");
            $("#single-input").parent().click();
            $("#poster-input").attr("disabled","disabled")
            $("#poster-input").parent().addClass("disabled")
        })

        $("#file_upload").on("change",function () {
            var file = this.files[0];
            var fileReader = new FileReader();
            // 监听
            fileReader.onabort = function(){
                alert("图片读取中断，请重试")
            }
            fileReader.onerror = function(){
                alert("图片读取失败，请重试")
            }
            fileReader.onload = function(e){
                $(".img-preview img").attr("src",e.target.result);
                $(".img-preview").removeClass("hide");
                $(".add-img").addClass("hide")
                $("#poster-input").removeAttr("disabled").click()
                $("#poster-input").parent().addClass("on").removeClass("disabled").siblings().removeClass("on")
                // $("#single-input").attr("disabled",true)
            }
            try{
                console.log("准备读取-")
                fileReader.readAsDataURL(file);
                console.log('读取。。。')
            }catch (Exception){
                console.log(Exception.name +":"+ Exception.message);
            }
        })


        $(".compose-box label").on("click",function () {
            if(!$(this).hasClass("disabled")){
                $(this).addClass("on").siblings().removeClass("on")
            }
        })
    }



    bind_event();
})
var publish_article = function () {
    function check_type() {
        var types = $(".type input"),
        type = false;
        $.each(types,function (i, v) {
            if(v.checked){
                type = true;
                return;
            }
        })
        if(!type){
            $(".type").showTips("请选择文章分类")
        }
        return type;
    }
    function check_title() {
        var title = $(".new_article .title").val().trim();
        if(title.length > 0){
            return true;
        }else{
            $(".new_article .title").showTips("请填写文章标题")
        }
        return false;
    }
    /*function check_img() {
        if($("#file_upload").val() == ""){

        }
    }*/
    
    
    return check_type() && check_title();
    
    
}