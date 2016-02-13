

$(document).ready(function () {


    $(".forward_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#forward_dialog" + id;
        $(forwardForm).toggle();
        e.preventDefault();
    });
    
    $(".solve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#solve_dialog" + id;
        $(forwardForm).toggle();
        e.preventDefault();
    });
    
    $(".unsolve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#unsolve_dialog" + id;
        $(forwardForm).toggle();
        e.preventDefault();
    });

});


