

$(document).ready(function () {


    $(".forward_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#forward_dialog" + id;
        $(forwardForm).toggle();

        e.preventDefault();
    });

});


