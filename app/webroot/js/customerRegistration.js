/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function initialization() {
    if ($('#shipment').is(":checked")) {
        $('#shipmentshow_hide').show();
    }
    else {
        $('#shipmentshow_hide').hide();
    }

    if ($('#additioninfo').is(":checked")) {
        $('#Additional_info').show();
    }
    else {
        $('#Additional_info').hide();
    }
    if ($('#dealer').is(":checked")) {
        $('#dshow').show();
    }
    else {
        $('#dshow').hide();
    }
}

$(document).ready(function () {
    $('#shipment_equipment_list').change(function () {
        var selected_equipment = $(this).val();
        if (selected_equipment == 'OTHER') {
            $('#other_shipment_equipment').show();
        }
        else {
            $('#other_shipment_equipment').hide();
        }
    });
    
    initialization();
});