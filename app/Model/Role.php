<?php
class Role extends AppModel
{
	var $name = "role";
	  public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Role already exist'
        ),
              'name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'This field cannot be empty'
        )
    );
	
}

?>