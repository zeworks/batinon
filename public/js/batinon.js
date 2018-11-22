var onInit = () => {
    $("body").addClass("body-loaded");

    $('main').css({
        'min-height': $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight())
    });
}

var toggleSystem = () => {
    if ($('.js-nav-system').length) {
        var jsNavSystem = $('.js-nav-system');

        if (jsNavSystem.find('[data-target]').length) {
            // on load function
            jsNavSystem.find('[data-target]:eq(0)').addClass('is-active');
            $('[data-scope]:eq(0)').addClass('is-active');
        }
        // on click in each data target;
        jsNavSystem.find('[data-target]').on('click', function (e) {
            e.preventDefault();
            var _target = $(this).attr('data-target');
            $('[data-scope]').removeClass('is-active');
            $('[data-scope="' + _target + '"]').addClass('is-active');

            jsNavSystem.find('[data-target]').removeClass('is-active');
            $(this).addClass('is-active');
        });
    }

    if ($('.js-tab-system')) {
        var jsTabSystem = $('.js-tab-system');

        if (jsTabSystem.find('[data-tab-target]').length) {
            // on load function
            jsTabSystem.find('[data-tab-target]:eq(0)').addClass('is-active');
            jsTabSystem.find('[data-tab-scope]:eq(0)').addClass('is-active');
        }

        jsTabSystem.find('[data-tab-target]').on('click', function (e) {
            e.preventDefault();
            var _target = $(this).attr('data-tab-target');
            $('[data-tab-scope]').removeClass('is-active');
            $('[data-tab-scope="' + _target + '"]').addClass('is-active');

            jsTabSystem.find('[data-tab-target]').removeClass('is-active');
            $(this).addClass('is-active');
        });
    }
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

    toggleSystem();

    headerSystem();

    breadcrumbSystem();
});