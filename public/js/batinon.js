var onInit = () => {
    $("body").addClass("body-loaded");

    $('main').css({
        'min-height': $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight())
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

$(document).ready(function () {

    var developed = console.log("Developed by Batinon!");

    onInit();

    headerSystem();

    breadcrumbSystem();
});