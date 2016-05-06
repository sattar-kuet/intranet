

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

    //Terms and Conditions 
//    $(function () {
//        $("#signup").click(function (e) {
//            if ($('#agree').prop('checked')) {
//
//            } else {
//                alert("You must agree with our Terms and Conditons");
//                e.preventDefault(); // this will prevent from submitting the form.
//            }
//        });
//    });

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
        }
        else {
            $('.assign_single').hide();
            $('.assign_group').hide();
            $('.priority .priority_input').addClass('required');
            $('.priority').show();
        }
    });


});

//registration form validation
//$(document).ready(function () {
//    
//    $('.submitbtn').click(function (event) {
//        
//        var error = 0;
//        
//        $('#info-container').empty();
//        $('.required').each(function () {
//            
//            if (!$(this).val()) {
//                error++;
//                $(this).css('border-color', 'red');
//            }
//            $(this).bind("change paste keyup", function () {
//               var remainingError=0;
//              if(!$(this).val()){
//                $(this).css('border-color', 'red');  
//             
//              }
//              else{
//                      $(this).css('border-color', 'green'); 
//                  }
//
//                   $('.required').each(function (){
//                     if (!$(this).val()) {
//                        remainingError++;
//                         }
//                   });
//                  
//                    var msg = '<p class ="warning_msg"> You did not fill up ' + remainingError + ' required field(s). Fill up these and try again</p>';
//                    $('#info-container').empty();
//                    if(!remainingError){
//                         msg = '<p class ="success_msg"> You filled up all required field(s).</p>';
//                    }
//                    $('#info-container').append(msg);
//                
//            });
//
//        });
//
//        if (error) {
//            var msg = '<p class ="warning_msg"> You did not fill up ' + error + ' required field(s). Fill up these and try again</p>';
//            $('#info-container').append(msg);
//            event.preventDefault();
//        }
//    });
//
//});

