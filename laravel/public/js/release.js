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

function newActivity() {
    var check_title = function() {
        var title = $(".title").val().trim();
        if(title.length <= 0){
            $(".title").showTips("请填写活动名称");
            return false;
        }
        return true;
    }

    var check_description = function () {
        var description = $(".description").val().trim();
        if(description.length <= 0){
            $(".description").showTips("请填写活动描述");
            return false;
        }
        return true;
    }

    var check_inputs = function () {
        var inputs = $(".inputs").find('input');
        var no_inputs = [],inputs_bl = true;
        $.each(inputs, function (i, v) {
            if(v.value == ""){
                no_inputs.push(v);
            }
        })
        $.each(no_inputs,function (_,t) {
            $(t).showTips(t.placeholder);
            inputs_bl = false;
        })
        return inputs_bl;
    }

    var check_image = function () {
        var image = $("#file_upload").val();
        if(image == ""){
            $(".upload-img-box").showTips("请上传海报图片");
            return false;
        }
        return true;
    }

    return check_title() && check_description() && check_inputs() && check_image()
}