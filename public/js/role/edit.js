$("#role_edit_form").submit(function (e) {
    e.preventDefault();



    let name = $("#name").val();
    let permission_ids = [];
    let url = $(this).attr("action");

    $.each($("#granted_permission_ul li"),function(key,value){
        permission_ids.push($(value).attr("id"));
    });

    console.log(name,permission_ids,url);

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            name: name,
            permission_ids: permission_ids,
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

$("#all_permission_ul").on("click","li",function(){
    $("#granted_permission_ul").append($(this));
    toastr.success("Permission added to role");
});

$("#granted_permission_ul").on("click","li",function(){
    $("#all_permission_ul").append($(this));
    toastr.info("Permission removed from role");
});

$("#delete_trigger,#delete_form_close").click(function(){
    $("#role_delete_div").toggleClass("delete-show");
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