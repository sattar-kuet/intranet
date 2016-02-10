<?php

class Department extends AppModel {

    var $name = "department";
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This department already exists'
        )
    );

}

?>
