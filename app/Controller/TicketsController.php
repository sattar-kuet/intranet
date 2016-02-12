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
        $loggedUser = $this->Auth->user();
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->Ticket->set($this->request->data);
            if ($this->Ticket->validates()) {
                $this->request->data['Ticket']['created_by'] = $loggedUser['id'];
                 if(empty($this->request->data['Ticket']['user_id']) && empty($this->request->data['Ticket']['role_id'])){
                      $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this ticket  </strong>
			</div>';
                    $this->Session->setFlash($msg); 
                      return $this->redirect($this->referer());
                 }
                $this->Ticket->save($this->request->data['Ticket']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Ticket Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Ticket->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
<<<<<<< HEAD
=======

>>>>>>> origin/master
        
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
       // pr($users);
      //  pr($roles); exit;
        
        $this->set(compact('users','roles'));
    }
    function close($id = null) {
        $this->loadModel('Ticket');
        $this->Ticket->id = $id;
        $this->Ticket->saveField("status", "closed");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Ticket is closed succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
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
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $tickets = $this->Ticket->find('all');
        $data = array();
        
       foreach($tickets as $index=>$ticket){
           //pr($ticket['Ticket']['created_by']);
           $open_by = $this->User->findById($ticket['Ticket']['created_by']);
           $data[$index]['open_by'] = $open_by;
           $data[$index]['ticket'] = $ticket['Ticket'];
           $data[$index]['assign_to'] = array('dept'=>$ticket['Role'],'admin'=>$ticket['User']); ;
           
          
          
       }
       pr($data);
       exit;
        $this->set(compact('tickets'));
       
      
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
<<<<<<< HEAD
        $this->set(compact('TicketDepartment'));
=======

        $this->set(compact('roles'));

>>>>>>> origin/master
    }

}

?>