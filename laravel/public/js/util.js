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

        /*self.on("mouseout", function () {
            var top = parseInt(htmlDom.css("top"));
            htmlDom.stop().animate({"top": top - 10, "opacity": 0}, 300, function () {
                htmlDom.remove();
                sw = false;
            });
        });*/
    }


})(jQuery)



if(!window.MD)
window.MD = {
    protocol: window.location.protocol,
    hostname: window.location.hostname,
    preview : function () {
        var img = MD.protocol + "//" + MD.hostname + "/storage/icons/pre-bg.png"
        var bg_shadow = $("<div class='preview-bg'><img class='bg-img' src='" + img +"'><span class='close-prev-bg'></span></div>")
        var bg_img = "<div></div>"


        bg_shadow.append($(bg_img))

        $("body").append(bg_shadow)
    }
}