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
    console.log(screen.width);

    if(window.location.pathname == "/settings"){
        $("#content").css("padding",headerHeight+" 0px 0px "+asideWidth);
    }
    
    else if((window.location.pathname == "/" || window.location.pathname == "/register") && $("#item_count").attr("class") == undefined){
        $("#content").css("padding",headerHeight+" 0px "+footerHeight+" 0px");
    }

    else if(screen.width > 920){
        $("#content").css("padding",headerHeight+" 0px "+footerHeight+" "+asideWidth);
    }
    
    else{
        $("#content").css("padding",headerHeight+" 0px "+footerHeight+" 0px");
    }

    $("aside").css("padding-top",headerHeight);
}

$("#header_toggler").click(function(){
    $("#view_controller").toggleClass("view-controller-show");
    $(this).toggleClass("header-toggler-rotate");
});