$(document).ready(function () {

    var developed = console.log("Developed by Batify!");

    onInit();

    tabSystem();

    headerSystem();

    breadcrumbSystem();
});


var onInit = () => {
    $("body").addClass("body-loaded");

    $('main').css({
        'min-height': $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight())
    });
}

var tabSystem = () => {
    if ($('[data-target]').length) {
        // on load function
        $('[data-target]:eq(0)').addClass('is-active');
        $('[data-scope]:eq(0)').addClass('is-active');
    }
    // on click in each data target;
    $('[data-target]').on('click', function (e) {
        e.preventDefault();
        var _target = $(this).attr('data-target');
        $('[data-scope]').removeClass('is-active');
        $('[data-scope="' + _target + '"]').addClass('is-active');

        $('[data-target]').removeClass('is-active');
        $(this).addClass('is-active');
    });
}

var headerSystem = () => {
    $('.js-toggle-aside').on('click', function () {
        $('body').toggleClass('is-collapsed');
    });
}

var breadcrumbSystem = () => {
    $('.c-breadcrumb__link:last-child').on('click', function (e) {
        e.preventDefault();
    });
}