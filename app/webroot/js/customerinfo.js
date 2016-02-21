$(document).ready(function () {
    $('.toggle').click(function(){
       var toggleElementID =  $(this).data('id');
       $('#'+toggleElementID).toggle();
    });
    
    
    $("#autofillAddrCheck").change(function () {

        if (this.checked) {
            //get the values of the filled fields
            var name = $("#first").val();

            var last = $("#last").val();
            var zipcode = $("#zip").val();
            var addressdetails = $("#address").val();
            addressdetails += ' ' + $("#street").val();
            addressdetails += ' ' + $("#apartment").val();
            addressdetails += ' ' + $("#city").val();
            addressdetails += ' ' + $("#state").val();
            //console.log("name");
            // then add those values to your billing infor window feilds 

            $("#firstname").val(name);
            $("#lastname").val(last);
            $("#zip_code").val(zipcode);
            $("#addressdetail").val(addressdetails);

            // then form will be automatically filled .. 

        }
        else {
            $('#firstname').val('');
            $("#lastname").val('');
            $("#zip_code").val('');
            $("#addressdetail").val('');
        }
    });

    $('.pmode').change(function () {
        var pmode = $(this).filter(':checked').val();
        if (pmode == 'card') {
            $("#option_card").show();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").hide();
            $("#option_onlinebill").hide();

        }
        if (pmode =='cash') {
            $("#option_card").hide();
            $("#option_cash").show();
            $("#option_check").hide();
            $("#option_onlinebill").hide();
            $("#option_moneyorder").hide();
        }
        if (pmode == 'check') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").show();
            $("#option_onlinebill").hide();
            $("#option_moneyorder").hide();
        }

        if (pmode == 'money order') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").show();
            $("#option_onlinebill").hide();

        }
        if (pmode == 'online bill') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").hide();
            $("#option_onlinebill").show();

        }

        console.log(pmode);
    });
});