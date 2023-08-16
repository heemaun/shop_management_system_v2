$("#side_bar_toggle").click(function(){
    $("aside").toggleClass("aside-show");
});

$("#login_trigger,#login_close").click(function(){
    $("#login_div").toggleClass("show");
});

$("#product_view_trigger,#product_view_close").click(function(){
    if(!$("#product_details_div").hasClass("show")){
        let id = $(this).attr("data-id");

        $.ajax({
            url: "/home-product-view",
            type: "GET",
            data: {
                id: id,
            },
            beforeSend: function(){
                console.log(id);
            },
            success: function(response){
                console.log(response);
                $("#product_name").text(response.product.name);
                $("#product_details").text(response.product.details);
                $("#product_price").text("Price: "+response.product.price+" Tk");
            }
        });
    }


    $("#product_details_div").toggleClass("show");
});

$("#login_form").submit(function (e) {
    e.preventDefault();
    let username = $("#username").val();
    let password = $("#password").val();

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