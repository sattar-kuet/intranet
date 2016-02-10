<?php
/**
* 
*/
class AdminsController extends AppController
{
	var $layout = 'admin';
	
	function login(){
		$this->layout="admin-login";
	}
	function deshboard(){

	}
	function create(){
		$this->loadModel('Agent');
		if($this->request->is('post')){
			$this->Agent->set($this->request->data);
			if ($this->Agent->validates()) {
				$this->Agent->save($this->request->data['Agent']);
				$msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Agent Created succeesfully </strong>
			</div>';
			$this->Session->setFlash($msg);
			return $this->redirect('create'); 
		} else {
			$errors =$this->generateError($this->Agent->validationErrors);
            $this->set(compact('errors'));

		}


	}

}
function manage(){
	$this->loadModel('Agent');
	$agents = $this->Agent->find('all');
	$this->set(compact('agents'));

}
function edit($id=null){
	$this->loadModel('Agent');
	if($this->request->is('post') || $this->request->is('put')) { 
		$this->Agent->id =  $this->request->data['Agent']['id'];
		$this->Agent->save($this->request->data['Agent']);
		$msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Agent updated succeesfully </strong>
	</div>';
	$this->Session->setFlash($msg);
	return $this->redirect('edit'); 
} 

if(!$this->request->data) { 
	$data = $this->Agent->findById($id);
	$this->request->data = $data;  
}

}



function delete($id=null){
	$this->loadModel('Agent');
	$this->Agent->delete($id);
	$msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Agent deleted succeesfully </strong>
</div>';
$this->Session->setFlash($msg);
return $this->redirect('manage'); 
}
function block($id=null){
	$this->loadModel('Agent');
	$this->Agent->id=$id;
	$this->Agent->saveField("status","blocked");
	$msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Agent blocked succeesfully </strong>
</div>';
$this->Session->setFlash($msg);
return $this->redirect('manage'); 
}
function active($id=null){
	$this->loadModel('Agent');
	$this->Agent->id=$id;
	$this->Agent->saveField("status","active");
	$msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Agent activated succeesfully </strong>
</div>';
$this->Session->setFlash($msg);
return $this->redirect('manage'); 
}

}

?>