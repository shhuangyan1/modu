$(function () {
    var bind_event = function () {
        $(".limit").on("keyup",function () {
            var val = $(this).val();
            val = val.replace(/[^0-9]/g,"")
            $(this).val(Number(val))
        })

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

    }


    bind_event();
})