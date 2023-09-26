$("#product_create_form").submit(function(e){
    e.preventDefault();
    let category_id = $("#category_id").val();
    let name = $("#name").val();
    let units = $("#units").val();
    let price = $("#price").val();
    let details = $("#details").val();
    let url = $(this).attr("action");
    let type = $(this).attr("method");

    $.ajax({
        url: url,
        type: type,
        dataType: "json",
        data: {
            category_id:category_id,
            name:name,
            units:units,
            price:price,
            details:details,
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