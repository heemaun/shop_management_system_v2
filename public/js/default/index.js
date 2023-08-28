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
    $("#content").css("margin-left",$("aside").css("width"));
    $("#content").css("padding-top",$(".main-header").css("height"));

    let fotterHeight = $(".footer").css("height").substring(0,($(".footer").css("height").length - 2));
    let contentHeight = $("#content").css("height").substring(0,($("#content").css("height").length - 2));

    $("#content").css("min-height",(contentHeight-fotterHeight)+"px");

    console.log(fotterHeight,contentHeight);
}