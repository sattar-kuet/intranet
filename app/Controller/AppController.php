<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('Mylib', 'Lib');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email', //Default is 'username' in the userModel
                        'password' => 'password'  //Default is 'password' in the userModel
                    ),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha256'
                    )
                )
            )
        )
    );
    public $per_page = 200;

    public function beforeFilter() {
        // save last visited url
        $url = Router::url(NULL, true); //complete url
        if (!preg_match('/login|logout|isLooged_in/i', $url)) {
            $this->Session->write('lastUrl', $url);
        }
        $this->set('baseUrl', Router::url('/', true));
        $this->Auth->allow('index', 'logo');
        $admin = $this->Auth->user();
        if (isset($admin['Role']['name'])) {
            $sidebar = $admin['Role']['name'];
            $this->set(compact('sidebar'));
        }
        $loggedUser = $this->Auth->user();
        $this->set('loggedUser', $loggedUser['name']);
      //  $this->sendReport();
      // echo 'works'; exit;
        //   $loggedUserpic = $this->Auth->user();       
        //  $this->set('loggedUserpic', $loggedUser['picture']);
    }

    function getFormatedDate($date = null) {
        $temp = explode('/', $date);
        if (count($temp) > 1) {
            return $temp[2] . '-' . $temp[0] . '-' . $temp[1];
        }
        return $date;
    }

    function loadFooter() {
        $this->loadModel('Footer');
        $footer = $this->Footer->find('all');
        $this->set(compact('footer'));
    }

    function loadLeftMenu() {
        $this->loadModel('Level');
        $options = array(
            'fields' => array('Level.name', 'Level.id', 'subjects.name', 'subjects.id', 'chapters.name', 'chapters.id'),
            'joins' => array('LEFT JOIN `subjects`  ON `Level`.`id` = `subjects`.`level_id` 
            LEFT JOIN `chapters`  ON `subjects`.`id` = `chapters`.`subject_id`       
                '),
            'conditions' => array('LOWER(Level.name)' => strtolower($this->request->params['action']))
        );

        $menus = $this->Level->find('all', $options);
        $filteredMenu = array();
        $unique = array();

        $index = 0;
        $subjectNo = 0;
        foreach ($menus as $key => $menu) {
            $level = $menu['Level']['id'];
            $subject = $menu['subjects']['id'];
            if (isset($unique[$level])) {
                if (isset($unique[$subject])) {
                    if (!empty($menu['chapters']['name'])) {
                        $temp = array('name' => $menu['chapters']['name'], 'chapter_id' => $menu['chapters']['id'], 'level_id' => $level, 'subject_id' => $subject);
                        $filteredMenu[$index]['subject'][$subjectNo]['chapter'][] = $temp;
                    }
                } else {
                    if ($key != 0)
                        $subjectNo++;
                    if (!empty($menu['chapters']['name'])) {
                        $temp = array('name' => $menu['subjects']['name']);
                        $filteredMenu[$index]['subject'][$subjectNo] = $temp;
                        $temp = array('name' => $menu['chapters']['name'], 'chapter_id' => $menu['chapters']['id'], 'level_id' => $level, 'subject_id' => $subject);
                        $filteredMenu[$index]['subject'][$subjectNo]['chapter'][] = $temp;
                    }
                }
            } else {

                if ($key != 0)
                    $index++;
                $unique[$level] = 'set';
                $temp = array('name' => $menu['Level']['name']);
                $filteredMenu[$index]['level'] = $temp;
                if (!empty($menu['subjects']['name'])) {
                    $temp = array('name' => $menu['subjects']['name']);
                    $filteredMenu[$index]['subject'][$subjectNo] = $temp;
                }


                if (!empty($menu['chapters']['name'])) {
                    $temp = array('name' => $menu['chapters']['name'], 'chapter_id' => $menu['chapters']['id'], 'level_id' => $level, 'subject_id' => $subject);
                    $filteredMenu[$index]['subject'][$subjectNo]['chapter'][] = $temp;
                }
            }
        }
        if (count($filteredMenu) > 0) {
            $leftMenu = $filteredMenu[0];
            $this->set(compact('leftMenu'));
        }

        //echo $this->Level->getLastQuery(); 
        //pr( $filteredMenu); exit;    
    }

    function pr($input = null) {
        echo '<pre>';
        print_r($input);
        echo '</pre>';
    }

    function generateError($input = null) {
        $output = '';
        if (is_array($input)) {
            $output = '<ul>';
            foreach ($input as $single) {
                foreach ($single as $value) {
                    $output.='<li>' . $value . '</li>';
                }
            }
            $output.='</ul>';
        } else {
            $output = $input;
        }

        $output = '<div class="alert alert-danger">
		' . $output . '<strong> Change these things and try again. </strong> </div>';
        return $output;
    }

    function humanTiming($input = null) {
        $time = strtotime($input);
        $time = time() - $time; // to get the time since that moment

        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '') . ' ago';
        }
    }

    public function getYM() {
        $cy = date('Y');
        $cm = date('m');
        $y = array();
        $n = 0;
        for ($i = $cy; $n < 40; $i++) {
            $y[$i] = $i;
            $n++;
        }
        $return['year'] = $y;
        $return['month'] = array(
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12'
        );
        return $return;
    }

    function getAllTickectsByCustomer($pcid) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
