<?php

require_once APP . 'Vendor' . DS . 'evalMath.class.php';

class ChunksController extends AppController {

    var $layout = 'admin';
    var $endTime;

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

    function create() {
        if ($this->request->is('post')) {
            $this->loadModel('Chunk');
            $this->Chunk->set($this->request->data);
            if ($this->Chunk->validates()) {
                $this->Chunk->save($this->request->data['Chunk']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Chunk Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('create');
            } else {
                $errors = $this->generateError($this->Chunk->validationErrors);
                $this->set(compact('errors'));
            }
        }
    }

    function manage() {
        $this->loadModel('Chunk');
        $chunks = $this->Chunk->find('all');
        $this->endTime = $chunks;
        $this->set(compact('chunks'));
    }

    function edit($id = null) {
        $this->loadModel('Chunk');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Chunk->id = $this->request->data['Chunk']['id'];
            $this->Chunk->save($this->request->data['Chunk']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Program updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('manage');
        }
        if (!$this->request->data) {
            $data = $this->Chunk->findById($id);
            $this->request->data = $data;
        }
    }

    function delete($id = null) {
        $this->loadModel('Chunk');
        $this->Chunk->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Program deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function setduration() {
        $this->loadModel('Chunk');
        $this->set('chunks', $this->Chunk->find("list"));
        if ($this->request->is('post')) {
            $this->Chunk->id = $this->request->data['Chunk']['id'];
            $this->Chunk->saveField("duration", $this->request->data['Chunk']['duration']);
            $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Duration added successfully </strong>
</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('setduration');
        }
    }

    function manageduration() {
        $this->loadModel('Chunk');
        $chunks = $this->Chunk->find('all');
        $this->endTime = $chunks;
        $this->set(compact('chunks'));
    }

    function editduration($id = null) {
        $this->loadModel('Chunk');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Chunk->id = $this->request->data['Chunk']['id'];
            $this->Admin->saveField("duration", $this->request->data['Chunk']['duration']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Duration updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('editduration');
        }
        if (!$this->request->data) {
            $data = $this->Chunk->findById($id);
            $this->request->data = $data;
        }
    }

    function addslot() {
        if ($this->request->is('post')) {
            $this->loadModel('Slot');
            $this->Slot->set($this->request->data);
            if ($this->Slot->validates()) {
                $this->Slot->save($this->request->data['Chunk']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Slot Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addslot');
            } else {
                $errors = $this->generateError($this->Slot->validationErrors);
                $this->set(compact('errors'));
            }
        }
    }

    function editslot($id = null){
        $this->loadModel('Slot');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Slot->id = $this->request->data['Slot']['id'];
            $this->Slot->save($this->request->data['Slot']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Slot updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('editslot');
        }
        if (!$this->request->data) {
            $slots = $this->Slot->find('list');
            $this->set(compact('slots'));
        }
    }

    function addadsduration() {
        $this->loadModel('Chunk');
        $this->loadModel('Company');
        $this->loadModel('Slot');
        $chunks = $this->Chunk->find('list');
        $companies = $this->Company->find('list');
        $slots = $this->Slot->find('list');
        $this->set(compact('chunks','companies','slots'));
    }

}

?>