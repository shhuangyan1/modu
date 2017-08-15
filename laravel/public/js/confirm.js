$(function () {
    $(document).on("click",".delete",function () {
        var id = $(this).data("id");

        dialog_box({
            fun: function (index) {
                $.post(
                    MD.url + "/admin/article/" + id,
                    {"_method":"delete",'_token':MD.token},
                    function (res) {
                        jeBox.close(index);
                        if(res.status == 1){
                            jeBox.msg(res.msg, {icon: 2,time:1});
                            setTimeout(function () {
                                location.reload();
                            },1000)
                        }else{
                            jeBox.msg(res.msg, {icon: 3,time:1.5});
                        }

                    }
                )
            }
        })


    })

    // 继续展示
    $(document).on("click",".refuse",function () {
        dialog_box({
            content: '<div class="jeBox-iconbox jeicon1">确定要恢复该文章吗？</div>',
            fun:function (index) {
                /*$.post(
                    MD.url + "",
                    {'_token':"{{csrf_token()}}","id":id},
                    function (res) {


                    }
                )*/
            }
        })
    })

})

function dialog_box(config) {
    config = $.extend({
        content: '<div class="jeBox-iconbox jeicon1">确定要删除该文章吗？删除后不可恢复</div>',
        fun: function (index) {jeBox.close(index);}
    },config)
    jeBox.open({
        cell:"jbx",
        title:"删除",
        // boxSize:["300px","210px"],
        padding:"25px 10px",
        content: config.content,
        maskLock : true ,
        btnAlign:"center",
        button:[
            {
                name: '确定',
                callback: function(index){
                    config.fun(index)
                }
            },
            {
                name: '取消'
            }
        ]
    })
}