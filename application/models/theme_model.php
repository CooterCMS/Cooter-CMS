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

class Theme_model extends CI_Model{
		
	private $theme_name = '';
	private $enabled = true;
		
    public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Load Theme
	 * @var theme[int][text]
	 * @var enabled[bool] 
	 */
	public function load_theme($theme = '', $enabled = true){
		if(isset($theme) && !empty($theme)){
		  if(ctype_alnum($theme)){
			$this->theme_name = $theme;
		  }
		}
		$this->enabled = $enabled;
		
	  $theme_data = $this->get_theme();
	  
	  foreach($theme_data as $theme){
	    // Load our assets
	    $this->load_css($theme->name);
		$this->load_js($theme->name);
		$this->load_meta($theme->name);
	    // Setup the rest of the template
	    $this->template->set_template_dir($theme->template_dir);
	    $this->template->set_template_assets_dir($theme->template_assets_dir);	
	    $this->template->set_template_index($theme->template_index);
	    $this->template->set_header($theme->template_header);
	    $this->template->set_menu($theme->template_menu);
	    $this->template->set_footer($theme->template_footer);
	  }
	  
	}
	// Get the enabled theme 
	private function get_theme($theme = null){
			
		$this->db->where('enabled', $this->enabled);

		if(isset($this->theme_name) && !empty($this->theme_name)){	
		  $this->db->where('name', $this->theme_name);
		}
		
		$page_data = $this->db->get('Theme', 1);
		
		$return_data = array();
		if($page_data->num_rows() > 0){
			foreach ($page_data->result() as $key => $value) {
				$return_data[$key] = $value;
			}
		}		
		return $return_data;
	}
	// Loads the css
	public function load_css($css_name){
	  $css_data = $this->get_css($css_name);
	  
	  foreach($css_data as $css){
		  if($css->remote == TRUE){
		  	$this->template->addcss($css->file_name, TRUE);
		  }else{
		  	$css_file = $css->file_dir.'/'.$css->file_name;
		    $this->template->addcss($css_file);  	
		  }
	  	
	  }
	}
	// Gets the css
	private function get_css($css_name){
		
		$this->db->where('name', $css_name);
		$this->db->where('file_type', 'css');
		$data = $this->db->get('Assets');		
		
		$return_data = array();
		
		if($data->num_rows() > 0){
			
		  foreach($data->result() as $key => $value){
			$return_data[$key] = $value;	
		  }
		  	
		}
		
		return $return_data;
	}
	// Loads the js
	public function load_js($js_name){
	  $js_data = $this->get_js($js_name);
	  foreach($js_data as $js){
		  if($js->remote == TRUE){
		  	$this->template->addjs($js->file_name, TRUE);
		  }else{
		  	$js_file = $js->file_dir.'/'.$js->file_name;
		    $this->template->addjs($js_file);  	
		  }
	  	
	  }
	}
	// Gets the js
	private function get_js($js_name){
		
		$this->db->where('name', $js_name);
		$this->db->where('file_type', 'js');
		$data = $this->db->get('Assets');		
		
		$return_data = array();
		
		if($data->num_rows() > 0){
			
		  foreach($data->result() as $key => $value){
			$return_data[$key] = $value;	
		  }
		  	
		}
		
		return $return_data;
	}
	// Loads the meta
	public function load_meta($meta_name){
	  $meta_data = $this->get_meta($meta_name);
	  foreach($meta_data as $meta){
		  
		$this->template->addmeta($meta);  	
	  	
	  }
	}
	// Gets the meta
	private function get_meta($meta_name){
		
		$this->db->select('name');
		$this->db->select('content');
		$this->db->where('post_name', $meta_name);
		$data = $this->db->get('Meta');		
		
		$return_data = array();
		
		if($data->num_rows() > 0){
			
		  foreach($data->result() as $key => $value){
			$return_data[$key] = $value;	
		  }
		  	
		}
		
		return $return_data;
	}	
	
}