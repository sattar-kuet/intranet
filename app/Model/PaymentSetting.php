<?php

class PaymentSetting extends AppModel {

    var $name = 'payment_settings';
    public $validate = array(
        'action' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'action already exist'
        )
    );

}

?>