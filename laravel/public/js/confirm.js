$(function () {
    $(document).on("click",".delete",function () {
        var id = $(this).data("id");
        var this_ = $(this);
        dialog_box({
            fun: function (index) {
                $.post(
                    MD.url + "/admin/article/" + id,
                    {"_method":"delete",'_token':MD.token},
                    function (res) {
                        jeBox.close(index);
                        if(res.status == 1){
                            jeBox.msg(res.msg, {icon: 2,time:1});
                            this_.removeClass("delete").text("已删除").css("color","#f40")
                            this_.next().remove();
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
        var id = $(this).data("id");
        var this_ = $(this);

        dialog_box({
            content: '<div class="jeBox-iconbox jeicon1">确定要恢复该文章吗？</div>',
            fun:function (index) {
                MD.ajax_get({
                    url: 'admin/article/article_recover',
                    data: {"id": id}
                },function (res) {
                    jeBox.close(index);
                    if(res.success){
                        jeBox.msg(res.msg, {icon: 2,time:1});
                        this_.removeClass("refuse").text("已恢复").css("color","#428bca")
                        this_.prev().remove()
                    }else{
                        jeBox.msg(res.msg, {icon: 3,time:1.5});
                    }
                })
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