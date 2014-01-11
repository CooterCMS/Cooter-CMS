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
class My_404 extends CI_Controller
{
	private $post_type = 'error';
	
	private $default_post = 0;
	
    public function __construct(){
        parent::__construct();
	  
	  $this->theme_model->load_theme();
	  $this->load->model('posts_model');
	  
    }
	/**
	 * Displays a 404 error page. This is set in the routes file
	 * @see MY_Exceptions  
	 */ 
    public function index(){
      	
      $post_value = 'post_error';
      
      $data = new stdClass;
  
      $data->post_data = $this->posts_model->get_post($post_value, $this->post_type);	

	  $this->template->addtitle($data->post_data[0]->title);

	  $template_data = $this->template->load($this->template->get_template_dir().$data->post_data[0]->post_view, $data);

	  $this->load->view($template_data->template, $template_data);

    }//End index()
}
?>