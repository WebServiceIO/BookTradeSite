/*jslint browser: true*/
/*global $, jQuery, alert*/

$(document).ready(function () {
    "use strict";
    var s = $("form");
    var height = s.height();
    var pos = s.position();
    var searchIconWidth = $("#button-search").width();
    var dropdownWidth = $(".select-style").width();
    $(window).scroll(function () {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos.top) {
            s.css("top", height / 2);
            s.css("position", "fixed");
            $("form").animate({
                width: $(window).width()
            }, 20);
            $("input").css("width", $(window).width() - searchIconWidth - dropdownWidth - 3);
        } else {
            s.css({"position": "absolute", "top": "50%", "transform": "translate(-50%, -50%)"});
            $("input").css("width", "480px");
            $("form").animate({
                width: '765px'
            }, 20);
        }
    });
});
