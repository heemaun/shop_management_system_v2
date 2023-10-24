// $("#image_object_create_form").submit(function(e){
//     e.preventDefault();
//     let name = $("#name").val();
//     let balance = $("#balance").val();
//     let url = $(this).attr("action");
//     let type = $(this).attr("method");

//     $.ajax({
//         url: url,
//         type: type,
//         dataType: "json",
//         data: {
//             name:name,
//             balance:balance,
//         },
//         beforeSend: function(){
//             $(".error").text("");
//         },
//         success: function(response){
//             if(response.status === "errors"){
//                 $.each(response.message,function(key,value){
//                     $("#"+key+"_error").text(value[0]);
//                 });
//             }

//             else if(response.status === "error"){
//                 toastr.error(response.message);
//             }

//             else if(response.status === "exception"){
//                 toastr.info(response.message);
//             }

//             else{
//                 window.location = response.route;
//             }
//         }
//     });
// });

$("#view_image").click(function(){
    $("#image_input").click();
});

$("#image_input").change(function(e){
    $("#view_image").attr("src","/image/add_user.png");

    let image_input = e.target.files[0];
    if (image_input) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#view_image').attr('src', e.target.result);
        };
        reader.readAsDataURL(image_input);
    }
});

$("#image_object_create_form").submit(function(e){
    e.preventDefault();
    
    let url = $(this).attr("action");
    let formData = new FormData();

    if(window.location.href.includes("users")){
        formData.append("user_id",$("#view_image").attr("data-id"));
        formData.append("key","user_profile_image");
    }

    else if(window.location.href.includes("products")){
        formData.append("product_id",$("#view_image").attr("data-id"));
        formData.append("key","product_image");
    }

    else if(window.location.href.includes("settings")){
        formData.append("setting_id",$("#view_image").attr("data-id"));
        formData.append("key","settings_image");
    }

    else{
        return undefined;
    }

    formData.append("image",$("#image_input")[0].files[0]);

    // console.log(formData);

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
            // console.log(response);
            if(response.status === "errors"){
                $.each(response.message,function(key,value){
                    $("#"+key+"_error").text(value[0]);
                });
            }

            else if(response.status === "error"){
                toastr.error(response.message);
            }

            else if(response.status === "exception"){
                toastr.info(response.message);
            }

            else{
                window.location = response.route;
            }
        }
    });
});