<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');

require_once(APP . 'Vendor' . DS . 'class.upload.php');
App::import('Controller', 'Payments');
App::import('Controller', 'Reports');

class CustomersController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
        // database name must be picture, attachment
        $this->img_config = array(
            'picture' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 50,
                'image_y' => 40
            ),
            'attachment' => array(
                'image_ratio_crop' => false,
            ),
            'parent_dir' => 'pictures',
            'target_path' => array(
                'picture' => WWW_ROOT . 'pictures' . DS,
                'attachment' => WWW_ROOT . 'attchment' . DS
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

    function processAttachment($img) {
        $upload = new Upload($img['attachment']);
        $upload->file_new_name_body = time();
        foreach ($this->img_config['attachment'] as $key => $value) {
            $upload->$key = $value;
        }
        $upload->process($this->img_config['target_path']['attachment']);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }

        $return['file_dst_name'] = $upload->file_dst_name;
        return $return;
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
        }
        $data = array();
        $data['customer'] = $customer;
        $data['package'] = $package;
        return $data;
    }

    function updatePackageCustomerTable($data = array()) {
        if (isset($data['mac'])) {
            $data['mac'] = json_encode($data['mac']);
            $data['system'] = json_encode($data['system']);
        }
        $this->loadModel('PackageCustomer');

        $this->loadModel('CustomPackage');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $tmsg = 'Information of  ' . $data['first_name'] . '  ' .
                $data['middle_name'] . '  ' .
                $data['last_name'] . ' has been updated';

        //For Custom Package data insert
        $data4CustomPackage['CustomPackage']['duration'] = $data['duration'];
        $data4CustomPackage['CustomPackage']['charge'] = $data['charge'];
        if (!empty($data['charge'])) {
            //save data into custom_package table
            
            $cp = $this->CustomPackage->save($data4CustomPackage);
            unset($cp['CustomPackage']['PackageCustomer']);
            //from custom_package table, save custom package id to package_customer table
            $data['custom_package_id'] = $cp['CustomPackage']['id'];
        }
        // if custom package is changed then custom_package_id will be reset to 0
        if (!isset($data['CustomPackage'])) {
            $data['custom_package_id'] = 0;
        }
        //Ends Custom_package data entry  
        $this->PackageCustomer->id = $data['id'];
       
        $this->PackageCustomer->save($data);
    }

    function searchbyinvoice($id = null) {

        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            //  echo 'hello';  
            $id = $this->request->data['Transaction']['id'];
            $trinfo = $this->Transaction->query("SELECT * FROM `transactions` tr
            left join package_customers  pc on tr.package_customer_id =pc.id 
            where tr.id = $id");
            $clicked = true;
            $this->set(compact('trinfo'));
        }
        $this->set(compact('clicked'));
    }

    function update_status() {
        $data4statusHistory = array();
        $this->loadModel('StatusHistory');
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
        $this->PackageCustomer->saveField("status", $this->request->data['PackageCustomer']['status']);
        $this->PackageCustomer->saveField("date", $this->getFormatedDate($this->request->data['PackageCustomer']['date']));
        $data4statusHistory['StatusHistory'] = array(
            'package_customer_id' => $this->request->data['PackageCustomer']['id'],
            'date' => $this->request->data['PackageCustomer']['date'],
            'status' => $this->request->data['PackageCustomer']['status'],
        );
        $this->StatusHistory->save($data4statusHistory);
        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Status updated Successfully! </strong>
    </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function update_auto_recurring() {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');
        $dateObj = $this->request->data['Transaction']['exp_date'];
        $this->request->data['Transaction']['r_form'] = date('Y-m-d', strtotime($this->request->data['Transaction']['r_form']));
        $this->request->data['Transaction']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
        $timestamp = strtotime($this->request->data['Transaction']['r_form']) + $this->request->data['Transaction']['r_duration'] * 24 * 60 * 60; // +strtotime($this->request->data['Transaction']['r_duration'].' days');
        $next_payment_date = date('Y-m-d', $timestamp);
        $this->request->data['Transaction']['next_payment'] = $next_payment_date;
        $this->request->data['Transaction']['pay_mode'] = 'card';

        $this->Transaction->save($this->request->data);
        $this->PackageCustomer->id = $this->request->data['Transaction']['package_customer_id'];
        $this->PackageCustomer->save($this->request->data['Transaction']);

        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Auto recurring updated Successfully! </strong>
    </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function updatecardinfo() {
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->request->data['Transaction']['user_id'] = $user_id;
        $this->request->data['Transaction']['status'] = 'update';
        $this->request->data['Transaction']['exp_date'] = $this->request->data['Transaction']['exp_date']['month'] . '/' . substr($this->request->data['Transaction']['exp_date']['year'], -2);
   
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Card information updated successfully </strong>
            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function getOpenInvoice($pcid = null) {
        $this->loadModel('Transaction');
        return $this->Transaction->query("SELECT *  FROM transactions 
left join package_customers on transactions.package_customer_id = package_customers.id
left join psettings on package_customers.psetting_id = psettings.id
left join packages on psettings.package_id = packages.id
left join custom_packages on package_customers.custom_package_id = custom_packages.id
WHERE  transactions.package_customer_id = $pcid and transactions.status = 'open' order by transactions.id DESC;");
    }

    function getStatements($id = null) {
        $statements = $this->Transaction->query("SELECT *
            FROM transactions tr			
            LEFT JOIN package_customers pc ON pc.id = tr.package_customer_id			
            LEFT JOIN psettings ps ON ps.id = pc.psetting_id			
            LEFT JOIN packages p ON p.id = ps.package_id			
            LEFT JOIN custom_packages cp ON cp.id = pc.custom_package_id			
            WHERE pc.id = $id AND (tr.status = 'open' OR tr.status ='close')"
        );

        $return = array();
        foreach ($statements as $index => $statement) {
            $package = 'No package Selected';
            if (!empty($statement['ps']['id'])) {
                $package = $statement['ps']['name'];
            } else if (!empty($statement['cp']['id'])) {
                $package = $statement['cp']['duration'] . ' Months Custom Package ' . $statement['cp']['charge'] . '$';
            }

            $paid = $this->Transaction->query("SELECT *
            FROM transactions tr			
            WHERE transaction_id = " . $statement['tr']['id']
            );
            $return[] = array(
                'bill' => $statement['tr'],
                'payment' => $paid,
                'package' => $package
            );
        }
        return $return;
    }

    function edit($id = null) {
        $this->loadModel('StatusHistory');
        $pcid = $id;
        $loggedUser = $this->Auth->user();
        $user = $loggedUser['Role']['name'];        
        if ($this->request->is('post') || $this->request->is('put')) {
            // update package_customers table
            $this->request->data['PackageCustomer']['id'] = $id;
            
            $this->updatePackageCustomerTable($this->request->data['PackageCustomer']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Customer information updated successfully </strong>
            </div>';
            $this->Session->setFlash($msg);
        }
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $customer_info = $this->PackageCustomer->findById($pcid);
        $this->request->data = $customer_info;
        $payment = new PaymentsController();
        $latestcardInfo = $payment->getLastCardInfo($pcid);
        unset($customer_info['PackageCustomer']['email']);
        unset($customer_info['PackageCustomer']['exp_date']);
        unset($customer_info['PackageCustomer']['payable_amount']);
        unset($customer_info['PackageCustomer']['cvv_code']);
        unset($customer_info['PackageCustomer']['zip_code']);
        $this->request->data['Transaction'] = $customer_info['PackageCustomer'] + $latestcardInfo;
        $nextPay = $this->Transaction->find('first', array('conditions' => array('Transaction.package_customer_id' => $pcid, 'Transaction.status' => 'open'), 'order' => array('Transaction.id' => 'DESC')));
        if (count($nextPay)) {
            $this->request->data['NextTransaction'] = $nextPay['Transaction'];
            $this->request->data['NextTransaction']['exp_date'] = $nextPay['Transaction']['next_payment'];
        }
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


        $transactions = $this->Transaction->find('all', array('conditions' => array('Transaction.package_customer_id' => $id)));

        $this->set(compact('transactions', 'customer_info', 'c_acc_no', 'macstb', 'custom_package_duration', 'checkMark', 'statusHistories'));

//        Ticket History
        $response = $this->getAllTickectsByCustomer($id);
        $data = $response['data'];
        $users = $response['users'];
        $roles = $response['roles'];
        $this->set(compact('data', 'users', 'roles', 'customer_info'));
//        End Ticket History
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
        $ym = $this->getYm();
        $this->loadModel('Transaction');
        $invoices = $this->getOpenInvoice($pcid);
        $statements = $this->getStatements($pcid);
        $this->set(compact('invoices', 'statements', 'packageList', 'psettings', 'ym', 'custom_package_charge', 'user'));
    }

    function send($param = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
//        $this->loadModel('Setting');

        $sql = "SELECT * FROM transactions 
                left join package_customers on transactions.package_customer_id = package_customers.id
                left join psettings on package_customers.psetting_id = psettings.id
                left join packages on psettings.package_id = packages.id
                left join custom_packages on package_customers.custom_package_id = custom_packages.id
                WHERE  transactions.id = $param";
        $invoices = $this->Transaction->query($sql);
//                
//        
//        $emails = $this->Setting->find('first', array(
//            'conditions' => array('field' => 'email')
//        ));

        $from = 'si.totaltvs@gmail.com';
        $subject = "Invoice of Transaction";
        $cus_name = $invoices[0]['package_customers']['middle_name'];
        $email_custom = $invoices[0]['package_customers']['email'];
        $to = array('farukmscse@gmail.com', 'sattar.kuet@gmail.com');

        $phone_num = $invoices[0]['transactions']['phone'];
        $description = $invoices[0]['package_customers']['comments'];
        $mail_content = array($invoices[0]);
        //sendEmail($from,$name,$to,$subject,$body)
        sendInvoice($from, $cus_name, $to, $subject, $mail_content);
        // End send mail
//        $this->set(compact('invoices'));
        return $this->redirect(array('controller' => 'customers', 'action' => 'edit', $invoices[0]['package_customers']['id']));
    }

    function registration() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->loadModel('CustomPackage');
        $this->loadModel('PaidCustomer');
        $this->loadModel('Country');
        $this->loadModel('Comment');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Issue');
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['PackageCustomer']['status'] = 'requested';

            if ($this->request->data['PackageCustomer']['shipment_equipment'] == 'OTHER') {
                $this->request->data['PackageCustomer']['shipment_equipment'] = $this->request->data['PackageCustomer']['shipment_equipment_other'];
            }
            //$this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
            //For Custom Package data insert//
            if (!empty($this->request->data['PackageCustomer']['charge'])) {
                $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
                $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];
                $cp = $this->CustomPackage->save($data4CustomPackage);
                unset($cp['CustomPackage']['PackageCustomer']);
                $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
            }
            $this->PackageCustomer->set($this->request->data);

            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
            if (!empty($this->request->data['PackageCustomer']['attachment']['name'])) {
                $result = $this->processAttachment($this->request->data['PackageCustomer']);
                $this->request->data['PackageCustomer']['attachment'] = $result['file_dst_name'];
            } else {
                $this->request->data['PackageCustomer']['attachment'] = '';
            }
            $date = date('Y-m-d');
            $this->request->data['PackageCustomer']['date'] = $date;

            $pc = $this->PackageCustomer->save($this->request->data['PackageCustomer']);

            $data4statusHistory = array();
            $data4statusHistory['StatusHistory'] = array(
                'package_customer_id' => $pc['PackageCustomer']['id'],
                'date' => date('m/d/Y'),
                'status' => $this->request->data['PackageCustomer']['status'],
            );

            $this->StatusHistory->save($data4statusHistory);
//            data for comment
            $comment['Comment']['package_customer_id'] = $pc['PackageCustomer']['id'];
            $loggedUser = $this->Auth->user();
            $comment['Comment']['user_id'] = $loggedUser['id'];
            $comment['Comment']['content'] = $this->request->data['PackageCustomer']['comments'];
            $this->Comment->save($comment);

            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Package customer edited succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }

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
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'issues'));
        //*************** End Package List ******************
        $ym = $this->getYm();
        $this->set(compact('ym'));
        //   $this->loadModel('User');
        //   $this->loadModel('Role');
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
    }

    function edit_registration($id = null) {
        $pcid = $id;
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->loadModel('Issue');
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

            if (!empty($this->request->data['PackageCustomer']['attachment']['name'])) {
                $result = $this->processAttachment($this->request->data['PackageCustomer']);
                $this->request->data['PackageCustomer']['attachment'] = $result['file_dst_name'];
            } else {
                $this->request->data['PackageCustomer']['attachment'] = '';
            }

            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            //update last comment
            if ($this->request->data['PackageCustomer']['comment_id']) {
                $this->Comment->id = $this->request->data['PackageCustomer']['comment_id'];
            }
            $loggedUser = $this->Auth->user();
            $commentData['Comment']['user_id'] = $loggedUser['id'];
            $commentData['Comment']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
            $commentData['Comment']['content'] = $this->request->data['PackageCustomer']['comments'];
            $this->Comment->save($commentData);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Cutomer Package Information update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $data = $this->PackageCustomer->findById($id);
        $date = explode('/', $data['PackageCustomer']['exp_date']);
        $yyyy = date('Y');
        $yy = substr($yyyy, 0, 2);
        $yyyy = 0;
        $mm = -1;
        if (count($date) == 2) {
            $yyyy = $yy . '' . $date[1];
            $mm = $date[0];
        }
        $data['PackageCustomer']['exp_date'] = array('year' => $yyyy, 'month' => $mm);
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



        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'latestcardInfo', 'issues'));

