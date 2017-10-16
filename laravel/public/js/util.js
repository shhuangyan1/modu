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

    // 获取value
    $.fn.getValue = function () {
        return MD.getValue($(this))
    }
    //
    $.fn.setValue = function (data, callback) {
        MD.setValue(this, data, callback)
    }

    // 查找特定元素,cont元素id或class，index元素的索引
    $.fn.get_ele = function (cont, index) {
        cont = ""+ cont + ""
        return $(this).find( cont )[index]
    }

    // 查找元素，用于解析页面
    $.fn.find_ele = function (cont, index) {
        cont = ""+ cont + ""
        if(index){
            return $(this).find( cont )[index]
        }else{
            return $(this).find( cont )
        }
    }

})(jQuery)



/**
 * 自定义全局方法
 */
if(!window.MD)
window.MD = {
    protocol: window.location.protocol,
    hostname: window.location.hostname,
    url: window.location.protocol + "//" + window.location.hostname + "/",
    https: 'https://shtongnian.com/',

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
        var el;
        if(typeof container == 'string'){
            el = $(container);
        }else{
            el = container
        }

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
     *  data 表单元素的name与data的key对应
     *  callback 针对编辑器的操作，ue非全局变量
     */
    setValue: function ( container, data, callback) {
        var group = $(container).find("input,select,textarea") || []
        $.each(group,function (_,v) {
            v.value = data[v.name] || ""
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
     * 获取url携带的 查询字符串
     */
    get_query: function (para) {
        var arr = location.href.split('?');
        var result = {};
        if(arr[1] != undefined){
            var arr_2 = arr[1].split('&');
            var config = {};

            $.each(arr_2, function (i, v) {
                var lin = v.split('=')
                config[lin[0]] = lin[1]
            })
            result =  config;

            if(para){
                var cof = {}
                cof[para] = config[para]
                result = cof;
            }
        }
        return result;
    },


    /**
     * ajax_get
     * 使用注意，若需要自定义弹窗提示，需要借助jedate插件
     */
    ajax_get: function (config, callback, error) {
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
                alert("网络错误");
                typeof error == "function" && error();
            }
        })
    },

    /**
     * ajax_post post请求，实际实现待定
     */
    ajax_post: function (config, callback, error) {
        var conf = {
            url: MD.url + config.url,
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
                alert("网络错误");
                typeof error == "function" && error();
            }
        })
    },

    // 为编辑器添加微信图标
    //
    wechat: function () {
        var src = MD.url + 'storage/icons/uedit-wechat.png';
        var img = $("<img id='wechat-preview' src=" + src +" title='微信编辑模式' alt='wechat'>")

        img.on("click", function () {
            var this_ = $(this)
            this_.toggleClass('we-chat');
            if(this_.hasClass('we-chat')){
                $("#myEditor").css({width: '400px', border: '1px solid #ddd'})
                $("#edui1_iframeholder").css({height: '700px'})
            }else{
                $("#myEditor").css({width: '100%', border: 'none'})
                $("#edui1_iframeholder").css({height: 'auto'})
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

    /**
     * 手动number表单设置
     */
    input_number: function () {
        $(".number").on("keyup",function () {
            var val = $(this).val();
            val = val.replace(/[^0-9]/g,"");
            $(this).val(Number(val))
        })
    },

    /**
     * iframe加载完成后（onload）
     * 页面解析时，是否需要特殊的解析规则
     * 如： 微信公众号文章中的figure标签为自定义标签，innerHTML无法解析，所以需要特殊处理
     * $doc 为目标iframe,document
     */
    release_before: function ($doc, current_rule) {
        if(current_rule.url == 'https://mp.weixin.qq.com' || current_rule.url == 'http://mp.weixin.qq.com'){
            // 解决微信 的figure标签无法解析问题
            var f = $doc.find(current_rule.content).find('figure')
            $.each(f, function (i, v) {
                var wp = $(v).wrap("<div class='md-wrap'></div>")
                $(v).find('img').attr({'src': MD.url+'/'+ MD.rule_image[i], 'width':'100%'})
                wp.parent().html($(v).html())
            });
        }


        // 每个解析规则下，都执行
        MD.change_images($doc, current_rule)
    },

    /**
     * 替换源页面中全部图片后台
     */
    change_images: function ($doc, current_rule) {
        if(MD.rule_image && MD.rule_image.length > 0){
            var imgs = $doc.find(current_rule.content).find('img')
            $.each(imgs, function (i, v) {
                $(v).attr({'src': MD.url+'/'+ MD.rule_image[i], 'width':'100%'})
            })
        }
    }



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































