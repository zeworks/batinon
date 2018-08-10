$(document).ready(function(){

    var developed = console.log("Developed by BATINON!");

    windowHeight();
    onInit();

});

function windowHeight(){
    $(".content-wrapper").css({ "min-height" : $(window).outerHeight() - $("header").outerHeight() - $("footer").outerHeight() });
}

function onInit(){
    // document.querySelector("body").style.setProperty("--bodyBackground", "red");
    $("body").addClass("body-loaded");
}
    