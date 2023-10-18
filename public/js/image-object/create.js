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
    $("#file").click();
});

$("#file").change(function(e){
    $("#view_image").attr("src","/image/add_user.png");

    let file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#view_image').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

$("#image_object_create_form").submit(function(e){
    e.preventDefault();
    console.log($("#file").val());
    let url = $(this).attr("action");

    // Create a FormData object.
    var formData = new FormData();
    formData.append('image', $('#file')[0].files[0]); // Append the file.
    formData.append('key', "user_profile_image"); // Append the file.
    // console.log(formData);
    // Send an AJAX POST request to your Laravel controller.
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false, // Don't set content type.
        processData: false,
        success: function(response) {
            // Handle the response from your controller.
            console.log(response);
        }
    });
});