<?php
/**
* 
*/
class Study extends AppModel
{
  var $name = "study";
   var $belongsTo = array('Level','Subject','Chapter');
public $validate = array(
        'topics' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Topic already exist'
        )
    );
}

?>