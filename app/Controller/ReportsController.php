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

    function cancel() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('StatusHistory');
        $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
        $start = $datrange['start'];
        $end = $datrange['end'];
        $conditions = 'status_histories.status = "canceled" AND status_histories.date >="' . $start . '" AND status_histories.date <="' . $end . '"';

        $sql = "SELECT * FROM status_histories  
            LEFT JOIN package_customers  ON package_customers.id = status_histories.package_customer_id 
            left join transactions  on package_customers.id = transactions.package_customer_id    
            left join psettings  on psettings.id = package_customers.psetting_id
            LEFT JOIN packages  ON packages.id = psettings.package_id 
            LEFT JOIN custom_packages  ON custom_packages.id = package_customers.custom_package_id 
            where $conditions GROUP BY status_histories.id  limit 0,199";
        $data = $this->PackageCustomer->query($sql);
        return $data;
    }

    function payment_history($page, $start, $end, $pay_mode) {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');

        if (isset($this->request->data['Role'])) {
            $datrange = json_decode($this->request->data['Role']['daterangepaymode'], true);
            $start = $datrange['start'];
            $end = $datrange['end'];
            $pay_mode = $this->request->data['Role']['pay_mode'];
        }

        $conditions = " tr.status = 'success' AND ";
        if (!empty($pay_mode) && $pay_mode != null) {
            $conditions .=" tr.pay_mode = '" . $pay_mode . "' AND ";
        }

        if ($start != '') {
            if ($start == $end) {
                $nextday = date('Y-m-d', strtotime($end . "+1 days"));
                $conditions .="tr.created >=' " . $start . " 00:00:00' AND  tr.created < '" . $end . " 23:59:59' AND ";
            } else {
                $conditions .=" tr.created >='" . $start . " 00:00:00' AND  tr.created <='" . $end . " 23:59:59' AND ";
            }
        }

        $conditions.="###";
        $conditions = str_replace("AND###", "", $conditions);
        $conditions = str_replace("AND ###", "", $conditions);
        $conditions = str_replace("###", "", $conditions);

        $offset = 0; //--$page * $this->per_page;
        $total = $this->Transaction->query("SELECT COUNT(tr.id) as total FROM transactions tr 
                WHERE $conditions");
        $total = $total[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $sql = "SELECT * FROM transactions tr 
                left join package_customers pc on pc.id = tr.package_customer_id
                left join psettings ps on ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id 
                left join custom_packages cp on pc.custom_package_id = cp.id
                WHERE $conditions order by tr.id desc limit $offset,$this->per_page";
//        echo $sql; exit;
        $transactions = $this->Transaction->query($sql);

        $sql1 = "SELECT SUM(payable_amount)as totalamount FROM transactions tr WHERE $conditions ";
        $totalamount = $this->Transaction->query($sql1);
        $totalamount = round($totalamount[0][0]['totalamount'], 2);

        $sql = "SELECT pc.mac FROM transactions tr 
                left join package_customers pc on pc.id = tr.package_customer_id
                left join psettings ps on ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id 
                WHERE $conditions";

        $total_mac = $this->Transaction->query($sql);

        //Total box
//            $sqlbox = "SELECT * FROM transactions tr left join package_customers pc on pc.id = tr.package_customer_id WHERE $conditions";
//            $totalbox = $this->Transaction->query($sqlbox);
        $sql = "SELECT sum(stbs)as total FROM transactions tr                      
                left join package_customers pc on pc.id = tr.package_customer_id WHERE $conditions";
        $stbs = $this->PackageCustomer->query($sql);
        $totalbox = $stbs[0][0]['total'];


        //Total Manual
        $sqlmanual = "SELECT SUM(payable_amount)as totalmanual FROM transactions tr WHERE $conditions and tr.auto_recurring != 1";
        $totalmanual = $this->Transaction->query($sqlmanual);
        $totalmanual = round($totalmanual[0][0]['totalmanual'], 2);

        //Auto recurring
        $sqlautore = "SELECT SUM(payable_amount)as totalautore FROM transactions tr WHERE $conditions and tr.auto_recurring = 1";
        $totalautore = $this->Transaction->query($sqlautore);
        $totalautore = round($totalautore[0][0]['totalautore'], 2);

        $sql1monthp = $this->getSubscriptionNo($conditions, '1 month package', 1);
        $total3monthp = $this->getSubscriptionNo($conditions, '3 month package', 3);
        $total6monthp = $this->getSubscriptionNo($conditions, '6 month package', 6);
        $total12monthp = $this->getSubscriptionNo($conditions, '1 year package', 12);

        $return['totalbox'] = $totalbox;
        $return['total_mac'] = $total_mac;
        $return['transactions'] = $transactions;
        $return['totalamount'] = $totalamount;
        $return['total_page'] = $total_page;
        $return['total'] = $total;
        $return['start'] = $start;
        $return['end'] = $end;
        $return['pay_mode'] = $pay_mode;
        $return['totalmanual'] = $totalmanual;

        $return['totalautore'] = $totalautore;
        $return['sql1monthp'] = $sql1monthp;
        $return['total3monthp'] = $total3monthp;
        $return['total6monthp'] = $total6monthp;
        $return['total12monthp'] = $total12monthp;
        return $return;
    }

    function invoice($id = null) {
        $this->loadModel('Transaction');
        $data = $this->Transaction->query("SELECT *  FROM transactions  tr
        left join package_customers pc on tr.package_customer_id = pc.id
        left join psettings ps on pc.psetting_id = ps.id
        left join packages p on ps.package_id = p.id
        left join custom_packages cp on pc.custom_package_id = cp.id
        WHERE  tr.id =$id ");
        $this->set(compact('data'));
    }

    function allInvoice($page = 1) {
        $this->loadModel('PackageCustomer');
        $expiredate = trim(date('Y-m-d', strtotime("+25 days")));
        $offset = --$page * $this->per_page;

        $packagecustomers = $this->PackageCustomer->query("SELECT * FROM transactions tr           
            left join package_customers pc on pc.id = tr.package_customer_id
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE tr.next_payment>='" . date('Y-m-d') . "' AND tr.next_payment<='" . $expiredate . "' AND tr.next_payment != 0000-00-00 "
                . "GROUP BY pc.id limit $offset,$this->per_page");

        $temp = $this->PackageCustomer->query("SELECT COUNT(tr.id) as total FROM transactions tr           
            left join package_customers pc on pc.id = tr.package_customer_id            
            WHERE tr.next_payment>='" . date('Y-m-d') . "' AND tr.next_payment<='" . $expiredate . "' AND tr.next_payment != 0000-00-00 "
                . "GROUP BY pc.id");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);
        $this->set(compact('total_page'));
        foreach ($packagecustomers as $data) {
            $pcid = $data['pc']['id'];
            $this->PackageCustomer->id = $pcid;
            $this->PackageCustomer->saveField("printed", 1);
        }
        $mac = count(json_decode($packagecustomers['0']['pc']['mac']));
        $packagecustomers[0]['pc']['mac'] = $mac;

        $return['packagecustomers'] = $packagecustomers; 
        //pr($total_page); exit;
        $return['total_page'] = $total_page;
       
        return $return;
    }

    function passedInvoice() {
        $this->loadModel('PackageCustomer');
        $packagecustomers = $this->PackageCustomer->query("SELECT * FROM transactions  tr            
            left join package_customers pc on pc.id = tr.package_customer_id
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE  pc.printed = 1");
        $return['packagecustomers'] = $packagecustomers;
        return $return;
        $this->set(compact('packagecustomers'));
    }

    function closedInvoice($start = null, $end = null) {
        $this->loadModel('Package_customer');
        $this->loadModel('Transaction');
        $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
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
        $return['packagecustomers'] = $packagecustomers;
        return $return;
    }

    function all_invoice_close() {
        $this->loadModel('Package_customer');
        $this->loadModel('Transaction');
        if ($this->request->is('post') || $this->request->is('put')) {
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
            $clicked = true;
            $this->set(compact('packagecustomers'));
        }
        $this->set(compact('clicked'));
    }

    function invoice_wise_report($invoice = null) {
        $invoice = $this->params['pass'][0];
        $this->loadModel('PackageCustomer');
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id, CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.exp_date,tr.invoice,ps.name, ps.amount, ps.duration,p.name
            FROM package_customers pc
            left join psettings ps on ps.id = pc.psetting_id
            left join transactions tr on pc.id = tr.package_customer_id
            LEFT JOIN packages p ON p.id = ps.package_id 
           where tr.invoice = '" . $invoice . "'");
        $this->set(compact('packagecustomers'));
    }

    function openInvoice25() {
        $this->loadModel('Transaction');
        $expiredate = trim(date('Y-m-d', strtotime("+25 days")));
        $packagecustomers = $this->Transaction->query("SELECT * 
        FROM transactions tr
        LEFT JOIN package_customers pc ON pc.id = tr.package_customer_id
        LEFT JOIN psettings ps ON ps.id = pc.psetting_id
        LEFT JOIN packages p ON p.id = ps.package_id
        WHERE pc.exp_date>='" . date('Y-m-d') . "' AND pc.exp_date<='" . $expiredate . "' AND pc.exp_date != 0000-00-00 "
                . "GROUP BY pc.id");

        $return['packagecustomers'] = $packagecustomers;
        return $return;
    }

    function summeryReport() {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');
        $date = date("'Y-m-d'");
        $expiredate = trim(date('Y-m-d', strtotime("+25 days")));
        //Pdf generate with in 25 days
        $openInvoice = $this->Transaction->query("SELECT count(tr.id) as total FROM transactions tr WHERE tr.status = 'open' AND tr.next_payment >= '" . date('Y-m-d') . "'");
        $passedDueInvoice = $this->Transaction->query("SELECT count(tr.id) as total FROM transactions tr WHERE tr.status = 'open' AND tr.next_payment < '" . date('Y-m-d') . "'");
        $closeInvoice = $this->Transaction->query("SELECT count(tr.id) as total FROM transactions tr WHERE tr.status = 'close'");

        $invoice['open'] = $openInvoice[0][0]['total'];
        $invoice['passed'] = $passedDueInvoice[0][0]['total'];
        $invoice['close'] = $closeInvoice[0][0]['total'];
        $return['invoice'] = $invoice;
        return $return;
    }

    function printed() {
        $this->loadModel('PackageCustomer');
        $packagecustomers = $this->PackageCustomer->query("SELECT pc.id,pc.printed, CONCAT( first_name,' ', middle_name,' ', last_name ) AS name, pc.psetting_id, pc.mac,pc.house_no,
            pc.street,pc.apartment,pc.city,pc.state,pc.zip,pc.exp_date,tr.invoice,ps.name, ps.amount, ps.duration,p.name
            FROM package_customers pc
            left join transactions tr on pc.id = tr.package_customer_id
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
            WHERE exp_date>='" . date('Y-m-d') . "' AND exp_date<='" . $expiredate .
                "' AND exp_date != 0000-00-00 AND auto_r ='no' AND ticket_generated = 0 "
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

    function expcustomers($page, $start, $end) {
        $this->loadModel('PackageCustomer');
        $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
        $conditions = array('PackageCustomer.package_exp_date >=' => $datrange['start'], 'PackageCustomer.package_exp_date <=' => $datrange['end']);
        $customers = $this->PackageCustomer->find('all', array('conditions' => $conditions));

        return $customers;
    }

    function newcustomers($dateRange) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $datrange = json_decode($dateRange, true);
        $dateselected = count($datrange);

        $start = $datrange['start'];
        $end = $datrange['end'];
        $conditions = 'status_histories.status ="sales done" AND status_histories.date >="' . $start . '" AND status_histories.date <="' . $end . '"';
        $sql = "SELECT * FROM package_customers pc                
            LEFT JOIN status_histories ON pc.id = status_histories.package_customer_id           
            left join transactions tr on pc.id = tr.package_customer_id    
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            LEFT JOIN custom_packages cp  ON cp.id = pc.custom_package_id";
        if ($dateselected) {
            $sql .=" WHERE " . $conditions;
        }
        $sql .= " GROUP BY status_histories.package_customer_id order by status_histories.id desc limit 0,200";

        $customers = $this->StatusHistory->query($sql);

        return $customers;
    }

    function call_log($page = 1, $start = null, $end = null) {
        $this->loadModel('Issue');
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;

        $issue = $this->request->data['Role']['issue_id'];
        $agent = $this->request->data['Role']['user_id'];
        $datrange = json_decode($this->request->data['Role']['daterangecalllog'], true);
        $status = $this->request->data['Role']['status'];
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
                $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                $conditions .=" t.created >=' " . $datrange['start'] . "' AND  t.created < '" . $nextday . "' AND ";
            } else {
                $conditions .=" t.created >='" . $datrange['start'] . "' AND  t.created <='" . $datrange['end'] . "' AND ";
            }
        }
        if (isset($issue) && is_numeric($issue)) {
            $conditions .= " tr.issue_id = $issue AND";
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
                         WHERE $conditions order by pc.id desc limit $offset,$this->per_page";

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
        $temp = $this->Track->query("SELECT COUNT(tr.id) as total FROM  tracks tr left JOIN tickets t ON tr.ticket_id = t.id WHERE $conditions");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $this->set(compact('filteredTicket', 'total_page', 'start', 'end'));


        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $return['filteredTicket'] = $filteredTicket;
        $return['total_page'] = $total_page;
        $return['start'] = $start;
        $return['end'] = $end;
        $return['users'] = $users;
        $return['issues'] = $issues;
        $return['roles'] = $roles;
        return $return;
    }

    function criteria() {
        $this->loadModel('Issue');
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $clicked = true;
            $this->set(compact(''));
        }
        $this->set(compact('clicked'));
    }

    function getTotalCall() {
        $this->loadModel('Ticket');
        $date = date("Y-m-d");
        $call = $this->Ticket->query("SELECT count(id) as total_call FROM tickets WHERE CAST(modified as DATE) = '$date'");
        return $call[0][0]['total_call'];
    }

    function getTotalSalesQuery($start = null, $end = null) {
        $this->loadModel('StatusHistory');
        $sql = "SELECT count(id) as request FROM status_histories WHERE date >= '" . $start . "' AND  date <='" . $end . "' AND status = 'sales query' ";
        $request = $this->StatusHistory->query($sql);
        return $request[0][0]['request'];
    }

    function getTotalHold($start = null, $end = null) {
        $this->loadModel('StatusHistory');
        $hold = $this->StatusHistory->query("SELECT count(status) as hold FROM status_histories WHERE date >= '" . $start . "' AND status_histories.date <='" . $end . "' and status = 'hold'");
        return $hold[0][0]['hold'];
    }

    function getTotalUnhold($start = null, $end = null) {
        $this->loadModel('StatusHistory');
        $unhold = $this->StatusHistory->query("SELECT count(status) as unhold FROM status_histories WHERE date >= '" . $start . "' AND status_histories.date <='" . $end . "' and status = 'unhold'");
        return $unhold[0][0]['unhold'];
    }

    function getTotalCancel() {
        $this->loadModel('StatusHistory');
        $date = date("Y-m-d");
        $cancel = $this->StatusHistory->query("SELECT count(status) as cancel FROM status_histories WHERE date >= '$start' and status = 'canceled'");
        return $cancel[0][0]['cancel'];
    }

    function getTotalDone($start = null, $end = null) {
        $this->loadModel('StatusHistory');

        $done = $this->StatusHistory->query("SELECT count(status) as done FROM status_histories WHERE date >= '" . $start . "' AND date <='" . $end . "' and status = 'sales done'");
        return $done[0][0]['done'];
    }

    function getTotalReconnection($start = null, $end = null) {
        $this->loadModel('StatusHistory');

        $reconnection = $this->StatusHistory->query("SELECT count(status) as reconnection FROM status_histories WHERE date >= '" . $start . "' AND status_histories.date <='" . $end . "' and status = 'reconnection'");
        return $reconnection[0][0]['reconnection'];
    }

    function getTotalFullServiceCancel() {
        $this->loadModel('StatusHistory');
        $today = date("Y-m-d");
        $servicecancel = $this->StatusHistory->query("SELECT count(status) as servicecancel FROM status_histories WHERE date >= '$today' and LOWER(status) = 'Request to cancel'");
        return $servicecancel[0][0]['servicecancel'];
    }

    function getTotalCancelDueBill() {
        $this->loadModel('StatusHistory');
        $today = date("Y-m-d");
        $cancelduebill = $this->StatusHistory->query("SELECT count(status) as cancelduebill FROM status_histories WHERE date = '$today' and status = 'cancel from due bill'");
        return $cancelduebill[0][0]['cancelduebill'];
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

    function getTotalInstallation() {
        $this->loadModel('PackageCustomer');
        $today = date('Y-m-d');
        $data = $this->PackageCustomer->query("SELECT count(status) as installation FROM package_customers WHERE date = '$today'  and status = 'installation'");
        return $data[0][0]['installation'];
    }

    function getTotalCallBySatatus($status = null, $start = null, $end = null) {
        $this->loadModel('Track');

        $start = $start . ' 00:00:00';
        $end = $end . ' 23:59:59';
        $sql = "SELECT COUNT(DISTINCT(tracks.ticket_id)) as total FROM tracks " .
                "LEFT JOIN issues ON tracks.issue_id = issues.id " .
                " WHERE LOWER(issues.name) = '$status' AND tracks.created >='" . $start . "' AND tracks.created <='" . $end . "'";
        $data = $this->Track->query($sql);
        return $data[0][0]['total'];
    }

    function getTotalCardinfotaken($start = null, $end = null) {
        $this->loadModel('Transaction');
        $sql = "SELECT count(DISTINCT card_no) as cardinfotaken FROM transactions WHERE CAST(transactions.created as DATE) >= '" . $start . "' AND CAST(transactions.created as DATE) <='" . $end .
                "' AND transactions.pay_mode = 'card' AND card_no !='' AND auto_recurring = 0";
        $cardinfotaken = $this->Transaction->query($sql);

        return $cardinfotaken[0][0]['cardinfotaken'];
    }

    function supportCall($start = null, $end = null) {
        $this->loadModel('Issue');
        $this->loadModel('Track');
        $this->loadModel('StatusHistory');
        $sql = "SELECT COUNT(DISTINCT(tracks.ticket_id)) as totalSupport FROM tracks        
        LEFT JOIN tickets ON tracks.ticket_id = tickets.id 
         WHERE CAST(tickets.created as DATE) >='" . $start . "' AND CAST(tickets.created as DATE) <='" . $end . "'";
        $data = $this->Track->query($sql);
        $sql = "SELECT count(DISTINCT package_customer_id) as requested FROM status_histories WHERE (status_histories.date) >= '" . $start .
                "' AND status_histories.date <='" . $end . "'  and status = 'requested'";
        $requested = $this->StatusHistory->query($sql);
        $totalIBCS = ($data[0][0]['totalSupport'] - $this->accountCall($start, $end)) + $requested[0][0]['requested']; //total in bound call DCC
        return $totalIBCS;
    }

    function addsalesReceive($start = null, $end = null) { //ADDITIONAL SALES RECEIVE
        $this->loadModel('Issue');
        $this->loadModel('Track');

        $start = $start . ' 00:00:00';
        $end = $end . ' 23:59:59';

        $sql = "SELECT COUNT(DISTINCT(tracks.ticket_id)) as addsalesreceive FROM tracks 
                 LEFT JOIN issues ON tracks.issue_id = issues.id 
                 LEFT JOIN tickets ON tracks.ticket_id = tickets.id 
                 WHERE (issues.name = '2nd Box' 
                 or issues.name = '3rd Box' 
                 or issues.name = '2nd & 3rd Box' 
                 or issues.name = '4th Box' 
                 or issues.name = '3rd & 4th Box' 
                 or issues.name = '4th & 5th Box' 
                 or issues.name = '5th Box')  
                 AND tickets.created >='" . $start . "' AND tickets.created <='" . $end . "'";

        $data = $this->Track->query($sql);
        return $data[0][0]['addsalesreceive'];
    }

    function totalOutbound($start = null, $end = null) { //Total out bound call
        $this->loadModel('Issue');
        $this->loadModel('Track');

        $start = $start . ' 00:00:00';
        $end = $end . ' 23:59:59';

        $sql = "SELECT COUNT(DISTINCT(tracks.ticket_id)) as totaloutbound FROM tracks 
                 LEFT JOIN issues ON tracks.issue_id = issues.id 
                 LEFT JOIN tickets ON tracks.ticket_id = tickets.id 
                 WHERE LOWER(issues.name) LIKE  '%outbound%'  
                 AND tickets.created >='" . $start . "' AND tickets.created <='" . $end . "'";

        $data = $this->Track->query($sql);
        return $data[0][0]['totaloutbound'];
    }

    function accountCall($start = null, $end = null) {
        $this->loadModel('Issue');
        $this->loadModel('Track');
        $start = $start . ' 00:00:00';
        $end = $end . ' 23:59:59';

        $sql = "SELECT COUNT(DISTINCT(tracks.ticket_id)) as totalAccount FROM tracks 
                 LEFT JOIN issues ON tracks.issue_id = issues.id 
                 LEFT JOIN tickets ON tracks.ticket_id = tickets.id 
                 WHERE (issues.name = 'Billing Problem' 
                 or issues.name = 'Calling Card' 
                 or issues.name = 'Card Info Taken' 
                 or issues.name = 'Declined Card Outbound' 
                 or issues.name = 'Due Bill Out Bound' 
                 or issues.name = 'Wants to pay' 
                 or issues.name = 'Referral Issue' 
                 or issues.name = 'Security Deposit Issue' 
                 or issues.name = 'Promotional package' 
                 or issues.name = 'Box Expired'  
                 or issues.name = 'MONEY ORDER ONLINE PAYMENT')  
                 AND tickets.created >='" . $start . "' AND tickets.created <='" . $end . "'";

        $data = $this->Track->query($sql);
        return $data[0][0]['totalAccount'];
    }

    function overAllreport($start, $end) {
        $total = array();
        //$total['call'] = $this->getTotalCall();
        //$total['cancel'] = $this->getTotalCancel(); 
        $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
        $start = $datrange['start'];
        $end = $datrange['end'];
        $total['sales_query'] = $this->getTotalSalesQuery($start, $end);

        // $total[0] = $total['done'] + $total['ready'];
        // $total['installation'] = $this->getTotalInstallation();

        $total['hold'] = $this->getTotalHold($start, $end);
        $total['unhold'] = $this->getTotalUnhold($start, $end);
        $total['reconnection'] = $this->getTotalReconnection($start, $end);
        $total['done'] = $this->getTotalDone($start, $end);

//            $total['ready'] = $this->getTotalNewordertaken();
//            $total['servicecancel'] = $this->getTotalFullServiceCancel();
//            $total['cancelduebill'] = $this->getTotalCancelDueBill();

        $total['cardinfotaken'] = $this->getTotalCardinfotaken($start, $end);
        $total['check_send'] = $this->getTotalCallBySatatus('check send', $start, $end);
        $total['vod'] = $this->getTotalCallBySatatus('vod', $start, $end);
        $total['interruption'] = $this->getTotalCallBySatatus('service interruption', $start, $end);
        $total['cancel'] = $this->getTotalCallBySatatus('service cancel', $start, $end);
        $total['cancel_from_da'] = $this->getTotalCallBySatatus('cancel from dealer & agent', $start, $end);
        $total['cancel_from_hold'] = $this->getTotalCallBySatatus('cancel from hold', $start, $end);
        //$total['card_info_taken'] = $this->getTotalCallBySatatus('card info taken');
        $total['additional_box'] = $this->getTotalCallBySatatus('additional box installation', $start, $end);
        $total['online_payment'] = $this->getTotalCallBySatatus('MONEY ORDER ONLINE PAYMENT', $start, $end);
        $this->getTotalCallBySatatus('check send', $start, $end);
        $total['addsalesreceive'] = $this->addsalesReceive($start, $end);
        $total['totalSupport'] = $this->supportCall($start, $end);
        $total['totaloutbound'] = $this->totalOutbound($start, $end);

        $total['totalAccount'] = $this->accountCall($start, $end);
        $total['inbound'] = $total['totalSupport'] + $total['totalAccount'] +
                $total['done'] + $total['sales_query'] + $total['reconnection'] + $total['cardinfotaken']
                // + $total['check_send'] + $total['vod'] 
//                    + $total['interruption']+ $total['online_payment'] + $total['cancel_from_hold']
                + $total['addsalesreceive'] + $total['cancel'] +
                $total['cancel_from_da'] + $total['unhold'];


        $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
        $start1 = $datrange['start'];
        $start = date("m-d-Y", strtotime($start1));
        $end1 = $datrange['end'];
        $end = date("m-d-Y", strtotime($end1));

        $date = ($start . ' ' . 'To' . ' ' . $end);

        $return['date'] = $date;
        $return['total'] = $total;
        return $return;
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

    function all($page = 1, $start = null, $end = null, $pay_mode = null) {
        $this->loadModel('Issue');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('PackageCustomer');
        $loggedUser = $this->Auth->user();
        $role_name = $loggedUser['Role']['name'];
        $action = 0;
        $data = array();
        if ($this->request->is('post')) {

            $action = strtolower($this->request->data['Role']['action']);
            if ($action == 'newcustomer') {
                $data = $this->newcustomers($this->request->data['Role']['daterangeonly']);
            }
            if ($action == 'paymenthistory') {
                $data = $this->payment_history($page = 1, $start = null, $end = null, $pay_mode = null);
            }
            if ($action == 'cancel') {
                $data = $this->cancel();
            }
            if ($action == 'expirecustomer') {
                $data = $this->expcustomers($page = 0, $start = null, $end = null);
            }
            if ($action == 'calllog') {
                $data = $this->call_log($page = 1, $start = null, $end = null);
            }

            if ($action == 'allautorecurring') {
                $data = $this->allautorecurring($page = 1, $start = null, $end = null);
            }

            if ($action == 'successful') {
                $data = $this->successful($page = 1, $start = null, $end = null);
            }

            if ($action == 'failed') {
                $data = $this->failed($page = 1, $start = null, $end = null);
            }

            if ($action == 'summeryreport') {
                $data = $this->summeryreport($start = null, $end = null);
            }

            if ($action == 'allinvoice') {
                $data = $this->allInvoice();
            }

            if ($action == 'openinvoice25') {
                $data = $this->openinvoice25();
            }
            if ($action == 'passedinvoice') {
                $data = $this->passedinvoice();
            }

            if ($action == 'closedinvoice') {
                $data = $this->closedinvoice($start = null, $end = null);
            }

            if ($action == 'customerbyloaction') {
                $data = $this->customerbyloaction();
            }

            if ($action == 'customersummary') {
                $data = $this->customerSummary();
            }

            if ($action == 'overallreport') {
                $data = $this->overAllreport($start = null, $end = null);
            }
        }

        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        $this->set(compact('data', 'action', 'users', 'issues', 'roles', 'role_name'));
    }

    function allAutorecurring($page = 1, $start = null, $end = null, $pay_mode = null) { //Auto recurring data all
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $offset = --$page * $this->per_page;

        if (isset($this->request->data['Role'])) {
            $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
//            pr($datrange); exit;
            $start = $datrange['start'];
            $end = $datrange['end'];
        }
        $allData = $this->PackageCustomer->query("SELECT * 
                    FROM package_customers pc
                    LEFT JOIN users u ON pc.technician_id = u.id
                    LEFT JOIN psettings ps ON ps.id = pc.psetting_id
                    LEFT JOIN custom_packages cp ON cp.id = pc.custom_package_id
                    WHERE pc.auto_r =  'yes' and pc.r_form >='" . $start . "' AND pc.r_form <='" . $end . "'  order by pc.id desc" . " LIMIT " . $offset . "," . $this->per_page);

        if (count($datrange)) {
            $sql = "SELECT SUM(pc.payable_amount) as total FROM package_customers pc
                left join transactions tr on pc.id = tr.package_customer_id
                WHERE pc.auto_r =  'yes' and pc.r_form >='$start' AND pc.r_form <='$end'";
        } else {
            $sql = "SELECT SUM(pc.payable_amount) as total FROM package_customers pc
                left join transactions tr on pc.id = tr.package_customer_id
                WHERE pc.auto_r =  'yes'";
        }
        $temp = $this->Transaction->query($sql);
        $totalPayment = $temp[0][0]['total'];
        $totalPayment = round($totalPayment, 2);

        $sql = "SELECT COUNT(pc.id) as total FROM package_customers pc
                left join transactions tr on pc.id = tr.package_customer_id
                WHERE pc.auto_r =  'yes' and pc.r_form >='" . $start . "' AND pc.r_form <='" . $end . "'";
        $temp = $this->Transaction->query($sql);
        $totalCustomer = $temp[0][0]['total'];

        $temp = $this->PackageCustomer->query("SELECT COUNT(pc.id) as total FROM package_customers pc WHERE pc.auto_r =  'yes' and pc.r_form >='" . $start . "' AND pc.r_form <='" . $end . "'");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $return['allData'] = $allData;
        $return['total_page'] = $total_page;
        $return['start'] = $start;
        $return['end'] = $end;
        $return['totalCustomer'] = $totalCustomer;
        $return['totalPayment'] = $totalPayment;

        return $return;
    }

    function successful($page = 1, $start = null, $end = null) { //Auto recurring data success
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $offset = --$page * $this->per_page;

        if (isset($this->request->data['Role'])) {
            $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
            $start = $datrange['start'];
            $end = $datrange['end'];
        }

        $sql = "SELECT * 
                    FROM transactions
                    LEFT JOIN package_customers ON package_customers.id = transactions.package_customer_id
                    LEFT JOIN psettings ON psettings.id = package_customers.psetting_id
                    LEFT JOIN custom_packages ON custom_packages.id = package_customers.custom_package_id
                    WHERE transactions.auto_recurring = 1
                    AND  transactions.status =  'success' AND CAST(transactions.created as DATE) >='" .
                $start . "' AND CAST(transactions.created as DATE) <='" . $end .
                "' order by transactions.id desc" . " LIMIT " . $offset . "," . $this->per_page;
        $allData = $this->PackageCustomer->query($sql);

        $sql = "SELECT SUM(payable_amount) as total FROM transactions 
                WHERE transactions.auto_recurring = 1 AND transactions.status =  'success' AND CAST(transactions.created as DATE) >='" .
                $start . "' AND CAST(transactions.created as DATE) <='" . $end . "'";
        $temp = $this->Transaction->query($sql);
        $totalPayment = $temp[0][0]['total'];
        $totalPayment = round($totalPayment, 2);

        $sql = "SELECT COUNT(id) as total FROM transactions 
                WHERE transactions.auto_recurring = 1 AND transactions.status =  'success' AND CAST(transactions.created as DATE) >='" .
                $start . "' AND CAST(transactions.created as DATE) <='" . $end . "'";
        $temp = $this->Transaction->query($sql);
        $totalCustomer = $temp[0][0]['total'];


        $temp = $this->Transaction->query("SELECT COUNT(transactions.id) as total FROM transactions WHERE
                transactions.auto_recurring = 1 AND  transactions.status =  'success' AND 
                    CAST(transactions.created as DATE) >='" .
                $start . "' AND CAST(transactions.created as DATE) <='" . $end . "'");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $return['allData'] = $allData;
        $return['total_page'] = $total_page;
        $return['start'] = $start;
        $return['end'] = $end;
        $return['totalCustomer'] = $totalCustomer;
        $return['totalPayment'] = $totalPayment;
        return $return;
    }

    function failed($page = 1, $start = null, $end = null) { //Auto recurring data error
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $offset = --$page * $this->per_page;

        if (isset($this->request->data['Role'])) {
            $datrange = json_decode($this->request->data['Role']['daterangeonly'], true);
            $start = $datrange['start'];
            $end = $datrange['end'];
        }

        $data = $this->Ticket->query("SELECT * FROM tickets t
                    left JOIN tracks tr ON t.id = tr.ticket_id
                    left join package_customers pc on tr.package_customer_id = pc.id
                    LEFT JOIN psettings ON psettings.id = pc.psetting_id
                    LEFT JOIN custom_packages ON custom_packages.id = pc.custom_package_id
                    WHERE t.auto_recurring != 0 and pc.r_form >='" . $start . "' AND pc.r_form <='" . $end .
                "' GROUP BY t.id" . " LIMIT " . $offset . "," . $this->per_page);

        $sql = "SELECT SUM(t.auto_recurring) as total FROM tickets t
                    left JOIN tracks tr ON t.id = tr.ticket_id
                    left join package_customers pc on tr.package_customer_id = pc.id 
                    WHERE t.auto_recurring != 0 and pc.r_form >='" . $start . "' AND pc.r_form <='" . $end . "'";
        $temp = $this->Ticket->query($sql);
        $totalPayment = $temp[0][0]['total'];
        $totalPayment = round($totalPayment, 2);

        $sql = "SELECT COUNT(t.id) as total FROM tickets t
                    left JOIN tracks tr ON t.id = tr.ticket_id
                    left join package_customers pc on tr.package_customer_id = pc.id
                    WHERE t.auto_recurring != 0 and pc.r_form >='" . $start . "' AND pc.r_form <='" . $end . "'";
        $temp = $this->Ticket->query($sql);
        $totalCustomer = $temp[0][0]['total'];


        $temp = $this->PackageCustomer->query("SELECT COUNT(t.id) as total  FROM tickets t 
                    WHERE t.auto_recurring != 0 and CAST(t.created as DATE) >='" . $start . "' AND CAST(t.created as DATE) <='" . $end . "'");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $return ['data'] = $data;
        $return['total_page'] = $total_page;
        $return['totalPayment'] = $totalPayment;
        $return['totalCustomer'] = $totalCustomer;
        $return['start'] = $start;
        $return['end'] = $end;
        return $return;
    }

    function customerFilter($status = 0, $system = 0) {
        $this->loadModel('PackageCustomer');
        $sql = "SELECT count(id) as total FROM`package_customers`WHERE LOWER(system) LIKE  '%$system%' AND LOWER(status) = '$status' ";
        $temp = $this->PackageCustomer->query("SELECT count(id) as total FROM`package_customers`WHERE LOWER(system) LIKE  '%$system%' AND LOWER(status) = '$status' ;");
        return $temp[0][0]['total'];
    }

    function customerSummary() {
        $active = array();

        //Active
        $active['cms1'] = $this->customerFilter('active', 'cms1') + $this->customerFilter('done', 'cms1');
        $active['cms2'] = $this->customerFilter('active', 'cms2') + $this->customerFilter('done', 'cms2');
        $active['cms3'] = $this->customerFilter('active', 'cms3') + $this->customerFilter('done', 'cms3');
        $active['portal'] = $this->customerFilter('active', 'portal') + $this->customerFilter('done', 'portal');
        $active['portal1'] = $this->customerFilter('active', 'portal1') + $this->customerFilter('done', 'portal1');

        //Canceled
        $canceled['cms1'] = $this->customerFilter('canceled', 'cms1');
        $canceled['cms2'] = $this->customerFilter('canceled', 'cms2');
        $canceled['cms3'] = $this->customerFilter('canceled', 'cms3');
        $total['portal'] = $this->customerFilter('canceled', 'portal');
        $canceled['portal1'] = $this->customerFilter('canceled', 'portal1');
        $canceled['portal'] = $total['portal'] - $canceled['portal1'];


        //Hold
        $hold = array();
        $hold['cms1'] = $this->customerFilter('hold', 'cms1');
        $hold['cms2'] = $this->customerFilter('hold', 'cms2');
        $hold['cms3'] = $this->customerFilter('hold', 'cms3');
        $total['portal'] = $this->customerFilter('hold', 'portal');

        $hold['portal1'] = $this->customerFilter('hold', 'portal1');

        $hold['portal'] = $total['portal'] - $active['portal1'];

        //Unhold
        $unhold['cms1'] = $this->customerFilter('unhold', 'cms1');
        $unhold['cms2'] = $this->customerFilter('unhold', 'cms2');
        $unhold['cms3'] = $this->customerFilter('unhold', 'cms3');
        $total['portal'] = $this->customerFilter('unhold', 'portal');

        $unhold['portal1'] = $this->customerFilter('unhold', 'portal1');

        $unhold['portal'] = $total['portal'] - $active['portal1'];



        //Total        
        $total_active = $active['cms1'] + $active['cms2'] + $active['cms3'] + $active['portal'] + $active['portal1'];

        $total_canceled = $canceled['cms1'] + $canceled['cms2'] + $canceled['cms3'] + $canceled['portal'] + $canceled['portal1'];
        $total_hold = $hold['cms1'] + $hold['cms2'] + $hold['cms3'] + $hold['portal'] + $hold['portal1'];
        $total_unhold = $unhold['cms1'] + $unhold['cms2'] + $unhold['cms3'] + $unhold['portal'] + $unhold['portal1'];

        $return['active'] = $active;
        $return['hold'] = $hold;
        $return['unhold'] = $unhold;
        $return['canceled'] = $canceled;
        $return['total_active'] = $total_active;
        $return['total_canceled'] = $total_canceled;
        $return['total_hold'] = $total_hold;
        $return['total_unhold'] = $total_unhold;
        return $return;
    }

}

?>