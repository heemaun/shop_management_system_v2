//search for customer name
$("#customer_name").keyup(function(){
    let search = $(this).val();

    $.ajax({
        url: "/users",
        type: "GET",
        data:{
            search: search,
            key: "create_sell",
        },
        success: function(response){
            $("#customer_list").html(response);
        }
    });
});

// storing customer id on selection
$("#customer_name").change(function(){
    $(this).attr("data-id",$("#customer_list option[data-name='"+$(this).val()+"']").attr("data-id"));
});

//auto redirecting cursor on customer select
$("#customer_name").keypress(function(e){
    if(e.keyCode == 13){
        e.preventDefault();
        $("#product_name").focus();
    }
});

// $("#product_name").keydown(function(e){
//     if(e.keyCode == 13 && $(this).val() != ""){
//         e.preventDefault();
//     }

//     else if(e.keyCode == 13){
//         console.log("not here");
//     }
//     if(e.keyCode == 9 && $(this).val() != ""){
//         e.preventDefault();
//         console.log(555);
//     }
// });

//search for customer name
$("#product_name").keyup(function(){
    $("#product_price").text(" TK");
    $("#product_units").val("0");
    $("#product_discount").val("0");
    $("#product_total").text(" TK");
    
    $("#product_units").prop("disabled",true);
    $("#product_discount").prop("disabled",true);
    $("#add_product").prop("disabled",true);

    let search = $(this).val();

    $.ajax({
        url: "/products",
        type: "GET",
        data:{
            search: search,
            key: "create_sell",
        },
        success: function(response){
            $("#product_list").html(response);
        }
    });
});

//loading product data on product panel on selection
$("#product_name").change(function(){
    let id = $("#product_list option[data-name='"+$("#product_name").val()+"']").attr("data-id");
     
    if(id != undefined){
        $.ajax({
            url: "/products/"+id,
            type: "GET",
            dataType: "json",
            data:{
                key: "create_sell",
            },
            success: function(response){
                $("#product_price").text(response.product.price+" TK");
                $("#product_units").val("1");
                $("#product_discount").val("0");
                $("#product_total").text(response.product.price+" TK");
                
                $("#product_units").prop("disabled",false);
                $("#product_discount").prop("disabled",false);
                $("#add_product").prop("disabled",false);

                $("#product_units").focus();
            }
        });
    }   
});

// changing product units & discounts based user interection
$("#product_units,#product_discount").change(function(){
    setProductTotal();
});

$("#product_units,#product_discount").keyup(function(){
    setProductTotal();
});

function setProductTotal()
{
    let product_units = $("#product_units").val();
    let product_discount = $("#product_discount").val();
    let id = $("#product_list option[data-name='"+$("#product_name").val()+"']").attr("data-id");

    if(id != undefined){
        $.ajax({
            url: "/products/"+id,
            type: "GET",
            dataType: "json",
            data:{
                key: "create_sell",
            },
            success: function(response){
                if(response.product.price * product_units >= product_discount * 2){
                    $("#product_total").text(response.product.price * product_units - product_discount+" TK");
                    $("#add_product").prop("disabled",false);
                }

                else{
                    alert("Not Allowed");
                    $("#add_product").prop("disabled",true);
                    $("#product_total").text("TK");
                }
            }
        });
    }
}
// changing product units & discounts based user interection ends

// adding product info into sell objs sell-orders
$("#add_product").click(function(){
    let product_units = $("#product_units").val();
    let product_discount = $("#product_discount").val();
    let id = $("#product_list option[data-name='"+$("#product_name").val()+"']").attr("data-id");

    $.ajax({
        url: "/sell-orders",
        type: "POST",
        data:{
            product_id:id,
            units:product_units,
            discount:product_discount,
            key: "create_sell",
        },
        success: function(response){
            $(".sell-orders").html(response);
            $("#product_name").val("");
            $("#product_name").focus();
            $("#product_list option[data-name='"+$("#product_name").val()+"']").attr("data-id","");
            $("#product_units").val("");
            $("#product_discount").val("");
            $("#product_price").text(" TK");
            $("#product_total").text(" TK");
            $("#product_units").prop("disabled",true);
            $("#product_discount").prop("disabled",true);
            $("#add_product").prop("disabled",true);
        }
    });
});

// modifing sell-orders on table
$(".sell-orders").on("click",".add,.sub,.delete",function(e){
    e.preventDefault();

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
        url: "/sell-orders/"+id,
        type: "PUT",
        data:{
            id:id,
            sign:sign,
            key: "create_sell"
        },
        success: function(response){
            if(response.status === "error"){
                toastr.error(response.message);
            }
            
            else if(response.status === "warning"){
                toastr.warning(response.message);
            }
            
            else{
                toastr.success("Item(s) updated succesfully");
                $(".sell-orders").html(response);
            }
        }
    });
});

// calculating sell discount
$(".sell-orders").on("keyup","#sell_discount",function(){ 
    let sellTotal = $("#sell_total").text();
    let discount = $(this).val();
    
    if(sellTotal < discount * 2){
        $("#sell_store").prop("disabled",true);
        alert("Discount not allowed");
    }

    else if(discount < 0){
        $(this).val(0);
    }
    
    else{
        $("#sell_store").prop("disabled",false);
        $("#sell_grand_total").text((sellTotal - discount).toFixed(2));
    }
});

// clearing the entire sell data
$("#sell_clear_all").click(function(){
    if(confirm("Are you sure, you want to clear all items?")){
        $.ajax({
            url: "/sells/"+$(this).attr("data-id"),
            type: "DELETE",
            dataType: "json",
            data:{
                soft_delete: "false",
                key: "create_sell",
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = response.route;
                }
            }
        });
    }
});

// creating final sell & storing it
$("#sell_create_form").submit(function(e){
    e.preventDefault();
    let customer_id = $("#customer_name").attr("data-id");
    let discount = ($("#sell_discount").val() != "") ? $("#sell_discount").val() : 0;
    let url = $(this).attr("action");
    let type = $(this).attr("method");

    $.ajax({
        url: url,
        type: type,
        dataType: "json",
        data: {
            customer_id: customer_id,
            discount: discount,
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