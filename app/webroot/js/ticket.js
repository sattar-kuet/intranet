$(document).ready(function () {
    $(".comment_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#comment_dialog" + id;
        $('#forward_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });
    $(".forward_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#forward_dialog" + id;
        $('#comment_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".solve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#solve_dialog" + id;
        $('#comment_dialog' + id).hide();
        $('#forward_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".unsolve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#unsolve_dialog" + id;
        $('#comment_dialog' + id).hide();
        $('#forward_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });



//end tracks dialog box design

    $(".done").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#done_dialog" + id;
        $('#ready_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".ready").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#ready_dialog" + id;
        $('#done_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".shedule").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#shedule_dialog" + id;
        $(forwardForm).toggle();
        e.preventDefault();
    });


    //partial payment
    $(document).on("change", ".partial", function () {
        var sum = 0;
        $(".partial").each(function () {
            sum += +$(this).val();
        });
        $(".total").val(sum);
    });

    $("#action_type").change(function () {
        var selected = $(this).val().trim();
        if (selected == '') {
            $('.assign_single').show();
            $('.assign_group').show();
            $('.priority .priority_input').addClass('required');
            $('.priority').show();
        }
        if (selected == 'solved') {
            $('.assign_single').hide();
            $('.assign_group').hide();
            $('.priority .priority_input').removeClass('required');
            $('.priority').hide();
            $('#shipmentshow_hide').hide();
        }
        else {
            $('.assign_single').hide();
            $('.assign_group').hide();
            $('.priority .priority_input').addClass('required');
            $('.priority').show();
            $('#shipmentshow_hide').show();
        }
    });


    $('.issueChange').change(function () {
        var selected = $('.issueChange option:selected').text().toLowerCase();
        //alert(selected);
        if (selected.trim() == "moving") {
            $('#action').hide();
            $('#new_addr').show();
        }
        else if (selected.trim() == "wiring problem") {
            $('#action').hide();
            $('#new_addr').hide();
        }
        else if (selected.trim() == "remote problem") {
            $('#action').hide();
            $('#new_addr').hide();
        }
        else {
            $('#action').show();
            $('#new_addr').hide();
        }


    });

    $('.issueChange').change(function () {
        var selected = $('.issueChange option:selected').text().toLowerCase();
        var canceled = "cancel";
        var holded = "hold";
        var unholded = "unhold";
        var recono = "reconnect";

        if (selected.indexOf(canceled) != -1) {
            $('#check_mac').show();
            $('#canceldate').show();
            $('#pickup_date').show();
            $('#hold').hide();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#action').hide();
        }
        else if (selected.indexOf(holded) != -1 && selected.indexOf(unholded) == -1) {
            $('#check_mac').show();
            $('#hold').show();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
        }
        else if (selected.indexOf(unholded) != -1) {
            $('#check_mac').show();
            $('#unhold').show();
            $('#hold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
        }
        else if (selected.indexOf(recono) != -1) {
            $('#check_mac').show();
            $('#reconnect').show();
            $('#hold').hide();
            $('#unhold').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
        }
        else {
            $('#check_mac').hide();
            $('#hold').hide();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').show();
        }
    });

});
