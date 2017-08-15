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



if(!window.MD)
window.MD = {
    protocol: window.location.protocol,
    hostname: window.location.hostname,
    url: window.location.protocol + "//" + window.location.hostname,
    preview : function () {
        var img = MD.protocol + "//" + MD.hostname + "/storage/icons/pre-bg.png"
        var bg_shadow = $("<div class='preview-bg'><img class='bg-img' src='" + img +"'><span class='close-prev-bg'></span></div>")
        var bg_img = "<div></div>"


        bg_shadow.append($(bg_img))

        $("body").append(bg_shadow)
    },
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


    }
}