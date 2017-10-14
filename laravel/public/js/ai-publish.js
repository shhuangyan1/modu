function analyze() {
    var url = $("#url").val();
    if(url.trim().length <= 0){
        return false;
    }
    return url;
}

$(function () {
    var scope = {}
    /**
     * 页面初始化加载
     */
    MD.Form("#category-box",{type: "radio"});
    MD.Form(".recommend-item",{type: "checkbox"});
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
     * 解析结果，参数：解析规则
     */
    var realist = function (rule) {

        var result = {};
        // 子页面的document
        var $doc = $($("#preview").contents()[0]);

        // 预处理
        MD.release_before($doc, rule.url)

        // 解析结果赋值
        var title = $doc.get_ele(rule.title, rule.titleindex),
            author = $doc.get_ele(rule.author, rule.authorindex),
            from = $doc.get_ele(rule.from, rule.fromindex),
            date = $doc.get_ele(rule.date, rule.dateindex),
            content = $doc.get_ele(rule.content, rule.contentindex)

        if(title){
            result.title = title.innerText.trim() || ''}
        if(author){
            result.author = author.innerText.trim() || ''}
        if(from){
            result.from = from.innerText.trim() || ''}
        if(date){
            result.date = date.innerText.trim() || ''}
        if(content){
            result.content = content.innerHTML || ''}

        if(result.title && result.author && result.from && result.content){
        }else{
            $(".edit-error").removeClass("hide")
            jeBox.msg("解析规则过期或暂未收录",{"icon": 3, "time": 2});
        }

        // 显示解析值
        $(".result-items-box").setValue(result);
        // 编辑器赋值
        ue.setContent(result.content)

    }

    // 通过url匹配目标规则
    var get_rule = function (url) {
        var result_rule = {};
        // 获取全部解析规则
        MD.ajax_get({
            url: '/admin/article/showregular',
            async: false
        }, function (res) {

            MD.rule = scope.rule = res;

            for(var i=0; i<res.length; i++){
                if(url.indexOf(res[i].url) >= 0){
                    MD.current_rule = result_rule = res[i]
                }
            }
        })
        return result_rule;
    }


    var bind = function () {
        // 开始解析
        $("#start-release").on("click",function () {
            var url = analyze(); // 验证并返回输入的url
            var san = jeBox.loading(1,"正在解析…");
            // 通过url获取解析规则， {title: '#activity-name',titleindex: '0',...}
            if(typeof url == 'string'){
                var result_rule = get_rule(url)
                MD.ajax_post({
                    url: '/admin/article/ai_article',
                    data: {'url': url}
                },function (res) {
                    jeBox.close(san)
                    var san_2 = jeBox.loading(1,"等待目标页面加载完成…");
                    // 返回图片数据
                    MD.rule_image = res.image;
                    // 没有url，在iframe容器显示提示信息
                    $("#preview").attr("src", MD.url+'/'+res.file);
                    var pre = document.getElementById('preview');
                    $(pre).load(function () {
                        realist(result_rule);
                        jeBox.close(san_2)
                    })

                },function () {
                    jeBox.close(san)
                })
            }else{
                jeBox.close(san)
            }

        })
    }

    /**
     * 排版与封面选择
     */
    var show_

    /**
     * 确认发布
     */


    bind();
})




