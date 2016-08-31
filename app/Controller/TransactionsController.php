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
        $this->set(compact('filteredPackage'));
    }

    function edit_customer_data($id = null) {
        $this->loadModel('StatusHistory');
        $pcid = $id;
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['PackageCustomer']['status'] = $this->request->data['status'];
            $this->request->data['PackageCustomer']['r_form'] = $this->getFormatedDate($this->request->data['PackageCustomer']['r_form']);
            if (isset($this->request->data['PackageCustomer']['mac'])) {
                $this->request->data['PackageCustomer']['mac'] = json_encode($this->request->data['PackageCustomer']['mac']);
                $this->request->data['PackageCustomer']['system'] = json_encode($this->request->data['PackageCustomer']['system']);
            }
            $this->loadModel('PackageCustomer');
            $this->loadModel('CustomPackage');
            $this->loadModel('Ticket');
            $this->loadModel('Track');
            $tmsg = 'Information of  ' . $this->request->data['PackageCustomer']['first_name'] . '  ' .
                    $this->request->data['PackageCustomer']['middle_name'] . '  ' .
                    $this->request->data['PackageCustomer']['last_name'] . ' has been updated';
            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
            $this->PackageCustomer->id = $id; //$customer_info['PackageCustomer']['id'];
            //For Custom Package data insert

            $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
            $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];
            if (!empty($this->request->data['PackageCustomer']['charge'])) {
                //save data into custom_package table
                $cp = $this->CustomPackage->save($data4CustomPackage);
                unset($cp['CustomPackage']['PackageCustomer']);
                //from custom_package table, save custom package id to package_customer table
                $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
            }
            //Ends Custom_package data entry  
//            pr($this->request->data); exit;
            $shistory = $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            $data4statusHistory = array();
            $data4statusHistory['StatusHistory'] = array(
                'package_customer_id' => $pcid,
                'date' => $this->request->data['PackageCustomer']['date'],
                'status' => $this->request->data['PackageCustomer']['status'],
            );
            $this->StatusHistory->save($data4statusHistory);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Customer information updated successfully </strong>
            </div>';
            $this->Session->setFlash($msg);
            $tdata['Ticket'] = array('content' => $tmsg);
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $id,
                'role_id' => 100,
                'ticket_id' => $tickect['Ticket']['id'],
                'status' => 'closed',
                'issue_id' => 100,
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
        }
        $this->loadModel('PackageCustomer');
        $customer_info = $this->PackageCustomer->findById($pcid);
        $statusHistories = $this->StatusHistory->find('all', array('conditions' => array('StatusHistory.package_customer_id' => $pcid)));
        $lastStatus = end($statusHistories);
        //Show default value for custome package
        $customer_info['PackageCustomer']['date'] = $lastStatus['StatusHistory']['date'];
        $custom_package_charge = $customer_info['CustomPackage']['charge'];
        $custom_package_duration = $customer_info['CustomPackage']['duration'];

        //Custom package checkmark
        $checkMark = FALSE;
        if (isset($custom_package_charge)) {
            $checkMark = TRUE;
        } else {
            $checkMark = FALSE;
        }
        //Show mac and stb information which is already in database
        $macstb['mac'] = json_decode($customer_info['PackageCustomer']['mac']);
        $macstb['system'] = json_decode($customer_info['PackageCustomer']['system']);

        $c_acc_no = $customer_info['PackageCustomer']['c_acc_no'];

        $pcustomer_id = $this->request->data = $customer_info;    //transaction history view by customer id
        $transactions = $this->Transaction->find('all', array('conditions' => array('Transaction.package_customer_id' => $id)));

        $this->set(compact('transactions', 'c_acc_no', 'macstb', 'custom_package_duration', 'checkMark', 'statusHistories'));
        $response = $this->getAllTickectsByCustomer($id);
        $data = $response['data'];

        $users = $response['users'];
        $roles = $response['roles'];
        $this->set(compact('data', 'users', 'roles', 'customer_info'));
        //$this->Transaction->manage($id);
