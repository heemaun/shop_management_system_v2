$("#search").keyup(function(){
    search();
});
$("#status_id").change(function(){
    search();
});

function search()
{
    let search = $("#search").val();
    let status_id = $("#status_id").val();

    $.ajax({
        url: "/users",
        type: "GET",
        data: {
            search: search,
            status_id: status_id,
            key: "search",
        },
        success: function(response){
            $("tbody").html(response);
        }
    });
}

$("tbody").on("click",".clickable",function(){
    window.location = $(this).attr("data-href");
});