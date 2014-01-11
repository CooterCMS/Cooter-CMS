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
 
class Admin extends CI_Controller {
		
	private $is_logged_in 		= FALSE;
	private $login_count		= FALSE;
	
	private $post_type = 'admin';
	
	private $default_post = 0;
	
	public function __construct(){
		parent::__construct();
	  
	  $this->is_logged_in = $this->auth_model->is_logged_in();
	  $this->login_count  = $this->auth_model->get_form_submit_count('Login', 3600);
	  $this->config->load('recaptcha');
	  $this->load->helper('recaptcha');

	}

	public function index($post_value = NULL)
	{

	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
		redirect(base_url().'admin/dashboard');
		
	  }else{
	  	// Show the login form
	    $this->login_form();
	  }
	   
	}
	/**
	 * Login Form
	 * Displays the login form 
	 */
	private function login_form(){
	  // Load our theme
	  $this->theme_model->load_theme('default');	
	  // Add post title  
	  $this->template->addtitle('Login Form');
	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'login');
	  $template_data->recaptcha = '';
		
		if($this->login_count > 1){
				
				$template_data->recaptcha = recaptcha();
				$resp = recaptcha_check_answer(
						$this->config->item('recaptcha_private_key'),
						$_SERVER["REMOTE_ADDR"],
						$this->input->post('recaptcha_challenge_field'),
						$this->input->post('recaptcha_response_field')
						);
				
				if($resp->is_valid != TRUE){
					$this->form_validation->set_rules(
				'recaptcha_challenge_field', 'ReCaptcha Challenge Field', 'required|matches[recaptcha_response_field]'
					);
					$this->form_validation->set_rules(
				'recaptcha_response_field', 'ReCaptcha Response Field', 'required'
					);	
				}
			}
		  // Load the view	
	  	  $this->load->view($template_data->template, $template_data);
	}
	
	public function dashboard(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Dashboard');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'dashboard', $data);
	  
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}
	/**
	 * Posts
	 */
	public function posts(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Posts');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'posts', $data);
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}
	/**
	 * Pages
	 */
	public function pages(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Pages');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'pages', $data);
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}
	/**
	 * Assets
	 */
	public function assets(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Assets');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'assets', $data);
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}
	/**
	 * Themes
	 */
	public function themes(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Themes');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'themes', $data);
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}		
	/**
	 * Users
	 */
	public function users(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Users');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'users', $data);
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}	
	/**
	 * Options
	 */
	public function options(){
		
	  $data = new stdClass;

	  if($this->is_logged_in && $this->auth_model->current_user_role('admin')){
	  	
	  // Load our theme
	  $this->theme_model->load_theme('admin');
	  
	  // Add post title  
	  $this->template->addtitle('Admin | Options');

	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().'options', $data);
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	$this->login_form();
	  }
	}	
	/**
	 * Routes
	 */
	public function routes(){
	  	
	  // Variable
	  $user_role 	= 'admin';// User role to allow access for
	  $model 		= 'admin_routes_model'; // Model for this function
	  $theme 		= 'admin'; // Theme for this function
	  $page_title 	= 'Admin | Routes'; // Title of the page
	  $page 		= 'routes'; // Page to load
	  
	  // Object for extra data  
	  $extra_data = new stdClass;
	  
	  // Check if user is logged in
	  if($this->is_logged_in && $this->auth_model->current_user_role($user_role)){
	  	
	  // Load the model
	  $this->load->model($model);  	
	  // Load our theme
	  $this->theme_model->load_theme($theme);  
	  // Add post title  
	  $this->template->addtitle($page_title);
		
	  // Setup and Load the template
	  $template_data = $this->template->load($this->template->get_template_dir().$page, $extra_data);
	  
	  $template_data->routes = $this->admin_routes_model->index();
	  
	  // Load the view	
  	  $this->load->view($template_data->template, $template_data);
	  
	  }else{
	  	// Not logged in!!
	  	$this->login_form();
	  }
	  
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */