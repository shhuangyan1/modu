function analyze() {
    var url = $("#url").val();
    if(url.trim().length <= 0){
        return false;
    }
    return url;
}

$(function () {
    /**
     * 页面初始化加载
     */
    MD.Form("#category-box",{type: "radio"});
    $("#editor-box").html('<script type="text/plain" id="myEditor" name="content" style="width:100%;height:240px;"><\/script>')
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('myEditor',{
        elementPathEnabled: false
    });
    ue.addListener('ready',function () {
        MD.wechat();
    })
    MD.scrollTop();

    var bind = function () {
        // 开始解析
        $("#start-release").on("click",function () {
            var url = analyze()
            MD.ajax_post({
                url: '/admin/xxxxx',
                data: {'url': url}
            },function (res) {
                // 返回解析规则？

                if(res.fail){ //失败
                    $(".banner-result-t").append($('<span class="red"><i class="fa fa-warning"></i>未知来源，需要新的解析规则</span>'));
                    return;
                }
            })
        })
    }


    bind();
})




