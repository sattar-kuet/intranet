//$('.partial').each(function () {
//    var totalPoints = 0;
//    $('.partial').bind("change paste keyup", function () {
//        totalPoints += parseInt($(this).val());
//    });
//    alert(totalPoints);
//});

$(document).on("change", ".partial", function() {
    var sum = 0;
    $(".partial").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});

// Signature needed if selected other than Card(debit/credit)
$(document).ready(function() {
    //$("div.sss").hide();
   // $("#cardsig").remove(".required");
    $("input[id*='sig2']").click(function() {        
        $("div.sss").show(200); 
        $("#moneyorder").addClass("required");
    });    
    $("input[id*='sig1']").click(function() {        
        $("div.sss").hide(200);  
        $("#moneyorder").removeClass("required");
    });
});

// mac no is need when box1, box2 or box3 are selected. box1 => 1 input field is show while box2 shows 2 input
$(document).ready(function() {
    //$("div.sss").hide();
   // $("#cardsig").remove(".required");
    $("input[id*='box1']").click(function() {        
        $("div#mac1").show(); 
        $("div#mac2").hide();
        $("div#mac3").hide();
        $("#mac_no_1").addClass("required");
        $("#mac_no_2").removeClass("required");
        $("#mac_no_3").removeClass("required");
    }); 
    $("input[id*='box2']").click(function() {        
        $("div#mac1").show();
        $("div#mac2").show(); 
        $("div#mac3").hide();
        $("#mac_no_1").addClass("required");
        $("#mac_no_2").addClass("required");
        $("#mac_no_3").removeClass("required");
    });
    $("input[id*='box3']").click(function() {        
        $("div#mac1").show();
        $("div#mac2").show();
        $("div#mac3").show(); 
        $("#mac_no_1").addClass("required");
        $("#mac_no_2").addClass("required");
        $("#mac_no_3").addClass("required");
    });
    
});



$(document).ready(function(){
    $('.hover-effect').click(function() {
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
    
