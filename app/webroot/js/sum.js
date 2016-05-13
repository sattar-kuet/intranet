//$('.partial').each(function () {
//    var totalPoints = 0;
//    $('.partial').bind("change paste keyup", function () {
//        totalPoints += parseInt($(this).val());
//    });
//    alert(totalPoints);
//});

$(document).on("change", ".partial", function () {
    var sum = 0;
    $(".partial").each(function () {
        sum += +$(this).val();
    });
    $(".total").val(sum);
});

// Signature needed if selected other than Card(debit/credit)
$(document).ready(function () {
    //$("div.sss").hide();
    // $("#cardsig").remove(".required");
    $("input[id*='sig2']").click(function () {
        $("div.sss").show(200);
        $("#moneyorder").addClass("required");
    });
    $("input[id*='sig1']").click(function () {
        $("div.sss").hide(200);
        $("#moneyorder").removeClass("required");
    });
});

// mac no is need when box1, box2 or box3 are selected. box1 => 1 input field is show while box2 shows 2 input
$(document).ready(function () {
    //$("div.sss").hide();
    // $("#cardsig").remove(".required");
    $("input[id*='box1']").click(function () {
        $("div#mac1").show();
        $("div#mac2").hide();
        $("div#mac3").hide();
        $("#mac_no_1").addClass("required");
        $("#mac_no_2").removeClass("required");
        $("#mac_no_3").removeClass("required");
    });
    $("input[id*='box2']").click(function () {
        $("div#mac1").show();
        $("div#mac2").show();
        $("div#mac3").hide();
        $("#mac_no_1").addClass("required");
        $("#mac_no_2").addClass("required");
        $("#mac_no_3").removeClass("required");
    });
    $("input[id*='box3']").click(function () {
        $("div#mac1").show();
        $("div#mac2").show();
        $("div#mac3").show();
        $("#mac_no_1").addClass("required");
        $("#mac_no_2").addClass("required");
        $("#mac_no_3").addClass("required");
    });

});



$(document).ready(function () {
    $('.hover-effect').click(function () {
        $('.hover-effect').css({"border": "3px solid #eee", "font-size": "100%"});
        $(this).css({"border": "3px solid gray", "font-size": "100%"});

        //var pkid = jQuery(this).find('#psetid').val();


        // $("#packageid").val(pkid);

        //alert($(this).attr('id'));
        var ps_id = $(this).data('id');
        //alert(ps_id);
        $("#packageid").val(ps_id);

    });
});

//in edit coustomer info page, showing custom package option 
$(document).ready(function () {

    $('#customcheckbox').click(function () {
        if ($(this).is(":checked")) {
            $("div#custompackage").show();
            $("div#regularpackage").hide();
            $("#selctMonth").addClass("required");
            $("#inputAmount").addClass("required");
            $("#psettingId").removeClass("required");
            $('#psettingId').val('');
        }
        else {
            $("div#custompackage").hide();
            $("div#regularpackage").show();
            $("#selctMonth").removeClass("required");
            $("#inputAmount").removeClass("required");
            $('#inputAmount').val('');
        }
    });

});


//Remove all links if print button is clicked.....
$(document).ready(function () {

    $('#btnclick').click(function () {
        jQuery("#printableArea a").click(function () {
            return false;
        })
    });

});


//Show techician select box if 'by Technician' is selected.....
$(document).ready(function () {
    $("input[id*='tech']").click(function () {
        $("div#technician").show();
        $("#technician_id").addClass("required");
    });
    $("input[id*='email']").click(function () {
        $("div#technician").hide();
        $("#technician_id").removeClass("required");
        $('#technician_id').val('');
    });
});



//Print section
function printDiv(printableArea) {
    var printContents = document.getElementById(printableArea).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

//  start show & hide shipment in customer rezistration 
$(document).ready(function (){
   $('#shipment').click(function (){
       if($(this).is(":checked")){
           $('#shipmentshow_hide').show();
       }
        else{
           $('#shipmentshow_hide').hide();  
        }
   });
});
//  end show & hide shipment in customer rezistration

// start Additional info 
$(document).ready(function (){
    $('#additioninfo').click(function (){
       if($(this).is(":checked")){
           $('#Additional_info').show();
       }
        else{
           $('#Additional_info').hide();  
        } 
    });
    
});

// end Additional info 

// start Additional info 
$(document).ready(function (){
    $('#dealer').click(function (){
       if($(this).is(":checked")){
           $('#dshow').show();
       }
        else{
           $('#dshow').hide();  
        } 
    });
    
});

// end Additional info 

//blink strat shipment
function blinker() {
    $('.blink_me').fadeOut(500);
    $('.blink_me').fadeIn(500);
}



setInterval(blinker, 1000);

