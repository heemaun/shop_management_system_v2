function search()
{
    let customer_id = $("#customer_list option[data-name='"+$("#customer_name").val()+"']").attr("data-id");
    let from_date = $("#from_date").val();
    let to_date = $("#to_date").val();
    let status_id = $("#status_id").val();
    let row_count = $("#row_count").val();

    $.ajax({
        url: "/sells",
        type: "GET",
        data: {
            customer_id: customer_id,
            from_date: from_date,
            to_date: to_date,
            status_id: status_id,
            row_count: row_count,
            key: "search",
        },
        success: function(response){
            $(".table-container").html(response);
            convertToLocalTime();
        }
    });
}

$(".table-container").on("click",".clickable",function(){
    window.location = $(this).attr("data-href");
});

$(".table-container").on("click",".page-link",function(e){
    e.preventDefault();

    let customer_id = $("#customer_list option[data-name='"+$("#customer_name").val()+"']").attr("data-id");
    let from_date = $("#from_date").val();
    let to_date = $("#to_date").val();
    let status_id = $("#status_id").val();
    let row_count = $("#row_count").val();
    let url = $(this).attr("href");

    $.ajax({
        url: url,
        type: "GET",
        data: {
            customer_id: customer_id,
            from_date: from_date,
            to_date: to_date,
            status_id: status_id,
            row_count: row_count,
            key: "search",
        },
        success: function(response){
            $(".table-container").html(response);
        }
    });
});

$("#controls_toggle").click(function(){
    $(".controls").toggleClass("controls-show");
});

$("#from_date,#to_date").change(function(){
    let fromDate = $("#from_date").val();
    let toDate = $("#to_date").val();

    $("#from_date").attr("max",toDate);
    $("#to_date").attr("min",fromDate);
});

$("#customer_name").keyup(function(){    
    let customer_name = $("#customer_name").val();

    $.ajax({
        url: "/sells",
        type: "GET",
        data: {
            customer_name: customer_name,
            key: "customer_search",
        },
        success: function(response){
            $("#customer_list").html(response);
        }
    });
});

