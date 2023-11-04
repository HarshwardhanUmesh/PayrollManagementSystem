$(".delete").click((event) => {
    // sessionStorage.setItem("delete", "TRUE");
    event.stopPropagation();
    try{
    if($(event.target).attr("class").split(" ")[1] != "delete"){
        console.log($(event.target).attr("class").split(" ")[1])
        $(event.target).parent().trigger("click");
    }else{
    console.log($(event.target).attr("class"))
    table = $(event.target).attr("class").split(" ")[0]
    var parent1 = $(event.target).parent()
    console.log(parent1.parent())
    attri = []
    values = []
    $(parent1.parent()).children().each((index, element) => {
        try {
            attri.push($(element).attr('class').split(" ")[2]);
            values.push($(element).text());
        } catch (error) {
            console.log(error)
        }
    })
    $.ajax({
        async: true,
        type: "POST",
        url: "./delete.php",
        data: {
            "table": table,
            "attribute": attri,
            "value": values,
        },
        success: function (data) {
            console.log("success " + data);
            if (data != 1) {
                $("body").append('<div class="alert alert-danger" role="alert">Error : Failed to Delete.</div>')
                sessionStorage.clear()
                sleep(2000);
                $(".alert").animate({
                  opacity: 0
                },
                  5000,
                  function () {
                    $elementToDisappear.empty();
                  }
                );
              } else {
                sessionStorage.clear();
                sessionStorage.setItem("delete", "TRUE");
                location.reload();
              }
        },
        error:
            function (data) {
                console.log('An error occurred.');
                console.log(data);
            }
    })
    sessionStorage.clear();
    sessionStorage.setItem("delete", "TRUE");
    location.reload();
    }
} catch (error) {
    console.log(error)
}
})