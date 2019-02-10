var onInit = () => {
    $("body").addClass("body-loaded");

    $('main').css({
        'min-height': $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight())
    });

    /**
     * Profile card on header
     */
    $('.c-profile__card').on('click', function(e){
        e.stopPropagation();
    });

    $('body,html').on('click', function(e){
        if ($('.c-profile__card').hasClass('c-profile__card-active')) {
            $('.c-profile__card').removeClass('c-profile__card-active')
            e.preventDefault()
        }
    });

}

$(document).ready(function () {
    var developed = console.log("Developed by Batinon!");

    onInit();
});