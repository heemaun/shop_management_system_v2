$("#user_create_form").submit(function(e){
    e.preventDefault();
    let name = $("#name").val();
    let username = $("#username").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let address = $("#address").val();
    let dob = $("#dob").val();
    let gender = $("#gender").val();
    let password = $("#password").val();
    let password_confirmation = $("#password_confirmation").val();
    let url = $(this).attr("action");
    let type = $(this).attr("method");

    $.ajax({
        url: url,
        type: type,
        dataType: "json",
        data: {
            name:name,
            username:username,
            email:email,
            phone:phone,
            address:address,
            dob:dob,
            gender:gender,
            password:password,
            password_confirmation:password_confirmation,
        },
        beforeSend: function(){
            $(".error").text("");
        },
        success: function(response){
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