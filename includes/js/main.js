/*jslint browser: true*/
/*global $, jQuery, alert*/

function resizeForm() {
    var window = $(this);
    var title = $('.navbar-brand').width();
    var rightNav = $('.navbar-right').width();
    var newWidth = window.width() - title - rightNav - 80;

    $('.navbar-form').width(newWidth);
}

$(window).load(function () {
    "use strict";
    $('.timer').countTo();
});

$(document).ready(resizeForm);
$(window).resize(resizeForm);