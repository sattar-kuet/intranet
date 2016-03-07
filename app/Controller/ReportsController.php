<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class ReportsController extends AppController {
    
public $components = array('RequestHandler');

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

    function block() {
        // increase memory limit in PHP 
        ini_set('memory_limit', '256M');
        $this->loadModel('PackageCustomer');
        $block_customers = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.status' => 'blocked')));
        $this->set(compact('block_customers'));
    }
    
//    public function view(){
//// increase memory limit in PHP 
//ini_set('memory_limit', '256M');
// $reports = $this->Report->find('all');
//$this->set(compact('reports');
//} 

}

?>