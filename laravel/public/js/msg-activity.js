$(function () {
    var scope = {}
    /**
     * 默认预览第一条
     * @param item
     */
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
                    show_activity(v);
                    load_ask(id)
                    return;
                }
            })
        });


    }
    /**
     * 加载尚未开始活动
     */
    MD.ajax_get({
        url: '/admin/activity/activity_format',
    },function (res) {
        scope.list = res;

        $("#list-slide-box").loadTemplate($("#activity-list-tmp"),res)

        show_activity(res[0]);
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