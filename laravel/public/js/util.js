/**
 * $方法扩展
 */
(function ($) {
    $.fn.showTips = function (text) {
        var self = $(this);
        var sw = self.get(0).switch;
        if (!sw) {
            sw = true;
            var htmlDom = $("<div class='tooltips'>")
                .addClass("tooltipsred")
                .html("<p class='content'></p>"
                    + "<p class='triangle-front'></p>"
                    + "<p class='triangle-back'></p>");
            htmlDom.find("p.content").html(text);
        }

        setTimeout(function () {
            $("body").append(htmlDom);
            var left = self.offset().left - htmlDom.outerWidth() / 2 + self.outerWidth() / 2;
            var top = self.offset().top - htmlDom.outerHeight() - parseInt(htmlDom.find(".triangle-front").css("border-width"));
            htmlDom.css({"left": left, "top": top - 10, "display": "block"});
            htmlDom.stop().animate({"top": top, "opacity": 1}, 300);
        },100);

        self.on("focus click", function () {
            var top = parseInt(htmlDom.css("top"));
            htmlDom.stop().animate({"top": top - 10, "opacity": 0}, 300, function () {
                htmlDom.remove();
                sw = false;
            });
        });
    }



})(jQuery)


/**
 * 自定义全局方法
 */
if(!window.MD)
window.MD = {
    protocol: window.location.protocol,
    hostname: window.location.hostname,
    url: window.location.protocol + "//" + window.location.hostname,
    https: 'https://shtongnian.com',
    preview : function () {
        var img = MD.protocol + "//" + MD.hostname + "/storage/icons/pre-bg.png"
        var bg_shadow = $("<div class='preview-bg'><img class='bg-img' src='" + img +"'><span class='close-prev-bg'></span></div>")
        var bg_img = "<div></div>"


        bg_shadow.append($(bg_img))

        $("body").append(bg_shadow)
    },

    preview_article: function () {

    },
    /**
     * 实现表单元素UI效果
     * @param elem
     * @param config
     * @constructor
     */
    Form : function (elem,config) {
        var dom = $(elem);
        var opts = {
            type : "checkbox"
        }

        opts = $.extend(opts, config||{});

        (function () {
            var aims = dom.find('input[type='+ opts.type +']');
            var wrapDom = $('<div class="md-'+ opts.type +'"></div>');
            var itype = opts.type == 'checkbox' ? 'fa-check' : ''

            $.each(aims, function (i, v) {
                var afterDom = $('<i class="fa '+ itype +'"></i><span>'+ $(v).attr("mdtext") +'</span>')

                if(v.checked){
                    $(v).wrap(wrapDom.addClass("on")).after(afterDom);
                }else{
                    $(v).wrap(wrapDom.removeClass("on")).after(afterDom);
                }

                if(opts.type == "checkbox"){
                    $(v).on("click",function () {
                        $(this).parent().toggleClass("on")
                    })
                }

                if(opts.type == "radio"){
                    $(v).on("click",function () {
                        $(this).parent().addClass("on")
                        $(this).parent().siblings().removeClass("on")
                    })
                }

            })
        })()
    },

    /**
     * 获取某一容器内全部表单元素值,
     * 或者某个表单的value
     * @param container
     * @returns {*}
     */
    getValue: function (container) {
        var el = $(container);
        var items = el.find('input,select,textarea');
        if(items.length == 0){
            if(el.prop('name') != undefined || el.prop('name') != ""){
                var k = el.attr('name');
                var v = el.val();
                var rs = {};
                rs[k] = v;
                return rs;
            }
            else{
                return "";
            }
        }
        var config = {};
        for(var i=0;i<items.length;i++){
            var key = $(items[i]).attr('name');
            var value = $(items[i]).val();
            config[key] = value;
        }
        return config;
    },


    /**
     * @param data 表单元素的name与data的key对应
     * @param callback 针对编辑器的操作，ue非全局变量
     */
    setValue: function ( container, data, callback) {
        var group = $(container).find("input,select,textarea") || []
        $.each(group,function (_,v) {
            v.value = data[v.name]
        })

        typeof callback == "function" && callback(data)
    },

    /**
     * 合并多个对象，与 $.extend({})效果一致
     * @returns {{}}
     */
    merger: function(){

        var inner_merge = function (obj1, obj2) {
            for (var key in obj2) {
                if (obj2.hasOwnProperty(key)) {
                    obj1[key] = obj2[key]
                }
            }
            return obj1
        }
        var ret = {}
        for (var i = 0, l = arguments.length; i < l; i++) {
            inner_merge(ret, arguments[i])
        }
        return ret
    },

    /**
     * ajax_get
     * 使用注意，若需要自定义弹窗提示，需要借助jedate插件
     */
    ajax_get: function (config, callback) {
        var conf = {
            url: '',
            dataType: 'json',
            async: true,
            data: {}
        }
        config = MD.merger(conf, config);
        $.ajax({
            type: 'GET',
            url: MD.url + config.url,
            cache: false,
            dataType: config.dataType,
            data: config.data,
            async: config.async,
            success: function (res) {
                typeof callback == "function" && callback(res);
            },
            error: function(res){
                console.log("接口请求错误");
                alert("网络错误")
            }
        })
    },

    /**
     * ajax_post post请求，实际实现待定
     * @param config
     * @param callback
     */
    ajax_post: function (config, callback) {
        var conf = {
            url: '/',
            dataType: 'json',
            async: true,
            data: {}
        }
        config = MD.merger(conf, config);
        $.ajax({
            type: 'POST',
            url: MD.url + config.url,
            cache: false,
            dataType: config.dataType,
            data: config.data,
            async: config.async,
            success: function (res) {
                typeof callback == "function" && callback(res);
            },
            error: function(res){
                console.log("接口请求错误");
                alert("网络错误")
            }
        })
    },

    // 为编辑器添加微信图标
    //
    wechat: function () {
        var src = MD.url + '/image/uedit-wechat.png';
        var img = $("<img id='wechat-preview' src=" + src +" title='微信编辑模式' alt='wechat'>")

        img.on("click", function () {
            var this_ = $(this)
            this_.toggleClass('we-chat');
            if(this_.hasClass('we-chat')){
                $("#myEditor").css({width: '400px', border: '1px solid #ddd'})
                $("#edui1_iframeholder").css({height: '700px'})
            }else{
                $("#myEditor").css({width: '100%', border: 'none'})
                $("#edui1_iframeholder").css({height: '240px'})
            }

        })

        $(".edui-editor-toolbarboxinner ").append(img)
    },

    // 回到顶部
    //
    scrollTop: function () {
        var fix = $('<div class="fixed"></div>');
        var arr = $('<div class="fixed-arr"><i class="fa fa-arrow-up"></i></div>')

        arr.on('click',function () {
            $('html, body').animate({scrollTop: 0}, 500);
        })

        fix.append(arr)
        $('body').append(fix)
    },

}


/**
 * 全局页面元素绑定方法
 * 自动执行
 */
$(function () {
    //数字输入控制
    $(".number").on("keyup",function () {
        var val = $(this).val();
        val = val.replace(/[^0-9]/g,"");
        $(this).val(Number(val))
    })
})