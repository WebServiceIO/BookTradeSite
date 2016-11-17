/*jslint browser: true*/
/*global $, jQuery, alert*/

jQuery(function () {
    var containerHeight = $('.container').height();
    var marginTop = parseInt($('.container').css("marginTop"));
    var marginBottom = parseInt($('.container').css("marginBottom"));

    $('#wrapper-content').height(containerHeight + marginTop + marginBottom);
});

$(window).on('resize', function () {
    var containerHeight = $('.container').height();
    var marginTop = parseInt($('.container').css("marginTop"));
    var marginBottom = parseInt($('.container').css("marginBottom"));

    $('#wrapper-content').height(containerHeight + marginTop + marginBottom);
});