<?php
/**
* 
*/
class Question extends AppModel
{
    var $name = "question";
    var $belongsTo = array('Level','Subject','Chapter','University','Year');
  
public $validate = array(
        'question' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Question already exist'
        )
    );
    
  function beforeSave($options = array()) {
           if(!empty($this->data[$this->alias]['options']) && !empty($this->data[$this->alias]['ans'])){
                $this->data[$this->alias]['options'] = json_encode($this->data[$this->alias]['options']);
                $this->data[$this->alias]['ans'] = json_encode($this->data[$this->alias]['ans']);
           }
          
         return true;
    }
}

?>