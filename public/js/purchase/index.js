function search()
{
    let search = $("#search").val();
    let status_id = $("#status_id").val();
    let row_count = $("#row_count").val();

    $.ajax({
        url: "/purchases",
        type: "GET",
        data: {
            search: search,
            status_id: status_id,
            row_count: row_count,
            key: "search",
        },
        success: function(response){
            $(".table-container").html(response);
        }
    });
}

$(".table-container").on("click",".clickable",function(){
    window.location = $(this).attr("data-href");
});

$(".table-container").on("click",".page-link",function(e){
    e.preventDefault();

    let search = $("#search").val();
    let status_id = $("#status_id").val();
    let row_count = $("#row_count").val();
    let url = $(this).attr("href");

    $.ajax({
        url: url,
        type: "GET",
        data: {
            search: search,
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