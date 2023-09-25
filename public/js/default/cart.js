function loadCartIndex()
{
    if($("#item_count").attr("class") != undefined){
        $.ajax({
            url: "/cart",
            type: "GET",
            success: function(response){
                if(response.count == 0){
                    $("#item_count").text("");
                    $("#item_count").css("background","none");
                }
                
                else{
                    $("#item_count").text(response.count);
                    $("#item_count").css("background","red");
                }
            }
        });
    }
}

getCartView();
loadCartIndex();

$("#cart_trigger,#cart_close").click(function(){
    $("#cart_div").toggleClass("cart-show");
    getCartView();
});

$("#products,#product_details_div").on("click",".add-to-cart",function(e){
    e.preventDefault();

    if($("#item_count").attr("class") == undefined){
        toastr.info("Please login first!");
    }

    else{
        let id = $(this).attr("data-id");
    
        $.ajax({
            url: "/cart",
            type: "POST",
            dataType: "json",
            data:{
                id: id,
            },
            success: function(response){
                if(response.status === "error"){
                    toastr.error(response.message);
                }
                else if(response.status == "info"){
                    toastr.info(response.message);
                }
                else if(response.status == "exception"){
                    toastr.warning(response.message);
                }
                else{
                    toastr.success(response.message);
                    let count = response.sell.sell_orders.length;
    
                    if(count == 0){
                        $("#cart_trigger span").text("");
                        $("#cart_trigger span").css("background","none");
                    }
                    
                    else{
                        $("#cart_trigger span").text(count);
                        $("#cart_trigger span").css("background","red");
                    }
                    getCartView();
                }
            }
        });
    }
});

function getCartView()
{    
    if($("#item_count").attr("class") != undefined){
        $.ajax({
            url: "/cart/1",
            type: "GET",
            success: function(response){
                $("#cart_div .cart .table-container table").html(response);
                loadCartIndex();
            }
        });
    }
}

$("#cart_div").on("click",".add,.sub,.delete",function(){
    let id = $(this).attr("data-id");
    let sign = 0;

    if($(this).hasClass("add")){
        sign = 1;
    }

    else if($(this).hasClass("sub")){
        sign = 2;
    }

    if(sign === 0 && !confirm("Are you sure?")){
        return;
    }

    $.ajax({
        url: "/cart/update",
        type: "PUT",
        data:{
            id:id,
            sign:sign,
        },
        success: function(response){
            if(response.status === "error"){
                toastr.error(response.message);
            }
            
            else{
                toastr.success(response.message);
                let count = response.sell.sell_orders.length;

                if(count == 0){
                    $("#cart_trigger span").text("");
                    $("#cart_trigger span").css("background","none");
                    $("#cart_div").toggleClass("show");
                }
                
                else{
                    $("#cart_trigger span").text(count);
                    $("#cart_trigger span").css("background","red");
                }

                getCartView();
            }
        }
    });
});

$("#cart_clear_all").click(function(){
    if(confirm("Are you sure?")){
        $.ajax({
            url: "/cart/1",
            type: "DELETE",
            success: function(response){
                if(response.status === "success"){
                    toastr.success(response.message);
    
                    $("#cart_trigger span").text("");
                    $("#cart_trigger span").css("background","none");
                    $("#cart_div").toggleClass("show");
    
                    getCartView();
                }
    
                else{
                    toastr.error(response.message);
                }
            }
        });
    }    
});