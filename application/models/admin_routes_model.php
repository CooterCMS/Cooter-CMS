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
 */

class Admin_routes_model extends CI_Model{
	
	private $_db_table = 'Routes';
	private $_option_type = 'System';
	
    public function __construct(){
	}
	
	public function index(){
		
		$data = $this->db->get($this->_db_table);
		$return_data = array();
		foreach ($data->result() as $value) {
			$return_data[] = $value;
		}
		return $return_data;
	}
	
	public function add_route(){
		
	}	
	
	public function remove_route(){
		
	}
	
	public function update_route(){
		
	}
	
}