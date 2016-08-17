<?php

/**
 * 
 */
require_once(APP . 'Vendor' . DS . 'class.upload.php');

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
            pr($upload->error);
            exit;
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
        // pr($temp);
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
//            else {
//                $data['custom_packages']['name'] = 'Custom';
//                $package[] = $data['custom_packages'];
//            }
        }
        $data = array();
        $data['customer'] = $customer;
        $data['package'] = $package;
        return $data;
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
            //  pr($this->request->data); exit;
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
            //    pr($this->request->data); exit;
            if (!empty($this->request->data['PackageCustomer']['attachment']['name'])) {
                $result = $this->processAttachment($this->request->data['PackageCustomer']);
                $this->request->data['PackageCustomer']['attachment'] = $result['file_dst_name'];
            } else {
                $this->request->data['PackageCustomer']['attachment'] = '';
            }
            
            
            $pc = $this->PackageCustomer->save($this->request->data['PackageCustomer']);

            $data4statusHistory = array();
            $data4statusHistory['StatusHistory'] = array(
                'package_customer_id' => $pc['PackageCustomer']['id'],
                'date' => date('m/d/Y'),
                'status' => $this->request->data['PackageCustomer']['status'],
            );
//                        pr($data4statusHistory); exit;
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
        //$data = $this->PackageCustomer->findById($id);
        // $this->request->data = $data;
        //Show Package List 
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
        //  pr($technician); exit;
    }

    function edit_registration($id = null) {
        $pcid = $id;
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->loadModel('Issue');
        if ($this->request->is('post') || $this->request->is('put')) {
            // pr($this->request->data); exit;
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
        $yyyy = $yy . '' . $date[1];
        $mm = $date[0];
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
//        pr($allData); exit;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
        // pr($filteredData);exit;

        $this->set(compact('filteredData'));
    }

    function ready_installation() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'ready'  OR (pc.follow_up=0 AND pc.status ='requested' AND pc.status != 'old_ready' ) AND shipment =0");

        $filteredData = array();
        $unique = array();
        $index = 0;
//         pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
        //   pr($allData);
        //  exit;
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
//        pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
//        pr($technician); exit;

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
        $date = $this->request->data['PackageCustomer']['schedule_date'] . ' ' . $this->request->data['PackageCustomer']['seTime'];

        $this->request->data['Installation']['assign_by'] = $loggedUser['id'];
        $this->request->data['Installation']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['schedule_date'] = $date;
        $this->request->data['Installation']['user_id'] = $this->request->data['PackageCustomer']['technician_id'];
        $this->request->data['Installation']['status'] = 'Scheduled';

        $this->request->data['PackageCustomer']['schedule_date'] = $date;
        $this->request->data['PackageCustomer']['status'] = 'Scheduled';
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
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.shipment = 1");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
//        pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
                $filteredData[$index]['issue'] = array();
                if (!empty($data['i']['id'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issue'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
//        pr($technician); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function troubleshot_shipment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE pc.shipment = 2");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
//        pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
//        pr($technician); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function cancelrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to cancel%'");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
//        pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
        // pr($filteredData); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function holdrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to hold%'");
        // echo $sql; exit;
//                pr($allData); exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        /// pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
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
//        pr($technician); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function unholdrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%request to unhold%'");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
//        pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
//        pr($technician); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function reconnectionRequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                     left join issues i on pc.issue_id = i.id
                    WHERE LOWER(pc.status) like '%Request to reconnection%'");
        // echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
//        pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
//        pr($technician); exit;
        $this->set(compact('filteredData', 'technician'));
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
                    where pc.issue_id = 34");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
//        pr($filteredData); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function troubleshot_technician() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'old_ready'");
        // echo $sql; exit;
//                pr($allData); exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        /// pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
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
//        pr($technician); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function moving() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on pc.user_id = u.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    where pc.issue_id = 17");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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
//        pr($filteredData); exit;
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
                    where pc.issue_id = 5");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

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

}

?>