$("#login_trigger,#login_close").click(function(){
    $("#login_div").toggleClass("show");
});

$("#login_form").submit(function (e) {
    e.preventDefault();
    let username = $("#login_username").val();
    let password = $("#login_password").val();

    $.ajax({
        url: "/login",
        type: "POST",
        dataType: "json",
        data: {
            username: username,
            password: password,
        },
        beforeSend: function () {
            $(".error").text("");
        },
        success: function (response) {
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#"+key+"_error").text(value[0]);
                });
            }

            else if(response.status === "exception"){
                toastr.error(response.message);
            }

            else if(response.status === "error"){
                toastr.error(response.message);
            }

            else{
                window.location = response.url;
            }
        }
    });
});