<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Controller', 'Transactions'); // mention at top

class AdminsController extends AppController {

    var $layout = 'admin';
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
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
        $this->Auth->userScope = array('Admin.status' => 'active');
        $this->Auth->allow('create', 'getIsChatAgent');
    }

    public function isAuthorized($user = null) {
        if ($user['Role']['name'] == 'admin') {
            $this->Auth->loginRedirect = array('controller' => 'orders', 'action' => 'nocontact');
            $this->Auth->deny('dashboard');
        }
        return true;
    }

    public function getIsChatAgent() {
        $this->layout = 'ajax';
        $this->render('nothing');
        $this->loadModel('Admin');
        $admins = $this->Admin->find('first', array(
            'conditions' => array(
                'Role.name' => 'support'
            )
        ));

        if ($admins['Admin']['loggedIn']) {
            echo 'online,' . $admins['Admin']['name'];
        } else {
            echo 'offline';
        }
    }

    function login() {
        $this->loadModel('User');
        $this->layout = "admin-login";
        // if already logged in check this step
        if ($this->Auth->loggedIn()) {
            return $this->redirect('dashboard'); //(array('action' => 'deshboard'));
        }
        // after submit login form check this step
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // pr($this->Auth); exit;
                if ($this->Auth->user('status') == 'active') {
                    // user is activated

                    return $this->redirect('/admins/servicemanage');
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
                return $this->redirect('addrole');
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editrole() {
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

    function create() {
        $this->loadModel('User');
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $this->User->save($this->request->data['User']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> User Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('create');
            } else {
                $msg = $this->generateError($this->User->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $this->set('roles', $this->Role->find("list"));
    }

    function manage() {
        $this->loadModel('User');
        $agents = $this->User->find('all');
        $this->set(compact('agents'));
    }

    function edit_admin($id = null) {
        $this->loadModel('Role');
        $this->loadModel('User');

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->set($this->request->data);

            $this->User->id = $id;
            $this->User->save($this->request->data['User']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Admin updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);


            return $this->redirect($this->referer());
        }
        if (!$this->request->data) {
            $data = $this->User->findById($id);
            $this->request->data = $data;
//           $roles = $this->set('roles', $this->Role->find("list"));
            $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
            $this->set(compact('roles'));
        }
    }

    function delete($id = null) {
        $this->loadModel('User');
        $this->User->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> User deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function block($id = null) {
        $this->loadModel('User');
        $this->User->id = $id;
        $this->User->saveField("status", "blocked");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> User blocked succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function active($id = null) {
        $this->loadModel('User');
        $this->User->id = $id;
        $this->User->saveField("status", "active");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> User activated succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function servicemanage($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Track');
        $this->loadModel('Message');
        $this->loadModel('CustomPackage');
        $this->loadModel('Psetting');
        $this->loadModel('Package');
        $clicked = false;
        if ($id) {
            $customer_info = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $id)));
            $clicked = true;
            $this->set(compact('customer_info'));
        }
        if ($this->request->is('post')) {
            $cell = $this->request->data['PackageCustomer']['cell'];
            $clicked = true;
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                        WHERE pc.cell = " . $cell . " ORDER BY tr.created DESC");
            // pr($tickets); exit;
            $filteredTicket = array();
            $data = array();
            $unique = array();
            $index = 0;
            foreach ($tickets as $key => $ticket) {
                $t = $ticket['t']['id'];
                if (isset($unique[$t])) {
                    //  echo 'already exist'.$key.'<br/>';
                    $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                    $filteredTicket[$index]['history'][] = $temp;
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$t] = 'set';
                    $filteredTicket[$index]['ticket'] = $ticket['t'];
                    $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                    $filteredTicket[$index]['history'][] = $temp;
                }
            }
            $data = $filteredTicket;

            //FIND PACKAGE DETAILS

            $sql = "SELECT * FROM package_customers "
                    . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                    . " LEFT JOIN packages ON psettings.package_id = packages.id"
                    . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                    " WHERE package_customers.cell = '" . $cell . "'";

            $temp = $this->PackageCustomer->query($sql);
            $data = array();
            if (array_key_exists(0, $temp))
                $data = $temp[0];
            $customer = $data['package_customers'];
            $package = array();
            if (isset($data['packages']['id'])) {
                $psetting = $data['psettings'];
                $data['packages']['duration'] = $psetting['duration'];
                $data['packages']['charge'] = $psetting['amount'];
                $package = $data['packages'];
            } else {
                $data['custom_packages']['name'] = 'Custom';
                $package = $data['custom_packages'];
            }
            $data = array();
            $data['customer'] = $customer;
            $data['package'] = $package;
            $this->set(compact('data'));
        }
        $admin_messages = $this->Message->find('all', array('order' => array('Message.created' => 'DESC')));
        $cells = $this->PackageCustomer->find('list', array('fields' => array('cell', 'cell')));
        $this->set(compact('cells', 'clicked', 'admin_messages'));
    }

    function changeservice($id = null) {
        $this->loadModel('PackageCustomer');
        // pr($this->request->data); exit;
        if ($this->request->data['PackageCustomer']['status'] == 'ticket') {
            return $this->redirect('/tickets/create/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'payment') {
            //return $this->redirect('/transactions/expire_customer/' . $this->request->data['PaidCustomer']['id']);
            return $this->redirect('/transactions/edit_customer_data/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'history') {
            return $this->redirect('/tickets/customertickethistory/' . $this->request->data['PackageCustomer']['id']);
        }
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
        $this->PackageCustomer->status = $this->request->data['PackageCustomer']['status'];
        $this->PackageCustomer->save($this->request->data['PackageCustomer']);
        return $this->redirect('servicemanage' . DS . $this->request->data['PackageCustomer']['id']);
    }
    
}

?>