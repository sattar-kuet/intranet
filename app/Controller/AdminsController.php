<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Controller', 'Transactions'); // mention at top
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
        $param = str_replace(' ', '', $param);
        $condition = "LOWER(package_customers." . $field . ") LIKE '%" . strtolower($param) . "%'";
        $name = array('first_name', 'last_name', 'middle_name');

        if (in_array($field, $name)) {
            $condition = " LOWER(package_customers.first_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.middle_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.last_name) LIKE '%" . strtolower($param) . "%'";
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


        //     echo $sql;
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
//            else {
//                $data['custom_packages']['name'] = 'Custom';
//                $package[] = $data['custom_packages'];
//            }
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
                $data = $this->getCustomerByParam($param, 'full_name');
            }

            $clicked = true;
            //FIND customer DETAILS
            $this->set(compact('data'));
        }
        $loggedUser = $this->Auth->user();
        $uid = $loggedUser['id'];
        $rid = $loggedUser['Role']['id'];
        $admin_messages = $this->Message->query("SELECT * FROM messages m
        LEFT JOIN users u ON u.id = m.user_id  WHERE m.assign_id = $uid OR m.role_id = $rid");
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

    function edit_customer_registration($id = null) {
        $this->loadModel('PackageCustomer');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->PackageCustomer->set($this->request->data);
            $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
            //For Custom Package data insert

            if (!empty($this->request->data['PackageCustomer']['charge'])) {
                $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
                $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];
                $cp = $this->CustomPackage->save($data4CustomPackage);
                unset($cp['CustomPackage']['PackageCustomer']);
                $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
            }

            $this->PackageCustomer->set($this->request->data);
            $this->PackageCustomer->id = $id;
            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);

            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Cutomer Package Information update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $data = $this->PackageCustomer->findById($id);
        $this->request->data = $data;
        //Show Package List 
        //********************************************************************************************************
        $this->loadModel('Package');
        $this->loadModel('Psetting');
        $packages = $this->Package->find('all');
        $packageList = array();
        foreach ($packages as $index => $package) {
            $psettings = $this->Psetting->find('all', array('conditions' => array('package_id' => $package['Package']['id'])));
            $psettingList = array();
            foreach ($psettings as $psetting) {
                $id = $psetting['Psetting']['id'];
                $psettingList[$id] = $psetting['Psetting']['name'];
            }
            $pckagename = $package['Package']['name'];
            $packageList[$pckagename] = $psettingList;
        }
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE package_customers.id = '" . $id . "'";
        $temp = $this->PackageCustomer->query($sql);
        $ym = $this->getYm();
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge'));
        //*************** End Package List ****************************************************************************************
        $ym = $this->getYm();
         $this->loadModel('comment');
         $this->comment->find('first', array('conditions' => array('package_customer_id' => $id), 
                               'order' => array('id' => 'DESC') ));
         
        $this->set(compact('ym'));
    }

    function customer_registration() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('CustomPackage');
        $this->loadModel('PaidCustomer');
        $this->loadModel('Country');
        $this->loadModel('Comment');
        $this->loadModel('User');
        $this->loadModel('Role');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->PackageCustomer->set($this->request->data);
            $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
//            data for comment
            $comment['Comment']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
            $comment['Comment']['content'] = $this->request->data['PackageCustomer']['comment'];
            $this->comment->save($comment);
            
            //For Custom Package data insert//
            if (!empty($this->request->data['PackageCustomer']['charge'])) {
                $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
                $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];
                $cp = $this->CustomPackage->save($data4CustomPackage);
                unset($cp['CustomPackage']['PackageCustomer']);
                $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
            }
            $this->PackageCustomer->set($this->request->data);
            $this->PackageCustomer->id = $id;
            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);

            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Package customer edited succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        //$data = $this->PackageCustomer->findById($id);
        // $this->request->data = $data;
        //Show Package List 
        //******************************
        $this->loadModel('Package');
        $this->loadModel('Psetting');
        $packages = $this->Package->find('all');
        $packageList = array();
        foreach ($packages as $index => $package) {
            $psettings = $this->Psetting->find('all', array('conditions' => array('package_id' => $package['Package']['id'])));
            $psettingList = array();
            foreach ($psettings as $psetting) {
                $id = $psetting['Psetting']['id'];
                $psettingList[$id] = $psetting['Psetting']['name'];
            }
            $pckagename = $package['Package']['name'];
            $packageList[$pckagename] = $psettingList;
        }
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE package_customers.id = '" . $id . "'";
        $temp = $this->PackageCustomer->query($sql);
        $ym = $this->getYm();
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge'));
        //*************** End Package List ******************
        $ym = $this->getYm();
        $this->set(compact('ym'));
        //   $this->loadModel('User');
        //   $this->loadModel('Role');

        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        //  pr($technician); exit;
    }

    public function print_queue() {
        $this->loadModel('PackageCustomer');
        $current_date = date('Y-m-d');
        $future_date = date('Y-m-d', strtotime("+25 days"));
        $expire_customer = $this->PackageCustomer->find('all', array('conditions' => array('package_exp_date >' => $future_date)));
        $this->set(compact('expire_customer'));
        //pr($expire_customer);exit;
    }

    function pdf() {
        $this->layout = 'blank';
    }

    function opportunity_followup() {
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'requested', 'PackageCustomer.follow_up' => 1)));
        $this->set(compact('allData'));
    }

    function ready_installation() {
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'requested', 'PackageCustomer.follow_up' => 1)));
        $this->set(compact('allData'));
    }

    function contact() {
        
    }

    function done($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $this->PackageCustomer->saveField("status", "done");
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

}

?>