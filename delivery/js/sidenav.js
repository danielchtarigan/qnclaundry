var sizeMarginLeft = "-250px";
var boolOpenNav = false;
function openNav(boolFromButton) {
    if (!boolOpenNav && boolFromButton) {
        document.getElementById("mySidenav").style.marginLeft = "0";
        document.body.style.background = "rgba(0,0,0,0.4)"
        boolOpenNav = true;
    } else {
        document.getElementById("mySidenav").style.marginLeft = sizeMarginLeft;
        document.body.style.background = "white"
        boolOpenNav = false;
    }
}

$(document).ready(function(){
    $('div.sidenav a[href]').click(function() {
        $('div.sidenav a[href]').removeClass('active');
        $(this).addClass('active');
    });
    function getSizeWidth() {
        var widthSize = $(window).width();
        if (widthSize < 480) {
            $('.sidenav').css('width', '150px');
            $('.sidenav a').css('font-size', '18px');
            sizeMarginLeft = "-150px";
        } else {
            $('.sidenav').css('width', '250px');
            $('.sidenav a').css('font-size', '25px');
            sizeMarginLeft = "-250px";
        }
    }
    getSizeWidth();
    $(window).resize(function() {
        getSizeWidth();
    });
});
