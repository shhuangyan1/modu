$(function () {
    MD.releaseScope = {}
    MD.releaseScope.fileType = "image"
    var bind_event = function () {
        $(".limit").on("keyup",function () {
            var val = $(this).val();
            val = val.replace(/[^0-9]/g,"")
            $(this).val(Number(val))
        })

        $(".add-img").on("click",function () {
            $("#file_upload").click();
        })
        $(".img-preview .tab").on("click",function () {
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

    //    视频
        $(".add-video").on("click",function () {
            $("#video_upload").click()
        })

        $("#video_upload").on("change",function () {
            $(".add-video i").removeClass("fa-youtube-play").addClass("fa-spinner")
            setTimeout(function () {
                var formDom = document.getElementById("video-form");
                var formData = new FormData(formDom);
                var req = new XMLHttpRequest();
                req.open("POST", MD.url + "/admin/upload");
                req.onreadystatechange = function() {
                    if (this.status === 200 && this.readyState === 4) {
                        var res = JSON.parse(this.response);
                        $(".video-preview").removeClass("hide")
                        $(".add-video").addClass("hide")
                        $("#myVideo").attr("src",res.path)
                        $("#video_upload").val("")
                        $(".video").val(res.path)
                    }
                };
                //将form数据发送出去
                req.send(formData);
                //避免内存泄漏
                req = null;
            },500)



        })


    //    切换
        $(".up-image").on("click",function () {
            $(".upload-img-box").removeClass("hide")
            $(".upload-video-box").addClass("hide")
            MD.releaseScope.fileType = "image"

        })

        $(".up-video").on("click",function () {
            $(".upload-video-box").removeClass("hide")
            $(".upload-img-box").addClass("hide")
            MD.releaseScope.fileType = "video"

        })

    //
        $("#collect").on("click",function () {
            $(".cl-items-box").toggleClass("hide")
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
        if(image == "" && MD.releaseScope.fileType == "image"){
            $(".upload-img-box").showTips("请上传海报图片");
            return false;
        }
        return true;
    }

    var check_video = function () {
        if(MD.releaseScope.fileType == "video"){
            var file_ = $("#video_upload").val(), url_ = $(".video").val();

            var video_bl = false;
            if(file_ == "" && url_ == ""){
                $(".upload-video-box").showTips("请上传活动视频");
            }
            if(file_ != "" && url_ == ""){
                jeBox.msg('视频上传中，请稍后！', {icon: 1,time:1.5});
            }
            if(file_ == "" && url_ != ""){
                video_bl = true;
            }
            return video_bl
        }
        return true
    }

    return check_title() && check_description() && check_image() && check_video() && check_inputs()
}