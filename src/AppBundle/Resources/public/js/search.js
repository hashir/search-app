
$(document).ready(function(){
    $("#search-box").keyup(function(){
        $.ajax({
            type: "POST",
            url: "/get-ajax-data",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search-box").css("background","#FFF url(/loader_icon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background","#FFF");
            },
            error: function(){
                $("#suggesstion-box").hide();
                $("#search-box").css("background","#FFF");
            }
        });
    });
});

function selectCountry(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
}