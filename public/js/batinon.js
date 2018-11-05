$(document).ready(function () {

    var developed = console.log("Developed by BATINON!");

    onInit();

    tabSystem();

    headerSystem();

    inputValidation();

});


function onInit() {
    $("body").addClass("body-loaded");

    $('main').css({
        'min-height': $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight())
    });
}

function tabSystem() {
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

function headerSystem() {
    $('.js-toggle-aside').on('click', function () {
        $('body').toggleClass('is-collapsed');
    });
}

function inputValidation() {
    $("button[type='submit']").prop('disabled', 'disabled');

    $("input").on('change', function () {
        if ($(this).length) {
            $("button[type='submit']").prop('disabled', false);
        } else {
            $("button[type='submit']").prop('disabled', 'disabled');
        }
    });
}