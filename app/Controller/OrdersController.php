<?php
/**
* 
*/
class OrdersController extends AppController
{
	var $name = "orders";
	var $layout = 'admin';

	function nocontact(){
		$this->loadModel('Order');
		 $options = array(
		'fields'=>array('Order.*','products.*','psettings.*','City.name','Location.name'),                    		
		'joins' => array('LEFT JOIN `products`  ON `Order`.`product_id` = `products`.`id` 
			LEFT JOIN `psettings`  ON `Order`.`product_id` = `psettings`.`product_id`'),
		'conditions'=>array('status'=>'No contact')

		);
		$allNoContacts = $this->Order->find('all',$options);

		$this->set(compact('allNoContacts'));
	}
	function confirmed(){

		$this->loadModel('Order');
		$allConfirmed = $this->Order->find('all', array(
			'conditions' => array(
				'status' => 'confirmed'
				)
			));
		$this->set(compact('allConfirmed'));
	}
	function sold(){
		$this->loadModel('Order');
		$allSold = $this->Order->find('all', array(
			'conditions' => array(
				'status' => 'sold'
				)
			));
		$this->set(compact('allSold'));
	}
     
     function canceled(){
		$this->loadModel('Order');
		$allCanceled = $this->Order->find('all', array(
			'conditions' => array(
				'status' => 'canceled'
				)
			));
		$this->set(compact('allCanceled'));
	}
	   function all(){
		$this->loadModel('Order');
		$all = $this->Order->find('all');
		$this->set(compact('all'));
	}
	function cancel($id=null){
		if($id){
			$this->loadModel('Order');
		$this->Order->id=$id;
		$this->Order->saveField("status","canceled");
		$msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Order canceled succeesfully </strong>
	</div>';
	$this->Session->setFlash($msg);
	
		}
		return $this->redirect($this->referer()); 
		
}

function confirm($id=null){
	if($this->request->is('post')){

		$this->loadModel('Order');
		$this->Order->id=$this->request->data['Order']['id'];
		$data = array(
			'Order'=>array(
				'id'=>$this->request->data['Order']['id'],
				'status'=>'confirmed',
				'comment'=>$this->request->data['Order']['comment']
				)
			);

		$this->Order->save($data);
		
		$msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Order confirmed succeesfully </strong>
		</div>';
		$this->Session->setFlash($msg);
	}
	return $this->redirect('nocontact'); 
}

function sell($id=null){
		if($id){
			$this->loadModel('Order');
		$this->Order->id=$id;
		$this->Order->saveField("status","sold");
		$msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Order sold succeesfully </strong>
	</div>';
	$this->Session->setFlash($msg);
	
		}
		return $this->redirect('confirmed'); 
}

}