$(function () {
    var bind_event = function () {
        $(".add-cover").on("click",function () {
            $("#file_upload").click();
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
            }
            try{
                console.log("准备读取-")
                fileReader.readAsDataURL(file);
                console.log('读取。。。')
            }catch (Exception){
                console.log(Exception.name +":"+ Exception.message);
            }
        })

        // 话题描述字数统计
        $(".content").on("keyup",function () {
            var cont = $(this).val();

            var inputed = cont.length;
            var canbe = 300 - inputed;

            $(".content-nums").text("当前已输入"+ inputed +"个字符，您还可以输入"+ canbe +"个字符。")
        })

        //
        $(".btn-preview").on("click",function () {
            // MD.preview();
        })
    }

    bind_event()
})
function newTopic() {
    var check_title = function() {
        var title = $(".title").val().trim();
        if(title.length <= 0){
            $(".title").showTips("请填写话题标题");
            return false;
        }
        return true;
    }

    var check_content = function () {
        var content = $(".content").val().trim();
        if(content.length <= 0){
            $(".content").showTips("请填写话题描述");
            return false;
        }
        return true;
    }

    var check_image = function () {
        var image = $("#file_upload").val();
        if(image == ""){
            $(".upload-img-box").showTips("请上传海报图片");
            return false;
        }
        return true;
    }

    return check_title() && check_content() && check_image()
}