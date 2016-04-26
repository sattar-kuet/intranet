<?php

/**

 * */
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
        $this->set(compact('active_customers'));
    }

    function cancel() {
        $this->loadModel('PackageCustomer');
        $block_customers = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'canceled')));
        $this->set(compact('block_customers'));
    }

    function paidcustomers() {
        $this->loadModel('Transaction');
        $paid_customers = $this->Transaction->find('all', array('conditions' => array('Transaction.due' => '0')));
        $this->set(compact('paid_customers'));
    }

    function duecustomers() {
        $this->loadModel('Transaction');
        $due_customers = $this->Transaction->find('all', array('conditions' => array('NOT' => array('Transaction.due' => array(0)))));
        $this->set(compact('due_customers'));
    }

    function payment_history() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
            $conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
            $transactions = $this->Transaction->query("SELECT tr.id,tr.package_customer_id,concat(first_name,' ',middle_name,' ',last_name) as name,pc.psetting_id, pc.mac,
                ps.name, p.name,ps.amount,ps.duration FROM transactions tr 
                left join package_customers pc on pc.id = tr.package_customer_id
                left join psettings ps on ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id");
            $clicked = true;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

    function invoice($id = null) {
        $this->loadModel('Transaction');
        $this->Transaction->id = $id;
        $transactions = $this->Transaction->query("SELECT tr.id, tr.package_customer_id, 
            CONCAT( first_name,  ' ', middle_name,  ' ', last_name ) AS name, pc.psetting_id, pc.mac, ps.name, p.name, ps.amount, ps.duration
                FROM transactions tr
                LEFT JOIN package_customers pc ON pc.id = tr.package_customer_id
                LEFT JOIN psettings ps ON ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id
                WHERE tr.id = $id
                ");
        $mac = count(json_decode($transactions['0']['pc']['mac']));
        $transactions[0]['pc']['mac'] = $mac;
        $this->set(compact('transactions'));
    }

    function invoice_printqueue() {
        $this->loadModel('Package_customer');
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {           
            $datrange = json_decode($this->request->data['Package_customer']['daterange'], true);            
            $conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
            $packagecustomers = $this->Transaction->query("SELECT tr.id, tr.package_customer_id, 
            CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,
            ps.name, p.name, ps.amount, ps.duration FROM transactions tr
            left join package_customers pc on tr.package_customer_id = pc.id
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id WHERE amount !=0 and
            tr.created >='".$datrange['start']."' AND tr.created <='". $datrange['end']."'");
            $clicked = true;
            $this->set(compact('packagecustomers'));
        }
        $this->set(compact('clicked'));
    }
    
     function pexp_invoice() {
         
     }

    function payment_pdf($id = null) {
        $this->layout = 'blank_page';
        $this->loadModel('Transaction');
        $this->Transaction->id = $id;
        $id_info = $this->Transaction->find('all', array('conditions' => array('Transaction.id' => $id)));
        $temp = $id_info['0'];
        $this->set(compact('temp'));
        $this->request->data = $this->Transaction->findById($id);
    }

    function expcustomers() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
            $ds = new DateTime($datrange['start']);
            $timestamp = $ds->getTimestamp(); // Unix timestamp
            $startd = $ds->format('m/y'); // 2003-10-16
            $de = new DateTime($datrange['end']);
            $timestamp = $de->getTimestamp(); // Unix timestamp
            $endd = $de->format('m/y'); // 2003-10-16
            $conditions = array('Transaction.exp_date >=' => $startd, 'Transaction.exp_date <=' => $endd);
//            pr($conditions); exit;
            $transactions = $this->Transaction->find('all', array('conditions' => $conditions));
            $clicked = true;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

    function newcustomers() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
            $conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
             
            $transactions = $this->Transaction->find('all', array('conditions' => $conditions));
           
            $clicked = true;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

}

?>