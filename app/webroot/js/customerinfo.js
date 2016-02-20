$(document).ready(function () {
    $("#autofillAddrCheck").change(function () {

        if (this.checked) {
            //get the values of the filled fields
            var name = $("#first").val();
            alert(name);
            var last  = $("#last").val();
            var zipcode=$("#zip").val();
            var addressdetails=$("#address").val();
            addressdetails+=' '+$("#street").val();
            addressdetails+=' '+$("#apartment").val();
            addressdetails+=' '+$("#city").val();
            addressdetails+=' '+$("#state").val();
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
   
    $('.pmode').change(function() {
  var pmode = $(this).filter(':checked').val();
  if(pmode=='card'){
      $("#option_card").show();
      $("#option_cash").hide();
      $("#option_check").hide();
  }
  if(pmode=='cash'){
      $("#option_card").hide();
      $("#option_cash").show();
      $("#option_check").hide();
  }
  if(pmode=='check'){
      $("#option_card").hide();
      $("#option_cash").hide();
      $("#option_check").show();
  }
  
   console.log(pmode);
});
});