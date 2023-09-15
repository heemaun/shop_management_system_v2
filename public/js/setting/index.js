// function setSettingsCSS()
// {
//     $(".backgrounds-and-colors .controls").css("height",$(".demo").css("height"));
// }

// setSettingsCSS();

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

$("#bg_color_save").click(function(){
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
            "key": "colors",
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

$("#nav ul li").click(function(){
    if(!$(this).hasClass("active")){
        $("#nav ul li").removeClass("active");
        $(this).addClass("active");
    
        $(".panels div").removeClass("div-active");
        $("#"+$(this).attr("data-target")).addClass("div-active");
    }
});

$("input[type=range]").change(function(){
    $(this).siblings("label").children("span").text("["+$(this).val()+"px]");
});

function loadDemo(element)
{
    let key = $(element).attr("data-target");

    if(key == "nav-item"){
        key = "nav";
    }

    let fontSize = $("#--"+key+"-font-size").val();
    let fontWeight = $("#--"+key+"-font-weight").val();
    let fontStyle = $("#--"+key+"-font-style").val();
    let fontFamily = $("#--"+key+"-font-family").val(); 
    
    if(key == "nav"){
        key = "nav-item";
    }

    $("#"+key).css("font-size",fontSize+"px");
    $("#"+key).css("font-weight",fontWeight);
    $("#"+key).css("font-style",fontStyle);
    $("#"+key).css("font-family",fontFamily);
}

$("#font_save").click(function(){
    let h2FontSize = $("#--h2-font-size").val();
    let h2FontWeight = $("#--h2-font-weight").val();
    let h2FontStyle = $("#--h2-font-style").val();
    let h2FontFamily = $("#--h2-font-family").val();
    let h3FontSize = $("#--h3-font-size").val();
    let h3FontWeight = $("#--h3-font-weight").val();
    let h3FontStyle = $("#--h3-font-style").val();
    let h3FontFamily = $("#--h3-font-family").val();
    let h4FontSize = $("#--h4-font-size").val();
    let h4FontWeight = $("#--h4-font-weight").val();
    let h4FontStyle = $("#--h4-font-style").val();
    let h4FontFamily = $("#--h4-font-family").val();
    let textFieldFontSize = $("#--text-field-font-size").val();
    let textFieldFontWeight = $("#--text-field-font-weight").val();
    let textFieldFontStyle = $("#--text-field-font-style").val();
    let textFieldFontFamily = $("#--text-field-font-family").val();
    let labelFontSize = $("#--label-font-size").val();
    let labelFontWeight = $("#--label-font-weight").val();
    let labelFontStyle = $("#--label-font-style").val();
    let labelFontFamily = $("#--label-font-family").val();
    let defaultFontSize = $("#--default-font-size").val();
    let defaultFontWeight = $("#--default-font-weight").val();
    let defaultFontStyle = $("#--default-font-style").val();
    let defaultFontFamily = $("#--default-font-family").val();
    let thFontSize = $("#--th-font-size").val();
    let thFontWeight = $("#--th-font-weight").val();
    let thFontStyle = $("#--th-font-style").val();
    let thFontFamily = $("#--th-font-family").val();
    let tdFontSize = $("#--td-font-size").val();
    let tdFontWeight = $("#--td-font-weight").val();
    let tdFontStyle = $("#--td-font-style").val();
    let tdFontFamily = $("#--td-font-family").val();
    let logoFontSize = $("#--logo-font-size").val();
    let logoFontWeight = $("#--logo-font-weight").val();
    let logoFontStyle = $("#--logo-font-style").val();
    let logoFontFamily = $("#--logo-font-family").val();
    let navFontSize = $("#--nav-font-size").val();
    let navFontWeight = $("#--nav-font-weight").val();
    let navFontStyle = $("#--nav-font-style").val();
    let navFontFamily = $("#--nav-font-family").val();
    let bannerFontSize = $("#--banner-font-size").val();
    let bannerFontWeight = $("#--banner-font-weight").val();
    let bannerFontStyle = $("#--banner-font-style").val();
    let bannerFontFamily = $("#--banner-font-family").val();

    $.ajax({
        url: "/settings/update",
        type: "PUT",
        dataType: "json",
        data: {
            "--h2-font-size": h2FontSize,
            "--h2-font-weight": h2FontWeight,
            "--h2-font-family": h2FontFamily,
            "--h2-font-style": h2FontStyle,
            "--h3-font-size": h3FontSize,
            "--h3-font-weight": h3FontWeight,
            "--h3-font-family": h3FontFamily,
            "--h3-font-style": h3FontStyle,
            "--h4-font-size": h4FontSize,
            "--h4-font-weight": h4FontWeight,
            "--h4-font-family": h4FontFamily,
            "--h4-font-style": h4FontStyle,
            "--text-field-font-size": textFieldFontSize,
            "--text-field-font-weight": textFieldFontWeight,
            "--text-field-font-family": textFieldFontFamily,
            "--text-field-font-style": textFieldFontStyle,
            "--label-font-size": labelFontSize,
            "--label-font-weight": labelFontWeight,
            "--label-font-family": labelFontFamily,
            "--label-font-style": labelFontStyle,
            "--default-font-size": defaultFontSize,
            "--default-font-weight": defaultFontWeight,
            "--default-font-family": defaultFontFamily,
            "--default-font-style": defaultFontStyle,
            "--th-font-size": thFontSize,
            "--th-font-weight": thFontWeight,
            "--th-font-family": thFontFamily,
            "--th-font-style": thFontStyle,
            "--td-font-size": tdFontSize,
            "--td-font-weight": tdFontWeight,
            "--td-font-family": tdFontFamily,
            "--td-font-style": tdFontStyle,
            "--logo-font-size": logoFontSize,
            "--logo-font-weight": logoFontWeight,
            "--logo-font-family": logoFontFamily,
            "--logo-font-style": logoFontStyle,
            "--nav-font-size": navFontSize,
            "--nav-font-weight": navFontWeight,
            "--nav-font-family": navFontFamily,
            "--nav-font-style": navFontStyle,
            "--banner-font-size": bannerFontSize,
            "--banner-font-weight": bannerFontWeight,
            "--banner-font-family": bannerFontFamily,
            "--banner-font-style": bannerFontStyle,
            "key": "fonts"
        },
        beforeSend: function(){
            console.log(h2FontFamily,h2FontSize,h2FontStyle,h2FontWeight,
                h3FontFamily,h3FontSize,h3FontStyle,h3FontWeight,
                h4FontFamily,h4FontSize,h4FontStyle,h4FontWeight,
                textFieldFontFamily,textFieldFontSize,textFieldFontStyle,textFieldFontWeight,
                labelFontFamily,labelFontSize,labelFontStyle,labelFontWeight,
                defaultFontFamily,defaultFontSize,defaultFontStyle,defaultFontWeight,
                thFontFamily,thFontSize,thFontStyle,thFontWeight,
                tdFontFamily,tdFontSize,tdFontStyle,tdFontWeight,
                logoFontFamily,logoFontSize,logoFontStyle,logoFontWeight,
                navFontFamily,navFontSize,navFontStyle,navFontWeight,
                bannerFontFamily,bannerFontSize,bannerFontStyle,bannerFontWeight,);
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

function loadMultiDemo(element)
{
    let key = $(element).attr("data-target");

    if(key == "nav-item"){
        key = "nav";
    }

    console.log(key);

    let fontSize = $("#--text-field-font-size").val();
    let fontWeight = $("#--text-field-font-weight").val();
    let fontStyle = $("#--text-field-font-style").val();
    let fontFamily = $("#--text-field-font-family").val(); 
    
    if(key == "nav"){
        key = "nav-item";
    }

    $("."+key).css("font-size",fontSize+"px");
    $("."+key).css("font-weight",fontWeight);
    $("."+key).css("font-style",fontStyle);
    $("."+key).css("font-family",fontFamily);
}

$("#font_clear,#bg_color_clear").click(function(){
    window.location = "/settings";
});

function loadButton(element)
{
    let id = $(element).attr("id");
    let target = $(element).attr("data-target");
    let value = $(element).val();

    if(id.includes("bg")){
        $("#"+target).css("background-color",value);
    }
    
    else{
        $("#"+target).css("color",value);
    }
}

$("#buttons_save").click(function(){
    let buttonDefaultBgColor = $("#--button-default-bg-color").val();
    let buttonDefaultColor = $("#--button-default-color").val();
    let buttonPrimaryBgColor = $("#--button-primary-bg-color").val();
    let buttonPrimaryColor = $("#--button-primary-color").val();
    let buttonSecondaryBgColor = $("#--button-secondary-bg-color").val();
    let buttonSecondaryColor = $("#--button-secondary-color").val();
    let buttonSuccessBgColor = $("#--button-success-bg-color").val();
    let buttonSuccessColor = $("#--button-success-color").val();
    let buttonInfoBgColor = $("#--button-info-bg-color").val();
    let buttonInfoColor = $("#--button-info-color").val();
    let buttonWarningBgColor = $("#--button-warning-bg-color").val();
    let buttonWarningColor = $("#--button-warning-color").val();
    let buttonDangerBgColor = $("#--button-danger-bg-color").val();
    let buttonDangerColor = $("#--button-danger-color").val();
    let buttonLightBgColor = $("#--button-light-bg-color").val();
    let buttonLightColor = $("#--button-light-color").val();
    let buttonDarkBgColor = $("#--button-dark-bg-color").val();
    let buttonDarkColor = $("#--button-dark-color").val();

    $.ajax({
        url: "/settings/update",
        type: "PUT",
        dataType: "json",
        data: {
            "--button-default-bg-color": buttonDefaultBgColor,
            "--button-default-color": buttonDefaultColor,
            "--button-primary-bg-color": buttonPrimaryBgColor,
            "--button-primary-color": buttonPrimaryColor,
            "--button-secondary-bg-color": buttonSecondaryBgColor,
            "--button-secondary-color": buttonSecondaryColor,
            "--button-success-bg-color": buttonSuccessBgColor,
            "--button-success-color": buttonSuccessColor,
            "--button-info-bg-color": buttonInfoBgColor,
            "--button-info-color": buttonInfoColor,
            "--button-warning-bg-color": buttonWarningBgColor,
            "--button-warning-color": buttonWarningColor,
            "--button-danger-bg-color": buttonDangerBgColor,
            "--button-danger-color": buttonDangerColor,
            "--button-light-bg-color": buttonLightBgColor,
            "--button-light-color": buttonLightColor,
            "--button-dark-bg-color": buttonDarkBgColor,
            "--button-dark-color": buttonDarkColor,
            key: "buttons",
        },
        beforeSend: function(){
            // console.log(
            //     buttonDefaultBgColor,buttonPrimaryBgColor,buttonSecondaryBgColor,buttonSuccessBgColor,buttonInfoBgColor,buttonWarningBgColor,buttonDangerBgColor,buttonLightBgColor,buttonDarkBgColor,buttonDefaultColor,buttonPrimaryColor,buttonSecondaryColor,buttonSuccessColor,buttonInfoColor,buttonWarningColor,buttonDangerColor,buttonLightColor,buttonDarkColor,
            // );
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