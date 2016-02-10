<?php
/**
* 
*/
require_once(APP . 'Vendor' . DS  . 'class.upload.php');
class ProductsController extends AppController
{
	var $layout = 'admin';
	public $folder_url;
	function beforeFilter(){
		$this->folder_url = WWW_ROOT.'productImages'.DS;
	// create the folder if it does not exist
		if(!is_dir($this->folder_url)) {
			mkdir($this->folder_url);
		}
	}

	function clear_oldfile($id,$attached_file){
		$this->loadModel('Psetting');
		$data=$this->Psetting->find('first', array(
			'conditions' => array('product_id' => $id)
			));
		
		$id= false;
		if(count($data)>0){
			if($attached_file){
				if(file_exists($this->folder_url.$data['Psetting']['img'])){
					unlink($this->folder_url.$data['Psetting']['img']);
				}
			}
			$id= $data['Psetting']['id'];		
		}
		return $id;	
	}
	function add(){
		$this->loadModel('Product');
		$this->loadModel('Category');
		if($this->request->is('post')){
			$this->Product->set($this->request->data);
			if ($this->Product->validates()) {
				$this->Product->save($this->request->data['Product']);
				$msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Product added succeesfully </strong>
			</div>';
			$this->Session->setFlash($msg);
			return $this->redirect('add'); 
		} else {
			$errors =$this->generateError($this->Agent->validationErrors);
			$this->set(compact('errors'));

		}
	}
	$categories=$this->Category->find('list');
	$this->set(compact('categories'));

}

function category(){

	$this->loadModel('Category');
	if($this->request->is('post')){
		$this->Category->set($this->request->data);
		if ($this->Category->validates()) {
			$this->Category->save($this->request->data['Category']);
			$msg = '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> Category added succeesfully </strong>
		</div>';
		$this->Session->setFlash($msg);
		return $this->redirect('category'); 
	} else {
		$errors =$this->generateError($this->Agent->validationErrors);
		$this->set(compact('errors'));

	}
}
}
function editcategory($id){

}
function import(){
	$this->loadModel('Product');
	$this->loadModel('Category');
	$this->loadModel('Import');
	if($this->request->is('post')){
		$this->Import->set($this->request->data);
		if ($this->Import->validates()) {
			$this->Import->save($this->request->data['Product']);
			$msg = '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> Product imported succeesfully </strong>
		</div>';
		$this->Session->setFlash($msg);
		return $this->redirect('import'); 
	} else {
		$errors =$this->generateError($this->Agent->validationErrors);
		$this->set(compact('errors'));

	}
}
$categories=$this->Category->find('list');
$product=$this->Product->find('list',array('fields' =>array('id','name','category_id')));
$this->set(compact('product','categories'));

}

function settings(){
	$this->loadModel('Product');
	$this->loadModel('Category');
	$this->loadModel('Psetting');
	if($this->request->is('post') || $this->request->is('put')){
		if(empty($this->request->data['Psetting']['img']['name'])){
			$exist_in_db=$this->clear_oldfile($this->request->data['Psetting']['product_id'],false);
		    unset($this->request->data['Psetting']['img']);
		}
		else{
			$exist_in_db=$this->clear_oldfile($this->request->data['Psetting']['product_id'],true);
			$upload = new Upload($this->request->data['Psetting']['img']);
			$upload->file_new_name_body=$this->request->data['Psetting']['product_id'];
			$upload->image_ratio_crop = true;
			$upload->image_resize = true;
			$upload->image_x = 175;
			$upload->image_y = 240;
			$target_path = $this->folder_url;
			$upload->process($target_path);
			$this->request->data['Psetting']['img'] =$upload->file_dst_name;
			if(!$upload->processed){
				$msg =$this->generateError($upload->error);
				return $this->redirect('settings'); 

			} 
		}
		if($exist_in_db){
			$this->Psetting->id = $exist_in_db;
			foreach($this->request->data['Psetting'] as $k=>$v){
				if(!empty($v)){
					
					$this->Psetting->saveField($k,$v);
				}
			}
		}
		else{
			$this->Psetting->save($this->request->data['Psetting'] );
		}
			$msg = '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> Changes saved succeesfully </strong>
		</div>';


	
	$this->Session->setFlash($msg);
	return $this->redirect('settings'); 
}

$categories=$this->Category->find('list');
$product=$this->Product->find('list',array('fields' =>array('id','name','category_id')));
$this->set(compact('product','categories'));
	//pr($product);
	//exit;

}

function status(){
	$this->loadModel('Import');
    $options = array(
		'fields'=>array('Import.*','Product.*','Category.*','psettings.*',                    	
			'SUM( case when orders.status = "sold" THEN orders.pieces else 0 end) as total_sell',
			'SUM( case when orders.status = "No contact" THEN orders.pieces else 0 end) as no_contact',
			'SUM( case when orders.status = "confirmed" THEN orders.pieces else 0 end) as confirmed',
			'SUM( case when orders.status = "canceled" THEN orders.pieces else 0 end) as canceled'),
		'products.writer',
		'joins' => array('LEFT JOIN `orders`  ON `Import`.`product_id` = `orders`.`product_id` 
			LEFT JOIN `psettings`  ON `Import`.`product_id` = `psettings`.`product_id`'),
		'group' => '`Import`.`id`',

		);

	$original= $this->Import->find('all', $options);
	$filteredArray = [];  
	foreach ($original as $productData) {
		if (isset($filteredArray[$productData['Import']['product_id']])) {
			$filteredArray[$productData['Import']['product_id']]['Import']['amount'] += $productData['Import']['amount'];
			$filteredArray[$productData['Import']['product_id']]['Import']['cost'] += $productData['Import']['cost'];
		}
		else {
			$filteredArray[$productData['Import']['product_id']] = $productData;
		}
	}

	$this->set(compact('filteredArray'));
}

}

?>