//        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'latestcardInfo'));
        //*************** End Package List ****************************************************************************************
        $ym = $this->getYm();

        $lastComment = $this->Comment->find('first', array('conditions' => array('package_customer_id' => $pcid),
            'order' => array('id' => 'DESC')));

        if (count($lastComment)) {
            $lastComment = $lastComment['Comment'];
        } else {
            $lastComment['content'] = '';
            $lastComment['id'] = 0;
        }
        $this->set(compact('ym', 'lastComment'));
    }

    function followup() {
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'requested' AND pc.follow_up = 1");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
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

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

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
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $this->set(compact('filteredData'));
    }

    function ready_installation() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'ready'  OR (pc.follow_up=0 AND pc.status ='requested' AND pc.status != 'old_ready' ) AND shipment =0");

        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

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

                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }

                $filteredData[$index]['issue'] = array();
                if (!empty($data['i']['id'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issue'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function schedule_done() {
        $this->loadModel('User');
        $loggedUser = $this->Auth->user();
        $id = $loggedUser['id'];
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc  
        WHERE pc.technician_id = $id and pc.status = 'scheduled'");
        $this->set(compact('allData'));
    }

    function repair($id = null) {

        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    WHERE pc.id=$id");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

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

    function box_change($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
        $this->PackageCustomer->technician_id = $this->request->data['PackageCustomer']['technician_id'];
        $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);

        $this->request->data['PackageCustomer']['from'] = $datrange['start'];
        $this->request->data['PackageCustomer']['to'] = $datrange['end'];
        $loggedUser = $this->Auth->user();
        $this->request->data['PackageCustomer']['user_id'] = $loggedUser['id'];
        $this->PackageCustomer->save($this->request->data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function done($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->PackageCustomer->id = $this->request->data['Comment']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "done");
        $this->Comment->save($this->request->data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function update_payment($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $this->request->data['NextTransaction']['package_customer_id'];
        $data = array();
        $data['PackageCustomer'] = array(
            'exp_date' => $this->getFormatedDate($this->request->data['NextTransaction']['exp_date']),
            // when change package exp date then these fields will be update
            'ticket_generated' => 0,
            'invoice_no' => 0,
            'invoice_created' => 0,
            'printed' => 0,
            'auto_r' => 'no'
            
        );

      
        
        if ($this->request->data['NextTransaction']['discount'] == '') {
            $this->request->data['NextTransaction']['discount'] = 0;
        }
        
        $pc_data = $this->PackageCustomer->save($data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);

        $data['Transaction'] = array(
            'package_customer_id' => $this->request->data['NextTransaction']['package_customer_id'],
            'note' => $this->request->data['NextTransaction']['note'],
            'discount' => $this->request->data['NextTransaction']['discount'],
            'status' => 'open',
            'invoice' => $pc_data['PackageCustomer']['invoice_no'],
            'next_payment' => $pc_data['PackageCustomer']['exp_date'],
            'payable_amount' => $this->request->data['NextTransaction']['payable_amount']
        );

        $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function ready($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->PackageCustomer->id = $this->request->data['Comment']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "ready");
        $this->Comment->save($this->request->data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function shedule_assian($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Installation');
        $loggedUser = $this->Auth->user();
//        $date = $this->request->data['PackageCustomer']['schedule_date'] . ' ' . $this->request->data['PackageCustomer']['seTime'];
        $temp = explode('/', $this->request->data['PackageCustomer']['schedule_date']); //date format change and insert
        $dateformat = $this->request->data['PackageCustomer']['schedule_date'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1];
        $date = $dateformat . ' ' . $this->request->data['PackageCustomer']['seTime'];
        $this->request->data['Installation']['assign_by'] = $loggedUser['id'];
        $this->request->data['Installation']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['schedule_date'] = $date;
        $this->request->data['Installation']['user_id'] = $this->request->data['PackageCustomer']['technician_id'];
        $this->request->data['Installation']['status'] = 'scheduled';
        $this->request->data['PackageCustomer']['schedule_date'] = $date;
        $this->request->data['PackageCustomer']['status'] = 'scheduled';
        $this->PackageCustomer->save($this->request->data);
        $this->Installation->save($this->request->data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function shipment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id                    
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.shipment = 1 AND pc.status ='requested'");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

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
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                $filteredData[$index]['issue'] = array();
                if (!empty($data['i']['id'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issue'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function troubleshot_shipment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE pc.shipment = 2 and approved = 0 and pc.status ='requested' ");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                 $filteredData[$index]['tech'] = $data['ut'];
                
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
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function cancelrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[1] . '/' . $start[2] . '/' . $start[0];
            $end = explode('-', $datrange['end']);
            $end = $end[1] . '/' . $end[2] . '/' . $end[0];
            $conditions = 'pc.cancelled_date >="' . $start . '" AND pc.cancelled_date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to cancel%' and $conditions";
//            echo $sql; exit;
            $allData = $this->PackageCustomer->query($sql);
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
                    if (!empty($data['c']['content'])) {
                        //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
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

                    if (!empty($data['i']['id'])) {
                        $filteredData[$index]['issue'] = $data['i'];
                    }

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
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function holdrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[1] . '/' . $start[2] . '/' . $start[0];
            $end = explode('-', $datrange['end']);
            $end = $end[1] . '/' . $end[2] . '/' . $end[0];
            $conditions = 'pc.hold_date >="' . $start . '" AND pc.hold_date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to unhold%' and $conditions";

            $allData = $this->PackageCustomer->query($sql);
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
                    //  echo 'already exist'.$key.'<br/>';
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
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
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;

            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function unholdrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[1] . '/' . $start[2] . '/' . $start[0];
            $end = explode('-', $datrange['end']);
            $end = $end[1] . '/' . $end[2] . '/' . $end[0];
            $conditions = 'pc.unhold_date >="' . $start . '" AND pc.unhold_date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to unhold%' and $conditions";
            $allData = $this->PackageCustomer->query($sql);
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
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
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
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function reconnectionRequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[1] . '/' . $start[2] . '/' . $start[0];
            $end = explode('-', $datrange['end']);
            $end = $end[1] . '/' . $end[2] . '/' . $end[0];
            $conditions = 'pc.reconnect_date >="' . $start . '" AND pc.reconnect_date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to reconnection%' and $conditions";
            $allData = $this->PackageCustomer->query($sql);
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
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
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
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function wire_problem() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    where LOWER(i.name) = 'wire problem' and approved = 0");
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

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                $filteredData[$index]['comments'] = array();

                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
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
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function troubleshot_technician() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'old_ready'");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

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
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function moving() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    where LOWER(i.name) = 'moving' and approved = 0");
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
                $filteredData[$index]['tech'] = $data['ut'];

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                $filteredData[$index]['comments'] = array();

                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
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
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function remote_problem() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    where LOWER(i.name) = 'remote problem' and approved = 0 and LOWER(pc.status)!= 'scheduled'");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
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
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));

        $this->set(compact('filteredData', 'technician'));
    }

    //duplicate data manage start

    function delete($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('BackupPackageCustomer');
        $cusdata = $this->PackageCustomer->findById($id);
        $cusdata['BackupPackageCustomer'] = $cusdata['PackageCustomer'];

        $this->BackupPackageCustomer->save($cusdata);
        $this->PackageCustomer->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Customer deleted succeesfully and it is stored in trash </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect(array('controller' => 'admins', 'action' => 'servicemanage'));
    }

    function manage_delete_data() {
        $this->loadModel('BackupPackageCustomer');
        $data = $this->BackupPackageCustomer->find('all');
        $this->set(compact('data'));
    }

    function restore($id) {
        $this->loadModel('BackupPackageCustomer');
        $this->loadModel('PackageCustomer');
        $customer = $this->BackupPackageCustomer->findById($id);
        $data['PackageCustomer'] = $customer['BackupPackageCustomer'];
        $this->PackageCustomer->save($data);
        $this->BackupPackageCustomer->delete($id);
        $this->redirect(array('controller' => 'admins', 'action' => 'servicemanage'));
    }

    //duplicate data manage end
}

?>