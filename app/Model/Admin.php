<?php

class Admin extends AppModel {
    var $name = 'admin';
    var $belongsTo = array('Role');
       public $validate = array(
        'email' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Email already exist'
            
        )
    );
    
      function hashPassword() {
     if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
    }

    function beforeSave($options = array()) {
        $this->hashPassword();
        return true;
    }
}

?>

