$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// toastr.options = {
//     "debug": false,
//     "positionClass": "toast-bottom-left",
//     "onclick": null,
//     "fadeIn": 500,
//     "fadeOut": 500,
//     "timeOut": 2000,
//     "extendedTimeOut": 500
// }

$("#side_bar_toggle").click(function () {
    $("aside").toggleClass("aside-show");
});

contentOnloadPosition();

function contentOnloadPosition(){
    let headerHeight = $(".main-header").css("height");
    let footerHeight = $(".footer").css("height");
    let asideWidth = $("aside").css("width");

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

function convertToLocalTime()
{
    
    let dates = $(".date");
    
    $.each(dates,function(key,value){
        let date = new Date($(value).text());

        let utcDate = new Date(Date.UTC(date.getFullYear(),date.getMonth(),date.getDate(),date.getHours(),date.getMinutes(),date.getSeconds()));

        $(value).text(dateToString(utcDate,"dd-j-Y hh:ii:ss aa"));
    });
}

convertToLocalTime();

function dateToString(date,dateFormat)
{

    let daysLong = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    let daysShort = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

    let monthsLong = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    let monthsShort = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

    dateFormat = dateFormat.replace("Y" , date.getFullYear());
    dateFormat = dateFormat.replace("mm" , (date.getMonth()+1 < 10) ? "0"+(date.getMonth()+1) : (date.getMonth()+1));
    dateFormat = dateFormat.replace("m" , date.getMonth()+1);
    dateFormat = dateFormat.replace("dd" , (date.getDate() < 10) ? "0"+(date.getDate()) : (date.getDate()));
    dateFormat = dateFormat.replace("d" , date.getDate());
    dateFormat = dateFormat.replace("HH" , (date.getHours() < 10) ? "0"+(date.getHours()) : (date.getHours()));
    dateFormat = dateFormat.replace("H" , date.getHours());
    dateFormat = dateFormat.replace("hh" , (date.getHours() % 12 < 10) ? ((date.getHours() % 12 === 0) ? 12 : "0"+(date.getHours() % 12)) : (date.getHours() % 12));
    dateFormat = dateFormat.replace("h" , (date.getHours() % 12 === 0) ? 12 : date.getHours() % 12);
    dateFormat = dateFormat.replace("ii" , (date.getMinutes() < 10) ? "0"+(date.getMinutes()) : (date.getMinutes()));
    dateFormat = dateFormat.replace("i" , date.getMinutes());
    dateFormat = dateFormat.replace("ss" , (date.getSeconds() < 10) ? "0"+(date.getSeconds()) : (date.getSeconds()));
    dateFormat = dateFormat.replace("s" , date.getSeconds());
    dateFormat = dateFormat.replace("DD" , daysLong[date.getDay()]);
    dateFormat = dateFormat.replace("f" , daysShort[date.getDay()]);
    dateFormat = dateFormat.replace("MM" , monthsLong[date.getMonth()]);
    dateFormat = dateFormat.replace("j" , monthsShort[date.getMonth()]);
    dateFormat = dateFormat.replace("aa" , (date.getHours() > 11) ? "PM" : "AM");

    return dateFormat;
}