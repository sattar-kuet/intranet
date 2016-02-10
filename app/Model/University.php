<?php
/**
* 
*/
class University extends AppModel
{
	var $name = "university";
	var $belongsTo = array('Option');
public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This University already exist'
        )
    );
}

?>