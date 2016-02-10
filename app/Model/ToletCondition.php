<?php
class ToletCondition extends AppModel
{
	var $name = "toletCondition";
       public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This condition already exist'
        )
    );
    
}

?>