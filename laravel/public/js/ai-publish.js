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
            time = $doc.get_ele(rule.date, rule.dateindex),
            content = $doc.get_ele(rule.content, rule.contentindex)

        if(title){
            result.title = title.innerText.trim() || ''}
        if(author){
            result.author = author.innerText.trim() || ''}
        if(from){
            result.from = from.innerText.trim() || ''}
        if(time){
            result.time = time.innerText.trim() || ''}
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
        $.each($(result.content).find('img'), function (i, v) {
            $(v).css({"max-width": "100%"})
        })
        // result.content
        ue.setContent(result.content)

        // 后处理
        MD.release_after($($("#ueditor_0").contents()[0]), rule)
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

                    // 返回图片数据，并展示
                    MD.rule_image = res.image;
                    show_images(MD.rule_image);


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
                $(".pb-main").css({'display': 'block'})
            }else{
                $(".pb-main").css({'display': 'none'})
            }
        })

        /**
         * 点击添加图片，先预览，再上传，最后切换显示dom
         */
        $(".add-cover").on("click",function () {
            $("#coverInput").click();
        })
        $("#coverInput").on("change", function () {
            // 预览
            MD.upload_preview(this, function (e) {
                var op = $('<div class="imgs-prev-item imgs-prev-item-on">\n' +
                    '          <div class="checked-tri delete-cover" data-index=""><i class="fa fa-check-square-o"></i></div>\n' +
                    '               <img class="imgs-pre" src="'+ e.target.result +'">\n' +
                    '               <div class="loading-cover"\n' +
                    '                     style="background: rgba(255,255,255, 0.5) url(\'http://www.modu.com/storage/icons/loading.gif\') no-repeat center">\n' +
                    '               </div>'+
                    '      </div>');
                op.mouseover(function () {
                    $(this).find(".fa").addClass("fa-minus-circle")
                })
                op.mouseout(function () {
                    $(this).find(".fa").removeClass("fa-minus-circle")
                })
                op.insertBefore(".add-cover");
            })

            // 上传
            MD.form_submit("coverForm", "/admin/article/upload", function (res) {
                // 返回被上传图片的路径
                // var path = res.path;
                // var length = MD.ai_cover.push(path)
            })
        })

    } // bind结束

    /**
     *
     */


    /**
     * 排版与封面选择
     */
    var show_images = function (images) {
        images = images || []
        var img = ''
        $.each(images, function (i, v) {
            img += '<div class="imgs-item" data-index="'+ i +'" style="background: url('+ MD.url + v +') center / contain no-repeat"><div class="checked-tri"><i class="fa fa-check-square-o"></i></div></div>'
        })

        $("#imgs-name").html(img);
        show_typeset(images.length)
        choose_images();
    }
    /**
     * 显示排版选择
      */
    var show_typeset = function (length) {
        length = length || 0;

        if(length == 0){
            $(".typeset-none").removeClass('hide');
        }else {
            $(".typeset-none").addClass('hide');
            if(length < 3){
                show_single();
            }
            if(length >=3){
                show_multi();
            }
        }

        $(".typeset-box label").on("click", function () {
            $(this).addClass("on").siblings().removeClass("on");
            MD.ai_typeset = $(this).find('input').val()
        })
    }
    // 显示单图排版选项，显示大图排版选项(一张图)
    var show_single = function() {
        $(".compose3").removeClass('hide')
        $(".compose1").removeClass('hide')
        $(".compose2").addClass('hide')

    }
    // 显示多图排版选项
    var show_multi = function () {
        $(".compose3").removeClass('hide')
        $(".compose1").removeClass('hide')
        $(".compose2").removeClass('hide')
    }

    /**
     * 从正文图片选择文章封面
     */
    var choose_images = function () {
        MD.ai_cover = []; // 封面图片数组

        $(".imgs-item").on("click", function () {
            var that = $(this);
            var this_ = this;
            var index = parseInt(that.data('index'));
            var src = MD.url + MD.rule_image[index]
            that.toggleClass("imgs-item-on")

            // var conf = {}
            // conf[index] = src;

            if(that.hasClass('imgs-item-on')){
                that.find("i").addClass("fa-check-square").removeClass('fa-check-square-o')
                var length = MD.ai_cover.push(src);  // 返回的是数组长度
                this_.dataset.length = length - 1
            }else {
                that.find("i").addClass("fa-check-square-o").removeClass('fa-check-square')
                MD.ai_cover.splice(this_.dataset.length,1,""); // 采用空字符串占位，该项在数组中的位置保持不变
            }
        })
    }
    /**
     * 确认发布
     */


    bind();
})

