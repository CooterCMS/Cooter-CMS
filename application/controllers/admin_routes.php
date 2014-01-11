<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
    Copyright (C) <2013>  <Cooter CMS>
 *
 * @package		Cooter CMS
 * @author		Kyle Coots - Cheetah Web Solutions
 * @copyright	Copyright (c) 2013, Cooter CMS
 * @license		http://www.CooterCMS.net/
 * @link		http://www.CooterCMS.net/
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 *
 * This class object is the Appointments model class. 
 *
 * @package		Cooter CMS
 * @subpackage  Model
 * @category	Appointments
 * @author		Kyle Coots - Cheetah Web Solutions
 * @link		http://www.CooterCMS.net/
 * 
 */
 
class Admin_routes extends CI_Controller {
		
	private $is_logged_in 		= FALSE;
	
	public function __construct(){
		parent::__construct();
	  
	  $this->is_logged_in = $this->auth_model->is_logged_in();

	}
	
	public function add_route(){
		if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
			if($this->input->is_ajax_request()){
			 echo 'Ajax';
			}else{
			 echo 'Not Ajax';
			}
		}
	}
	
	public function remove_route(){
		if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
			if($this->input->is_ajax_request()){
			 echo 'Ajax';
			}else{
			 echo 'Not Ajax';
			}
		}
	}
		
	public function update_route(){
		if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
			if($this->input->is_ajax_request()){
			 echo 'Ajax';
			}else{
			 echo 'Not Ajax';
			}
		}
	}	
}