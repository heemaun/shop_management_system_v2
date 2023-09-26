$("#account_edit_form").submit(function (e) {
    e.preventDefault();

    let status_id = $("#status_id").val();
    let name = $("#name").val();
    let balance = $("#balance").val();

    let url = $(this).attr("action");

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            status_id: status_id,
            name: name,
            balance: balance,
            key: "update",
        },
        beforeSend: function () {
            $(".error").text("");
        },
        success: function (response) {
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