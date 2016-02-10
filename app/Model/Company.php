
<?php

/**
 * 
 */
class Company extends AppModel {
    var $name = "company";
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This company already exist'
        )
    );
}

?>