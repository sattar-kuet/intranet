<?php

/**
 * 
 */
require_once(APP . 'Vendor' . DS . 'class.upload.php');

class TechniciansController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
            //  echo 'here'; exit; //(array('action' => 'deshboard'));
        }
        $this->Auth->allow('');
        // database name must be thum_img,small_img
        $this->img_config = array(
            'picture' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 50,
                'image_y' => 40
            ),
            'parent_dir' => 'pictures',
            'target_path' => array(
                'picture' => WWW_ROOT . 'pictures' . DS
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
        $this->loadModel('CustomPackage');
        $this->loadModel('PaidCustomer');
        $this->loadModel('Country');
        $this->loadModel('Comment');
        $this->loadModel('User');
        $this->loadModel('Role');
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['PackageCustomer']['status'] = 'requested';
            //  pr($this->request->data); exit;
            $this->PackageCustomer->set($this->request->data);
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

            $pc = $this->PackageCustomer->save($this->request->data['PackageCustomer']);
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
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge'));
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

            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
            //update last comment
            $this->Comment->id = $this->request->data['PackageCustomer']['comment_id'];
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
        // pr($data);
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
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge'));
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
                    WHERE pc.status = 'requested' AND pc.follow_up = 1");
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
        $this->set(compact('filteredData'));
    }

    function newCustomer() {
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
                    WHERE ins.user_id = " . $loggedUser['id'] . " and pc.status = 'scheduled' "
                . " ORDER BY ins.id");

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

                $filteredData[$index]['issues'] = array();
                if (!empty($data['i']['name'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issues'][] = $temp;
                }

                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }

                $filteredData[$index]['installations'] = array();
                if (!empty($data['ins']['user_id'])) {
                    $temp = array('user_id' => $data['ins'], 'user' => $data['u']);
                    $filteredData[$index]['installations'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function doneCustomer() {
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
                    WHERE ins.user_id = " . $loggedUser['id'] . " and ins.status = 'done by tech'  ORDER BY ins.id");
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
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
        $this->PackageCustomer->technician_id = $this->request->data['PackageCustomer']['technician_id'];
        $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
        $this->request->data['PackageCustomer']['from'] = $datrange['start'];
        $this->request->data['PackageCustomer']['to'] = $datrange['end'];
        $this->PackageCustomer->save($this->request->data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function status_done($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $this->PackageCustomer->saveField("status", "active");
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function comment() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $loggedUser = $this->Auth->user();
        $this->request->data['Comment']['user_id'] = $loggedUser['id'];
        $this->request->data['Comment']['status'] = 'done';
//        pr($this->request->data); exit;
        $this->Comment->save($this->request->data['Comment']);
        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Comment saved successfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function dodone() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->loadModel('Installation');

        $this->Installation->id = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['status'] = 'done by tech';
//        pr($this->request->data); exit;
        $this->Installation->save($this->request->data);

        $loggedUser = $this->Auth->user();
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "done");

        $commentData['Comment'] = array(
            'package_customer_id' => $this->request->data['PackageCustomer']['package_customer_id'],
            'content' => $this->request->data['PackageCustomer']['comment'],
            'user_id' => $loggedUser['id'],
        );
        $this->Comment->save($commentData);

        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Done Successfully! </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function postPone() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->loadModel('Installation');

        $this->Installation->id = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['status'] = 'post pone';
        $this->Installation->save($this->request->data);

        $loggedUser = $this->Auth->user();
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "post pone");

        $commentData['Comment'] = array(
            'package_customer_id' => $this->request->data['PackageCustomer']['package_customer_id'],
            'content' => $this->request->data['PackageCustomer']['comment'],
            'user_id' => $loggedUser['id'],
        );

        $this->Comment->save($commentData);
        $msg = '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Post pone successfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function reschedule() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->loadModel('Installation');

        $this->Installation->id = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['status'] = 'rescheduled';
        $this->Installation->save($this->request->data);

        $loggedUser = $this->Auth->user();
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "rescheduled");

        $commentData['Comment'] = array(
            'package_customer_id' => $this->request->data['PackageCustomer']['package_customer_id'],
            'content' => $this->request->data['PackageCustomer']['comment'],
            'user_id' => $loggedUser['id'],
        );

        $this->Comment->save($commentData);
        $msg = '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Rescheduled successfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function cancel() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');

        $this->loadModel('Installation');
        $this->Installation->id = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['status'] = 'canceled';
        $this->Installation->save($this->request->data);

        $loggedUser = $this->Auth->user();
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "canceled");

        $commentData['Comment'] = array(
            'package_customer_id' => $this->request->data['PackageCustomer']['package_customer_id'],
            'content' => $this->request->data['PackageCustomer']['comment'],
            'user_id' => $loggedUser['id'],
        );

        $this->Comment->save($commentData);
        $msg = '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Cancelled successfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function postponeView() {
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
                    WHERE ins.user_id = " . $loggedUser['id'] . " and pc.status = 'post pone'  ORDER BY ins.id");

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

    function rescheduledCustomer() {
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
                    WHERE ins.user_id = " . $loggedUser['id'] . " and pc.status = 'rescheduled'  ORDER BY ins.id");

        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
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

    function cancelledCustomer() {
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
                    WHERE ins.user_id = " . $loggedUser['id'] . " and pc.status = 'canceled'  ORDER BY ins.id");


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
    
    function my_payment (){
          $this->loadModel('OthersPayment');
          $loggedUser = $this->Auth->user();
          $id =$loggedUser['id'];
          
          //$payments = $this->OthersPayment->find('all');
          
           $sql = "SELECT * FROM others_payments where technician_id = $id";
        $payments = $this->OthersPayment->query($sql);
         // pr($payments); exit;
        $this->set(compact('payments'));
    }
    
     
        

}

?>