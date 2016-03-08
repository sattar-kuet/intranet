<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class ReportsController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {
        return true;
    }

    function active() {
        $this->loadModel('PackageCustomer');
        $active_customers = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'active')));
//        pr($active_customers);
//        exit;
        $this->set(compact('active_customers'));
    }

    function block() {
        $this->loadModel('PackageCustomer');
        $block_customers = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'blocked')));
        $this->set(compact('block_customers'));
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