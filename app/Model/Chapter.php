<?php
class Chapter extends AppModel
{
	var $name = "chapter";
	public $validate = array(
    'name' => array(
        'unique' => array(
            'rule' => array('checkUnique', array('name', 'subject_id'), false), 
            'message' => 'This Chapter already exist'
        )
    )
);
	
}

?>