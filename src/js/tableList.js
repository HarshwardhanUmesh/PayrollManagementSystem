$( document ).ready(function() {
$(".btn.view").click(
    (event) => {
        var table = $(event.target).attr("class").split(" ")[0]
        console.log($(event.target).attr("class"))
        window.location.replace(window.location.origin+"/tables/table.php"+"?table="+ table)
    }
)
$(".btn.logs").click(() =>{
    window.location.replace(window.location.origin+"/tables/logs.php")
}
)
})