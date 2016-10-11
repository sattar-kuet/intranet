<?php

class Transaction extends AppModel {
    public $recursive = 2;
    var $belongsTo = array('PackageCustomer', 'User');
    
    public $validate = array(
        'invoice' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Invoice already exist'
        )
    );

}

?>