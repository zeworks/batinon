$(document).ready(function () {

    var developed = console.log("Developed by BATINON!");

    onInit();

    tabSystem();
});


function onInit() {
    $("body").addClass("body-loaded");
}

function tabSystem() {
    $('[data-target]').on('click', function (e) {
        e.preventDefault();
        var _target = $(this).attr('data-target');
        $('[data-scope]').removeClass('is-active');
        $('[data-scope="' + _target + '"]').addClass('is-active');
    });
}