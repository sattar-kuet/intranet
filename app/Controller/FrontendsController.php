<?php
/**
* 
*/
class FrontendsController extends AppController
{
	var $layout = 'public';
	function index(){

		$this->loadModel('Order');
		if($this->request->is('post')){
			
			$this->Order->set($this->request->data);
			if ($this->Order->validates()) {
				
				$this->Order->save($this->request->data['Order']);
				$msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Order placed succeesfully. We will call you within very short time </strong>
			</div>';			 
		} else {
			$msg  =$this->generateError($this->Order->validationErrors);   
		}  
		$this->Session->setFlash($msg);
		return $this->redirect('index');
	}
	$this->loadModel('Psetting');
	$products=$this->Psetting->find('all');
	$this->set(compact('products'));
	$this->loadModel('City');
	$this->loadModel('Location');
	$this->set('cities',$this->City->find('list'));
	$locations=$this->Location->find('list',array('fields' =>array('id','name','city_id')));
	$this->set(compact('locations'));
}
}

?>