$(function () {
    $(document).on("click",".delete",function () {
        var id = $(this).data("id");



    })



    var confirm_delete = function (id) {
        $.post(MD.url + "/admin/article/" + id,
            {'_method':'delete','_token': MD.token},
            function (res) {

            });
    }
})