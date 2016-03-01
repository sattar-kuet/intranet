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

    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
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
           // $search_input = $this->request->data['PackageCustomer']['cell'];
            //remove parenthesis from string
            //$cell = preg_replace('/\s+/', '', (str_replace(array( '(', ')' ), '', $search_input)));
            $cell = $this->request->data['PackageCustomer']['cell'];
           // pr($cell);exit;
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
//        $homes = $this->PackageCustomer->find('list', array('fields' => array('home', 'home')));
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

    function tariffplan() {
        $this->loadModel('Psetting');
        $this->loadModel('Package');
        $sql = "SELECT *  FROM packages
                LEFT JOIN psettings ON packages.id=psettings.package_id ORDER BY packages.id ASC";
        $info = $this->Package->query($sql);

        $filteredPackage = array();
        $unique = array();
        $index = 0;
        foreach ($info as $key => $menu) {
            //pr($menu); exit;
            $pm = $menu['packages']['name'];

            if (isset($unique[$pm])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($menu['psettings']['duration'])) {
                    $temp = array('id' => $menu['psettings']['id'], 'duration' => $menu['psettings']['duration'], 'amount' => $menu['psettings']['amount'], 'offer' => $menu['psettings']['offer']);
                    //pr($temp); exit;
                    $filteredPackage[$index]['psettings'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pm] = 'set';
                $temp = array('name' => $pm, 'id' => $menu['packages']['id']);
                $filteredPackage[$index]['packages'] = $temp;
                if (!empty($menu['psettings']['duration'])) {
                    $temp = array('id' => $menu['psettings']['id'], 'duration' => $menu['psettings']['duration'], 'amount' => $menu['psettings']['amount'], 'offer' => $menu['psettings']['offer']);
                    $filteredPackage[$index]['psettings'][] = $temp;
                }
            }
        }
        // pr($filteredPackage);exit;
        $this->set(compact('filteredPackage'));
    }

    function customer_registration() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('CustomPackage');
        $this->loadModel('PaidCustomer');
        $this->loadModel('Country');
        //$this->loadModel('Role');
        //  $role = $this->Role->findByName('customer');
        //$this->layout = 'technician';

        $this->tariffplan(); //Call tarrifplan fuction to show packagese

        if ($this->request->is('post')) {
            
            $this->request->data['PackageCustomer']['psetting_id'] = $this->request->data['psetting_id'];
            unset($this->request->data['psetting_id']);
            $this->PackageCustomer->set($this->request->data);
            $this->CustomPackage->set($this->request->data);
            $msg = '';

            if ($this->PackageCustomer->validates()) {

                $result = array();
                if (!empty($this->request->data['PackageCustomer']['ch_signature']['name'])) {
                    $result = $this->processImg($this->request->data['PackageCustomer'], 'ch_signature');
                    $this->request->data['PackageCustomer']['ch_signature'] = (string) $result['file_dst_name'];
                } else {
                    $this->request->data['PackageCustomer']['ch_signature'] = '';
                }

                //ID Card Upload
                if (!empty($this->request->data['PackageCustomer']['id_card']['name'])) {
                    $result = $this->processImg($this->request->data['PackageCustomer'], 'id_card');
                    $this->request->data['PackageCustomer']['id_card'] = (string) $result['file_dst_name'];
                } else {
                    $this->request->data['PackageCustomer']['id_card'] = '';
                }

                //Money order Upload
                if (!empty($this->request->data['PackageCustomer']['money_order']['name'])) {
                    $result = $this->processImg($this->request->data['PackageCustomer'], 'money_order');
                    $this->request->data['PackageCustomer']['money_order'] = (string) $result['file_dst_name'];
                } else {
                    $this->request->data['PackageCustomer']['money_order'] = '';
                }

                if ($this->Auth->loggedIn()) {
                    //$this->request->data['User']['psetting_id']='';
                    $admin = $this->Auth->user();

                    // todo count();
                    $this->request->data['PackageCustomer']['user_id'] = $admin['id'];
                } else {
                    // $value = $this->request->params['pass'][0];
                    // $this->request->data['PackageCustomer']['psetting_id'] = $value;
                    $this->request->data['PackageCustomer']['filled-by'] = '0';
                }
                
                //remove parenthesis from cell number
                $cell_input = $this->request->data['PackageCustomer']['cell'];                
                $cell = preg_replace('/\s+/', '', (str_replace(array( '(', ')' ), '', $cell_input)));
                $this->request->data['PackageCustomer']['cell'] = $cell;
                
                $home_input = $this->request->data['PackageCustomer']['home'];                
                $home = preg_replace('/\s+/', '', (str_replace(array( '(', ')' ), '', $home_input)));
                $this->request->data['PackageCustomer']['home'] = $home;
                //pr($this->request->data['PackageCustomer']['cell']);exit;

                //$dateObj = $this->request->data['PackageCustomer']['exp_date'];
                //$this->request->data['PackageCustomer']['exp_date'] = $dateObj['year'] . '-' . $dateObj['month'] . '-' . $dateObj['day'];
                //$this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
                //Input mac address...
                //$mac1 = $this->request->data['PackageCustomer']['mac_1'];
                //$mac2 = $this->request->data['PackageCustomer']['mac_2'];
                //$mac3 = $this->request->data['PackageCustomer']['mac_3'];
                //$this->request->data['PackageCustomer']['mac'] = $mac1. ', ' . $mac2 . ', ' . $mac3;
                //For Custom Package data insert
                $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
                $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];

                if (!empty($this->request->data['PackageCustomer']['charge'])) {
                    $cp = $this->CustomPackage->save($data4CustomPackage);

                    unset($cp['CustomPackage']['PackageCustomer']);
                    $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
                }
                //For Paid Customer data insert 
                //$data4PaidCustomers['PaidCustomer']['fname'] = $this->request->data['PackageCustomer']['first_name'];
                //$data4PaidCustomers['PaidCustomer']['lname'] = $this->request->data['PackageCustomer']['last_name'];
                //$data4PaidCustomers['PaidCustomer']['card_no'] = $this->request->data['PackageCustomer']['card_check_no'];
                //$data4PaidCustomers['PaidCustomer']['zip_code'] = $this->request->data['PackageCustomer']['zip'];
                //$data4PaidCustomers['PaidCustomer']['amount'] = $this->request->data['PackageCustomer']['charge_amount'];
                //$data4PaidCustomers['PaidCustomer']['exp_date'] = $this->request->data['PackageCustomer']['exp_date'];
                //$data4PaidCustomers['PaidCustomer']['psetting_id'] = $this->request->data['PackageCustomer']['psetting_id'];
                //$this->PaidCustomer->save($data4PaidCustomers);
//                $this->Model->find('all', array('fields' => 'MAX(PackageCustomer.c_acc_no)));
//                $customer_account = $this->PackageCustomer->query("SELECT MAX(`c_acc_no`) FROM package_customers");
                
                $customer_account = $this->PackageCustomer->query("SELECT MAX(c_acc_no) FROM package_customers");                
               $this->request->data['PackageCustomer']['c_acc_no'] = $customer_account['0']['0']['MAX(c_acc_no)']+1;
               
               
//                pr($this->request->data['c_acc_no']);
//                exit;
                $duration = $this->PackageCustomer->save($this->request->data['PackageCustomer']);
                $duration1 = $duration['PackageCustomer']['psetting_id'];

                $duration_time = $this->PackageCustomer->query("SELECT psetting_id,duration FROM package_customers inner 
                        join psettings on package_customers.psetting_id = psettings.id WHERE psetting_id = $duration1 limit 0,1");
                $additionalTime = "+" . $duration_time[0]['psettings']['duration'] . "months";

                //$dataPackageDate['PaidCustomer']['package_exp_date'] = date("Y-m-d", strtotime($additionalTime));
                //$this->PaidCustomer->save($dataPackageDate);

                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Your sign up process completed succeesfully </strong>
            </div>';
            } else {
                $msg = $this->generateError($this->PackageCustomer->validationErrors);
            }
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        
          $ym = $this->getYm();
        $this->set(compact('ym'));
    }

}

?>