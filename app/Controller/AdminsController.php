<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Controller', 'Transactions'); // mention at top
App::import('Controller', 'Payments');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

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

        // database name must be thum_img,small_img
        $this->img_config = array(
            'picture' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 50,
                'image_y' => 40
            ),
            'parent_dir' => 'pictures',
            'target_path' => array(
                'picture' => WWW_ROOT . 'pictures' . DS
            )
        );


        // create the folder if it does not exist
        if (!is_dir($this->img_config['parent_dir'])) {
            mkdir($this->img_config['parent_dir']);
        }
        foreach ($this->img_config['target_path'] as $img_dir) {
            if (!is_dir($img_dir)) {
                mkdir($img_dir);
            }
        }
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
        $payment = new PaymentsController();
        //  $payment->auto_recurring_invoice();
        // $payment->auto_recurring_payment();
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
                    $pic = $this->Auth->user('picture');

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

    function processImg($img) {
        $upload = new Upload($img['picture']);
        $upload->file_new_name_body = time();
        foreach ($this->img_config['picture'] as $key => $value) {
            $upload->$key = $value;
        }
        $upload->process($this->img_config['target_path']['picture']);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            return $this->redirect('create');
        }
        $return['file_dst_name'] = $upload->file_dst_name;
        return $return;
    }

    function create() {
        $this->loadModel('User');
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $result = array();
                if (!empty($this->request->data['User']['picture']['name'])) {
                    $result = $this->processImg($this->request->data['User']);
                    $this->request->data['User']['picture'] = $result['file_dst_name'];
                } else {
                    $this->request->data['User']['picture'] = '';
                }
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
            $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
            $this->set(compact('roles', 'data'));
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
	<strong> User blocked succeesfully </strong></div>';
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

    function getCustomerByParam($param, $field) {
        $param = trim($param);
        //  echo $field.'<br>';
        $param = str_replace(' ', '', $param);
        if ($field == "cell") {
            $param = str_replace('-', '', $param);
            $param = str_replace('(', '', $param);
            $param = str_replace(')', '', $param);
        }

        $condition = "LOWER(package_customers." . $field . ") LIKE '%" . strtolower($param) . "%'";
        $name = array('first_name', 'last_name', 'middle_name');

        if (in_array($field, $name)) {
            $condition = " LOWER(package_customers.first_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.middle_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.last_name) LIKE '%" . strtolower($param) . "%'";
        }
        if ($field == "fm_name") {
            $partialname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.first_name,package_customers.middle_name)) LIKE '%" . $partialname . "%'";
        }
        if ($field == "ml_name") {
            $partialname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.middle_name,package_customers.last_name)) LIKE '%" . $partialname . "%'";
        }
        if ($field == "full_name") {
            $fullname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.first_name,package_customers.middle_name,package_customers.last_name)) LIKE '%" . $fullname . "%'";
        }
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE " . $condition;


        //  echo $sql.'<br><br><br><br>'; 
        $temp = $this->PackageCustomer->query($sql);
        // pr($temp);
        $data = array();
        $customer = array();
        $package = array();
        foreach ($temp as $t) {
            $customer[] = $t['package_customers'];
            if (isset($data['packages']['id'])) {
                $psetting = $data['psettings'];
                $data['packages']['duration'] = $psetting['duration'];
                $data['packages']['charge'] = $psetting['amount'];
                $package[] = $data['packages'];
            }
        }
        $data = array();
        $data['customer'] = $customer;
        $data['package'] = $package;
        return $data;
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
            $param = $this->request->data['PackageCustomer']['param'];
            $data['customer'] = array();
            $data['package'] = array();
            $data = $this->getCustomerByParam($param, 'cell');
            if (count($data['customer']) == 0) {
                $data = $this->getCustomerByParam($param, 'first_name');
            }
            if (count($data['customer']) == 0) {
                $data = $this->getCustomerByParam($param, 'last_name');
            }
            if (count($data['customer']) == 0) {
                $data = $this->getCustomerByParam($param, 'mac');
            }
            if (count($data['customer']) == 0) {
                $data = $this->getCustomerByParam($param, 'fm_name');
            }
            if (count($data['customer']) == 0) {
                $data = $this->getCustomerByParam($param, 'ml_name');
            }
            if (count($data['customer']) == 0) {
                $data = $this->getCustomerByParam($param, 'full_name');
            }
            $clicked = true;
            //FIND customer DETAILS
            //  exit;
            $this->set(compact('data'));
        }
        $loggedUser = $this->Auth->user();
        $uid = $loggedUser['id'];
        $rid = $loggedUser['Role']['id'];

        $this->loadModel('Role');
        $sql = 'SELECT * FROM roles WHERE LOWER(roles.name)="general"';
        $temp = $this->Role->query($sql);
        $rid2 = $temp[0]['roles']['id'];
        $sql = "SELECT * FROM messages m
        LEFT JOIN users u ON u.id = m.user_id  WHERE (m.assign_id = $uid OR m.role_id = $rid OR m.role_id = $rid2) AND m.status ='open' ORDER BY m.id DESC";
        // echo $sql;
        $admin_messages = $this->Message->query($sql);

        // pr($admin_messages); exit;
        $cells = $this->PackageCustomer->find('list', array('fields' => array('cell', 'cell')));
        $this->set(compact('cells', 'clicked', 'admin_messages'));
    }

    function transactionId($trx_id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post')) {
            $idtrx = $this->request->data['Transaction']['trx_id'];
            $trinfo = $this->Transaction->query("SELECT * FROM `transactions` tr
            left join package_customers  pc on tr.package_customer_id =pc.id 
            where trx_id = $idtrx");
            $clicked = true;
            $this->set(compact('trinfo'));
        }
        $this->set(compact('clicked'));
    }

    function changeservice($id = null) {
        $this->loadModel('PackageCustomer');
        if ($this->request->data['PackageCustomer']['status'] == 'ticket') {
            return $this->redirect('/tickets/create/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'repair') {
            //return $this->redirect('/transactions/expire_customer/' . $this->request->data['PaidCustomer']['id']);
            return $this->redirect('/customers/repair/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'info') {
            //return $this->redirect('/transactions/expire_customer/' . $this->request->data['PaidCustomer']['id']);
            return $this->redirect('/customers/edit/' . $this->request->data['PackageCustomer']['id']);
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
        $this->set(compact('filteredPackage'));
    }

    public function print_queue() {
        $this->loadModel('PackageCustomer');
        $current_date = date('Y-m-d');
        $future_date = date('Y-m-d', strtotime("+25 days"));
        $expire_customer = $this->PackageCustomer->find('all', array('conditions' => array('exp_date >' => $future_date)));
        $this->set(compact('expire_customer'));
        //pr($expire_customer);exit;
    }

    function pdf() {
        $this->layout = 'blank';
    }

    function contact() {
        
    }

    function done($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;

        $contents = $this->request->data['Package_customer']['content'];

        $content = $this->PackageCustomer->saveField("status", "done");
//        pr($content);
//        exit;
//         $comment['Comment']['content'] = $this->request->data['PackageCustomer']['comments'];
//            $this->Comment->save($comment);
//      $comments['Comment']['content'] = $this->request->data['PackageCustomer']['co']
//        $this->Comment->saveField($comments);

        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('opportunity_followup');
    }

    function ready($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $this->PackageCustomer->saveField("status", "ready");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully Ready </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('opportunity_followup');
    }

    function assignedtotech() {

        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'scheduled'  ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;
        //    pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                $temp = array('content' => $data['c'], 'user' => $data['u']);
                $filteredData[$index]['comments'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );
                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                $temp = array('content' => $data['c'], 'user' => $data['u']);
                $filteredData[$index]['comments'][] = $temp;
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));

        // pr($filteredData);
        //  exit;

        $this->set(compact('filteredData', 'technician'));
    }

    function donebytech() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'done' AND approved=0 ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function donebyadmin() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'done' AND approved=1");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function postponebytech() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'post pone' AND approved=0  ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function rescheduledbytech() {

        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'rescheduled' ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;
        // pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function cancelledbytech() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'canceled' AND approved=0 ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function approved($id = null, $tid = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->PackageCustomer->id = $id;
        $loggedUser = $this->Auth->user();
        //  echo $id.'<br>';
        //  echo $tid;
        $this->PackageCustomer->saveField("approved", "1");
        $this->PackageCustomer->saveField("status", "done");
        $this->PackageCustomer->saveField("ins_by", $tid);
        $pc = $this->PackageCustomer->saveField("user_id", $loggedUser['id']);
        $status = 'sales done';
        $data4statusHistory = array();
        $data4statusHistory['StatusHistory'] = array(
            'package_customer_id' => $pc['PackageCustomer']['id'],
            'date' => date('Y-m-d'),
            'status' => $status
        );

        $this->StatusHistory->save($data4statusHistory);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
        $this->Session->setFlash($msg);
        $temp = $this->PackageCustomer->findById($id);
        $payable_amount = $temp['PackageCustomer']['deposit'] + $temp['PackageCustomer']['monthly_bill'] + $temp['PackageCustomer']['others'];
        $data['Transaction'] = array(
            'package_customer_id' => $id,
            'status' => 'open',
            'payable_amount' => $payable_amount
        );

        // $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function shortApprove($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->PackageCustomer->id = $id;
        $pcid = $this->request->data['Comment']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $comments = $this->request->data['Comment']['comments'];
        $data['PackageCustomer'] = array(
            "id" => $pcid,
            "approved" => "1",
            "status" => "done",
            "comments" => $comments,
            "user_id" => $loggedUser['id']);
        $pc = $this->PackageCustomer->save($data);
        $data4statusHistory = array();
        $data4statusHistory['StatusHistory'] = array(
            'package_customer_id' => $pc['PackageCustomer']['id'],
            'date' => date('Y-m-d'),
            'status' => $this->request->data['Comment']['status']
        );
        $this->StatusHistory->save($data4statusHistory);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
        $this->Session->setFlash($msg);
        // $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function pcComment($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $pcid = $this->request->data['Comment']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $comments = $this->request->data['Comment']['comments'];

        $data['PackageCustomer'] = array(
            "id" => $pcid,
            "comments" => $comments,
            "user_id" => $loggedUser['id']);
//    pr($data); exit;
        $this->PackageCustomer->save($data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully Commented </strong></div>';
        $this->Session->setFlash($msg);
        // $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function scheduleDone() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $ds = new DateTime($datrange['start']);
            $timestamp = $ds->getTimestamp(); // Unix timestamp
            $startd = $ds->format('m/y'); // 2003-10-16
            $de = new DateTime($datrange['end']);
            $timestamp = $de->getTimestamp(); // Unix timestamp
            $endd = $de->format('m/y'); // 2003-10-16
            $conditions = "";
            if (count($datrange)) {
                if ($datrange['start'] == $datrange['end']) {

                    $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                    //  convert(varchar(10),pc.schedule_date, 120) = '2014-02-07'
                    //CAST(pc.schedule_date as DATE)
                    $conditions .=" CAST(pc.schedule_date as DATE)  >=' " . $datrange['start'] . "' AND  CAST(pc.schedule_date as DATE) < '" . $nextday . "'";
                } else {

                    $conditions .=" CAST(pc.schedule_date as DATE) >='" . $datrange['start'] . "' AND  CAST(pc.schedule_date as DATE) <='" . $datrange['end'] . "'";
                }
            }
            $sql = "SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'scheduled' $conditions ORDER BY pc.id";

            $allData = $this->PackageCustomer->query($sql);
            //$allData; 
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$pd] = 'set';

                    $filteredData[$index]['customers'] = $data['pc'];
                    $filteredData[$index]['users'] = $data['u'];
                    $filteredData[$index]['tech'] = $data['ut'];

                    $filteredData[$index]['package'] = array(
                        'name' => 'No package dealings',
                        'duration' => 'Not Applicable',
                        'amount' => 'not Applicable'
                    );
                    if (!empty($data['i']['id'])) {
                        $filteredData[$index]['issue'] = $data['i'];
                    }

                    if (!empty($data['ps']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['ps']['name'],
                            'duration' => $data['ps']['duration'],
                            'amount' => $data['ps']['amount']
                        );
                    }
                    if (!empty($data['cp']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['cp']['duration'] . ' months custom package',
                            'duration' => $data['cp']['duration'],
                            'amount' => $data['cp']['charge']
                        );
                    }
                    $filteredData[$index]['comments'] = array();
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
            $clicked = true;
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function changePassword() {
        $this->loadModel('Role');
        $this->loadModel('User');
        if ($this->request->is('post') || $this->request->is('put')) {
            $loggedUser = $this->Auth->user();
            // pr($loggedUser); exit;
            $user = $this->User->findById($loggedUser['id']);
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $givenPass = $passwordHasher->hash(
                    $this->request->data['User']['old_password']
            );
            if ($givenPass == $user['User']['password']) {
                unset($this->User->validate['email']);
                $this->User->id = $loggedUser['id'];
                $this->User->save($this->request->data['User']);
                $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Password updated succeesfully </strong>
	</div>';
            } else {
                $msg = '<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Old password is wrong</strong>
	</div>';
            }
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function adjustmentMemo() {
        $sql = "SELECT * FROM transactions " .
                "LEFT JOIN package_customers ON package_customers.id = transactions.package_customer_id " .
                "WHERE LOWER(transactions.status) IN ('credit','sdadjustment','sdrefund','refferalbonus')";
        $this->loadModel('Transaction');
        $data = $this->Transaction->query($sql);
        $this->set(compact('data'));
        //  pr($data); exit;
    }

    function deleteMemo($id = null) {
        $this->loadModel('Transaction');
        $this->Transaction->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Memo deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('adjustmentMemo');
    }

    function approveMemo($id = null) {
        $this->loadModel('Transaction');
        $this->Transaction->id = $id;
        $loggedUser = $this->Auth->user();

        $this->Transaction->saveField("status", "approved");
        $this->Transaction->saveField("user_id", $loggedUser['id']);

        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }
    
    function runReport(){
        $this->sendReport();
        return $this->redirect('/admins/servicemanage');
    }

}

?>