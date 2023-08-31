$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

toastr.options = {
    "debug": false,
    "positionClass": "toast-bottom-left",
    "onclick": null,
    "fadeIn": 500,
    "fadeOut": 500,
    "timeOut": 2000,
    "extendedTimeOut": 500
}

$("#side_bar_toggle").click(function () {
    $("aside").toggleClass("aside-show");
});

contentOnloadPosition();

function contentOnloadPosition(){
    let headerHeight = $(".main-header").css("height");
    let footerHeight = $(".footer").css("height");
    let asideWidth = $("aside").css("width");

    $("#content").css("padding",headerHeight+" 0px "+footerHeight+" "+asideWidth);
    $("aside").css("padding-top",headerHeight);
}