<?php
/**
* 
*/
class City extends AppModel
{
	var $name = "city";
public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This city already exist'
        )
    );
}

?>