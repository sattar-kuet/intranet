<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Chunk extends AppModel {

    var $name = "chunk";
    
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This program already exist'
        )
    );

}

?>