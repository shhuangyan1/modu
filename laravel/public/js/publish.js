
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
        // open-more打开填写更多
        $(".open-more").on("click",function () {
            $(".more-info-box").toggleClass("hide")
        })

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

        /**
         * 点击close删除已上传的某图片
         */
        $(".close").on("click",function () {
            var this_ = $(this);
            if(this_.hasClass("single-close")){
                single_resset();
            }
            if(this_.hasClass("banner-close")){
                banner_resset();
            }
            if(this_.hasClass("multi-close")){
                this_.parent().css({"display":"none"});
                this_.parent().prev().css({"display":"inline-block"});
                $("#multi-tmp .compose-left label").removeClass("on")
            }
        })


        /**
         * 点击预览文章效果
         */
        $(".preview-button").on("click",function () {
            if(check_title() && check_html()){
                var title = $(".title").val();
                var content1 = ue.getAllHtml();
                console.log(content1)
                window.open('preview',"pre");
                // var my = window.open('preview','pre','width=414,height=736,resizable=0,location=0,toolbar=0',true)
                // my.document.write(content1)


                // var bg_path = MD.url + "/storage/icons/pre-bg.png";
                // MD.preview_article();
            }
        })
    }

    bind_event();
    MD.scrollTop();
})
var check_type = function() {
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
var check_title = function() {
    var title = $(".new_article .title").val().trim();
    if(title.length > 0){
        return true;
    }else{
        $(".new_article .title").showTips("请填写文章标题")
        jeBox.msg("请填写文章标题", {icon: 1,time:1});
    }
    return false;
}

var check_html = function() {
    var content = ue.getContent();
    if(content.trim() == ""){
        jeBox.msg("请填写文章正文", {icon: 1,time:1});
        return false;
    }
    return true;
}
var check_img = function() {
    var type = $("input[name=compose]:checked").val();
    // 3单图，1大图，2多图
    if((type == 3 && !$("#single-tmp .compose-left label").hasClass("on")) ||
        (type == 1 && !$("#banner-tmp .compose-left label").hasClass("on")) ||
        (type == 2 && !$("#multi-tmp .compose-left label").hasClass("on"))
    ){
        jeBox.msg("请上传文章封面", {icon: 1,time:1});
        return false;
    }
    return true
}
var publish_article = function () {
    var result =  check_type() && check_title() && check_html() && check_img();
    if(result){
        var san = jeBox.loading(3,"文章发布中…");
    }
    return result;
}
