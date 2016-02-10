<?php

/**
 * 
 */
class CompaniesController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('*');
        $this->Auth->userScope = array('Admin.status' => 'active');
        $admin = $this->Auth->user();
        $sidebar = $admin['Role']['name'];
        $this->set(compact('sidebar'));
    }

    public function isAuthorized($user = null) {
        if ($user['Role']['name'] == 'phead') {
            $this->Auth->loginRedirect = array('controller' => 'chunks', 'action' => 'create');
            $this->Auth->deny('dashboard');
        }
        return true;
    }

    function add() {
        $this->loadModel('Company');
        if ($this->request->is('post')) {
            $this->Company->set($this->request->data);
            if ($this->Company->validates()) {
                $this->Company->save($this->request->data['Company']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>New Ad company info added succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('add');
            } else {
                $errors = $this->generateError($this->Company->validationErrors);
                $this->set(compact('errors'));
            }
        }
    }
    
       function manage() {
        $this->loadModel('Company');
        $companies = $this->Company->find('all');
        $this->set(compact('companies'));
    }
    
     function edit($id = null) {
        $this->loadModel('Company');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Company->id = $this->request->data['Company']['id'];
            $this->Company->save($this->request->data['Company']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Company updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('edit');
        }
        if (!$this->request->data) {
            $data = $this->Company->findById($id);
            $this->request->data = $data;
        }
    }

    function delete($id = null) {
        $this->loadModel('Company');
        $this->Company->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Company deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

}

?>