//            $response = $this->requestAction('tickets/manage/'.$id); //For ticket history
        //  $this->tariffplan(); //Call tarrifplan fuction to show packagese
        $this->request->data = $customer_info;
        //   $this->tariffplan(); //Call tarrifplan fuction to show packagese in our old style
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
        $this->loadModel('Transaction');
        $sql = "SELECT * FROM transactions WHERE transactions.status ='success' AND transactions.pay_mode='card' AND transactions.package_customer_id = $pcid ORDER BY transactions.id DESC LIMIT 1";
        $temp = $this->Transaction->query($sql);
        $yyyy = 0;
        $mm = -1;
        // pr($temp); exit;
        $date = explode('/', $customer_info['PackageCustomer']['exp_date']);

        if (count($date) == 2) {
            $yyyy = date('Y');
            $yy = substr($yyyy, 0, 2);
            $yyyy = $yy . '' . $date[1];
            $mm = $date[0];
        }
        $cardInfo = array(
            'fname' => $customer_info['PackageCustomer']['cfirst_name'],
            'lname' => $customer_info['PackageCustomer']['clast_name'],
            'cvv_code' => $customer_info['PackageCustomer']['cvv_code'],
            'zip_code' => $customer_info['PackageCustomer']['czip'],
            'address' => '',
            'trx_id' => '',
            'card_no' => $customer_info['PackageCustomer']['card_check_no'],
            'company' => '',
            'city' => '',
            'state' => '',
            'email' => '',
            'country' => '',
            'phone' => '',
            'fax' => '',
            'paid_amount' => '',
            'description' => '',
            'exp_date' => array('year' => $yyyy, 'month' => $mm)
        );

        if (count($temp)) {
            $date = explode('/', $temp[0]['transactions']['exp_date']);
            $yyyy = date('Y');
            $yy = substr($yyyy, 0, 2);
            $yyyy = $yy . '' . $date[1];
            $mm = $date[0];
            $temp[0]['transactions']['exp_date'] = array('year' => $yyyy, 'month' => $mm);
            $latestcardInfo = $temp[0]['transactions'];
        } else {
            $date = explode('/', $customer_info['PackageCustomer']['exp_date']);

            if (count($date) == 2) {
                $yyyy = date('Y');
                $yy = substr($yyyy, 0, 2);
                $yyyy = $yy . '' . $date[1];
                $mm = $date[0];
            }
            $latestcardInfo = array(
                'fname' => $customer_info['PackageCustomer']['cfirst_name'],
                'lname' => $customer_info['PackageCustomer']['clast_name'],
                'cvv_code' => $customer_info['PackageCustomer']['cvv_code'],
                'zip_code' => $customer_info['PackageCustomer']['czip'],
                'address' => '',
                'trx_id' => '',
                'card_no' => $customer_info['PackageCustomer']['card_check_no'],
                'company' => '',
                'city' => '',
                'state' => '',
                'email' => '',
                'country' => '',
                'phone' => '',
                'fax' => '',
                'paid_amount' => '',
                'description' => '',
                'exp_date' => array('year' => $yyyy, 'month' => $mm)
            );
        }
        $this->loadModel('Transaction');
        $transactions_all = $this->Transaction->query("SELECT * 
            FROM  `transactions` tr
            INNER JOIN package_customers pc ON pc.id = tr.`package_customer_id` 
            WHERE package_customer_id = $pcid order by tr.id ASC;");

//         pr($transactions[0]['paid_amount']); exit;
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'latestcardInfo', 'cardInfo', 'transactions_data', 'transactions_all'));
    }

    function updatecardinfo() {
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->request->data['Transaction']['user_id'] = $user_id;
        $this->request->data['Transaction']['exp_date'] = $this->request->data['PackageCustomer']['exp_date']['month'] . '/' . $this->request->data['PackageCustomer']['exp_date']['year'];
        $this->request->data['Transaction']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Card information updated successfully </strong>
            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function extrainvoice() {
        // pr($this->request->data); exit;
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Card information updated successfully </strong>
            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect(array('controller' => 'reports', 'action' => 'extraPayment'));
        //return $this->redirect($this->referer());
    }

}

?>