<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');

App::uses('AppController', 'Controller');

class TransactionsController extends AppController {

    var $layout = 'admin';
    // public $components = array('Auth');
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email', //Default is 'username' in the userModel
                        'password' => 'password'  //Default is 'password' in the userModel
                    ),
                    'userModel' => 'User',
                )
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => '/', 'action' => 'index'),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function isAuthorized($user = null) {
        $sidebar = $user['Role']['name'];
        $this->set(compact('sidebar'));

        return true;
    }

    function registered($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('User');
        $user_id = $this->Auth->user(['id']);
        $customer_info = $this->PackageCustomer->find('all', array('conditions' => array('user_id' => $id)));
        $this->set(compact('customer_info'));
    }

    function search() {
        $this->loadModel('Transaction');
        ;
        $clicked = false;

        $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
        //$conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
        $transactions = $this->Transaction->find('all');

        $clicked = true;
        $this->set(compact('transactions'));

        $this->set(compact('clicked'));
    }

    function expire_customer($id = null) {
        $this->loadModel('PaidCustomer');
        $clicked = false;

        //$datrange = json_decode($this->request->data['paidcustomer']['daterange'], true);
        //$conditions = array('PaidCustomer.package_exp_date >=' => $datrange['start'], 'PaidCustomer.package_exp_date <=' => $datrange['end']);
        $paidcustomers = $this->PaidCustomer->find('first', array('conditions' => array('PaidCustomer.id' => $id)));
        //pr($paidcustomers); exit;
        $clicked = true;
        $this->set(compact('paidcustomers'));

        $this->set(compact('clicked'));
    }

    function manage() {
        $this->loadModel('Transaction');
        $data_info = $this->Transaction->find('all');
        $this->set(compact('data_info'));
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

    function edit_customer_data($id = null) {
//        pr($this->request->data);
//        exit;
        $this->loadModel('PackageCustomer');
        $this->loadModel('CustomPackage');
        $this->loadModel('Psetting');

        $this->loadModel('Package');

//         pr($this->request->data);exit;
//        
//        $customer_info = $this->PackageCustomer->findById($id);
//        $this->tariffplan(); //Call tarrifplan fuction to show packagese
//        //FIND PACKAGE DETAILS
//        $sql = "SELECT * 
//                FROM packages p
//                INNER JOIN vbpackage_customers vbpc ON vbpc.package_id = p.id
//                WHERE vbpc.id = $id";
////        $sql = "SELECT * FROM package_customers "
////                . "INNER JOIN psettings ON package_customers.psetting_id = psettings.id"
////                . "INNER JOIN packages ON psettings.package_id = packages.id"
////                . "INNER JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id";
//        $temp_packageInfo = $this->PackageCustomer->query($sql);
//       
//        $packageInfo = $temp_packageInfo[0];
//       // pr($packageInfo); exit;
//        //FOR CUSTOMER TABLE
//        $clicked = false;
//
//        //$datrange = json_decode($this->request->data['paidcustomer']['daterange'], true);
//        //$conditions = array('PaidCustomer.package_exp_date >=' => $datrange['start'], 'PaidCustomer.package_exp_date <=' => $datrange['end']);
//        $paidcustomers = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $id)));
//        //pr($paidcustomers); exit;
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE package_customers.id = '" . $id . "'";

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
        
        pr($data);
        exit;

        $this->loadModel('Pakage');
        $customer_info = $this->PackageCustomer->findById($id);
        $this->tariffplan(); //Call tarrifplan fuction to show packagese
        //FIND PACKAGE DETAILS
        
        
        $sql = "SELECT * 
            FROM vbpackage_customers vbpc
            INNER JOIN packages p ON vbpc.package_id = p.id
            WHERE vbpc.id = $id ";
        $temp_packageInfo = $this->PackageCustomer->query($sql);
        //pr($temp_packageInfo); exit;
        $packageInfo = array();
        if (array_key_exists(0, $temp_packageInfo)) {
            $packageInfo = $temp_packageInfo[0];
        }
        $clicked = false;
        $paidcustomers = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $id)));
        //pr($paidcustomers); exit;

        $clicked = true;
        $this->set(compact('paidcustomers', 'packageInfo'));

        $this->set(compact('clicked'));
        //FOR EDIT DATA
        if ($this->request->is('post') || $this->request->is('put')) {
            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
            // pr($this->request->data);
            // exit;

            $this->PackageCustomer->id = $customer_info['PackageCustomer']['id'];
            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Customer information updated successfully </strong>
            </div>';
            $this->Session->setFlash($msg);
            //return $this->redirect('manage_user');
        } else {
            $this->request->data = $customer_info;
        }
    }

    function payment_history() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['paidcustomer']['daterange'], true);
            $conditions = array('PaidCustomer.package_exp_date >=' => $datrange['start'], 'PaidCustomer.package_exp_date <=' => $datrange['end']);
            $paidcustomers = $this->PaidCustomer->find('all', array('conditions' => $conditions));
            $clicked = true;
            $this->set(compact('paidcustomers'));
        }
        $this->set(compact('clicked'));
    }

}

?>