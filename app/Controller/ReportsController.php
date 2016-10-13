<?php

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

    function payment_history_old() {
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

    function payment_history() {
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            // pr($this->request->data);
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
            $conditions = " tr.status = 'success' AND ";
            if (!empty($this->request->data['Transaction']['pay_mode'])) {
                $conditions .=" tr.pay_mode = '" . $this->request->data['Transaction']['pay_mode'] . "' AND ";
            }
            if ($datrange['start'] == $datrange['end']) {
                $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                $conditions .=" tr.created >=' " . $datrange['start'] . " 00:00:00' AND  tr.created < '" . $nextday . " 23:59:59' AND ";
            } else {
                $conditions .=" tr.created >='" . $datrange['start'] . " 00:00:00' AND  tr.created <='" . $datrange['end'] . " 23:59:59' AND ";
            }
            $conditions.="###";
            $conditions = str_replace("AND###", "", $conditions);
            $conditions = str_replace("AND ###", "", $conditions);
            $conditions = str_replace("###", "", $conditions);
            $sql = "SELECT * FROM transactions tr 
                left join package_customers pc on pc.id = tr.package_customer_id
                left join psettings ps on ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id 
                 WHERE $conditions";
            // echo $sql; exit;
            $transactions = $this->Transaction->query($sql);
            $clicked = true;
            //  pr($transactions); exit;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

    function invoice($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id, CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.package_exp_date,pc.invoice_no,ps.name, ps.amount, ps.duration,p.name
            FROM package_customers pc
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE pc.id = $id ");
        foreach ($packagecustomers as $data) {
            $pcid = $data['pc']['id'];
            $this->PackageCustomer->id = $pcid;
            $this->PackageCustomer->saveField("printed", 1);
        }
        $mac = count(json_decode($packagecustomers['0']['pc']['mac']));
        $packagecustomers[0]['pc']['mac'] = $mac;
        $this->set(compact('packagecustomers'));
    }

    function allInvoice() {
        $this->loadModel('PackageCustomer');
        $expiredate = trim(date('Y-m-d', strtotime("+25 days")));
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id, CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.package_exp_date,pc.invoice_no,ps.name, ps.amount, ps.duration,p.name
            FROM package_customers pc
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE package_exp_date>='" . date('Y-m-d') . "' AND package_exp_date<='" . $expiredate . "' AND package_exp_date != 0000-00-00 "
                . "GROUP BY pc.id");
        foreach ($packagecustomers as $data) {
            $pcid = $data['pc']['id'];
            $this->PackageCustomer->id = $pcid;
            $this->PackageCustomer->saveField("printed", 1);
        }
        $mac = count(json_decode($packagecustomers['0']['pc']['mac']));
        $packagecustomers[0]['pc']['mac'] = $mac;
        $this->set(compact('packagecustomers'));
    }

    function passedInvoice() {
        $this->loadModel('PackageCustomer');
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id,pc.printed, pc.invoice_no,CONCAT( first_name,' ', middle_name,' ', last_name ) AS name,pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.package_exp_date,
            ps.name, p.name,ps.amount, ps.duration FROM package_customers pc           
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE  pc.printed = 1");
        $this->set(compact('packagecustomers'));
    }

    function closeInvoice() {
        $this->loadModel('Package_customer');
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Package_customer']['daterange'], true);
            $datrange['start'] = $datrange['start'] . ' 00:00:00';
            $datrange['end'] = $datrange['end'] . ' 23:59:59';
            $packagecustomers = $this->Transaction->query("SELECT tr.id, tr.package_customer_id, 
            CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,
            ps.name, p.name, tr.paid_amount, ps.amount, ps.duration FROM transactions tr
            left join package_customers pc on tr.package_customer_id = pc.id
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE paid_amount !=0 and
            tr.created >='" . $datrange['start'] . "' AND tr.created <='" . $datrange['end'] . "'");
            $clicked = true;
            $this->set(compact('packagecustomers'));
        }
        $this->set(compact('clicked'));
    }

    function all_invoice_close() {
        $this->loadModel('Package_customer');
        $this->loadModel('Transaction');
//        pr($this->request->data);
//        exit;
        if ($this->request->is('post') || $this->request->is('put')) {
            pr($this->request->data);
            exit;
            $datrange = json_decode($this->request->data['Package_customer']['daterange'], true);
            $datrange['start'] = $datrange['start'] . ' 00:00:00';
            $datrange['end'] = $datrange['end'] . ' 23:59:59';

            $transactions = $this->Transaction->query("SELECT tr.id, tr.package_customer_id, 
            CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,
            ps.name, p.name, tr.paid_amount, ps.amount, ps.duration, tr.created 
            
            FROM transactions tr
            
            left join package_customers pc on tr.package_customer_id = pc.id
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            
            WHERE paid_amount !=0 and
            tr.created >='" . $datrange['start'] . "' AND tr.created <='" . $datrange['end'] . "'");
//            pr($transactions);
//            exit;
            $this->set(compact('transactions'));
        }
    }

    function openInvoice_back() {
        $this->loadModel('Package_customer');
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Package_customer']['daterange'], true);
            $conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);

            $packagecustomers = $this->Transaction->query("SELECT tr.id, tr.package_customer_id, 
            CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,
            ps.name, p.name, tr.paid_amount, ps.amount, ps.duration FROM transactions tr
            left join package_customers pc on tr.package_customer_id = pc.id
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE paid_amount !=0 and
            tr.created >='" . $datrange['start'] . "' AND tr.created <='" . $datrange['end'] . "'");
//            pr($packagecustomers);
//            exit;
            $clicked = true;
            $this->set(compact('packagecustomers'));
        }
        $this->set(compact('clicked'));
    }

    function openInvoice25() {
        $this->loadModel('PackageCustomer');
        $expiredate = trim(date('Y-m-d', strtotime("+25 days")));
        $data = $this->PackageCustomer->query("SELECT  *
            FROM package_customers 
            WHERE package_exp_date>='" . date('Y-m-d') .
                "' AND package_exp_date<='" . $expiredate .
                "' AND package_exp_date != 0000-00-00 " .
                " AND invoice_created != 1"
        );
        foreach ($data as $single) {
            $cid = $single['package_customers']['id'];
            $six_digit_random_number = mt_rand(100000000, 999999999);
            $this->PackageCustomer->id = $cid;
            $this->PackageCustomer->saveField('invoice_no', $six_digit_random_number);
            $this->PackageCustomer->saveField('invoice_created', 1); // set it as 0 when next payment date will be updated  
        }
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id, CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.package_exp_date,pc.invoice_no,ps.name, ps.amount, ps.duration,p.name
            FROM package_customers pc
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE package_exp_date>='" . date('Y-m-d') . "' AND package_exp_date<='" . $expiredate . "' "
                . "AND package_exp_date != 0000-00-00. "
                . " AND pc.printed = 0"
                . " GROUP BY pc.id");

        $this->set(compact('packagecustomers'));
    }

    function printed() {
        $this->loadModel('PackageCustomer');
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id,pc.printed, CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.package_exp_date,pc.invoice_no,ps.name, ps.amount, ps.duration,p.name
            FROM package_customers pc
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE pc.printed = 1");
        $this->set(compact('packagecustomers'));
    }
    function createTicket($customer_id = null, $data = array()) {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->Ticket->create();
        $tickect = $this->Ticket->save($data); // Data save in Ticket
        $trackData = array(
            'ticket_id' => $tickect['Ticket']['id'],
            'package_customer_id' => $customer_id,
            'role_id' => 4 // assign to acounts
        );
        $this->Track->create();
        $this->Track->save($trackData); // Data save in Track
    }

    function outbound() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $expiredate = trim(date('Y-m-d', strtotime("+5 days")));
        $packagecustomers = $this->Transaction->query("SELECT * 
            FROM package_customers pc
            WHERE package_exp_date>='" . date('Y-m-d') . "' AND package_exp_date<='" . $expiredate .
                "' AND package_exp_date != 0000-00-00 AND auto_r ='no' AND ticket_generated = 0 "
                . "GROUP BY pc.id");

        foreach ($packagecustomers as $packagecustomer) {
            $cid = $packagecustomer['pc']['id'];
            $data = array(
                'content' => 'Please call to this Customer about payment.',
                'user_id' => 0,
                'priority' => 'medium'
            );
            $this->createTicket($cid, $data);
            $this->PackageCustomer->id = $cid;
            $this->PackageCustomer->saveField("ticket_generated", 1);
        }
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> All outbound tickets created Successfully! </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect(array('controller' => 'admins', 'action' => 'dashboard'));
    }

    function outboundView() {
        $this->loadModel('track');
        $data = $this->track->query("SELECT * FROM `tracks` tr
                left join package_customers pc on tr.package_customer_id = pc.id
                left join tickets ti on tr.ticket_id = ti.id
                WHERE tr.status = 'outbound'");
        $this->set(compact('data'));
    }

    function extraPayment() {
        $this->loadModel('Transaction');
        $data = $this->Transaction->find('all', array('conditions' => array('Transaction.status' => 'unpaid', 'Transaction.type' => 'extra')));
        $card_info = array();
        foreach ($data as $i => $single) {
            $pci = $single['Transaction']['package_customer_id'];
            $sql = "SELECT * FROM transactions WHERE transactions.status ='success' AND transactions.pay_mode='card' AND transactions.package_customer_id = $pci ORDER BY transactions.id DESC LIMIT 1";
            $temp = $this->Transaction->query($sql);
            if (count($temp)) {
                $card_info[$i] = $temp[0]['transactions'];
            } else {
                $card_info[$i] = array();
            }
        }
        $ym = $this->getYm();
        $this->set(compact('data', 'ym', 'card_info'));
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
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
//            pr($this->request->data); exit;
//            $ds = new DateTime($datrange['start']);
//            $timestamp = $ds->getTimestamp(); // Unix timestamp
//            $startd = $ds->format('m/y'); // 2003-10-16
//            $de = new DateTime($datrange['end']);
//            $timestamp = $de->getTimestamp(); // Unix timestamp
//            $endd = $de->format('m/y'); // 2003-10-16
            $conditions = array('PackageCustomer.package_exp_date >=' => $datrange['start'], 'PackageCustomer.package_exp_date <=' => $datrange['end']);
//            pr($conditions); exit;
            $customers = $this->PackageCustomer->find('all', array('conditions' => $conditions));
            $clicked = true;
          
            $this->set(compact('customers'));
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
// pr($transactions);
//            exit;
            $clicked = true;
            $this->set(compact('transactions'));
        }
        $this->set(compact('clicked'));
    }

    function call_log() {
        $this->loadModel('Issue');
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $issue = $this->request->data['Track']['issue_id'];
            $agent = $this->request->data['Track']['user_id'];
            $datrange = json_decode($this->request->data['Track']['daterange'], true);
            $status = $this->request->data['Track']['status'];
            $ds = new DateTime($datrange['start']);
            $timestamp = $ds->getTimestamp(); // Unix timestamp
            $startd = $ds->format('m/y'); // 2003-10-16
            $de = new DateTime($datrange['end']);
            $timestamp = $de->getTimestamp(); // Unix timestamp
            $endd = $de->format('m/y'); // 2003-10-16
            $conditions = "";
            if (!empty($issue)) {
                $conditions .= " tr.issue_id = $issue AND";
            }
            if (!empty($agent)) {
                $conditions .=" tr.forwarded_by = $agent AND";
            }
            if (count($datrange)) {

                if ($datrange['start'] == $datrange['end']) {
                    // SELECT * FROM tracks tr left JOIN tickets t ON tr.ticket_id = t.id 
                    // where t.created >=' 2016-04-13' and t.created < '2016-04-15'
                    // WHERE  t.created >='2016-06-06' AND  t.created <'2016-06-07' 

                    $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                    $conditions .=" t.created >=' " . $datrange['start'] . "' AND  t.created < '" . $nextday . "' AND ";
                } else {

                    $conditions .=" t.created >='" . $datrange['start'] . "' AND  t.created <='" . $datrange['end'] . "' AND ";
                }
            }
            if (!empty($status)) {
                $conditions .=" tr.status = '$status'";
            }

            $conditions.="###";
            $conditions = str_replace("AND###", "", $conditions);
            $conditions = str_replace("AND ###", "", $conditions);
            $conditions = str_replace("###", "", $conditions);




            $sql = "SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE $conditions";
//            pr($sql);
//            exit;
            $tickets = $this->Track->query($sql);

            $filteredTicket = array();
            $unique = array();
            $index = 0;
            foreach ($tickets as $key => $ticket) {
                $t = $ticket['t']['id'];
                if (isset($unique[$t])) {
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
                $filteredTicket;
            }

            $clicked = true;
            $this->set(compact('filteredTicket'));
        }

        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('clicked', 'data', 'users', 'issues', 'roles'));
    }

    function getTotalCall() {
        $this->loadModel('Ticket');
        $call = $this->Ticket->query("SELECT count(id) as total_call FROM tickets WHERE modified >= CURRENT_DATE()");

        return $call[0][0]['total_call'];
    }

    function getTotalSalesQuery() {
        $this->loadModel('PackageCustomer');
        $request = $this->PackageCustomer->query("SELECT count(status) as request FROM package_customers WHERE modified >= CURRENT_DATE() and status = 'requested'");

        return $request[0][0]['request'];
    }

    function getTotalHold() {
        $this->loadModel('PackageCustomer');

        $hold = $this->PackageCustomer->query("SELECT count(status) as hold FROM package_customers WHERE modified >= CURRENT_DATE() and status = 'Request to hold'");

        return $hold[0][0]['hold'];
    }

    function getTotalUnhold() {
        $this->loadModel('PackageCustomer');
        $unhold = $this->PackageCustomer->query("SELECT count(status) as unhold FROM package_customers WHERE modified >= CURRENT_DATE() and status = 'Request to unhold'");
        return $unhold[0][0]['unhold'];
    }

    function getTotalCancel() {
        $this->loadModel('PackageCustomer');
        $cancel = $this->PackageCustomer->query("SELECT count(status) as cancel FROM package_customers WHERE modified >= CURRENT_DATE() and status = 'canceled'");
        return $cancel[0][0]['cancel'];
    }

    function getTotalDone() {
        $this->loadModel('PackageCustomer');
        $date = date("Y-m-d");
        $done = $this->PackageCustomer->query("SELECT count(status) as done FROM package_customers WHERE modified >= $date and status = 'done'");
        return $done[0][0]['done'];
    }

    function getTotalReconnection() {
        $this->loadModel('PackageCustomer');
        $date = date("Y-m-d");
        $reconnection = $this->PackageCustomer->query("SELECT count(status) as reconnection FROM package_customers WHERE modified >= $date and status = 'reconnection'");
        return $reconnection[0][0]['reconnection'];
    }

    function getTotalNewordertaken() {
        $this->loadModel('PackageCustomer');
        $date = date("Y-m-d");
        $ready = $this->PackageCustomer->query("SELECT count(pc.status) as ready
            FROM  `vbpackagecustomers` as pc
            WHERE pc.date = '$date' and pc.status = 'ready'  OR (pc.follow_up=0 AND pc.status ='requested'
            AND pc.status != 'old_ready' ) AND shipment =0 ");
        $shipment = $this->PackageCustomer->query("SELECT COUNT( pc.status ) AS shipment
            FROM  `vbpackagecustomers` AS pc
            WHERE DATE =  '$date'
            AND pc.shipment =1");
        $totalorder = $ready[0][0]['ready'] + $shipment[0][0]['shipment'];
        return $totalorder;
    }

    function salesSupportdp() {
        $total = array();
//        $total['call'] = $this->getTotalCall();
//        $total['cancel'] = $this->getTotalCancel();        
//        $total['hold'] = $this->getTotalHold();
//        $total['unhold'] = $this->getTotalUnhold();
//        $total['reconnection'] = $this->getTotalReconnection();
        $total['done'] = $this->getTotalDone();
        $total['ready'] = $this->getTotalNewordertaken();
        $total['sales_query'] = $this->getTotalSalesQuery();
        $total[0] = $total['done'] + $total['ready'];

//        pr($total['0']); exit;
        $this->set(compact('total'));
    }

    function techPendingPayment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $loggedUser = $this->Auth->user();
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id                    
                    left join installations ins on ins.package_customer_id = pc.id 
                    LEFT JOIN payment_settings pays ON pays.issue_id = i.id
                    WHERE  pc.approved = 1  and ins.status = 'done by tech' and tech_payment !=1  ORDER BY ins.id desc");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

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
                $filteredData[$index]['issues'] = array();
                if (!empty($data['i']['name'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issues'][] = $temp;
                }

                $filteredData[$index]['payment_settings'] = array();

                if (!empty($data['pays']['id'])) {
                    $filteredData[$index]['payment_settings'] = array(
                        'payment' => $data['pays']['payment']
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

    function confiramTechPayment($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
//        pr($this->request->data); exit;
        $this->PackageCustomer->saveField("tech_payment", "1");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function techDonePayment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $loggedUser = $this->Auth->user();
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id                    
                    left join installations ins on ins.package_customer_id = pc.id 
                    LEFT JOIN payment_settings pays ON pays.issue_id = i.id
                    WHERE  pc.approved = 1  and ins.status = 'done by tech' and tech_payment =1  ORDER BY ins.id desc");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

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
                $filteredData[$index]['issues'] = array();
                if (!empty($data['i']['name'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issues'][] = $temp;
                }

                $filteredData[$index]['payment_settings'] = array();

                if (!empty($data['pays']['id'])) {
                    $filteredData[$index]['payment_settings'] = array(
                        'payment' => $data['pays']['payment']
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

}

?>