$("#purchase_create_form").submit(function(e){
    e.preventDefault();
    let name = $("#name").val();
    let balance = $("#balance").val();
    let url = $(this).attr("action");
    let type = $(this).attr("method");

    $.ajax({
        url: url,
        type: type,
        dataType: "json",
        data: {
            name:name,
            balance:balance,
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