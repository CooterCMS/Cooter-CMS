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

class Options_model extends CI_Model{
	
	private $_db_table = 'Options';
	private $_option_type = 'System';
	
	private $site_title = '';
	private $site_url = '';
	private $site_tagline = '';
	
	private $default_page = 0;
	private $default_post = 0;
	
    public function __construct(){
		parent::__construct();

		$this->set_site_title();
		$this->set_site_url();
		$this->set_site_tagline();
		
		$this->set_default_page();
		$this->set_default_post();
	}
	/**
	* Get options returns and array or an array containing multiple object(s)  
	 * @return array  
	*/
	public function get_option($option_name='', $option_type='', $method_name=''){

	// Array to store data	
	$return_data = array();

	// Set the option type
	$this->_option_type = ($option_type) ? $option_type : 'System';
	  
	  // Returns the data from method if method exsits
	  if($method_name && method_exists($this->options_model, $method_name)){
	    return $this->$method_name($option_name, $this->_option_type);		
	  	  exit;
	  }
	  // Get option by type
	  if(!$option_name && $option_type){
		return $this->get_option_by_type($this->_option_type);
		  exit;
	  }	  	  
	  // Get option by int
	  if(ctype_digit($option_name)){
	    return $this->get_option_by_id($option_name, $this->_option_type);
	      exit;
	  }
	  // Get option by name	
	  if(!ctype_digit($option_name) && (!empty($option_name))){
	    return $this->get_option_by_name($option_name, $this->_option_type);
		  exit;
	  }
	  
	  return $return_data;
	  exit;
	}

	/**
	 * Get option by option type
	 */
	private function get_option_by_type($option_type){
	  
		// Get Page data	
		$this->db->where('option_type', $option_type);
		$page_data = $this->db->get($this->_db_table);

		//Store results in an array
		$return_data = array();
		
		if($page_data->num_rows() > 0){
			foreach ($page_data->result() as $key => $value) {
				$return_data[$key] = $value->response = TRUE;	
				$return_data[$key] = $value;
			}
		}else{
			$error_data = new stdClass;	
			$error_data->response = false;
			$error_data->error_code = '300';
			$error_data->error = 'Option(s) not found with that type.';
			$return_data[] = $error_data;
		}	
	
		return $return_data;
	}
	/**
	 * Get option by option name
	 */
	private function get_option_by_id($option, $option_type){
	  
		// Get Page data	
		$this->db->where('option_type', $option_type);
		$this->db->where('idOption', $option);
		$page_data = $this->db->get($this->_db_table);

		//Store results in an array
		$return_data = array();
		
		if($page_data->num_rows() == 1){
			foreach ($page_data->result() as $key => $value) {
				$return_data[$key] = $value->response = TRUE;
				$return_data[$key] = $value;
			}
		}else{
			$error_data = new stdClass;
			$error_data->response = TRUE;
			$error_data->error_code = '301';
			$error_data->error = 'Option not found with that id.';
			$return_data[] = $error_data;
		}	
	
		return $return_data;
	}
	/**
	 * Get option by option name
	 */
	private function get_option_by_name($option_name){
	  
		// Get Page data
		$this->db->where('option_name', $option_name);
		$page_data = $this->db->get($this->_db_table);

		//Store results in an array
		$return_data = array();
		
		if($page_data->num_rows() == 1){
			foreach ($page_data->result() as $key => $value) {
				$return_data[$key] = $value->response = TRUE;
				$return_data[$key] = $value;
			}
		}else{
			$error_data = new stdClass;
			$error_data->response = false;
			$error_data->error_code = '302';
			$error_data->error = 'Option not found by that name.';
			$return_data[] = $error_data;
		}	
	
		return $return_data;
	}
	
	/**
	 *  Setters
	 */
	
	/**
	 * Set the site title
	 */
	private function set_site_title(){
		$option = $this->get_option('site_title', $this->_option_type);
		$this->template->set_default_title($option[0]->option_value);
		$this->site_title = $option[0]->option_value;
	}
	/**
	 * Set the default tag line. This is only displayed when on the homepage
	 */
	private function set_site_tagline(){
		// Check if the url contains any segments
		if(!$this->uri->segment(1)){
		$option = $this->get_option('site_tagline', $this->_option_type);
		// Add the tagline to the tempalte library	
		$this->template->addtagline($option[0]->option_value, FALSE);
		// Set this class' site tagline
		$this->site_tagline = $option[0]->option_value;
		}
	}
	/**
	 * Set default site url to be used
	 */		
	private function set_site_url(){
		$option = $this->get_option('site_address', $this->_option_type);
		// Set the config base url 
		$this->config->set_item('base_url', $option[0]->option_value);
		// Set this class' site url
		$this->site_url = $option[0]->option_value;
	}
	/**
	 * Set default post to be displayed
	 */
	private function set_default_post(){
		$option = $this->get_option('default_post', $this->_option_type);
		$this->default_post = ($option !== FALSE) ? $option[0]->option_value : $option;
	}
	/**
	 * Set default page to be displayed
	 */		
	private function set_default_page(){
		$option = $this->get_option('default_page', $this->_option_type);
		$this->default_page = ($option !== FALSE) ? $option[0]->option_value : $option;
	}

	/**
	 * Getters 
	 */
	 
	public function get_site_title(){
		return $this->site_title;
	}
	public function get_site_tagline(){
		return $this->site_tagline;
	}
	public function get_site_url(){
		return $this->site_url;
	}	
	public function get_default_post(){
		return $this->default_post;	
	}
	public function get_default_page(){
		return $this->default_page;	
	}

}

?>