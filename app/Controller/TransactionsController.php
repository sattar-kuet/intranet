<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::uses('AppController', 'Controller');


require_once(APP . 'Vendor' . DS . 'authorize' . DS . 'autoload.php');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

//App::uses('AnetAPI', 'net\authorize\api\contract\v1');
//App::uses('AnetController', 'net\authorize\api\controller');
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", APP . 'Vendor' . DS . 'authorize' . DS . 'phplog');

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
            ), array('Security', 'RequestHandler'),
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
 
     function edit($cid,$id = null) {


        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        if ($this->request->is('post') || $this->request->is('put')) {
            $loggedUser = $this->Auth->user();
           // pr($loggedUser['name']); exit;
                 $tData = array(
                'issue_id' => 0,
                'customer_id' => $cid,
                'user_id' => 0,
                'role_id' => 0,
                'status' => 'solved',
                'content' => '#'.$this->request->data['Transaction']['id'].' Invoice edited by '.$loggedUser['name'].'. This ticket is generated by system.',
            );
            $this->create_ticket($tData);
         //   pr($this->request->data['Transaction']); exit;
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

        if ($temp['PackageCustomer']['auto_r'] == 'yes') {
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


    function refundTransaction() {
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
// Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        //  $merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
        $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        // $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();

        $creditCard->setCardNumber($this->request->data['Transaction']['card_no']);
//$creditCard->setCardNumber("0015");
        $dateObj = $this->request->data['Transaction']['exp_date'];
        $this->request->data['Transaction']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
        $creditCard->setExpirationDate($this->request->data['Transaction']['exp_date']);
// $creditCard->setExpirationDate("XXXX");
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
//create a transaction
        $transactionRequest = new AnetAPI\TransactionRequestType();
        $transactionRequest->setTransactionType("refundTransaction");
        $transactionRequest->setAmount($this->request->data['Transaction']['refund_amount']);
        $transactionRequest->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequest);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $msg = '';
        $data4transaction['Transaction']['exp_date'] = $this->request->data['Transaction']['exp_date'];
        $data4transaction['Transaction']['card_no'] = $this->request->data['Transaction']['card_no'];
        $data4transaction['Transaction']['user_id'] = $loggedUser['id'];

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();

            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $data4transaction['Transaction']['paid_amount'] = $this->request->data['Transaction']['refund_amount'];
                $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
                $data4transaction['Transaction']['status'] = 'Refund Successful';
//   $data4transaction['Transaction']['trx_id'] = $tresponse->getTransId();
                $msg = ' <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund SUCCESS</strong>
                </p> </div>';

                $tdata['Ticket'] = array('content' => 'Refund successfull', 'status' => 'solved');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
            } else {
                $data4transaction['Transaction']['paid_amount'] = 0;
                $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
                $data4transaction['Transaction']['status'] = 'Refund failed';
                $data4transaction['Transaction']['error_msg'] = "Refund ERROR : "; //. $tresponse->getResponseCode();
                $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund ERROR  ' . //$tresponse->ResponseCode() . 
                        '</strong> </p> </div>';

                $tdata['Ticket'] = array('content' => 'Refund failed for Null response', 'status' => 'solved');

                $tickect = $this->Ticket->save($tdata['Ticket']); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
            }
        } else {
            $data4transaction['Transaction']['paid_amount'] = 0;
            $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
            $data4transaction['Transaction']['status'] = 'Refund failed';
            $data4transaction['Transaction']['error_msg'] = "Refund Null response returned";
            $msg .='Refund failed for Null response';
            $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund failed for Null response  </strong> </p> </div>';


            $tdata['Ticket'] = array('content' => 'Transaction ' . ' Refund failed for Null response', 'status' => 'solved');
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                'ticket_id' => $tickect['Ticket']['id'],
                'status' => 'open',
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
//            $tdata4ticket['Ticket'] = array('content' => 'Refund for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit card Null response');
//            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
//            $trackData['Track'] = array(
//                'package_customer_id' => $cid,
//                'ticket_id' => $tickect['Ticket']['id'],
//                'status' => 'open',
//                'forwarded_by' => $loggedUser['id']
//            );
//            $this->Track->save($trackData);
//  echo "Refund Null response returned";
        }
        $this->loadModel('Transaction');

        $data4transaction['Transaction']['pay_mode'] = 'refund';
        $this->Transaction->save($data4transaction);
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

}

?>