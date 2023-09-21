$("#permission_edit_form").submit(function (e) {
    e.preventDefault();



    let name = $("#name").val();
    let url = $(this).attr("action");

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            name: name,
            key: "update",
        },
        beforeSend: function () {
            $(".error").text("");
        },
        success: function (response) {
            if (response.status === "errors") {
                $.each(response.message, function (key, value) {
                    $("#" + key + "_error").text(value[0]);
                    console.log("#" + key + "_error",value[0]);
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

$("#all_permission_ul").on("click","li",function(){
    $("#granted_permission_ul").append($(this));
    toastr.success("Permission added to permission");
});

$("#granted_permission_ul").on("click","li",function(){
    $("#all_permission_ul").append($(this));
    toastr.info("Permission removed from permission");
});

$("#delete_trigger,#delete_form_close").click(function(){
    $("#permission_delete_div").toggleClass("delete-show");
});

$("#delete_form").submit(function(e){
    e.preventDefault();

    if(confirm("Are you sure?")){
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
    }    
});