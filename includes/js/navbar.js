jQuery(function () {
    var window = $(this);
    var title = $('.navbar-brand').width();
    var rightNav = $('.navbar-right').width();
    var newWidth = window.width() - title - rightNav - 80;

    $('.navbar-form').width(newWidth);
});

$(window).on('resize', function () {
    var window = $(this);
    var title = $('.navbar-brand').width();
    var rightNav = $('.navbar-right').width();
    var newWidth = window.width() - title - rightNav - 80;

    $('.navbar-form').width(newWidth);
});