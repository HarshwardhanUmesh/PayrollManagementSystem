var value;
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
$(".pen").click((event) => {
    var parent = $(event.target).parent()
    // console.log(parent)
    parent.attr("contenteditable", "true");
    globalThis.value = parent.text()
    parent.text('')
    parent.append('<input type="text id="fname" name="fname">')
    var input = parent.find("input")
    input.attr("value", value)
    input[0].selectionStart = input[0].selectionEnd = input[0].value.length;
    input.focus();
    input.click();
})
$("td").click((event) => {
    if ($(event.target).prop("tagName")=='INPUT') {
        // {    console.log($(event.target).attr('class')+" " + globalThis.value)
        // $target_element = $(event.target)
        console.log($(event.target).parent())
        // console.log($(event.target).parent().parent());
        var classes = $(event.target).parent().attr('class').split(" ");
        table = classes[1]
        console.log("table: " + table)
        var parent1 = $(event.target).parent().parent()
        // parent1.append('<input type="text id="fname" name="fname">')
        attri = []
        values = []
        selected_element = classes[2]
        selected_value = $(event.target).text()
        // console.log(selected_value)
        $(parent1).children().each((index, element) => {
            console.log("element: "+$(element))
            if ($(element).attr('class') != 'delete') {
                try {
                    attri.push($(element).attr('class').split(" ")[2]);
                    if ($(element).find("input").val()) {
                        values.push($(element).find("input").val())
                        console.log("with input"+$(element))
                    } else {
                        values.push($(element).text());
                        console.log("no input"+$(element))
                    }
                } catch (error) {
                    // console.log(error)
                }
            }
        })
        console.log(attri);
        console.log(values);
        event.stopPropagation();
    }
})


// function hello(){
//     console.log("hi")
//     console.log
// }

$('td.v').on('keypress', function (e) {
    if($(e.target).prop("tagName")=='INPUT')
   { if (e.key == "Enter" && e.shiftKey == false) {
        $.ajax({
            async: true,
            type: "POST",
            url: "http://localhost/tables/update.php",
            data: {
                "table": table,
                "attribute": attri,
                "value": values,
                "update": $(e.target).val(),
                "selectedElement": selected_element,
                "selectedValue": selected_value
            },
            success: function (data) {
                console.log("success " + data);
                if (data != 1) {
                    $("body").append('<div class="alert alert-danger" role="alert">Error : Failed to Update.</div>')
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
                    $("body").append('<div class="alert alert-primary" role="alert">Updated Successfully.</div>')
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
                }
            },
            error:
                function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
        })
        // location.reload()
        return false;
    }}
    event.stopPropagation();
    
});