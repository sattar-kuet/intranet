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
        //$conditions = array('PaidCustomer.exp_date >=' => $datrange['start'], 'PaidCustomer.exp_date <=' => $datrange['end']);
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
    
     function edit($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Transaction']['next_payment'] = $this->getFormatedDate($this->request->data['Transaction']['next_payment']);
            $this->Transaction->set($this->request->data);
            $this->Transaction->id = $id;
            $this->Transaction->save($this->request->data['Transaction']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Transaction data updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $data = $this->Transaction->findById($id);
        $this->request->data['Transaction'] = $data['Transaction'];
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
         $this->request->data['Transaction']['next_payment'] = $this->getFormatedDate($this->request->data['Transaction']['next_payment']);
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Card information updated successfully </strong>
            </div>';
        $this->Session->setFlash($msg);
       // return $this->redirect(array('controller' => 'reports', 'action' => 'extraPayment'));
        return $this->redirect($this->referer());
    }
    
    function void($id = null) {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');
        $temp = $this->Transaction->findById($id);
       
        if($temp['PackageCustomer']['auto_r']== 'yes'){
            $this->PackageCustomer->id = $temp['PackageCustomer']['auto_r'];
            $this->PackageCustomer->id = $temp['PackageCustomer']['id'];
            $this->PackageCustomer->saveField("invoice_created", 0);
        }
        $this->Transaction->id = $id;
        $this->Transaction->saveField("status", "void");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Record succeesfully updated as void </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }
    
    

}

?>