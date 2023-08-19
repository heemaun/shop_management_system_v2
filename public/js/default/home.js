$("#category_search").keyup(function () {
    let category_search = $(this).val();
    let ul = $("#result_ul");
    
    if (category_search != "") {
        $.ajax({
            url: "/home-category-search",
            type: "GET",
            data: {
                category_search: category_search,
            },
            beforeSend: function () {
                ul.empty();
            },
            success: function (response) {
                if (category_search != "") {
                    $.each(response.categories, function (key, value) {
                        ul.append('<li data-id="' + value.id + '">' + value.name + '</li>');
                    });
                }
            }
        });
    }

    else {
        ul.empty();
        let product_search = $("#product_search").val();
        setProductList(product_search,category_search,"product_search");
    }

});

$("#result_ul").on("click","li",function(){
    let category_id = $(this).attr("data-id");
    let category_name = $(this).text();
    let product_search = $("#product_search").val();
    let ul = $("#result_ul");

    $.ajax({
        url: "/home-product-search",
        type: "GET",
        data: {
            product_search: product_search,
            category_id: category_id,
            key: "category_select",
        },
        success: function (response) {
            $("#category_search").val(category_name);
            $("#products_list").html(response);
            ul.empty();
        }
    });
});

$("#product_search").keyup(function () {
    let product_search = $(this).val();
    let category_search = $("#category_search").val();

    setProductList(product_search,category_search,"product_search");
});

function setProductList(product_search,category_search,key)
{
    $.ajax({
        url: "/home-product-search",
        type: "GET",
        data: {
            product_search: product_search,
            category_search: category_search,
            key: key,
        },
        success: function (response) {
            $("#products_list").html(response);
        }
    });
}

$("#product_view_trigger,#product_view_close").click(function () {
    if (!$("#product_details_div").hasClass("show")) {
        let id = $(this).attr("data-id");

        $.ajax({
            url: "/home-product-view",
            type: "GET",
            data: {
                id: id,
            },
            success: function (response) {
                $("#product_name").text(response.product.name);
                $("#product_details").text(response.product.details);
                $("#product_price").text("Price: " + response.product.price + " Tk");
                $("#product_details_div .add-to-cart").attr("data-id", response.product.id);
            }
        });
    }

    $("#product_details_div").toggleClass("show");
});