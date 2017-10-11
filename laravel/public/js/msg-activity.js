$(function () {
    var scope = {}
    /**
     * 默认预览第一条
     * @param
     */
    var load_detail = function (id) {
        MD.ajax_get({
            url: '/admin/activity/activity_detail',
            data: { 'id': id, 'openid': '' },
        },function (res) {
            show_activity(res[0])
        })
    }
    var show_activity = function (item) {
        $(".act-detail-box").loadTemplate($("#activity-tmp"),item)
    }

    /**
     * 加载问答信息
     * @id 当前活动的id
     */
    var load_ask = function (id) {
        MD.ajax_get({
            url: '/admin/wx/act_commentlist',
            data: { 'act_id': id, 'current': '' },
        },function (res) {
            show_asklist(res)
        })
    }

    /**
     * 显示问答信息
     */
    var show_asklist = function (list) {
        if(list.length == 0){
            $(".act-ask-box").html("<p>暂无提问</p>")
        }else{
            $(".act-ask-box").loadTemplate($("#ask-list-tmp"),list)
        }
    }


    var bind = function () {
        // 点击查看
        $(document).on("click",".check-btn",function () {
            // $("[data-value]", $("#activity-list-tmp")).each(function () {
            //     console.log($(this))
            //     console.log($(this).attr())
            // });
            var id = $(this).attr("value");
            $.each(scope.list, function (i, v) {
                if(v.id == id){
                    load_detail(id);
                    load_ask(id);
                    return;
                }
            })
        });


        // 点击回复
        $(document).on("click", ".back-btn", function () {
            //
            var id = $(this).attr("value");
            var value = $(this).prev().val();
            if(value == ""){
                jeBox.msg("请填写回复内容",{icon: 1,time:1})
                return;
            }

            MD.ajax_post({
                url: '/admin/activity/act_commentreply',
                data: {'id': id, 'reply': value},
            },function (res) {
                if(res.success){
                    jeBox.msg("回复成功",{"icon": 1, "time": 1})
                }
            })
        })

    }
    /**
     * 加载尚未开始活动
     */
    MD.ajax_get({
        url: '/admin/activity/activity_format',
    },function (res) {
        scope.list = res;

        $("#list-slide-box").loadTemplate($("#activity-list-tmp"),res)

        load_detail(res[0].id);
        load_ask(res[0].id)

        var mySwiper = new Swiper ('.swiper-container', {
            // loop: true,
            // 如果需要分页器
            pagination: '.swiper-pagination',
            paginationClickable :true,
            // 如果需要前进后退按钮
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',

            spaceBetween: 20,
            slidesPerView : 3,
            slidesPerGroup : 3,
            // centeredSlides: true,
            slideToClickedSlide: true,
        })
    })


    bind();
})