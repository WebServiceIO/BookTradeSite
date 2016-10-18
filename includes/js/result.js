/*jslint browser: true*/
/*global $, jQuery, alert*/

$(function () {
    "use strict";
    $('.dropdown').hover(function () {
        $(this).addClass('open');
    },
    function () {
        $(this).removeClass('open');
    });
});