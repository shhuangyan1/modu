$(function () {
    var bind_event = function () {
        $(".label-cat").on("click",function () {
            $(this).parent().addClass("label-active")
            $(this).parent().siblings().removeClass("label-active")
        })

        $(".add-cover").on("click",function () {
            $("#file_upload").click();
        })
    }



    bind_event();
})
var publish_article = function () {

}