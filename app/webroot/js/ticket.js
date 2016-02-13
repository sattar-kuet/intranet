

$(document).ready(function () {
<<<<<<< HEAD
    
    $("#forward_ticket").click(function(e) {
        $("#forward_dialog").toggle();
=======

    $(".forward_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#forward_dialog" + id;
        $(forwardForm).toggle();
>>>>>>> e629aea4a9f35e0c763a4b6d18988180400f5dd0
        e.preventDefault();
    });

});


