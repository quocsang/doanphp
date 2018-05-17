
$(document).ready(function(){

    $(".clickme").click(function(){

        $.post("/ajax-test.html", {para1:"val1", param2:"val2"}, function (data) {
            console.log(data);
        });

    });

});