var onInit = () => {
    $("body").addClass("body-loaded");

    $('main').css({
        'min-height': $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight())
    });
}

$(document).ready(function () {
    var developed = console.log("Developed by Batinon!");

    onInit();
});