function setSettingsCSS()
{
    $(".backgrounds-and-colors .controls").css("height",$(".demo").css("height"));
}

setSettingsCSS();

function loadBGAndColor()
{
    $(".first-div").css("background-color",$("#bg_1").val());
    $(".second-div").css("background-color",$("#bg_2").val());
    $(".third-div").css("background-color",$("#bg_3").val());
    $(".fourth-div").css("background-color",$("#bg_4").val());
    $(".fifth-div").css("background-color",$("#bg_5").val());
    $(".sixth-div").css("background-color",$("#bg_6").val());
    
    $(".first-div").css("color",$("#color_1").val());
    $(".second-div").css("color",$("#color_2").val());
    $(".third-div").css("color",$("#color_3").val());
    $(".fourth-div").css("color",$("#color_4").val());
    $(".fifth-div").css("color",$("#color_5").val());
    $(".sixth-div").css("color",$("#color_6").val());

    $(".logo").css("color",$("#logo_color").val());
    $(".banner").css("color",$("#banner_color").val());
    $(".nav").css("color",$("#nav_color").val());
    $(".nav").css("background-color",$("#nav_bg").val());
}

// $(".test").change(loadBGAndColor());

$("#save").click(function(){
    let bg1 = $("#bg_1").val();
    let bg2 = $("#bg_2").val();
    let bg3 = $("#bg_3").val();
    let bg4 = $("#bg_4").val();
    let bg5 = $("#bg_5").val();
    let bg6 = $("#bg_6").val();

    let color1 = $("#color_1").val();
    let color2 = $("#color_2").val();
    let color3 = $("#color_3").val();
    let color4 = $("#color_4").val();
    let color5 = $("#color_5").val();
    let color6 = $("#color_6").val();

    let logo_color = $("#logo_color").val();
    let banner_color = $("#banner_color").val();
    let nav_color = $("#nav_color").val();
    let nav_bg = $("#nav_bg").val();

    $.ajax({
        url: "/settings/update",
        type: "PUT",
        dataType: "json",
        data: {
            "--1st-bg-color": bg1,
            "--2nd-bg-color": bg2,
            "--3rd-bg-color": bg3,
            "--4th-bg-color": bg4,
            "--5th-bg-color": bg5,
            "--6th-bg-color": bg6,
            "--1st-color": color1,
            "--2nd-color": color2,
            "--3rd-color": color3,
            "--4th-color": color4,
            "--5th-color": color5,
            "--6th-color": color6,
            "--logo-color": logo_color,
            "--banner-color": banner_color,
            "--nav-color": nav_color,
            "--nav-bg-color": nav_bg,
        },
        beforeSend: function(){
            // console.log(bg1,bg2,bg3,bg4,bg5,bg6,color1,color2,color3,color4,color5,color6,logo_color,banner_color,nav_color,nav_bg);
        },
        success: function(response){
            if(response.status == "errors"){
                $.each(response.errors,function(key,value){
                    $("#"+key+"-error").text(value[0]);
                });
            }

            else if(response.status == "okay"){
                toastr.info("Nothing to save");
            }

            else if(response.status == "exception"){
                toastr.warning(response.message);
            }

            else if(response.status == "success"){
                window.location = response.url;
            }
        }
    });
});