<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketsController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {
        return true;
    }

    function create($customer_id = null) {
        if ($customer_id == null) {
            $this->redirect('/admins/servicemanage');
        }
        $loggedUser = $this->Auth->user();
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('Issue');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Issue');
        $this->loadModel('TicketDepartment');
        $this->loadModel('PackageCustomer');
        if ($this->request->is('post')) {
            $this->Ticket->set($this->request->data);
            if ($this->Ticket->validates()) {
                if (empty($this->request->data['Ticket']['user_id']) &&
                        empty($this->request->data['Ticket']['role_id']) &&
                        empty($this->request->data['Ticket']['action_type'])) {
                    $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this ticket  </strong>
			</div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->referer());
                }
                if (trim($this->request->data['Ticket']['action_type']) == 'solved') {
                    $this->request->data['Ticket']['priority'] = 'low';
                }
                $tickect = $this->Ticket->save($this->request->data['Ticket']); // Data save in Ticket
                $trackData['Track'] = array(
                    'issue_id' => $this->request->data['Ticket']['issue_id'],
                    'package_customer_id' => $customer_id,
                    'user_id' => $this->request->data['Ticket']['user_id'],
                    'role_id' => $this->request->data['Ticket']['role_id'],
                    'issue_id' => $this->request->data['Ticket']['issue_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'forwarded_by' => $loggedUser['id']
                );


//                if (trim($this->request->data['Ticket']['action_type']) == 'solved') {
//                    $trackData['Track']['status'] = 'solved';
//                }
                //pr($this->request->data['Ticket']['action_type']); exit;

                if (trim($this->request->data['Ticket']['action_type']) == "ready") {
                    // echo 'here'; exit;
                    $this->PackageCustomer->id = $customer_id;
                    $this->PackageCustomer->saveField("status", "old_ready");
                    $this->PackageCustomer->saveField("comments", $this->request->data['Ticket']['content']);
                }
                if (trim($this->request->data['Ticket']['action_type']) == 'shipment') {
                    pr($this->request->data);
                    exit;
                    if ($this->request->data['Ticket']['shipment_equipment'] == 'OTHER') {
                        $this->request->data['Ticket']['shipment_equipment'] = $this->request->data['Ticket']['shipment_equipment_other'];
                    }
                    $this->PackageCustomer->id = $customer_id;
                    $data['PackageCustomer'] = array(
                        'shipment' => 2,
                        'comments' => $this->request->data['Ticket']['content'],
                        'shipment_equipment' => $this->request->data['Ticket']['shipment_equipment'],
                        'shipment_note' => $this->request->data['Ticket']['shipment_note'],
                        'issue_id' => $this->request->data['Ticket']['issue_id']
                    );
                    $this->PackageCustomer->save($data);  // 2 means old customer
                  
                }
                $this->Track->save($trackData); // Data save in Track
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Ticket Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Ticket->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));

        $this->set(compact('users', 'roles', 'issues'));
    }

    function close($id = null) {
        $this->loadModel('Track');
        $this->Ticket->id = $id;
        $this->Ticket->saveField("status", "closed");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Ticket is closed succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function unsolve() {
        $this->loadModel('Track');
        $this->request->data['Track']['status'] = 'unresolved';
        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
        $this->Track->save($this->request->data['Track']);
        $msg = '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Ticket is closed without solution </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function ticket_comment() {
        $this->loadModel('Track');
        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
//        pr($this->request->data);  exit;
        $this->Track->save($this->request->data['Track']);
        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Comments insert succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function solve() {
        $this->loadModel('Track');
        $this->request->data['Track']['status'] = 'solved';
        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
        $this->Track->save($this->request->data['Track']);
        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Ticket is Solved succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function edit() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Role->set($this->request->data);
            if ($this->Role->validates()) {
                $this->Role->id = $this->request->data['Role']['id'];
                $this->Role->save($this->request->data['Role']);
                $msg = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Role edited succeesfully </strong>
                </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
        $this->set(compact('roles'));
    }

    function manage() {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
//        $tickets = $this->Track->query("SELECT * FROM tracks tr 
//                    inner join tickets t on tr.ticket_id = t.id
//                    inner join users fb on tr.forwarded_by = fb.id
//                    inner join roles r on  tr.role_id = r.id
//                    inner join users ft on  tr.user_id = ft.id order by tr.created desc");
        $loggedUser = $this->Auth->user();
        if ($loggedUser['Role']['name'] == 'sadmin') {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
			left join package_customers pc on tr.package_customer_id = pc.id order by tr.created DESC limit 100");
        } else {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE tr.user_id =" . $loggedUser['id'] . " ORDER BY tr.created DESC limit 100");
        }
        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        //  pr($roles); exit;
        $this->set(compact('data', 'users', 'roles'));
    }

    function assigned_to_me1() {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
//        $tickets = $this->Track->query("SELECT * FROM tracks tr 
//                    inner join tickets t on tr.ticket_id = t.id
//                    inner join users fb on tr.forwarded_by = fb.id
//                    inner join roles r on  tr.role_id = r.id
//                    inner join users ft on  tr.user_id = ft.id order by tr.created desc");
        $loggedUser = $this->Auth->user();


        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                        WHERE tr.user_id =" . $loggedUser['id'] . " ORDER BY tr.created DESC");

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        //   pr($data); exit;

        $this->set(compact('data', 'users', 'roles'));
    }

    function assigned_to_me() {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $loggedUser = $this->Auth->user();
        $tickets = $this->Ticket->query("SELECT * 
                                        FROM tickets t
                                        LEFT JOIN tracks tr ON tr.ticket_id = t.id
                                        left JOIN issues i ON tr.issue_id = i.id
                                        left join users fb on tr.forwarded_by = fb.id
                                        left join users sb on tr.solved_by = sb.id
                                        left join users usb on tr.unsolved_by = usb.id
                                        left JOIN roles fd ON tr.role_id = fd.id
                                        left JOIN users fi ON tr.user_id = fi.id
                                        left join package_customers pc on tr.package_customer_id = pc.id
                                        WHERE tr.ticket_id IN (SELECT ticket_id from tracks  tr where  tr.user_id  = " .
                $loggedUser['id'] . ")" . " ORDER BY tr.id DESC");
//              pr($tickets); exit;

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {


            $t = $ticket['t']['id'];

            if (isset($unique[$t])) {
                $temp = array('tr' => $ticket['tr'], 'sb' => $ticket['sb'], 'usb' => $ticket['usb'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'sb' => $ticket['sb'], 'usb' => $ticket['usb'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles'));
    }

    function forwarded_by() {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $loggedUser = $this->Auth->user();
        $tickets = $this->Ticket->query("SELECT * 
                                        FROM tickets t
                                        LEFT JOIN tracks tr ON tr.ticket_id = t.id
                                        left JOIN issues i ON tr.issue_id = i.id
                                        left join users fb on tr.forwarded_by = fb.id
                                        left join users sb on tr.solved_by = sb.id
                                        left join users usb on tr.unsolved_by = usb.id
                                        left JOIN roles fd ON tr.role_id = fd.id
                                        left JOIN users fi ON tr.user_id = fi.id
                                        left join package_customers pc on tr.package_customer_id = pc.id
                                        WHERE tr.ticket_id IN (SELECT ticket_id from tracks  tr where tr.forwarded_by = " .
                $loggedUser['id'] . ")" . " ORDER BY tr.id DESC");

// pr($tickets); exit;
        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {


            $t = $ticket['t']['id'];

            if (isset($unique[$t])) {
                $temp = array('tr' => $ticket['tr'], 'sb' => $ticket['sb'], 'usb' => $ticket['usb'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'sb' => $ticket['sb'], 'usb' => $ticket['usb'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles'));
    }

    function customertickethistory($id = null) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
//        $tickets = $this->Track->query("SELECT * FROM tracks tr 
//                    inner join tickets t on tr.ticket_id = t.id
//                    inner join users fb on tr.forwarded_by = fb.id
//                    inner join roles r on  tr.role_id = r.id
//                    inner join users ft on  tr.user_id = ft.id order by tr.created desc");
        $loggedUser = $this->Auth->user();
        if ($loggedUser['Role']['name'] == 'sadmin') {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
			left join package_customers pc on tr.package_customer_id = pc.id where pc.id = $id order by tr.created DESC");
//            pr($tickets);
//        exit;
        } else {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id where pc.id = $id
                        and tr.role_id =" . $loggedUser['Role']['id'] . " OR tr.user_id =" . $loggedUser['Role']['id'] . " ORDER BY tr.created DESC");
        }
//        pr('here');
//        exit;
        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        //   pr($data); exit;
        //  pr($roles); exit;
        $this->set(compact('data', 'users', 'roles'));
    }

    function forward() {
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();

//        pr($this->request->data);
//        exit;

        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
        if (empty($this->request->data['Track']['user_id']) && empty($this->request->data['Track']['role_id'])) {
            $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this ticket  </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $this->Track->save($this->request->data['Track']);
        $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Ticket Forwarded successfully!  </strong>
			</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function adddepartment() {
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->TicketDepartment->set($this->request->data);
            if ($this->TicketDepartment->validates()) {
                $this->TicketDepartment->save($this->request->data['TicketDepartment']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Added New Department  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('adddepartment');
            } else {
                $msg = $this->generateError($this->TicketDepartment->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editdepartment() {
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->TicketDepartment->set($this->request->data);
            if ($this->TicketDepartment->validates()) {
                $this->TicketDepartment->id = $this->request->data['TicketDepartment']['id'];
                $this->TicketDepartment->save($this->request->data['TicketDepartment']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->TicketDepartment->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->TicketDepartment->find('list', array('order' => array('TicketDepartment.name' => 'ASC')));
        $this->set(compact('TicketDepartment'));
        $this->set(compact('roles'));
    }

    function addissue() {
        $this->loadModel('Issue');
        if ($this->request->is('post')) {
            $this->Issue->set($this->request->data);
            if ($this->Issue->validates()) {
                $this->Issue->save($this->request->data['Issue']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Added New Issue </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addissue');
            } else {
                $msg = $this->generateError($this->issue->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editissue() {
        $this->loadModel('Issue');
        if ($this->request->is('post')) {
            $this->Issue->set($this->request->data);
            if ($this->Issue->validates()) {
                $this->Issue->id = $this->request->data['Issue']['id'];
                $this->Issue->save($this->request->data['Issue']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Issue->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->Issue->find('list', array('order' => array('Issue.name' => 'ASC')));
        $this->set(compact('Issue'));
        $this->set(compact('roles'));
    }

    function addmassage() {
        $this->loadModel('Message');
        if ($this->request->is('post')) {
            $this->Message->set($this->request->data);
            if ($this->Message->validates()) {
                $loggedUser = $this->Auth->user();
                $this->request->data['Message']['user_id'] = $loggedUser['id'];
                $this->Message->save($this->request->data['Message']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>  New Message added </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Message->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function solved_ticket() {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE tr.status = 'solved' ORDER BY tr.created DESC");

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        //  pr($roles); exit;
        $this->set(compact('data', 'users', 'roles'));
    }

}

?>