<?php

require_once(APP . 'Vendor' . DS . 'authorize' . DS . 'autoload.php');

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
    }

    public function process1() {


        $this->layout = 'ajax';
//        $this->loadModel('PaidCustomer');
//        $sql = "SELECT name, transactionkey ,card_no, exp_date FROM paid_customers ";
//        $cardinfo = $this->PaidCustomer->query($sql);
//        // Common setup for API credentials
//        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
//        $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
//        //$merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
//        $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
////        $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
//        $refId = 'ref' . time();
//
//        // Create the payment data for a credit card
//        $creditCard = new AnetAPI\CreditCardType();
//        $creditCard->setCardNumber("4111111111111111"); // testing
//        $creditCard->setExpirationDate("2038-12"); // testing
//
//      //  $creditCard->setCardNumber("4117733943147221"); // live
//       // $creditCard->setExpirationDate("07-2019"); //live
//        $paymentOne = new AnetAPI\PaymentType();
//        $paymentOne->setCreditCard($creditCard);
//
//        // Order info
//        $order = new AnetAPI\OrderType();
//        $order->setInvoiceNumber("101");
//        $order->setDescription("Golf Shirts");
//
//        // Line Item Info
//        $lineitem = new AnetAPI\LineItemType();
//        $lineitem->setItemId("Shirts");
//        $lineitem->setName("item1");
//        $lineitem->setDescription("golf shirt");
//        $lineitem->setQuantity("1");
//        $lineitem->setUnitPrice(1.00);
//        $lineitem->setTaxable(false);
//
//        // Tax info 
////        $tax = new AnetAPI\ExtendedAmountType();
////        $tax->setName("level 2 tax name");
////        $tax->setAmount(4.50);
////        $tax->setDescription("level 2 tax");
//        // Customer info 
////        $customer = new AnetAPI\CustomerDataType();
////        $customer->setId("15");
////        $customer->setEmail("foo@example.com");
//        // PO Number
//        $ponumber = "15";
//        //Ship To Info
//        $shipto = new AnetAPI\NameAndAddressType();
//        //$shipto->setFirstName("Bayles");
//        // $shipto->setLastName("China");
//        // $shipto->setCompany("Thyme for Tea");
//        //  $shipto->setAddress("12 Main Street");
//        // $shipto->setCity("Pecan Springs");
//        //  $shipto->setState("TX");
//        $shipto->setZip("11554");
//        //  $shipto->setCountry("USA");
//        // Bill To
////        $billto = new AnetAPI\CustomerAddressType();
////        $billto->setFirstName("Ellen");
////        $billto->setLastName("Johnson");
////        $billto->setCompany("Souveniropolis");
////        $billto->setAddress("14 Main Street");
////        $billto->setCity("Pecan Springs");
////        $billto->setState("TX");
////        $billto->setZip("44628");
////        $billto->setCountry("USA");
//        //create a transaction
//        $transactionRequestType = new AnetAPI\TransactionRequestType();
//        $transactionRequestType->setTransactionType("authCaptureTransaction");
//        $transactionRequestType->setAmount(1.00);
////        $transactionRequestType->setPayment($paymentOne);
////        $transactionRequestType->setOrder($order);
////        $transactionRequestType->addToLineItems($lineitem);
////        $transactionRequestType->setTax($tax);
////        $transactionRequestType->setPoNumber($ponumber);
////        $transactionRequestType->setCustomer($customer);
////        $transactionRequestType->setBillTo($billto);
////        $transactionRequestType->setShipTo($shipto);
//
//        $request = new AnetAPI\CreateTransactionRequest();
//        $request->setMerchantAuthentication($merchantAuthentication);
//        $request->setRefId($refId);
//        $request->setTransactionRequest($transactionRequestType);
//        $controller = new AnetController\CreateTransactionController($request);
//        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX); //Testing
//       // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); // live
//
//        pr($response);
//        exit;
//
//        $msg = '';
//        if ($response != null) {
//            $tresponse = $response->getTransactionResponse();
//
//            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
//                $msg = "Transaction Successful ! : " . "<br/>";
//                $msg .= "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "<br/>";
//                $msg .= "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "<br/>";
//            } else {
//                $msg = "Charge Credit Card ERROR :  Invalid response\n";
//            }
//        } else {
//            $msg = "Charge Credit card Null response returned";
//        }
        // Common setup for API credentials  
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        // $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        $merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
        //$merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
        $refId = 'ref' . time();

// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $this->loadModel('PaidCustomer');
        $this->loadModel('Transaction');
        $pcustomers = $this->PaidCustomer->find('all');
//        pr($pcustomers);
//        exit;
        $msg = '<ul>';
        foreach ($pcustomers as $pcustomer):
            $pc = $pcustomer['PaidCustomer'];
            $creditCard->setCardNumber($pc['card_no']); // testing
            $creditCard->setExpirationDate($pc['exp_date']); // testing
            //     $creditCard->setCardNumber("4117733943147221"); // live
            //  $creditCard->setExpirationDate("07-2019"); //live
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
            $transactionData['paid_customer_id'] = $pc['id'];
            //    Bill To
            $billto = new AnetAPI\CustomerAddressType();
            $billto->setFirstName($pc['fname']);
            $billto->setLastName($pc['lname']);
            // $billto->setCompany("Souveniropolis");
            //$billto->setAddress("14 Main Street");
            //$billto->setCity("Pecan Springs");
            //$billto->setState("TX");
            $billto->setZip($pc['zip_code']);
            //$billto->setCountry("USA");
            // Create a transaction
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount($pc['due']);
            $transactionRequestType->setPayment($paymentOne);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId($refId);
            $request->setTransactionRequest($transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            //   $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX); //Testing
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); // live
            //  pr($response); exit;
            $transactionData['error_msg'] = '';
            $transactionData['status'] = '';
            $transactionData['trx_id'] = '';
            $transactionData['auth_code'] = '';
            if ($response != null) {
                $tresponse = $response->getTransactionResponse();
                // pr($tresponse ); exit;
                if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                    $transactionData['status'] = 'success';
                    $transactionData['trx_id'] = $tresponse->getTransId();
                    $transactionData['auth_code'] = $tresponse->getAuthCode();
                    $msg .='<li> Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' successfull</li>';
                } else {
                    $transactionData['status'] = 'error';
                    $transactionData['error_msg'] = "Charge Credit Card ERROR :  Invalid response";
                    $msg .='<li> Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit Card ERROR</li>';
                }
            } else {
                $transactionData['status'] = 'error';
                $transactionData['error_msg'] = "Charge Credit card Null response returned";
                $msg .='<li> Transaction for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit card Null response</li>';
            }
            $this->Transaction->create();
            $this->Transaction->save($transactionData);
        endforeach;
        $msg .='</ul>';
        $this->set(compact('msg'));
    }

    public function individual_transaction($cid=null) {
        //Get ID and Input amount from edit_customer page
        $this->loadModel('PackageCustomer');
        $cinfo = $this->PackageCustomer->findById($cid);
        pr($cinfo); exit;
        pr($this->request->data['PackageCustomer']); exit;
        $id = $this->request->data['PackageCustomer']['id'];
        $charged_amount = $this->request->data['PackageCustomer']['amount'];
        

        $this->layout = 'ajax';

        // Common setup for API credentials  
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        //$merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
        $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        //$merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
        $refId = 'ref' . time();

// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');

        $loggedUser = $this->Auth->user();
        $pcustomers = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $id)));
        
        $msg = '<ul>';
        //foreach ($pcustomers as $pcustomer):
        $pc = $pcustomers['PackageCustomer'];
        // pr($pc); exit;
        $creditCard->setCardNumber($pc['card_check_no']); // testing
        $creditCard->setExpirationDate($pc['exp_date']); // testing
        //     $creditCard->setCardNumber("4117733943147221"); // live
        //  $creditCard->setExpirationDate("07-2019"); //live
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        $transactionData['package_customer_id'] = $pc['id'];
        //    Bill To
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($pc['first_name']);
        $billto->setLastName($pc['last_name']);
        // $billto->setCompany("Souveniropolis");
        //$billto->setAddress("14 Main Street");
        //$billto->setCity("Pecan Springs");
        //$billto->setState("TX");
        $billto->setZip($pc['zip']);
        //$billto->setCountry("USA");
        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($charged_amount); // to do set amount from form
        $transactionRequestType->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX); //Testing
        //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); // live
        //  pr($response); exit;
        $transactionData['error_msg'] = '';
        $transactionData['status'] = '';
        $transactionData['trx_id'] = '';
        $transactionData['auth_code'] = '';
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            // pr($tresponse ); exit;
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $transactionData['status'] = 'success';
                $transactionData['trx_id'] = $tresponse->getTransId();
                $transactionData['auth_code'] = $tresponse->getAuthCode();
                $msg .='<li> Transaction for ' . $pc['first_name'] . ' '.$pc['middle_name'].' '. $pc['last_name'] . ' successfull</li>';
                $tdata['Ticket'] = array('content' => 'Transaction for ' .  $pc['first_name'] . ' '.$pc['middle_name'].' '. $pc['last_name'] . ' successfull');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $id,
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                // INCREASE CHARGED AMOUNT IF TRANSACTION IS SUCCESSFUL
                $this->PackageCustomer->id = $id;
                $data = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $id)));
                $present_due['PackageCustomer']['charge_amount'] = (float)$data['PackageCustomer']['charge_amount'] + (float)$charged_amount;
                $this->PackageCustomer->save($present_due);
                $this->PackageCustomer->save($this->request->data['PackageCustomer']);
                //END OF DUE UPDATE
                $this->Track->save($trackData);
            } else {
                $transactionData['status'] = 'error';
                $transactionData['error_msg'] = "Charge Credit Card ERROR :  Invalid response";
                $msg .='<li> Transaction for ' .  $pc['first_name'] . ' '.$pc['middle_name'].' '. $pc['last_name'] . ' failed for Charge Credit Card ERROR</li>';

                $tdata['Ticket'] = array('content' => 'Transaction for ' .  $pc['first_name'] . ' '.$pc['middle_name'].' '. $pc['last_name'] . ' failed for Charge Credit Card ERROR');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $id,
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'open',
                    'forwarded_by' => $loggedUser['id']
                );              
                $this->Track->save($trackData);
            }
        } else {
            $transactionData['status'] = 'error';
            $transactionData['error_msg'] = "Charge Credit card Null response returned";
            $msg .='<li> Transaction for ' . $pc['first_name'] . ' '.$pc['middle_name'].' '. $pc['last_name'] . ' failed for Charge Credit card Null response</li>';

            $tdata['Ticket'] = array('content' => 'Transaction for ' .  $pc['first_name'] . ' '.$pc['middle_name'].' '. $pc['last_name']  . ' failed for Charge Credit card Null response');
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $id,
                'ticket_id' => $tickect['Ticket']['id'],
                'status' => 'open',
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
        }
        $this->Transaction->create();
        $this->Transaction->save($transactionData);
        // endforeach;
        //$msg .='</ul>';
        $msg1 = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . $msg . '</strong>
    </div>';
        $this->Session->setFlash($msg1);
        return $this->redirect($this->referer());
        //$this->set(compact('msg'));
    }

}

?>