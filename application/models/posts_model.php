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

class Posts_model extends CI_Model{
		
	public $post_id;
	public $post_name;
	public $post_title;
	public $post_html;
	public $post_date;
	public $post_tags;
	public $post_meta_name;
	public $post_meta_value;
	
	
    public function __construct(){
		parent::__construct();
	}
	
	/**
	 *  Check if post type is "post" or "page"
	 *  @return (bool)
	 */	
	public function valid_post_type($post_type){
		switch ($post_type) {
			case 'admin':
			case 'post':
			case 'page':
			case 'error':	
				$post_type = TRUE;
				break;
			default:
				$post_type = FALSE;
				break;
		}
		
		if($post_type == FALSE && !ctype_alpha($post_type)){
			return FALSE;
		}else{
			return TRUE;
		}
	} 
	
	public function get_post($post_value = null, $post_type){
	  $data = array();

	  if($post_value === null || empty($post_value) || $post_value == FALSE){
	  		
	  	$data = $this->posts_model->get_all_post($post_type);

	  }else if(ctype_digit($post_value) && $post_value !== null){
	  	
	  	$data = $this->posts_model->get_post_by_id($post_value, $post_type);

	  }else if(!ctype_digit($post_value) && $post_value !== null){
	  	
	    $data = $this->posts_model->get_post_by_name($post_value, $post_type);

	  }else{
	  	
	  	$data = 'get post function returned something else!';//$this->posts_model->get_not_found_post();
		
	  }
	  return $data;
	}
	/**
	 *  Get all post by type
	 */
	public function get_all_post($post_type, $post_count=0){
		if($this->valid_post_type($post_type)){
		  	
		  $return_data = array();
		  
		  $this->db->where('post_type', $post_type);
		  if(ctype_digit($post_count)){
		  	$post_data = $this->db->get('Posts', $post_count);
		  }else{
		  	$post_data = $this->db->get('Posts');
		  }
		  
		
		  if($post_data->num_rows() > 0){
			foreach ($post_data->result() as $key => $value) {
				$return_data[$key] = $value->post_view = $post_type;
				$return_data[$key] = $value;
			}			
		  }else{
			$return_data = $this->post_error($post_type);
		  }
		  
		  return $return_data;

		}else{
			
		  return $this->post_error($post_type);
		  
		}			
	}
	// Get post_by_id
	public function get_post_by_id($post_id = null, $post_type){
		if($this->valid_post_type($post_type)){
				
		  $return_data = array();

		  if(!empty($post_id) && $post_id !== null){
				
			$this->db->where('post_type', $post_type);
			$this->db->where('idPosts', $post_id);
			$post_data = $this->db->get('Posts');
			
			if($post_data->num_rows() > 0){
				foreach ($post_data->result() as $key => $value) {
					$return_data[$key] = $value->post_view = $post_type;
					$return_data[$key] = $value;
				}
			}else{
				
				$return_data = $this->post_error($post_type);

			}
			
		  }else{
		  		
		  	$return_data = $this->post_error($post_type);
			
		  }
		  
		  return $return_data;
		  
		}
	}
	// Get post_by_name
	public function get_post_by_name($post_name = null, $post_type){
		if($this->valid_post_type($post_type)){
		  	
		  $return_data = array();	
		  if(!empty($post_name) && $post_name !== null){
				
			$this->db->where('post_type', $post_type);	
			$this->db->where('name', $post_name);
			$post_data = $this->db->get('Posts');
			
			if($post_data->num_rows() > 0){
				foreach ($post_data->result() as $key => $value) {
					$return_data[$key] = $value->post_view = $post_type;
					$return_data[$key] = $value;
				}
			}else{
				$return_data = $this->post_error($post_type);
			}
			
		  }else{
		  		
		  	$return_data = $this->post_error($post_type);
			
		  }
		  return $return_data;

		}		
	}
	
	private function post_error($post_type=null){
			
		$return_data = array();
		
		$this->db->where('name', 'post_error');
		$post_data = $this->db->get('Posts', 1);
		
		if($post_data->num_rows() == 1){
		  foreach ($post_data->result() as $key => $value) {
		  	$return_data[$key] = $value->post_view = 'error';
			$return_data[$key] = $value;
		  }
		}else{
					
			$post_message = new stdClass;
			$post_message->post_view = 'error';
			$post_message->html = '<h1>Sorry</h1> <p>This "'. " $post_type " .'" is not a valid post type.</p>';
			$post_message->title = 'Not Found';
			$post_message->breadcrum = 'Error';
			$post_message->author_name = 'Default Error';
			$return_data = array('0' =>  $post_message);
			
		}
		
		return $return_data;
	} 
}