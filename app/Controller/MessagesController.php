<?php

/**
 * 
 */
class MessagesController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {
        return true;
    }

    function add() {
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Message');
        if ($this->request->is('post')) {
            $this->Message->set($this->request->data);
            if ($this->Message->validates()) {
                $loggedUser = $this->Auth->user();
                $this->request->data['Message']['user_id'] = $loggedUser['id'];
                $this->Message->save($this->request->data['Message']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>  New Message added </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Message->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('users', 'roles'));
    }

    function manage() {
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Message');
        $data = $this->Message->query('SELECT m.id, message,u.name as individual, r.name as department, m.status, m.created FROM messages m 
            left join users u on u.id = m.assign_id
            left join roles r on r.id = m.role_id');
        $this->set(compact('data'));
    }

    function close($id = null) {
        $this->loadModel('Message');
        $this->Message->id = $id;
        $this->Message->saveField("status", "close");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Message close succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function open($id = null) {
        $this->loadModel('Message');
        $this->Message->id = $id;
        $this->Message->saveField("status", "open");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Message open succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function edit($id = null) {
        $this->loadModel('Role');
        $this->loadModel('User');
        $this->loadModel('Message');

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Message->set($this->request->data);

            $this->Message->id = $id;
//            pr($this->request->data);
//            exit;
            $this->Message->save($this->request->data['Message']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Message updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        if (!$this->request->data) {
            $data = $this->Message->findById($id);
            $this->request->data = $data;
            $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
            $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
            $this->set(compact('users', 'roles', 'data'));
        }
    }

    function active() {
        $this->loadModel('PackageCustomer');
        $active_customers = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'active')));
        $this->set(compact('active_customers'));
    }

    function block() {
        $this->loadModel('PackageCustomer');
        $block_customers = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'blocked')));
        $this->set(compact('block_customers'));
    }

    function payment_history() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
            $conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
            $transactions = $this->Transaction->find('all', array('conditions' => $conditions));
//            pr($transactions);
//            exit;
            $clicked = true;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

}

?>