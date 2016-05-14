/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('#shipment_equipment_list').change(function(){
        var selected_equipment = $(this).val();
       if(selected_equipment=='OTHER'){
           $('#other_shipment_equipment').show();
       }
       else{
            $('#other_shipment_equipment').hide();
       }
    });
});