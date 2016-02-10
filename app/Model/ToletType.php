<?php
class ToletType extends AppModel
{
	var $name = "toletType";
       public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This type already exist'
        )
    );
    
}

?>