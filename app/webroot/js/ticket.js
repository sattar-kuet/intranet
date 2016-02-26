

$(document).ready(function () {
    $(".forward_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#forward_dialog" + id;
        $('#solve_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".solve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#solve_dialog" + id;
        $('#forward_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".unsolve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#unsolve_dialog" + id;
        $('#forward_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    //Terms and Conditions 
    $(function () {
        $("#signup").click(function (e) {
            if ($('#agree').prop('checked')) {

            } else {
                alert("You must agree with our Terms and Conditons");
                e.preventDefault(); // this will prevent from submitting the form.
            }
        });
    });

    //partial payment
    $(document).on("change", ".partial", function () {
        var sum = 0;
        $(".partial").each(function () {
            sum += +$(this).val();
        });
        $(".total").val(sum);
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




