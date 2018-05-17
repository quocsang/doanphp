

$(document).ready(function(){

    $("#btn1").click(function(){
       /* $("#list li").append(function(i, c){
            $(this).text(" " + (i +1) + "-->").append(c);
        });*/

        $("#list li").each(function(i, e){
            $(e).html("Phần tử thứ <b>" + i + "</b>");
        })

    });

    $(document).on("click", ".clickme", function(){

        var url = "/home/ajax-test.html";

        var params = {username: "admin", password: "12345"};
        $.ajax({
            url: url,
            data: params,
            type: "post",
            dataType: "json",
            error: function(){
                alert("Lỗi!");
            },
            beforeSend: function(){
                $("#loadingMsg").text("Đang nhận thời gian từ server....");
                $("#loading").show();

            },
            complete: function(){
                $("#loading").hide();
            },
            success: function(data){
                console.log("Đã nhận được dữ liệu");
                $("#result").text(data.message);
            }
        });


    });


    /*$(".clickme").click(function(){

        var newBtn = $(this).clone();

        $(this).after(newBtn);

    });*/
});