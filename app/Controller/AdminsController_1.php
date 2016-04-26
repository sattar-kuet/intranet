<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class CustomersController extends AppController {

    var $layout = 'admin';
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Customer',
                )
            ),
            'loginAction' => array(
                'controller' => 'customers',
                'action' => 'login'
            ),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('registration', 'passwordRecoveryRequest', 'resetpw', 'search');
    }

    public function isAuthorized($user = null) {
        return true;
    }

    public function logout() {
        $msg = ' <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>You have successfully logged out</strong> 
                            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->Auth->logout());
    }

    function registration($data = array()) {
        $this->loadModel('Customer');
        if ($this->request->is('post')) {
            if ($this->request->data['Customer']['password'] != $this->request->data['Customer']['rpassword']) {
                $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Retype Password does not match</strong>  </p>
       </div>';
                $this->Session->setFlash($msg);
                return true;
            }
            $this->Customer->set($data);
            if ($this->Customer->validates()) {
                $this->Customer->save($data);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Registration succeesfull! </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Customer->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function search($username = null) {

        $this->loadModel('Customer');
        $company = $this->Customer->findByUsername($username);
        return $company;
    }

    function login() {
        $this->layout = "public-login";
        $this->loadModel('Customer');
        // after submit set flag value to check in view
        $searched = false;
        $company = array();
        if ($this->request->is('post')) {
            if ($this->request->data['Customer']['action'] == 'search') {
                $searched = true;
                $newUser = $this->request->data['Customer']['username'];
                $company = $this->search($this->request->data['Customer']['username']);
            }
            if ($this->request->data['Customer']['action'] == 'login') {
                if ($this->Auth->login()) {
                    // pr($this->Auth); exit;
                    return $this->redirect('dashboard');
                } else {
                    $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Wrong Company short name/password combination. Try Again</strong>  </p>
       </div>';
                    $this->Session->setFlash($msg);
                }
            }
            $registershow = false;
            if ($this->request->data['Customer']['action'] == 'register') {
                $registershow = $this->registration($this->request->data['Customer']);
            }
        }

        $this->set(compact('company', 'searched', 'newUser', 'registershow'));
    }

    function addexpense() {
        $this->loadModel('Expense');
        if ($this->request->is('post')) {
            $this->Expense->set($this->request->data);
            if ($this->Expense->validates()) {

                $loggedUser = $this->Auth->user();
                $this->request->data['Expense']['customer_id'] = $loggedUser['id'];
                $this->Expense->save($this->request->data['Expense']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> New general expense item added succeesfull </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Expense->validationErrors);
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
    }

    function addcexpense() {
        $this->loadModel('CompanyExpense');
        if ($this->request->is('post')) {
            $this->CompanyExpense->set($this->request->data);
            if ($this->CompanyExpense->validates()) {

                $loggedUser = $this->Auth->user();
                $this->request->data['CompanyExpense']['customer_id'] = $loggedUser['id'];
                $this->CompanyExpense->save($this->request->data['CompanyExpense']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> New company expense item added succeesfull </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->CompanyExpense->validationErrors);
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
    }

    function addcompany() {
        $this->loadModel('Company');
        if ($this->request->is('post')) {
            $this->Company->set($this->request->data);
            if ($this->Company->validates()) {

                $loggedUser = $this->Auth->user();
                $this->request->data['Company']['customer_id'] = $loggedUser['id'];
                $this->Company->save($this->request->data['Company']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Client added succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Company->validationErrors);
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
    }

    function addbill() {
        $this->loadModel('Report');
        if ($this->request->is('post')) {
            $this->Report->set($this->request->data);
            if ($this->Report->validates()) {

                $loggedUser = $this->Auth->user();
                $this->request->data['Report']['customer_id'] = $loggedUser['id'];
                $this->Report->save($this->request->data['Report']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Billing record added succeesfully! </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Report->validationErrors);
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
    }

    function adddevilery() {
        $this->loadModel('Report');
        if ($this->request->is('post')) {
            $this->Report->set($this->request->data);
            if ($this->Report->validates()) {

                $loggedUser = $this->Auth->user();
                $this->request->data['Report']['customer_id'] = $loggedUser['id'];
                $this->Report->save($this->request->data['Report']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Delivary record added succeesfully! </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Report->validationErrors);
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
    }

    function recordexpense() {
        $this->loadModel('Report');
        if ($this->request->is('post')) {
            $this->Report->set($this->request->data);
            if ($this->Report->validates()) {

                $loggedUser = $this->Auth->user();
                $this->request->data['Report']['customer_id'] = $loggedUser['id'];
                $this->Report->save($this->request->data['Report']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Expense record added succeesfully! </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Report->validationErrors);
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
    }

    function getTotalbillToBeCollected() {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Report');
        $sql = "SELECT SUM(tobe_collected) as total FROM reports WHERE customer_id =" . $loggedUser['id'];
        $data = $this->Report->query($sql);
        return $data[0][0]['total'];
    }

    function getTotalbillCollected() {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Report');
        $sql = "SELECT SUM(collected) as total FROM reports WHERE customer_id =" . $loggedUser['id'];
        $data = $this->Report->query($sql);
        return $data[0][0]['total'];
    }

    function getTotalbillBank() {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Report');
        $sql = "SELECT SUM(collected) as total FROM reports WHERE customer_id =" . $loggedUser['id'] . " AND reports.pay_mode='check'";
        $data = $this->Report->query($sql);
        return $data[0][0]['total'];
    }

    function getAllExpense() {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Report');
        $sql = "SELECT SUM(amount) as total FROM reports WHERE customer_id =" . $loggedUser['id'];
        $data = $this->Report->query($sql);
        return $data[0][0]['total'];
    }

    function getClientBasisRecord() {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Report');
        $data = $this->Report->find('all', array('conditions' => array(
                'Report.customer_id' => $loggedUser['id'],
                'not' => array('Report.company_id' => null)
            ),
            'order' => array('Company.name' => 'ASC')
                )
        );

        $filteredData = array();
        $unique = array();
        $index = 0;
//        pr($allData); exit;
        foreach ($data as $key => $data) {

            $pd = $data['Report']['company_id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['Report']['collected'])) {
                    $filteredData[$index]['collected']+=$data['Report']['collected'];
                }
                if (!empty($data['Report']['tobe_collected'])) {
                    $filteredData[$index]['tobe_collected']+=$data['Report']['tobe_collected'];
                }
                if (!empty($data['Report']['amount'])) {
                    $filteredData[$index]['expense']+=$data['Report']['amount'];
                }
                if (!empty($data['Report']['product_id'])) {
                    $filteredData[$index]['material_value']+=$data['Report']['quantity'] * $data['Product']['cost'];
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['client'] = $data['Company']['name'];
                $filteredData[$index]['collected'] = $data['Report']['collected'];
                $filteredData[$index]['tobe_collected'] = $data['Report']['tobe_collected'];
                $filteredData[$index]['expense'] = $data['Report']['amount'];
                $filteredData[$index]['material_value'] = $data['Report']['quantity'] * $data['Product']['cost'];
            }
        }

        return $filteredData;
    }

    function dashboard() {

        $this->getClientBasisRecord();
        $this->loadModel('Product');
        $this->loadModel('Company');
        $this->loadModel('Expense');
        $this->loadModel('CompanyExpense');
        $loggedUser = $this->Auth->user();
        $products = $this->Product->find('list', array('conditions' => array('Product.customer_id' => $loggedUser['id']), 'order' => array('Product.name' => 'ASC')));
        $companies = $this->Company->find('list', array('conditions' => array('Company.customer_id' => $loggedUser['id']), 'order' => array('Company.name' => 'ASC')));
        $expenses = $this->Expense->find('list', array('conditions' => array('Expense.customer_id' => $loggedUser['id']), 'order' => array('Expense.name' => 'ASC')));
        $cexpenses = $this->CompanyExpense->find('list', array('conditions' => array('CompanyExpense.customer_id' => $loggedUser['id']), 'order' => array('CompanyExpense.name' => 'ASC')));
        $total['collected'] = $this->getTotalbillCollected();
        $total['tobe_collected'] = $this->getTotalbillToBeCollected();
        $total['bill_bank'] = $total['collected'];
        $total['expense'] = $this->getAllExpense();
        $clientData = $this->getClientBasisRecord();
        $productData = $this->getproductststus();
        // pr($productData ); exit;
        $this->set(compact('clientData', 'companies', 'products', 'expenses', 'cexpenses', 'total', 'productData'));
    }

    function passwordRecoveryRequest() {



        if ($this->request->is('post')) {
            $this->loadModel('Customer');
            $email = $this->request->data['Customer']['email'];
            $data = $this->Customer->findByEmail($email);

            if (!count($data)) {
                $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>No Such E-mail address registerd for Customer with us</strong>' .
                        ' </p> </div>';
                $this->Session->setFlash($msg);
            } else {
                $key = $data['Customer']['resetkey'];
                $id = $data['Customer']['id'];
                $emailInfo = array();
                $emailInfo['from'] = 'info@jegeachi.com';
                $emailInfo['subject'] = 'Password Reset Instruction';
                $emailInfo['title'] = 'Password Reset link';
                $emailInfo['to'] = array($this->request->data['Customer']['email']);
                $emailInfo['content'] = array(
                    'key' => $key,
                    'id' => $id,
                    'rand' => mt_rand(),
                    'url' => 'customers/resetpw',
                    'template' => 'passwordReset'
                );
                /*
                  //this is for testing view of email template
                  $mail_content = $emailInfo['content'] ;
                  $this->set(compact('mail_content')); */

                if ($this->sendEmail($emailInfo)) {
                    $msg = '<div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Please check your email <i>' . $this->request->data['Customer']['email'] . '</i> for password reset instructions</strong> 
                            </div>';
                } else {
                    $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>No Such E-mail address registerd for Customer with us</strong> </p> </div>';
                }
            }
            $this->Session->setFlash($msg);
            $this->redirect(array('controller' => 'customers', 'action' => 'login'));
        }
    }

    function resetpw($a) {
        $this->layout = "public";
        $this->loadModel('Customer');
        if ($this->request->is('post')) {

            $key = explode('BXX', $a);

            $pair = explode('XXB', $key[1]);
            $key = $key[0];
            $id = $pair[1];
            $uArr = $this->Customer->findById($id);
            if ($uArr['Customer']['resetkey'] == $key) {
                $this->Customer->read(null, $id);
                $this->Customer->set($this->request->data['Customer']);
                if ($this->Customer->validates($this->request->data['Customer'])) {
                    $this->Customer->save($this->request->data['Customer']);
                    $msg = ' <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Your password has been reset</strong> 
                            </div>';
                    $this->Session->setFlash($msg);
                    $this->redirect(array('controller' => 'customers', 'action' => 'login'));
                } else {
                    $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> Something has gone wrong. Please try later or <strong>sign up again</strong> </p> </div>';
                    $msg = $this->generateError($this->Customer->validationErrors);
                    $this->Session->setFlash($msg);
                }
            } else {
                $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Invalid link.Please check your reset link or request for new link</strong>  </p>
       </div>';
                $this->Session->setFlash($msg);
                $this->redirect(array('controller' => 'customers', 'action' => 'login'));
            }
        }
    }

    function getproductststus() {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Product');

        $sql = "SELECT * FROM products " .
                "LEFT JOIN imports ON products.id = imports.product_id " .
                "LEFT JOIN reports ON products.id = reports.product_id " .
                "WHERE products.customer_id=" . $loggedUser['id'];
        $data = $this->Product->query($sql);

        $filteredData = array();
        $unique = array();
        $uniqueExport = array();
        $uniqueImport = array();
        $index = 0;
        pr($data);
        foreach ($data as $key => $data) {
            $pd = $data['products']['id'];
            $iid = $data['imports']['id'];
            $rid = $data['reports']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['imports']['stock'])) {
                    if (!isset($uniqueImport[$iid])) {
                        $filteredData[$index]['in']+=$data['imports']['stock'];
                        $uniqueImport[$iid] = 'set';
                    }
                }
                if (!empty($data['reports']['quantity'])) {
                    //Skip for already adding 
                    
                    if (!isset($uniqueExport[$rid])) {
                        $filteredData[$index]['out']+=$data['reports']['quantity'];
                        $uniqueExport[$rid] = 'set';
                    }
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';
                $uniqueImport[$iid] = 'set';
                 $uniqueExport[$rid] = 'set';
                $filteredData[$index]['product'] = $data['products']['name'];
                $filteredData[$index]['in'] = $data['imports']['stock'];
                $filteredData[$index]['out'] = $data['reports']['quantity'];
            }
        }
        pr($filteredData);
        exit;
        return $filteredData;
    }

}

?>