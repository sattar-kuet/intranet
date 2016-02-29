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

        $loggedUser = $this->Auth->user();
        if ($this->request->is('post') || $this->request->is('put')) {

           
            $this->loadModel('PackageCustomer');
            $this->loadModel('Ticket');
            $this->loadModel('Track');
            $tmsg = 'Information of  ' . $this->request->data['PackageCustomer']['first_name'] . '  ' .
                    $this->request->data['PackageCustomer']['middle_name'] . '  ' .
                    $this->request->data['PackageCustomer']['last_name'] . ' has been updated';
//            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
//            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
            $this->PackageCustomer->id = $id; //$customer_info['PackageCustomer']['id'];
//             pr($this->request->data); exit;
            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
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
            // INCREASE CHARGED AMOUNT IF TRANSACTION IS SUCCESSFUL
            // $this->PackageCustomer->id = $cid;
            //$data = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $cid)));
            // $present_due['PackageCustomer']['charge_amount'] = (float) $data['PackageCustomer']['charge_amount'] + (float) $charged_amount;
            //  $this->PackageCustomer->save($present_due);
            // $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            //END OF DUE UPDATE
            $this->Track->save($trackData);
        }
        $this->loadModel('PackageCustomer');
        $customer_info = $this->PackageCustomer->findById($id);
        $c_acc_no = $customer_info['PackageCustomer']['c_acc_no'];



        $pcustomer_id = $this->request->data = $customer_info;    //transaction history view by customer id
        $transactions = $this->Transaction->find('all', array('conditions' => array('Transaction.package_customer_id' => $id)));
        
        $this->set(compact('transactions','c_acc_no'));
        $response = $this->getAllTickectsByCustomer($id);
        $data = $response['data'];
//        pr($data);        exit;
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
        //   pr($packageList); exit;

        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE package_customers.id = '" . $id . "'";

        $temp = $this->PackageCustomer->query($sql);
//        pr($selected); exit;
        //  $selected['psetting'] = $temp[0]['psettings']['id'];
        //    $selected['package'] = $temp[0]['packages']['id'];
        $ym = $this->getYm();
        $this->set(compact('packageList', 'psettings', 'selected', 'ym'));
    }

    function getYM() {
        $cy = date('Y');
        $cm = date('m');
        $y = array();
        $n = 0;
        for ($i = $cy; $n < 40; $i++) {
            $y[$i] = $i;
            $n++;
        }
        $return['year'] = $y;
        $return['month'] = array(
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12'
        );
        return $return;
    }

    function payment_history() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
            $conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
            $transactions = $this->Transaction->find('all', array('conditions' => $conditions));
//            pr($transactions);
//            exit;
            $clicked = true;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

}

?>