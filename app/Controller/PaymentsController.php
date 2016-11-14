<?php

require_once(APP . 'Vendor' . DS . 'authorize' . DS . 'autoload.php');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

//App::uses('AnetAPI', 'net\authorize\api\contract\v1');
//App::uses('AnetController', 'net\authorize\api\controller');
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", APP . 'Vendor' . DS . 'authorize' . DS . 'phplog');

class PaymentsController extends AppController {

    var $layout = 'admin';

    // public $components = array('Auth');
    public function isAuthorized($user = null) {
        $sidebar = $user['Role']['name'];
        $this->set(compact('sidebar'));
        return true;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('process');

        $this->img_config = array(
            'check_image' => array(
                'image_ratio_crop' => false,
            ),
            'parent_dir' => 'check_images',
            'target_path' => array(
                'check_image' => WWW_ROOT . 'check_images' . DS
            )
        );
        if (!is_dir($this->img_config['parent_dir'])) {
            mkdir($this->img_config['parent_dir']);
        }
        foreach ($this->img_config['target_path'] as $img_dir) {
            if (!is_dir($img_dir)) {
                mkdir($img_dir);
            }
        }
    }

    function processImg($img, $type) {
//         pr($img); 
//         echo $type;
//         exit;
        $upload = new Upload($img[$type]);
        $upload->file_new_name_body = time();
        foreach ($this->img_config[$type] as $key => $value) {
            $upload->$key = $value;
        }
        $upload->process($this->img_config['target_path'][$type]);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $return['file_dst_name'] = $upload->file_dst_name;
        return $return;
    }

    public function getLastCardInfo($customer_id = null) {
        $this->loadModel('Transaction');
        $sql = "SELECT * FROM transactions WHERE (transactions.status ='success' OR transactions.status ='update' OR transactions.status ='auto_recurring') AND transactions.pay_mode='card' AND transactions.package_customer_id = $customer_id ORDER BY transactions.id DESC LIMIT 1";
        $temp = $this->Transaction->query($sql);
        $yyyy = 0;
        $mm = -1;
        $latestcardInfo = array('card_no' => '', 'exp_date' => array('year' => 0, 'month' => 0), 'fname' => '', 'lname' => '', 'cvv_code' => '', 'zip_code' => '', 'trx_id' => '');
        if (count($temp)) {
            $date = explode('/', $temp[0]['transactions']['exp_date']);
            $yyyy = date('Y');
            $yy = substr($yyyy, 0, 2);
            if (isset($date[1])) {
                $yyyy = $yy . '' . $date[1];
            }
            $mm = $date[0];
            $temp[0]['transactions']['exp_date'] = array('year' => $yyyy, 'month' => $mm);
            $latestcardInfo = $temp[0]['transactions'];
        }
        return $latestcardInfo;
    }

    public function process($trans_id = null, $customer_id = null) {
        $this->request->data['Transaction'] = $this->getLastCardInfo($trans_id, $customer_id);
        $ym = $this->getYm();
        $this->set(compact('ym'));
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $customer_info = $this->PackageCustomer->findById($customer_id);
        $this->request->data = $customer_info;
        $latestcardInfo = $this->getLastCardInfo($customer_id);
        unset($customer_info['PackageCustomer']['email']);
        unset($customer_info['PackageCustomer']['id']);
        unset($customer_info['PackageCustomer']['exp_date']);
        $data = $this->Transaction->findById($trans_id);
        $this->request->data['Transaction'] =  $latestcardInfo;
        $this->request->data['Transaction']['id'] = $trans_id;
        $paid = getPaid($trans_id);
        $data = $this->Transaction->findById($trans_id);
        //pr($latestcardInfo); exit;
        $this->request->data['Transaction'] = $data['Transaction'] + $latestcardInfo;
        $this->request->data['Transaction']['payable_amount'] = $data['Transaction']['payable_amount'] - $paid;
        
        //$this->request->data = $customer_info;
        $this->set('customer_info');
    }

