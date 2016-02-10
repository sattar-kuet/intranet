<?php
class Subject extends AppModel
{
	var $name = "subject";
	public $validate = array(
    'name' => array(
        'unique' => array(
            'rule' => array('checkUnique', array('name', 'level_id'), false), 
            'message' => 'This subject already exist'
        )
    )
);
	
}

?>