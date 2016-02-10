<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartmentsController
 *
 * @author Developer
 */
class DepartmentsController extends AppController {

    //put your code here
     var $layout = 'admin';   
              
    function add_department() {
        $this->loadModel('Department');
        if ($this->request->is('post')) {

            $this->Department->set($this->request->data);
            if ($this->Department->validates()) {
                $this->Department->save($this->request->data['Department']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Department Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {

                $msg = $this->generateError($this->Department->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }
}