    public function individual_transaction_by_card() {
        // PROCESS PAYMENT
        // Common setup for API credentials  
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        //  $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
        $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        //   $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX
        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $msg = '<ul>';
        $card = $this->request->data['Transaction'];
        $creditCard->setCardNumber($card['card_no']);
        $exp_date = $card['exp_date']['month'] . '-' . $card['exp_date']['year'];
        // echo $exp_date; exit;
        $creditCard->setExpirationDate($exp_date);
        //    $creditCard->setCardNumber("4117733943147221"); // live
        // $creditCard->setExpirationDate("07-2019"); //live
        $creditCard->setcardCode($card['cvv_code']); //live
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //    Bill To
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($card['fname']);
        $billto->setLastName($card['lname']);
        $billto->setCompany($card['company']);
        //$billto->setAddress("14 Main Street");
        $billto->setAddress($card['address']);
        $billto->setCity($card['city']);
        $billto->setState($card['state']);
        $billto->setZip($card['zip_code']);
        $billto->setCountry($card['country']);
        $billto->setphoneNumber($card['phone']);
        $billto->setfaxNumber($card['fax']);

        ////////// ########################## //////////////
        // Create a Customer Profile Request
        //  1. create a Payment Profile
        //  2. create a Customer Profile   
        //  3. Submit a CreateCustomerProfile Request
        //  4. Validate Profiiel ID returned

        $paymentprofile = new AnetAPI\CustomerPaymentProfileType();

        $paymentprofile->setCustomerType('individual');
        $paymentprofile->setBillTo($billto);
        $customerProfile = new AnetAPI\CreateCustomerPaymentProfileRequest();
        $customerProfile->setPaymentProfile($paymentprofile);

        ////////// ########################## //////////////
//        $customerProfile = new AnetAPI\CreateCustomerPaymentProfileRequest();
//        pr($customerProfile); exit;
//    
        //$customerProfile->cardNumber($pc['card_no']);
//        $customerProfile->billToFirstName($pc['fname']);
//        $customerProfile->billToLastName($pc['lname']);
//        $customerProfile->zip($pc['zip_code']);
        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($card['payable_amount']); // to do set amount from form
        $transactionRequestType->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $this->loadModel('Transaction');
        $this->request->data['Transaction']['error_msg'] = '';
        $this->request->data['Transaction']['status'] = '';
        $this->request->data['Transaction']['trx_id'] = '';
        $this->request->data['Transaction']['auth_code'] = '';
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();

            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $this->request->data['Transaction']['status'] = 'close';
                $this->request->data['Transaction']['trx_id'] = $tresponse->getTransId();
                $this->request->data['Transaction']['auth_code'] = $tresponse->getAuthCode();
                // update payable amount and paidamount in transaction table
                $sql = 'UPDATE transactions SET payable_amount = payable_amount-' . $card['payable_amount'] .
                        ', paid_amount+' . $card['payable_amount'] .
                        ' WHERE transactions.id = ' . $card['id'];
                $result = $this->Transaction->query($sql);

                $data4due = $this->Transaction->findById($card['id']);
                if ($data4due['Transaction']['payable_amount']) {
                    $this->request->data['Transaction']['status'] = 'open';
                }
                $msg .='<li> Transaction for  successfull</li>';
                $tdata['Ticket'] = array('content' => 'Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' successfull');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );

                $this->Track->save($trackData);
            } else {
                $this->request->data['Transaction']['paid_amount'] = 0;
                $this->request->data['Transaction']['status'] = 'error';
                $this->request->data['Transaction']['error_msg'] = "Charge Credit Card ERROR :  Invalid response";
                $msg .='<li> Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit Card ERROR</li>';

                $tdata['Ticket'] = array('content' => 'Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit Card ERROR');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'open',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
            }
        } else {
            $this->request->data['Transaction']['paid_amount'] = 0;
            $this->request->data['Transaction']['status'] = 'error';
            $this->request->data['Transaction']['error_msg'] = "Charge Credit card Null response returned";
            $msg .='<li> Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit card Null response</li>';

            $tdata['Ticket'] = array('content' => 'Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit card Null response');
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $cid,
                'ticket_id' => $tickect['Ticket']['id'],
                'status' => 'open',
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
        }
        $this->Transaction->create();
        $this->Transaction->id = $this->request->data['Transaction']['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        // endforeach;
        //$msg .='</ul>';
        $transactionMsg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . $msg . '</strong>
    </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
        //$this->set(compact('msg'));
    }

