$("#search").keyup(function(){
    search();
});

function search()
{
    let search = $("#search").val();

    $.ajax({
        url: "/permissions",
        type: "GET",
        data: {
            search: search,
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