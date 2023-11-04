
var selected_value = 1;
$(".pen").click((event) => {
  var parent = $(event.target).parent()
  parent.attr("contenteditable", "true");
  globalThis.value = parent.text()
  parent.text('')
  parent.append('<input type="text id="fname" name="fname">')
  var input = parent.find("input")
  input.attr("value", value)
  input[0].selectionStart = input[0].selectionEnd = input[0].value.length;
  input.focus();
  input.click();
  console.log($(input).parent())
  var classes = $(input).parent().attr('class').split(" ");
  table = classes[1]
  console.log("table: " + table)
  var parent1 = $(input).parent().parent()
  attri = []
  values = []
  selected_element = classes[2]
  selected_value = $(event.target).text()
  $(parent1).children().each((index, element) => {
    console.log("element: " + $(element))
    if ($(element).attr('class') != 'delete') {
      try {
        attri.push($(element).attr('class').split(" ")[2]);
        $(element).find("input").addClass($(element).find("input").val())
        if ($(element).find("input").val()) {
          values.push($(element).find("input").val())
          console.log("with input" + $(element))
        } else {
          values.push($(element).text());
          console.log("no input" + $(element))
        }
      } catch (error) {
        console.log(error)
      }
    }
  })
  console.log(attri);
  console.log(values);
  event.stopPropagation();
  $(input).keypress((e) => {
    if (e.key == "Enter" && e.shiftKey == false) {
      if (getInput(input)) {
        if (foreignKey(input) && primaryKey(selected_value, input)) {
          console.log("Update sent")
          $.ajax({
            async: true,
            type: "POST",
            url: "./update.php",
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
                sessionStorage.clear();
                sessionStorage.setItem("update", "TRUE");
                location.reload();
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
        // } else {
        //   console.log("Update request not sent")
        //   $("body").append('<div class="alert alert-danger" role="alert">Error : Foreign Key Error.</div>')
        //   sessionStorage.clear()
        //   sleep(2000);
        //   $(".alert").animate({
        //     opacity: 0
        //   },
        //     5000,
        //     function () {
        //       $elementToDisappear.empty();
        //     }
        //   );

        }
      // } else {
      //   console.log("Update request not sent")
      //   $("body").append('<div class="alert alert-danger" role="alert">Error : Data Type Error.</div>')
      //   sessionStorage.clear()
      //   sleep(2000);
      //   $(".alert").animate({
      //     opacity: 0
      //   },
      //     5000,
      //     function () {
      //       $elementToDisappear.empty();
      //     }
      //   );
      }
    }

  })

})
function isVarchar(str, length) {
  return typeof str === 'string' && str.length <= length;
}
function isFloat(str) {
  const floatPattern = /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/;
  return floatPattern.test(str);
}
function isInteger(str) {
  const numericPattern = /^[0-9]+$/;
  return numericPattern.test(str);
}
function getInput(Inputelement) {
  var datatype = $(Inputelement).parent().attr("class").split(' ')[3]
  console.log(datatype)
  if (datatype.split('(')[0] == "varchar") {
    if (isVarchar($(Inputelement).val(), Number(datatype.split('(')[1].split(')')[0]))) {
      console.log('The string meets VARCHAR');
      return true;
    } else {
      console.log('The string does not meet VARCHAR requirement.');
      console.log("Update request not sent")
      $("body").append('<div class="alert alert-danger" role="alert">Error : Data Type Error.</div>')
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
      return false;
    }
  }
  if (datatype.split('(')[0] == "int") {
    if (isInteger($(Inputelement).val())) {
      console.log('The string can be converted to an integer.');
      return true;
    } else {
              console.log("Update request not sent")
        $("body").append('<div class="alert alert-danger" role="alert">Error : Data Type Error.</div>')
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
      console.log('The string cannot be converted to an integer.');
      return false;
    }
  }
  if (datatype == 'float') {
    if (isFloat(inputString)) {
      console.log('The string can be converted to a float.');
    } else {
      console.log("Update request not sent")
      $("body").append('<div class="alert alert-danger" role="alert">Error : Data Type Error.</div>')
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
      console.log('The string cannot be converted to a float.');
    }
  }
  return true;
}
function foreignKey(Inputelement) {
  if ($(Inputelement).parent().attr('class').split(" ")[4] == "ForeignKey") {
    var table = $(Inputelement).parent().attr('class').split(" ")[1]
    var col = $(Inputelement).parent().attr('class').split(" ")[2]
    var values = []
    $.ajax({
      async: false,
      type: 'GET',
      data: { table: table },
      url: './foreign.php',
      success: function (data) {
        console.log("foreignKey: " + data);
        values += (data[col]["values"]);
      }
    });
    if (values.includes($(Inputelement).val())) {

      return true;
    } else {
      console.log("Update request not sent")
      $("body").append('<div class="alert alert-danger" role="alert">Error : Foreign Key Error.</div>')
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
      return false;
    }

  } else {
    // console.log("now")
    return true;
  }
}

function primaryKey(selected_value, Inputelement) {
  console.log("SelectedValue : " + selected_value);
  if ($(Inputelement).attr("class") == $(Inputelement).val()) {
    return true;
  } else {
    if ($(Inputelement).parent().attr('class').split(" ")[4] == "PrimaryKey") {
      var table = $(Inputelement).parent().attr('class').split(" ")[1]
      var col = $(Inputelement).parent().attr('class').split(" ")[2]
      var values = []
      $.ajax({
        async: false,
        type: 'GET',
        data: { table: table },
        url: './primary.php',
        success: function (data) {
          values += (data);
        }
      });
      if (values.includes($(Inputelement).val())) {
        console.log("Update request not sent")
        $("body").append('<div class="alert alert-danger" role="alert">Error : Primary Key Error.</div>')
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
        console.log("PrimaryKey Error");
        return false;
      } else {

        return true;
      }

    } else {
      // console.log("now")
      return true;
    }

  }
}

$(".create").on('click', (event) => {
  var section = $(event.target).parent();
  var table = section[0].getElementsByTagName("table")[0]
  console.log(table)
  var Lastrow = table.getElementsByTagName("tr")[table.rows.length - 2]
  var newRow = $(Lastrow).clone()
  $(Lastrow).after(newRow)
  console.log(newRow)
  // var count = row.childElementCount
  // row = table.insertRow(table.rows.length-1);
  $(newRow).children().each((index, element) => {
    $(element).text("")
    if ($(element).attr("class") != "delete") {
      $(element).append('<input type="text id="fname" name="fname">')
    } else {
      $(element).append('<button class="submit">Submit</button>')
    }
  })
  $(".submit").click((event) => {
    sessionStorage.setItem("insert", "TRUE");
    parent = $(event.target).parent().parent();
    table = parent.parent().parent().attr("class").split(" ")[0]
    values = []
    if ($(parent).children().each((index, element) => {
      if ($(element).attr("class") != "delete") {
        console.log($(element))
        if (getInput($(element).find("input"))) {
          if (foreignKey($(element).find("input")) && primaryKey($(element).find("input"))) {
            try {
              values.push(element.getElementsByTagName("input")[0].value)
            } catch (error) {
              console.log(error)
            }
          } else {
            console.log("foreign key error")
            return false;
          }
        } else {
          console.log("datatype error")
          return false;
        }
      }
    })) {
      console.log(table)
      console.log(values)
      $.ajax({
        async: true,
        type: "POST",
        url: "./insert.php",
        data: {
          "table": table,
          "values": values,
        },
        success: function (data) {
          console.log("success " + data);
          if (data != 1) {
            $("body").append('<div class="alert alert-danger" role="alert">Error : Failed to Insert.</div>')
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
            sessionStorage.setItem("insert", "TRUE");
            location.reload();
          }
        },
        error:
          function (data) {
            console.log('An error occurred.');
            console.log(data);
          }
      })
      console.log("insert sucessful")
      event.stopPropagation();
    }
  })

})