$("#delete_trigger,#delete_form_close").click(function(){
    $("#user_delete_div").toggleClass("show");
});

$("#delete_form").submit(function(e){
    e.preventDefault();

    let url = $(this).attr("action");
    let password = $("#password").val();
    let permanent = $("#permanent").is(":checked");

    $.ajax({
        url: url,
        type: "DELETE",
        dataType: "json",
        data: {
            password: password,
            soft_delete: !permanent,
        },
        beforeSend: function(){
            console.log(password,permanent);
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