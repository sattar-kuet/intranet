<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

class EmployeesController extends AppController {

    var $layout = 'employee';
    public $dataExist = false;
    public $img_config;
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Employee',
                )
            ),
            'loginAction' => array(
                'controller' => 'employees',
                'action' => 'login'
            ),
            'loginRedirect' => array('controller' => 'employees', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => 'employees', 'action' => 'inout'),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        // database name must be thum_img,small_img
        $this->img_config = array('doc1' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 175,
                'image_y' => 240
            ),
            'doc2' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 110,
                'image_y' => 35
            ),
            'parent_dir' => 'eImages',
            'target_path' => array(
                'doc1' => WWW_ROOT . 'eImages' . DS . 'doc1' . DS,
                'doc2' => WWW_ROOT . 'eImages' . DS . 'doc2' . DS
            )
        );

        // create the folder if it does not exist
        // echo $this->img_config['parent_dir']; exit;
        if (!is_dir($this->img_config['parent_dir'])) {
            mkdir($this->img_config['parent_dir']);
        }
        foreach ($this->img_config['target_path'] as $img_dir) {
            if (!is_dir($img_dir)) {
                mkdir($img_dir);
            }
        }


        $this->Auth->allow('inout','create');
        $this->Auth->userScope = array('Employee.status' => 'active');
        $admin = $this->Auth->user();
      
        if (isset($admin['role'])) {
            $sidebar = $admin['role'];
        }
  
        $this->loadModel('Department');
        $this->loadModel('Employee');
        $employees = $this->Employee->find('all');
        $departments = $this->Department->find("list");
        $this->set(compact('sidebar', 'isSamdin', 'departments', 'employees'));
        
       

        
    }

    function clear_oldfile($email, $attached_file) {
        $this->loadModel('Employee');
        $data = $this->Employee->find('first', array(
            'conditions' => array('email' => $email)
        ));
        $id = null;
        if (count($data) > 0) {
            if ($attached_file) {
                if (!empty($data['Employee'][$this->current_dir]) && file_exists($this->img_config['target_path'][$this->current_dir] . $data['Employee'][$this->current_dir])) {
                    unlink($this->img_config['target_path'][$this->current_dir] . $data['Employee'][$this->current_dir]);
                }
            }
            $id = $data['Employee']['id'];
            $this->dataExist = true;
        }
        return $id;
    }

    public function isAuthorized($user = null) {
        //if ($user['Role']['name'] == 'admin') {
        $this->Auth->loginRedirect = array('controller' => 'orders', 'action' => 'nocontact');
        $this->Auth->deny('dashboard');
        //}
        return true;
    }

    function inout1() {
        $this->loadModel('Employee');
        $this->loadModel('Attendence');
        $this->layout = "admin-login";

        // if already logged in check this step
        if ($this->Auth->loggedIn()) {
            return $this->redirect('dashboard'); //(array('action' => 'deshboard'));
        }
        // after submit login form check this step
        if ($this->request->is('post')) {

            if (array_key_exists("login", $this->request->data)) {

                $this->login($this->request->data);
            }

            if (isset($this->request->data['in_button'])) {
                if ($this->Auth->login()) {
                    if ($this->Auth->user('status') == 'active') {
                        $currentTime = date("g:i a");
                        $currentdate = date("Y-m-d");

                        $employee = $this->Auth->user();

                        $sql = 'SELECT * FROM attendences WHERE date ="' . $currentdate .
                                '" AND employee_id =' . $employee['id'] .
                                ' AND intime IS NOT NULL  AND outtime IS NULL';
                        $alreadyIn = $this->Attendence->query($sql);
                        if (!count($alreadyIn)) {
                            $dataToBeSaved = array('employee_id' => $employee['id'], 'intime' => $currentTime, 'date' => $currentdate);

                            $this->Attendence->save($dataToBeSaved);
                            $msg = '<div class="alert alert-error">
                               <strong>Your in time :' . $currentTime . ' is Recorded </strong>
                            </div>';
                        } else {
                            $msg = '<div class="alert alert-error">
                               <strong> Strange!. You already in office and trying to Enter Office </strong>
                            </div>';
                        }
                    } else {
                        $msg = '<div class="alert alert-error">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               <strong>You are blocked, Contact with Adminstrator</strong>
                            </div>';
                    }

                    //echo 'exit before redirect'; exit;
                    $this->Session->setFlash($msg);
                    $this->Auth->logout();
                    //return $this->redirect($this->referer());
                } else {
                    $msg = '<div class="alert alert-error">
                               <strong> Incorrect email/password combination. Try Again </strong>
                            </div>';
                    $this->Session->setFlash($msg);
                }
            }
            if (isset($this->request->data['out_button'])) {
                if ($this->Auth->login()) {
                    if ($this->Auth->user('status') == 'active') {

                        $employee = $this->Auth->user();
                        $currentTime = date("g:i a");
                        $currentdate = date("Y-m-d");
                        $sql = 'SELECT *  FROM attendences WHERE date ="' . $currentdate .
                                '" AND intime IS NOT NULL AND outtime IS NULL AND employee_id =' . $employee['id'];
                        $alreadyIn = $this->Attendence->query($sql);


                        if (count($alreadyIn)) {
                            $this->Attendence->id = $alreadyIn[0]['attendences']['id'];
                            $this->Attendence->saveField('outtime', $currentTime);
                            $msg = '<div class="alert alert-error">
                               <strong>Your Out time :' . $currentTime . ' is Recorded </strong>
                            </div>';
                        } else {
                            $msg = '<div class="alert alert-error">
                               <strong> Strange!. You did not Enter office but trying to go out </strong>
                            </div>';
                        }
                    } else {
                        $msg = '<div class="alert alert-error">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               <strong>You are blocked, Contact with Adminstrator</strong>
                            </div>';
                    }

                    //echo 'exit before redirect'; exit;
                    $this->Session->setFlash($msg);
                    $this->Auth->logout();
                    //return $this->redirect($this->referer());
                } else {
                    $msg = '<div class="alert alert-error">
                               <strong> Incorrect email/password combination. Try Again </strong>
                            </div>';
                    $this->Session->setFlash($msg);
                }
            }
        }
    }
    
    
     function inout() {
        $this->loadModel('Employee');
        $this->loadModel('Attendence');
        $this->layout = "admin-login";
        // if already logged in check this step
        if ($this->Auth->loggedIn()) {
            return $this->redirect('dashboard'); //(array('action' => 'deshboard'));
        }
        // after submit login form check this step
        if ($this->request->is('post')) {
            
            // log in by employee start
            if (array_key_exists("login", $this->request->data)) {
                $this->login($this->request->data);
            }
            // log in by employee end
            
            if (isset($this->request->data['in_button'])) {
                if ($this->Auth->login()) {
                    if ($this->Auth->user('status') == 'active') {
                        $currentTime = date("g:i a");
                        $currentdate = date("Y-m-d");
                       
                        $employee = $this->Auth->user();

                        $sql = 'SELECT * FROM attendences WHERE date ="' . $currentdate .
                                '" AND employee_id =' . $employee['id'] .
                                ' AND intime IS NOT NULL  AND outtime IS NULL';
                        $alreadyIn = $this->Attendence->query($sql);
                        if (!count($alreadyIn)) {
                            $dataToBeSaved = array('employee_id'=> $employee['id'],'intime'=> $currentTime, 'date' =>$currentdate);
                           
                            $this->Attendence->save($dataToBeSaved);
                            $msg = '<div class="alert alert-error">
                               <strong>Your in time :' . $currentTime . ' is Recorded </strong>
                            </div>';
                        } else {
                            $msg = '<div class="alert alert-error">
                               <strong> Strange!. You already in office and trying to Enter Office </strong>
                            </div>';
                            
                        }
                        
                    } else {
                        $msg = '<div class="alert alert-error">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               <strong>You are blocked, Contact with Adminstrator</strong>
                            </div>';
                    }
                   
                    //echo 'exit before redirect'; exit;
                    $this->Session->setFlash($msg);
                    $this->Auth->logout();
                    //return $this->redirect($this->referer());
                } else {
                    $msg = '<div class="alert alert-error">
                               <strong> Incorrect email/password combination. Try Again </strong>
                            </div>';
                    $this->Session->setFlash($msg);
                }
            }
            if (isset($this->request->data['out_button'])) {
                if ($this->Auth->login()) {
                    if ($this->Auth->user('status') == 'active') {

                        $employee = $this->Auth->user();
                        $currentTime = date("g:i a");
                        $currentdate = date("Y-m-d");
                        $sql = 'SELECT *  FROM attendences WHERE date ="' . $currentdate .
                                '" AND intime IS NOT NULL AND outtime IS NULL AND employee_id =' . $employee['id'];

                        
                        $alreadyIn = $this->Attendence->query($sql);


                        if (count($alreadyIn)) {
                            $this->Attendence->id = $alreadyIn[0]['attendences']['id'];
                            $this->Attendence->saveField('outtime', $currentTime);
                            $msg = '<div class="alert alert-error">
                               <strong>Your Out time :' . $currentTime . ' is Recorded </strong>
                            </div>';
                        } else {
                            $msg = '<div class="alert alert-error">
                               <strong> Strange!. You did not Enter office but trying to go out </strong>
                            </div>';
                        }
                    } else {
                        $msg = '<div class="alert alert-error">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               <strong>You are blocked, Contact with Adminstrator</strong>
                            </div>';
                    }

                    //echo 'exit before redirect'; exit;
                    $this->Session->setFlash($msg);
                    $this->Auth->logout();
                    //return $this->redirect($this->referer());
                } else {
                    $msg = '<div class="alert alert-error">
                               <strong> Incorrect email/password combination. Try Again </strong>
                            </div>';
                    $this->Session->setFlash($msg);
                }
            }
        }
    }  
       

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
               
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>You are blocked, Contact with Adminstrator</strong>
                        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->Auth->logout());
            }
        } else {
            $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>Incorrect email/password combination. Try Again</strong>
                        </div>';
            $this->Session->setFlash($msg);
        }
    }
    
    public function logout() {
        $msg = ' <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>You have successfully logged out</strong> 
                            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->Auth->logout());
    }

    function dashboard() {
        
    }

    function add_department() {
        $this->loadModel('Department');
        if ($this->request->is('post')) {

            $this->Department->set($this->request->data);
            if ($this->Department->validates()) {
                $this->Department->save($this->request->data['Department']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Department Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {

                $msg = $this->generateError($this->Department->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function create() {
        $this->loadModel('Employee');
        $this->loadModel('Department');
        $this->loadModel('Role');
        
        if ($this->request->is('post')) {
            $employee = $this->Role->findByName('employee');
              $this->request->data['Employee']['role_id'] = $employee['Role']['id'];
            $result = array();
            $result = $this->processImg($this->request->data['Employee'], 'doc1');
            if (isset($result['file_dst_name'])) {
                $this->request->data['Employee']['doc1'] = $result['file_dst_name'];
            } else {
                $this->request->data['Employee']['doc1'] = null;
            }

            $result = $this->processImg($this->request->data['Employee'], 'doc2');
            if (isset($result['file_dst_name'])) {
                $this->request->data['Employee']['doc2'] = $result['file_dst_name'];
            } else {
                $this->request->data['Employee']['doc2'] = null;
            }

            $this->Employee->set($this->request->data);
            if ($this->Employee->validates()) {
                if (!$this->dataExist) {
                    $this->Employee->email = $result['email'];

                    foreach ($this->request->data['Employee'] as $k => $v) {
                        if (!empty($v)) {
                            $this->Employee->saveField($k, $v);
                        }
                    }
                } else {

                    $this->Employee->save($this->request->data['Employee']);
                }
                //  $this->Employee->save($this->request->data['Employee']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Employee Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('inout');
            } else {
                $errors = $this->generateError($this->Employee->validationErrors);
                $this->set(compact('errors'));
            }
        }
        $this->set('departments', $this->Department->find("list"));
        //$this->set('roles', $this->Role->find("list"));
    }

    function manage() {
        $this->loadModel('Employee');
        $agents = $this->Employee->find('all');
        $this->set(compact('agents'));
    }

    function employer_workview($id = null) {
        $this->loadModel('Employee');
        $this->loadModel('Attendence');
        $sql = 'SELECT * FROM `attendences` WHERE `employee_id` = ' . $id . ' ORDER BY id DESC';
        //   $sql = 'SELECT m.name, m.action, sm.name FROM menus m LEFT JOIN sub_menus sm ON sm.menu_id = m.id ORDER BY m.name ASC';
        $attendence = $this->Attendence->query($sql);
        //$attendence = $this->Attendence->findById($id);
        $employee = $this->Employee->findById($id);
        // pr($newses); exit;
        $this->set(compact('employee', 'attendence'));
    }

    function edit($id = null) {
        $this->loadModel('Employee');
        $employee = $this->Employee->findById($id);
        $this->set(compact('employee'));

        if ($this->request->is('get')) {
            $this->request->data = $this->Employee->read(); //data read from database
        } else {
            $data = $this->request->data;   //new data insert start  
            //$image = $data['Employee']['doc1'];
            $data1 = $this->Employee->findById($id);
            $directory = WWW_ROOT . 'eImages';
            if (!empty($data['Employee']['doc1']['name'])) {

                if (move_uploaded_file($data['Employee']['doc1']['tmp_name'], WWW_ROOT . 'eImages/' . $data['Employee']['doc1']['name'])) {//new image upload
                    $data['Employee']['doc1'] = $data['Employee']['doc1']['name'];
                }
                if (unlink($directory . DIRECTORY_SEPARATOR . $data1['Employee']['doc1'])) { //delete image from root and database
                    echo 'image deleted.....';
                }
                # code...
            } else {
                // $data['Employee']['doc1'] = $data1['Employee']['doc1'];
            }
            if ($this->Employee->save($data)) {
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
           <strong> Employee update successfully </strong>
          </div>';
                $this->Session->setFlash($msg);
                $this->redirect(array('controller' => "employees", "action" => "edit"));
            } else {
                $this->Session->setFlash("not updated");
                $this->render();
            }
        }





        if (!$this->request->data) {
            $data = $this->Employee->findById($id);
            $this->request->data = $data;
        }
    }

    function delete($id = null) {
        $this->loadModel('Employee');
        $this->Employee->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Employee deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function block($id = null) {
        $this->loadModel('Employee');
        $this->Employee->id = $id;
        $this->Employee->saveField("status", "blocked");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Employee blocked succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function active($id = null) {
        $this->loadModel('Employee');
        $this->Employee->id = $id;
        $this->Employee->saveField("status", "active");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Employee activated succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function processImg($img, $type = null) {
        // pr($img); exit;
        if (empty($img[$type]['name'])) {
            $return['id'] = $this->clear_oldfile($img['email'], false);
            unset($img);
        } else {
            $this->current_dir = $type;
            $return['id'] = $this->clear_oldfile($img['email'], true);
            $upload = new Upload($img[$type]);
            $upload->file_new_name_body = $img['email'];
            foreach ($this->img_config[$type] as $key => $value) {
                $upload->$key = $value;
            }
            $upload->process($this->img_config['target_path'][$type]);

            if (!$upload->processed) {
                $msg = $this->generateError($upload->error);
                return $this->redirect('create');
            }
            // pr($upload->file_dst_name);
            $return['file_dst_name'] = $upload->file_dst_name;
        }
        return $return;
    }

    public function create_admin() {
        
    }

}

?>