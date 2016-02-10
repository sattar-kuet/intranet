<?php
/**
* 
*/
class Solution extends AppModel
{
    var $name = "solution";
    var $belongsTo = array('Level','Subject','Chapter');
  
public $validate = array(
        'question' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Question already exist'
        )
    );
    
}

?>