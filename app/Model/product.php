<?php

class Product extends AppModel {

    var $name = "product";
    //public $belongsTo = array('Psetting');
    public $validate = array(
        'name' => array(
            'unique' => array(
                'rule' => array('checkUnique', array('name', 'category_id','writer'), false),
                'message' => 'This Product already exist'
            )
        )
    );
}

?>