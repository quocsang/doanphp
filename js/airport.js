
$(document).ready(function(){

    $(".del").click(function(e){

        e.preventDefault();
        var url = $(this).data("url");
        console.log(url);
        var airportname = $(this).data("airportname");

        $("#msg").html("Có chắc bạn muốn xóa sân bay <b>" + airportname + "</b>?");
        $("#dialog").modal("show");
    });

});