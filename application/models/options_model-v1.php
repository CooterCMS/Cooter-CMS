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
	
	private $site_title = '';
	private $site_url = '';
	private $site_tagline = '';
	private $default_post = 0;
	private $default_page = 0;
	
    public function __construct(){
		parent::__construct();
		
		$this->set_site_title();
		$this->set_site_url();
		$this->set_site_tagline();
		
		$this->set_default_page();
		$this->set_default_post();
		
	}
	
	/**
	 * Get option by option name
	 */
	private function get_option($option_name){
		// Get Page data	
		$this->db->where('option_name', $option_name);
		$page_data = $this->db->get('Options');
		//Sort through the results
		$return_data = array();
		if($page_data->num_rows() > 0){
			foreach ($page_data->result() as $key => $value) {
				$return_data[$key] = $value;
			}
		}else{
			$return_data = FALSE;
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
		$option = $this->get_option('site_title');
		$this->template->set_default_title($option[0]->option_value);
		$this->site_title = $option[0]->option_value;
	}
	/**
	 * Set the default tag line. This is only displayed when on the homepage
	 */
	private function set_site_tagline(){
		// Check if the url contains any segments
		if(!$this->uri->segment(1)){
		$option = $this->get_option('site_tagline');
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
		$option = $this->get_option('site_address');
		// Set the config base url 
		$this->config->set_item('base_url', $option[0]->option_value);
		// Set this class' site url
		$this->site_url = $option[0]->option_value;
	}
	/**
	 * Set default post to be displayed
	 */
	private function set_default_post(){
		$option = $this->get_option('default_post');
		$this->default_post = ($option !== FALSE) ? $option[0]->option_value : $option;
	}
	/**
	 * Set default page to be displayed
	 */		
	private function set_default_page(){
		$option = $this->get_option('default_page');
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
	public function get_option_by_name($option_name){
		$option = $this->get_option($option_name);
		return $option;
	}	
}

?>