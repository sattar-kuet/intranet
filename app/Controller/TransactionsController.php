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
            $paidcustomers = $this->PaidCustomer->find('first', array('conditions' => array('PaidCustomer.id' => $id)) );
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

}

?>