<?php

class Transaction extends AppModel {
    public $recursive = 2;
    var $belongsTo = array('PackageCustomer', 'User');
}

?>