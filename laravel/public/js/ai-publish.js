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

    /**
     * 解析结果
     */
    var realist = function (rule_para) {
        var rule = {
            title: '#activity-name',
            titleindex: '0',
            author: '.rich_media_meta',
            authorindex: '1',
            from: '#post-user',
            fromindex: '0',
            date: '#post-date',
            dateindex: '0',
            content: '#js_content',
            contentindex: '0'
        }

        rule_para = MD.merger(rule_para, rule)

        var result = {};

        // 子页面的document
        var $doc = $($("#preview").contents()[0]);

        // 解析结果赋值
        var title = $doc.get_ele(rule.title, rule.titleindex)
        var author = $doc.get_ele(rule.author, rule.authorindex)
        var from = $doc.get_ele(rule.from, rule.fromindex)
        var content = $doc.get_ele(rule.content, rule.contentindex)

        if(title){
            result.title = title.innerText.trim() || ''
        }
        if(author){
            result.author = author.innerText.trim() || ''
        }
        if(from){
            result.from = from.innerText.trim() || ''
        }
        if(content){
            result.content = content.innerHTML || ''
        }

        if(result.title && result.author && result.from && result.content){
        }else{
            // 解析规则不符
            $(".edit-error").removeClass("hide")
            jeBox.msg("解析规则过期或暂未收录",{"icon": 3, "time": 2});
        }

        // 显示解析值
        $(".result-items-box").setValue(result);
        // MD.res = result
        ue.addListener('ready',function () {
            ue.setContent(result.content)
        })

    }

    var pre = document.getElementById('preview');
    $(pre).load(function () {
        realist();
    })


    var bind = function () {
        // 开始解析
        $("#start-release").on("click",function () {
            var url = analyze()
            if(url)
            MD.ajax_post({
                url: '/admin/article/ai_article',
                data: {'url': url}
            },function (res) {
                // 返回解析规则
                // 返回目标路径

                // if(res.fail){ //失败
                //     $(".banner-result-t").append($('<span class="red"><i class="fa fa-warning"></i>未知来源，需要新的解析规则</span>'));
                //     return;
                // }

                // 没有url，在iframe容器显示提示信息


            })
        })
    }


    bind();
})




