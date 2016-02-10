<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class AdminsController extends AppController {

    var $layout = 'admin';
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Admin',
                )
            ),
            'loginAction' => array(
                'controller' => 'admins',
                'action' => 'login'
            ),
            'loginRedirect' => array('controller' => 'admins', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => 'admins', 'action' => 'login'),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('create');
        $this->Auth->userScope = array('Admin.status' => 'active');
        $admin = $this->Auth->user();

        if (isset($admin['Role']['name'])) {
            $sidebar = $admin['Role']['name'];
            $this->set(compact('sidebar'));
        }
    }

    public function isAuthorized($user = null) {
        if ($user['Role']['name'] == 'admin') {
            $this->Auth->loginRedirect = array('controller' => 'orders', 'action' => 'nocontact');
            $this->Auth->deny('dashboard');
        }
        return true;
    }

    function login() {
        $this->loadModel('Admin');
        $this->layout = "admin-login";
        // if already logged in check this step
        if ($this->Auth->loggedIn()) {
            return $this->redirect('dashboard'); //(array('action' => 'deshboard'));
        }
        // after submit login form check this step
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('status') == 'active') {
                    // user is activated
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    // user is not activated
                    // log the user out
                    $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>You are blocked, Contact with Adminstrator</strong>
                        </div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->Auth->logout());
                }
            } else {
                $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>Incorrect email/password combination. Try Again</strong>
                        </div>';
                $this->Session->setFlash($msg);
            }
        }
    }
    
    
    
    

    public function logout() {
        $msg = ' <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>You have successfully logged out</strong> 
                            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->Auth->logout());
    }

    function dashboard() {
        
    }

    function addrole() {
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
                return $this->redirect($this->referer());
            } else {

                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function create() {
        $this->loadModel('Admin');
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Admin->set($this->request->data);


            if ($this->Admin->validates()) {
                if (!$this->dataExist) {
                    $this->Admin->email = $result['email'];

                    foreach ($this->request->data['Admin'] as $k => $v) {
                        if (!empty($v)) {
                            $this->Admin->saveField($k, $v);
                        }
                    }
                } else {

                    $this->Admin->save($this->request->data['Admin']);
                }


                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Admin Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('create');
            } else {
                $errors = $this->generateError($this->Admin->validationErrors);
                $this->set(compact('errors'));
            }
        }
        $this->set('roles', $this->Role->find("list"));
    }

    function manage() {
        $this->loadModel('Admin');
        $agents = $this->Admin->find('all');
        $this->set(compact('agents'));
    }

    function edit($id = null) {
        $this->loadModel('Admin');
        $this->loadModel('Role');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Admin->id = $this->request->data['Admin']['id'];
            $this->Admin->save($this->request->data['Admin']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Admin updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('edit');
        }
        if (!$this->request->data) {
            $data = $this->Admin->findById($id);
            $this->request->data = $data;
            $this->set('roles', $this->Role->find("list"));
        }
    }

    function delete($id = null) {
        $this->loadModel('Admin');
        $this->Admin->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Admin deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function block($id = null) {
        $this->loadModel('Admin');
        $this->Admin->id = $id;
        $this->Admin->saveField("status", "blocked");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Admin blocked succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function active($id = null) {
        $this->loadModel('Admin');
        $this->Admin->id = $id;
        $this->Admin->saveField("status", "active");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Admin activated succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

}

?>