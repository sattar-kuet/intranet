<?php

class Message extends AppModel {

    var $belongsTo = array('User');
    public $validate = array(
    'message' => array(
        'rule'    => 'notEmpty',
        'message' => 'Your message field cannot be empty!'
    )
);

}

?>