    public function individual_auto_recurring($data) {
        //   pr($this->request->data); exit;
        //Get ID and Input amount from edit_customer page
        $cid = $data['cid'];
        // pr($this->request->data); exit;
        //pr($this->request->data['Transaction']);
        $this->layout = 'ajax';
        // Common setup for API credentials  
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        //   $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
        // $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX
        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $creditCard->setCardNumber($data['card_no']);
        $creditCard->setExpirationDate($data['exp_date']);
        //    $creditCard->setCardNumber("4117733943147221"); // live
        // $creditCard->setExpirationDate("07-2019"); //live
        $creditCard->setcardCode($data['cvv_code']); //live
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //    Bill To
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($data['fname']);
        $billto->setLastName($data['lname']);
        $billto->setCompany($data['company']);
        //$billto->setAddress("14 Main Street");
        $billto->setAddress($data['address']);
        $billto->setCity($data['city']);
        $billto->setState($data['state']);
        $billto->setZip($data['zip_code']);
        $billto->setCountry($data['country']);
        $billto->setphoneNumber($data['phone']);
        $billto->setfaxNumber($data['fax']);

        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($data['charge_amount']); // to do set amount from form
        $transactionRequestType->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX); 
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        $this->request->data['Transaction']['error_msg'] = '';
        $this->request->data['Transaction']['status'] = '';
        $this->request->data['Transaction']['trx_id'] = '';
        $this->request->data['Transaction']['auth_code'] = '';
        $this->request->data['Transaction']['package_customer_id'] = $data['cid'];
        $this->request->data['Transaction']['fname'] = $data['fname'];
        $this->request->data['Transaction']['lname'] = $data['lname'];
        $this->request->data['Transaction']['exp_date'] = $data['exp_date'];
        $this->request->data['Transaction']['address'] = $data['address'];
        $this->request->data['Transaction']['city'] = $data['city'];
        $this->request->data['Transaction']['state'] = $data['state'];
        $this->request->data['Transaction']['zip_code'] = $data['zip_code'];
        $this->request->data['Transaction']['phone'] = $data['phone'];
        $this->request->data['Transaction']['paid_amount'] = $data['charge_amount'];
        $this->request->data['Transaction']['card_no'] = $data['card_no'];
        $this->request->data['Transaction']['cvv_code'] = $data['cvv_code'];
        $this->request->data['Transaction']['fax'] = $data['fax'];

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            // pr($tresponse ); exit;
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $this->request->data['Transaction']['status'] = 'success';
                $r_from = date('Y-m-d');
                $this->PackageCustomer->id = $data['cid'];
                $this->PackageCustomer->saveField("r_form", $r_from);
                $this->request->data['Transaction']['trx_id'] = $tresponse->getTransId();
                $this->request->data['Transaction']['auth_code'] = $tresponse->getAuthCode();
                $tdata['Ticket'] = array('content' => 'Transaction for ' . $data['fname'] . ' ' . $data['lname'] . ' successfull');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data['cid'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
                $status = 1;
            } else {
                $this->request->data['Transaction']['paid_amount'] = 0;
                $this->request->data['Transaction']['status'] = 'error';
                $this->request->data['Transaction']['error_msg'] = "Charge Credit Card ERROR :  Invalid response";
                $tdata['Ticket'] = array('content' => 'Transaction for ' . $data['fname'] . ' ' . $data['lname'] . ' failed for Charge Credit Card ERROR');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'open',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
                $status = 0;
            }
        } else {
            $this->request->data['Transaction']['paid_amount'] = 0;
            $this->request->data['Transaction']['status'] = 'error';
            $this->request->data['Transaction']['error_msg'] = "Charge Credit card Null response returned";

            $tdata['Ticket'] = array('content' => 'Transaction for ' . $data['fname'] . ' ' . $data['lname'] . ' failed for Charge Credit card Null response');
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $cid,
                'ticket_id' => $tickect['Ticket']['id'],
                'status' => 'open',
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
            $status = 0;
        }
        $this->Transaction->create();
        $this->Transaction->save($this->request->data['Transaction']);
        return $status;
        //$this->set(compact('msg'));
    }

    function auto_recurring() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('AutoRecurring');
        $pcs = $this->PackageCustomer->find('all', array('conditions' => array('auto_r' => 'yes')));
        $success = 0;
        $failure = 0;
        foreach ($pcs as $single) {
            $pc = $single['PackageCustomer'];
            $duration = $pc['r_duration'];
            $rFrom = $pc['r_form'];
//            $Date = "2010-09-17";
//            echo date('Y-m-d', strtotime($Date . ' + 1 days'));
            $temp = date('Y-m-d', strtotime($rFrom . ' + ' . $duration . ' days'));
            $deadline = strtotime($temp);
            $temp = date('Y-m-d');
            $now = strtotime($temp);
            if ($now >= $deadline) {
                // Time out. So do it right now;

                $data = array(
                    'exp_date' => $pc['exp_date'],
                    'card_no' => $pc['card_check_no'],
                    'cvv_code' => $pc['cvv_code'],
                    'fname' => $pc['cfirst_name'],
                    'lname' => $pc['clast_name'],
                    'company' => '',
                    'address' => $pc['street'] . ' ' . $pc['apartment'],
                    'city' => $pc['city'],
                    'state' => $pc['state'],
                    'zip_code' => $pc['zip'],
                    'country' => '',
                    'phone' => $pc['cell'],
                    'fax' => $pc['fax'],
                    'charge_amount' => $pc['charge_amount'],
                    'cid' => $pc['id']
                );

                //  pr($data); exit;
                $temp = array();
                if ($this->individual_auto_recurring($data)) {
                    $temp = array(
                        'package_customer_id' => $pc['id'],
                        'amount' => $data['charge_amount'],
                        'status' => 'success',
                    );
                } else {
                    $temp = array(
                        'package_customer_id' => $pc['id'],
                        'amount' => $data['charge_amount'],
                        'status' => 'error',
                    );
                }
                $this->AutoRecurring->create();
                $this->AutoRecurring->save($temp);
            }
        }
        return $this->redirect('message');
    }

    function message() {
        
    }

    function refundTransaction() {
        $loggedUser = $this->Auth->user();
        //  pr($this->request->data['Transaction']);
        //    exit;
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        // $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        $merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
        // $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
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
        //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $msg = '';

        $data4transaction['Transaction']['exp_date'] = $this->request->data['Transaction']['exp_date'];

        $data4transaction['Transaction']['card_no'] = $this->request->data['Transaction']['card_no'];
        $data4transaction['Transaction']['user_id'] = $loggedUser['id'];
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            //pr($tresponse); exit;
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $data4transaction['Transaction']['paid_amount'] = $this->request->data['Transaction']['refund_amount'];
                $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
                $data4transaction['Transaction']['status'] = 'Refund Successful';
                //   $data4transaction['Transaction']['trx_id'] = $tresponse->getTransId();
                $msg = ' <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund SUCCESS</strong>
                </p> </div>';

                $tdata['Ticket'] = array('content' => 'Refund successfull');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'open',
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


                $tdata['Ticket'] = array('content' => 'Refund failed for Null response');
                //  pr($tdata['Ticket']);exit;
                $tickect = $this->Ticket->save($tdata['Ticket']); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'open',
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


            $tdata['Ticket'] = array('content' => 'Transaction for ' . ' Refund failed for Null response');
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
//        pr($this->request->data); exit;
        $data4transaction['Transaction']['pay_mode'] = 'refund';
        $this->Transaction->save($data4transaction);
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function createTransactionHistory($data = array()) {
        $this->loadModel('PaidTransaction');
        $this->PaidTransaction->save($data);
    }

    function getDue($data = array()) {
        $this->loadModel('PaidTransaction');
        $this->loadModel('Transaction');
        $data1 = $this->Transaction->findById($data['id']);
        $sql = 'SELECT SUM(amount) as paid FROM paid_transactions WHERE transaction_id =' . $data['id'];
        $data2 = $this->PaidTransaction->query($sql);
        $payable = $data1['Transaction']['payable_amount'];
        $paid = $data2[0][0]['paid'];
        return $payable - $paid;
    }

    public function individual_transaction_by_check() {
        $this->loadModel('Transaction');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $result = array();
        if (!empty($this->request->data['Transaction']['check_image']['name'])) {
            $result = $this->processImg($this->request->data['Transaction'], 'check_image');
            $this->request->data['Transaction']['check_image'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['check_image'] = '';
        }
        $this->request->data['Transaction']['status'] = 'close';

        //creatre transaction History 
        $data4trnshistory = array(
            'user_id' => $loggedUser['id'],
            'transaction_id' => $this->request->data['Transaction']['id'],
            'amount' => $this->request->data['Transaction']['payable_amount']
        );
        $this->createTransactionHistory($data4trnshistory);
        // check due amount 
        $due = $this->getDue($this->request->data['Transaction']);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
           
        }
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $this->request->data['Transaction']['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_morder() {
        $this->loadModel('Transaction');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $result = array();
        if (!empty($this->request->data['Transaction']['check_image']['name'])) {
            $result = $this->processImg($this->request->data['Transaction'], 'check_image');
            $this->request->data['Transaction']['check_image'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['check_image'] = '';
        }
//        $this->request->data['Transaction']['status'] = 'success';
         $this->request->data['Transaction']['status'] = 'close';

        //creatre transaction History 
        $data4trnshistory = array(
            'user_id' => $loggedUser['id'],
            'transaction_id' => $this->request->data['Transaction']['id'],
            'amount' => $this->request->data['Transaction']['payable_amount']
        );
        $this->createTransactionHistory($data4trnshistory);
        // check due amount 
        $due = $this->getDue($this->request->data['Transaction']);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $this->request->data['Transaction']['id'];
        
        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_online_bil() {
        $this->loadModel('Transaction');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $result = array();
        if (!empty($this->request->data['Transaction']['check_image']['name'])) {
            $result = $this->processImg($this->request->data['Transaction'], 'check_image');
            $this->request->data['Transaction']['check_image'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['check_image'] = '';
        }
        $this->request->data['Transaction']['status'] = 'close';

        //creatre transaction History 
        $data4trnshistory = array(
            'user_id' => $loggedUser['id'],
            'transaction_id' => $this->request->data['Transaction']['id'],
            'amount' => $this->request->data['Transaction']['payable_amount']
        );
        $this->createTransactionHistory($data4trnshistory);
        // check due amount 
        $due = $this->getDue($this->request->data['Transaction']);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $this->request->data['Transaction']['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_cash() {
        $this->loadModel('Transaction');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
       
//        $this->request->data['Transaction']['status'] = 'success';
         $this->request->data['Transaction']['status'] = 'close';
        //creatre transaction History 
        $data4trnshistory = array(
            'user_id' => $loggedUser['id'],
            'transaction_id' => $this->request->data['Transaction']['id'],
            'amount' => $this->request->data['Transaction']['payable_amount']
        );
        $this->createTransactionHistory($data4trnshistory);
        // check due amount 
        $due = $this->getDue($this->request->data['Transaction']);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $this->request->data['Transaction']['id'];

        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    function custom_payment() {
        $this->loadModel('Transaction');
        $this->loadModel('Role');
        $this->loadModel('User');

        if ($this->request->is('post')) {
            $this->Transaction->set($this->request->data);
            if ($this->Transaction->validates()) {
                $temp = explode('/', $this->request->data['Transaction']['created']);
                $this->request->data['Transaction']['created'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1] . ' 00:00:00';
                // pr($this->request->data); exit;
                $this->Transaction->save($this->request->data['Transaction']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Custom payment succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Transaction->validationErrors);
                $this->Session->setFlash($msg);
            }
        }

        $pay_to = $this->User->find('list', array('conditions' => array('OR' => array(array('User.role_id' => 9), array('User.role_id' => 11)))));
        $this->set(compact('pay_to'));
    }

}

?>