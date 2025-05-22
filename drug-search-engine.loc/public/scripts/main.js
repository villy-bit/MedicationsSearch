$(document).ready(function()
{ 
    //получение названия препарата из index.tmpl.php
    $("#searchbtn").on("click", function() {
        var medication = $("#medication").val().trim();
        //const url = "./medication?name=" + encodeURIComponent(medication);

        if(medication == "")
        {
            const newDiv = $("<div/>", {
                class: "error-text",
                text: "Введите название препарата",
                }).appendTo("#error")
            return false;
        }
        $("#error").text("");


        // //отправка данных на show.php
        // $.ajax({
        //     url: './controllers/show.php',
        //     //url: 'medication',
        //     type: 'GET',
        //     data: { 'name' : medication }, //  Передаем объект JavaScript
        //     //dataType: 'html',
        //     //contentType: 'application/x-www-form-urlencoded',
        //     success: function(response) {
        //         console.log(response);
        //         },
        //     error: function(xhr, status, error) {
        //             console.error("Error:", status, error);
        //         }
        // });
    });
});