/**
 * 提交验证
 */
function onSubmit() {
    var result = check_title() && check_author() && check_from() && check_date() && check_type() && check_typeset() && check_cover();
    if(result){
        var san = jeBox.loading(3,"文章发布中…");
    }
    return result;
}
var check_title = function() {
    var title = $(".title").val().trim();
    if(title.length > 0){
        return true;
    }else{
        $(".title").showTips("请填写文章标题")
        jeBox.msg("请填写文章标题", {icon: 1,time:1});
    }
    return false;
}
var check_author = function() {
    var title = $(".author").val().trim();
    if(title.length > 0){
        return true;
    }else{
        $(".author").showTips("请填写作者")
        jeBox.msg("请填写作者", {icon: 1,time:1});
    }
    return false;
}
var check_from = function() {
    var title = $(".from").val().trim();
    if(title.length > 0){
        return true;
    }else{
        $(".from").showTips("请填写文章来源")
        jeBox.msg("请填写文章来源", {icon: 1,time:1});
    }
    return false;
}
var check_date = function() {
    var title = $(".date").val().trim();
    if(title.length > 0){
        return true;
    }else{
        $(".date").showTips("请填写日期")
        jeBox.msg("请填写日期", {icon: 1,time:1});
    }
    return false;
}
var check_type = function() {
    var types = $("#category-box input"),
        type = false;
    $.each(types,function (i, v) {
        if(v.checked){
            type = true;
            return;
        }
    })
    if(!type){
        $("#category-box").showTips("请选择文章分类")
        jeBox.msg("请选择文章分类", {icon: 1,time:1});
    }
    return type;
}
var check_cover = function () {
    var cover = MD.ai_cover.slice(); // 封面图片
    var cov = true;
    if(cover.length <= 0){
        jeBox.msg("请选择封面图片", {icon: 1,time:1.5});
        return false;
    }else{
        var res_cover = [];
        // 过滤掉数组中占位项
        for(var i=0;i<cover.length; i++){
            if(cover[i] != ""){
                res_cover.push(cover[i])
            }
        }

        $("#images").val(res_cover.join(",")); // 设置封面图片表单数据
        // 封面图片数量限制
        if(MD.ai_typeset == 1 || MD.ai_typeset == 3){
            // 一张图片的选择
            if(res_cover.length < 1){
                jeBox.msg("请选择封面图片", {icon: 1,time:1.5});
                cov = false;
                return false
            }
            if(res_cover.length > 1){
                jeBox.msg("封面图片最多为一张", {icon: 1,time:1.5});
                cov = false;
                return false
            }
        }else{
            // 多图排版的选择
            if(res_cover.length < 3){
                jeBox.msg("请选择三张封面图片", {icon: 1,time:1.5});
                cov = false;
                return false;
            }
            if(res_cover.length > 3){
                jeBox.msg("最多选择三张封面图片", {icon: 1,time:1.5});
                cov = false;
                return false;
            }
        }
        return cov;
    }

}
// check_typeset在check_cover之前执行
var check_typeset = function () {
    if(!MD.ai_typeset){
        $(".typeset-box").showTips("请选择排版样式")
        jeBox.msg("请选择排版样式", {icon: 1,time:1});
        return false
    }
    return true;
}