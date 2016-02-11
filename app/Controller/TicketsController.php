<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketsController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {
        return true;
    }

    function create() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Role->set($this->request->data);
            if ($this->Role->validates()) {
                $this->Role->save($this->request->data['Role']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Role Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addrole');
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function edit() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Role->set($this->request->data);
            if ($this->Role->validates()) {
                $this->Role->id = $this->request->data['Role']['id'];
                $this->Role->save($this->request->data['Role']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
        $this->set(compact('roles'));
    }

    function manage() {
        $this->loadModel('User');
        $agents = $this->User->find('all');
        $this->set(compact('agents'));
    }

    function adddepartment() {
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->TicketDepartment->set($this->request->data);
            if ($this->TicketDepartment->validates()) {
                $this->TicketDepartment->save($this->request->data['TicketDepartment']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Added New Department  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('adddepartment');
            } else {
                $msg = $this->generateError($this->TicketDepartment->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }
    
   function editdepartment() {
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->TicketDepartment->set($this->request->data);
            if ($this->TicketDepartment->validates()) {
                $this->TicketDepartment->id = $this->request->data['TicketDepartment']['id'];
                $this->TicketDepartment->save($this->request->data['TicketDepartment']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->TicketDepartment->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->TicketDepartment->find('list', array('order' => array('TicketDepartment.name' => 'ASC')));
        $this->set(compact('TicketDepartment'));
    } 

}

?>