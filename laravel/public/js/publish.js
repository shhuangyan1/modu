$(function () {

    /**
     * single-tmp / banner-tmp / multi-tmp 重置
     */
    var single_resset = function () {
        $(".single-input").val("");
        $(".single-img-prev").parent().hide();
        $("#single-tmp .compose-right label").show();
        $("#single-tmp .compose-left label").removeClass("on");
    }
    var banner_resset = function () {
        $(".banner-input").val("");
        $(".banner-img-prev").parent().hide();
        $("#banner-tmp .compose-right label").show();
        $("#banner-tmp .compose-left label").removeClass("on");
    }
    var multi_bl = true;
    var multi_resset = function () {
        $(".multi-input").val("");
        $("#multi-tmp .img-preview").parent().hide();
        $("#multi-tmp .compose-right label").css({"display":"inline-block"});
        $("#multi-tmp .compose-left label").removeClass("on");
        multi_bl = true;
    }

    var bind_event = function () {
        /*$(".label-cat").on("click",function () {
            $(this).parent().addClass("label-active")
            $(this).parent().siblings().removeClass("label-active")
        })

        $(".add-img").on("click",function () {
            $("#file_upload").click();
        })

        $(".tab-upload").on("click",function () {
            $("#file_upload").click();
        })*/


        /**
         * 点击切换选择排版模式
         */
        $(".tabs").on("click",function () {
            var this_ =$(this);
            var target_id = this_.data("tmpid");
            console.log(target_id)

            this_.siblings().removeClass("active");
            this_.addClass("active");

            $(".compose-box").addClass("hide");
            $("#"+ target_id).removeClass("hide");

        })


        /**
         * 单图排版点击上传图片
         */
        $(".single-input").on("change",function () {
            var this_ = $(this)
            var file = this.files[0];
            var fileReader = new FileReader();
            // 监听
            fileReader.onabort = function(){
                jeBox.msg("图片读取中断，请重试", {icon: 2,time:1});
            }
            fileReader.onerror = function(){
                jeBox.msg("图片读取失败，请重试", {icon: 2,time:1});
            }
            fileReader.onload = function(e){
                this_.parent().css({"display":"none"});
                $(".single-img-prev").parent().css({"display":"inline-block"});
                $(".single-img-prev").attr("src",e.target.result);
                $("#single-tmp .compose-left label").addClass("on");

                // 重置其他两项
                banner_resset();
                multi_resset();
            }
            try{
                fileReader.readAsDataURL(file);
            }catch (Exception){
                console.log(Exception.name +":"+ Exception.message);
            }
        })

        /**
         * 大图排版 上传图片
         */
        $(".banner-input").on("change",function () {
            var this_ = $(this)
            var file = this.files[0];
            var fileReader = new FileReader();
            // 监听
            fileReader.onabort = function(){
                jeBox.msg("图片读取中断，请重试", {icon: 2,time:1});
            }
            fileReader.onerror = function(){
                jeBox.msg("图片读取失败，请重试", {icon: 2,time:1});
            }
            fileReader.onload = function(e){
                this_.parent().css({"display":"none"});
                $(".banner-img-prev").parent().css({"display":"inline-block"});
                $(".banner-img-prev").attr("src",e.target.result);
                $("#banner-tmp .compose-left label").addClass("on");

                // 重置其他两项
                single_resset();
                multi_resset();
            }
            try{
                fileReader.readAsDataURL(file);
            }catch (Exception){
                console.log(Exception.name +":"+ Exception.message);
            }
        })

        /**
         * 多图排版上传图片
         */
        $(".multi-input").on("change",function () {
            var this_ = $(this);
            var file = this.files[0];
            var fileReader = new FileReader();
            // 监听
            fileReader.onabort = function(){
                jeBox.msg("图片读取中断，请重试", {icon: 3,time:1});
            }
            fileReader.onerror = function(){
                jeBox.msg("图片读取失败，请重试", {icon: 3,time:1});
            }
            fileReader.onload = function(e){
                // 重置其他两项
                single_resset();
                banner_resset();

                this_.parent().css({"display":"none"});
                this_.parent().next(".img-preview-box").css({"display":"inline-block"});
                this_.parent().next(".img-preview-box").find(".img-preview").attr("src",e.target.result);

                $.each($(".multi-input"),function (i, v) {
                    if($(v).val() == ""){
                        multi_bl = false;
                    }else{
                        multi_bl = true;
                    }
                })
                if(multi_bl){
                    $("#multi-tmp .compose-left label").addClass("on")
                }
            }
            try{
                fileReader.readAsDataURL(file);
            }catch (Exception){
                console.log(Exception.name +":"+ Exception.message);
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
            jeBox.msg("请选择文章分类", {icon: 1,time:1});
        }
        return type;
    }
    function check_title() {
        var title = $(".new_article .title").val().trim();
        if(title.length > 0){
            return true;
        }else{
            $(".new_article .title").showTips("请填写文章标题")
            jeBox.msg("请填写文章标题", {icon: 1,time:1});
        }
        return false;
    }
    /*function check_img() {
        if($("#file_upload").val() == ""){

        }
    }*/
    
    
    return check_type() && check_title();
    
    
}