$("#product_edit_form").submit(function (e) {
    e.preventDefault();

    let status_id = $("#status_id").val();
    let category_id = $("#category_id").val();
    let name = $("#name").val();
    let price = $("#price").val();
    let units = $("#units").val();
    let details = $("#details").val();

    let url = $(this).attr("action");

    console.log(category_id);

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            status_id: status_id,
            category_id: category_id,
            name: name,
            price: price,
            units: units,
            details: details,
            key: "update",
        },
        beforeSend: function () {
            $(".error").text("");
        },
        success: function (response) {
            console.log(response);
            if (response.status === "errors") {
                $.each(response.message, function (key, value) {
                    $("#" + key + "_error").text(value[0]);
                });
            }

            else if (response.status === "error") {
                toastr.error(response.message);
            }

            else if (response.status === "exception") {
                toastr.info(response.message);
            }

            else {
                window.location = response.route;
            }
        }
    });
});