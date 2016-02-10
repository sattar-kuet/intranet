<?php

class Slot extends AppModel {

    var $name = "slot";
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Slot already exist'
        )
    );

}
?>

