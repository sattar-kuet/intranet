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

	function pr($input=null){
		echo '<pre>'; 
		print_r($input);
		echo '</pre>';

	}
	function generateError($input=null){
		$output='<ul>';
		foreach ($input as $single) {
			foreach ($single as $value) {
				$output.='<li>'.$value.'</li>';
			}
			
		}
		$output.='</ul>';
		$output='<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		'.$output.'<strong> Change these things and try again. </strong> </div>';
		return $output;
	}



	function humanTiming ($input=null)
	{
    $time = strtotime($input);
    $time = time() - $time; // to get the time since that moment

    $tokens = array (
    	31536000 => 'year',
    	2592000 => 'month',
    	604800 => 'week',
    	86400 => 'day',
    	3600 => 'hour',
    	60 => 'minute',
    	1 => 'second'
    	);

    foreach ($tokens as $unit => $text) {
    	if ($time < $unit) continue;
    	$numberOfUnits = floor($time / $unit);
    	return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
    }

}
}
