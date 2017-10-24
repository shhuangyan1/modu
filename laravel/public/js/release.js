$(function () {
    MD.releaseScope = {}
    MD.releaseScope.fileType = "image"

    // 清除已选中的活动视频
    var clear_video = function () {
        $(".video-preview").addClass("hide");
        $(".add-video").removeClass("hide");
        // $("#file_upload").val("");
        /**
         * ?????
         */
    }

    // 清除已选中的活动海报
    var clear_img = function () {
        $(".img-preview").addClass("hide");
        $(".add-img").removeClass("hide");
        $("#file_upload").val("");
    }

    var bind_event = function () {

        $(".add-img").on("click",function () {
            $("#file_upload").click();
        })
        $(".img-preview .tab").on("click",function () {
            $("#file_upload").click();
        })

        // 活动海报上传
        $("#file_upload").on("change",function () {
            var file = this.files[0];
            var fileReader = new FileReader();
            // 监听
            fileReader.onabort = function(){
                jeBox.msg("图片读取中断，请重试", {icon: 1,time:1});
            }
            fileReader.onerror = function(){
                jeBox.msg("图片读取失败，请重试", {icon: 1,time:1});
            }
            fileReader.onload = function(e){
                $(".img-preview img").attr("src",e.target.result);
                $(".img-preview").removeClass("hide");
                $(".add-img").addClass("hide")
            }
            try{
                fileReader.readAsDataURL(file);
            }catch (Exception){
                console.log(Exception.name +":"+ Exception.message);
            }
        })

    //    视频
        $(".add-video").on("click",function () {
            $("#video_upload").click()
        })

        // 活动视频上传
        /**
         * 上传之后？session?
         */
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
            $(".cl-items-box").toggleClass("hide");
            resize_index()
        })

        // 字数统计
        $(".description").on("keyup",function () {
            var cont = $(this).val();
            var inputed = cont.length;
            var canbe = 300 - inputed;

            $(".description-nums").text("当前已输入"+ inputed +"个字符，您还可以输入"+ canbe +"个字符。")
        })
    }


    bind_event();
})


function newActivity() {
    var check_title = function() {
        var title = $(".title").val().trim();
        if(title.length <= 0){
            $(".title").showTips("请填写活动名称");
            jeBox.msg("请填写活动名称", {icon: 1,time:1});
            return false;
        }
        return true;
    }

    var check_description = function () {
        var description = $(".description").val().trim();
        if(description.length <= 0){
            $(".description").showTips("请填写活动描述");
            jeBox.msg("请填写活动描述", {icon: 1,time:1});
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
            jeBox.msg(t.placeholder, {icon: 1,time:1});
            inputs_bl = false;
        })
        return inputs_bl;
    }

    var check_image = function () {
        var image = $("#file_upload").val();
        if(image == "" && MD.releaseScope.fileType == "image"){
            $(".upload-img-box").showTips("请上传海报图片");
            jeBox.msg("请上传海报图片", {icon: 1,time:1});
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
                jeBox.msg("请上传活动视频", {icon: 1,time:1});
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

    /**
     * collects 处理
     */
     var collects = {

        add: function () {
            var checkeds = $("#collect-items-box").find('input[type=checkbox]:checked')
            var value = ''
            $.each(checkeds, function (i, v) {
                value = value + "," +MD.getValue("#"+ v.name +"")[v.name]
            });

            if(value == ""){
                jeBox.msg("请选择报名信息", {icon: 1,time:1});
                return false;
            }else{
                $("#collect-items-box").html('<input type="hidden" name="collects" value="'+ value.substring(1) +'">');
            }
            return true;
        },
    }


    // 收集信息验证
    var check_collect = function () {
        // 未收集
        if($("input[name=collect]:checked").length <= 0){
            return true;
        }else{
            return collects.add()
        }
    }

    return check_title() && check_description() && check_image() && check_video() && check_inputs() && check_collect()
}