//        $tickets = $this->Track->query("SELECT * FROM tracks tr 
//                    inner join tickets t on tr.ticket_id = t.id
//                    inner join users fb on tr.forwarded_by = fb.id
//                    inner join roles r on  tr.role_id = r.id
//                    inner join users ft on  tr.user_id = ft.id order by tr.created desc");

        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                        WHERE tr.package_customer_id =" . $pcid . " ORDER BY tr.id DESC");

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
        $return['data'] = $data;
        $return['users'] = $users;
        $return['roles'] = $roles;
//        pr($return); exit;
        return $return;
    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    function generateInvoice($data = array()) {
        $this->loadModel('Transaction');

        $this->Transaction->create();
        $this->Transaction->save($data);
    }

    function formatCardNumber($card) {
        $digits = strlen($card);
        $last4 = substr($card, -4);
        $fill = '';
        for ($i = 0; $i < $digits - 4; $i++) {
            $fill .='X';
        }
        return $fill . $last4;
    }

    function getSubscriptionNo($daterange, $package, $duration = 0) {
        $this->loadModel('Transaction');
        //1 month total packages
        $sql1monthp = "SELECT COUNT(ps.name) as total1monthp FROM transactions tr
                left join package_customers pc on pc.id = tr.package_customer_id 
            left join psettings ps on ps.id = pc.psetting_id 
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE $daterange AND LOWER(ps.name) LIKE '%$package%'";
        $sql1monthp = $this->Transaction->query($sql1monthp);
//            pr($sql1monthp); exit;
        $sql1monthp1 = $sql1monthp[0][0]['total1monthp'];
        $sql1monthp = "SELECT COUNT(cp.id) as total1monthp FROM transactions tr
                left join package_customers pc on pc.id = tr.package_customer_id 
            left join custom_packages cp on cp.id = pc.custom_package_id 
            WHERE $daterange AND cp.duration = $duration";
        $sql1monthp = $this->Transaction->query($sql1monthp);
//            pr($sql1monthp); exit;
        $sql1monthp2 = $sql1monthp[0][0]['total1monthp'];

        return $sql1monthp1 + $sql1monthp2;
    }

    function removeEmptyElement($data = array()) {
        foreach ($data as $index => $single) {
            if (empty($single)) {
                unset($data[$index]);
            }
        }
        return $data;
    }

    function sendEmail($emailInfo = array()) {
 //pr($emailInfo); exit;
        $from = $emailInfo['from']; //'info@totalitsolution.com';
        $title = $emailInfo['title']; //'Report';
        $subject = $emailInfo['subject']; // "Reseller Registration";
        $to = $emailInfo['to']; //array('sattar.kuet@gmail.com');
        $mail_content = $emailInfo['content'];
        $Email = new CakeEmail('default');
        $Email->template($emailInfo['template'], null)
                ->emailFormat('html')
                ->from(array($from => $title))
//                ->attachments(array(
//                    array(
////<img src="../../assets/admin/pages/media/email/social_twitter.png" alt="social icon">
//                        'file' => ROOT . '/app/webroot/media/twitter.png',
//                        'mimetype' => 'image',
//                        'contentId' => 'twitterIcon'
//                    ),
//                    array(
/////assets/admin/pages/media/email/social_facebook.png
//                        'file' => ROOT . '/app/webroot/media/facebook.png',
//                        'mimetype' => 'image/png',
//                        'contentId' => 'fbIcon'
//                    ),
//                    array(
//                        'file' => ROOT . '/app/webroot/media/logo-corp-red.png',
//                        'mimetype' => 'image',
//                        'contentId' => 'logo'
//                    )
//                ))
                ->viewVars(compact('mail_content'))
                ->to($to)
                ->subject($subject);

        try {
            $Email->send();
            return true;
        } catch (SocketException $e) {
            return false;
        }
    }

    function sendReport() {
        
        $emailInfo = array(
            'from' => 'info@totalitsolution.com',
            'to' => array('sattar.kuet@gmail.com'),
            'title' => 'Report',
            'template' => 'report',
            'subject' => 'Report',
            'content' => array()
        );
        $this->sendEmail($emailInfo);
       
        // End send mail 
    }

}
