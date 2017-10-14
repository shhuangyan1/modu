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
    jeDate({
        dateCell:"#date",
        format:"YYYY-MM-DD",
        isTime: false,
        minDate:"2000-10-01",
        maxDate:"2099-01-01"
    });

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
        if(!rule){
            var idxs = jeBox.alert('未识别的解析规则', {
                icon: 3,
                maskClose: true
            }, function(){
                jeBox.close(idxs);
            });
            return;
        }
        var result = {};
        // 子页面的document
        var $doc = $($("#preview").contents()[0]);

        // 预处理
        MD.release_before($doc, rule)

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
        // 获取全部解析规则
        if(MD.rule){
            for(var j=0; j<MD.rule.length; j++){
                if(url.indexOf(MD.rule[j].url) >= 0){
                    MD.current_rule  = MD.rule[j]
                    return;
                }
            }
        }else{
            MD.ajax_get({
                url: '/admin/article/showregular',
                async: false
            }, function (res) {

                MD.rule  = res;

                for(var i=0; i<res.length; i++){
                    if(url.indexOf(res[i].url) >= 0){
                        MD.current_rule  = res[i]
                    }
                }
            })
        }
        return MD.current_rule;
    }


    var bind = function () {
        // 开始解析
        $("#start-release").on("click",function () {
            var url = analyze(); // 验证并返回输入的url
            var san = jeBox.loading(1,"正在解析…");
            // 通过url获取解析规则， {title: '#activity-name',titleindex: '0',...}
            if(typeof url == 'string'){
                get_rule(url); // 通过url，将当前规则存放在MD.current_rule中
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
                        realist(MD.current_rule);
                        jeBox.close(san_2)
                    })

                },function () {
                    jeBox.close(san)
                })
            }else{
                jeBox.close(san)
            }

        })

        // 页面滚动，左侧预览框固定
        document.addEventListener('scroll', function (e) {
            var off = $(".release-box-posi").offset().top
            // console.log(off)
            var this_off = $(document).scrollTop()
            // console.log(this_off)

            if(this_off >= off){
                $(".release-box").addClass('position_fix')
            }else{
                $(".release-box").removeClass('position_fix')
            }
        })

        // 底部操作栏，箭头事件
        $(".pb-arrow").on('click', function () {
            var arrow = $("#pb-opt-arrow")
            arrow.toggleClass('fa-caret-down').toggleClass('fa-caret-up')

            if(arrow.hasClass('fa-caret-down')){

                // $(".pb-main").animate({'height': 'auto'}, 500)
            }else{

                // $(".pb-main").animate({'height': '0px'}, 500)
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




