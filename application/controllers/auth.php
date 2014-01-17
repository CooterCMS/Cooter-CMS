<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cooter CMS
 *
    Copyright (C) <2012-2013>  <Cooter CMS>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * An open source CMS for PHP 5.1.6 or newer
 *
 *
 * @package		Cooter CMS
 * @author		Kyle Coots
 * @copyright	Copyright (c) 2012 - 2013, Cooter CMS
 * @license		http://www.cootercms.net/
 * @link		http://www.cootercms.net/
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Cooter CMS Application
 *
 * This class object is the Authentication model.
 *
 * @package		Cooter CMS
 * @subpackage	Model
 * @category	Authentication
 * @author		Kyle Coots
 * @link		http://www.cootercms.net/
 */
 
class Auth extends CI_Controller{
	
   private $is_logged_in 		= FALSE;
   private $login_count			= FALSE;
   private $register_count		= FALSE;

   public function __construct(){				
		parent::__construct();
		
		$this->login_count 		= $this->auth_model->get_form_submit_count('Login', 3600);
		$this->is_logged_in  	= $this->auth_model->is_logged_in();
		
		$this->config->load('recaptcha');
		$this->load->helper('recaptcha');
		
   }
 	/**
	 * Login
	 */		
   public function login(){
		
	$post_data = new stdClass;

   	// Set Form Submit	 
	$this->auth_model->set_form_submit('Login');
	
	  if($this->is_logged_in){

		show_404();

	  }
	  
	  if($this->auth_model->allow_login()){

		// Check if we need reCaptcha form validations
		$recaptcha = '';
		if($this->login_count > 1){
			
			$recaptcha = recaptcha();
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
	
		// Post data
		$post_data = new stdClass;
		$post_data->username 	= $this->input->post('username');
		$post_data->password 	= $this->input->post('password');
		//$post_data->remember_me = $this->input->post('remember_me');
	
		// If the form is called directly, display the login form
		if(!$this->input->post()){
			// Load the theme	
			$this->theme_model->load_theme('default');   
			// Load the template
			$template_data = $this->template->load($this->template->get_template_dir().'login');
			$template_data->post_username = ($this->input->post('username') !== '' ? $this->input->post('username'):'');
			$template_data->recaptcha = $recaptcha;
			
	        $this->load->view($template_data->template, $template_data);
	
		}else{
			
		$this->form_validation->set_rules(
			'username', 'Username', 'trim|required'
		);
		$this->form_validation->set_rules(
			'password', 'Password', 'trim|required|min_length[6]|max_lenght[32]'
		);
			// Check form validation
			if($this->form_validation->run() == FALSE){
					
				// Load additional script			
				$this->template->addjs('auth');
				$this->template->addcss('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css', true);
				$this->template->addjs('http://code.jquery.com/ui/1.10.3/jquery-ui.js', true);
				
				// Load the theme	
				$this->theme_model->load_theme('default');   
				// Load the template
				$template_data = $this->template->load($this->template->get_template_dir().'login');
				$template_data->post_username = ($this->input->post('username') !== '' ? $this->input->post('username'):'');
				$template_data->recaptcha = $recaptcha;
				$template_data->animate = 1;
				// Load the view
		        $this->load->view($template_data->template, $template_data);

			}else{
					
			  // Try to login user
			  
			  
				// Login user 		
				$return_data = $this->auth_model->login($post_data);					
				
				// Load the theme	
				$this->theme_model->load_theme($return_data->theme);   
				$template_data = $this->template->load($this->template->get_template_dir().$return_data->page);
				$this->load->view($template_data->template, $template_data);

			}// End form Validataion
	
		}// End if NOT POST
	
	  }else{
	  	 // Login Disabled
	  	
	  	// Load the theme	
		$this->theme_model->load_theme('default');
		$template_data = $this->template->load($this->template->get_template_dir().'login_disabled');
		$this->load->view($template_data->template, $template_data);
		
	  }

	}
	/**
	 * Destroy's the current user session
	 * 
	 * @see http://ellislab.com/codeigniter/user-guide/libraries/sessions.html Documentation of Sessions
	 */
    public function logout(){
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
        }
    } 
   /**
    * Register The User 
    */
    public function register(){
    	
    }
	/**
	 * Remove Account
	 */
	public function remove_account(){
		
	} 
	/**
	 * Recover Account
	 */
	public function recover_account(){
		
	}
		
	public function get_last_active(){
		
		$session_id = $this->session->userdata('session_id');
		$this->db->select('last_activity');
		$this->db->where('session_id', $session_id);
		$query = $this->db->get('Manage_Sessions');
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->last_activity;
			}
		}
		
	}
	
	public function check_login($data=null){
		if($this->is_logged_in == FALSE){
			$login_form = $this->login_form();
			//echo 'Logged Out';
			echo "<script> $(function() {
					$( '#dialog' ).dialog();
				});</script><div id='dialog'>$login_form</div>";
		}
	}

	public function login_form(){
		$token_name = $this->security->get_csrf_token_name(); 
		$token_value = $this->security->get_csrf_hash();
		return "<div id=\"login\">
		<form action=\"http://manage.valleywestcornerstore.com/auth/login\" method=\"post\"> 
		<ul>
		<input type=\"hidden\" name=\"$token_name\" value=\"$token_value\" />
		<li><label>Username</label></li>
		<li class=\"text-box\"><input type=\"text\" name=\"username\" /></li>
		<li><label>Password</label></li>
		<li class=\"text-box\"><input type=\"password\" name=\"password\" /></li>
		<li><input type=\"submit\" value=\"Login\" /></li>
		</ul>
		</form>
		</div>";
	}	  
	 
	
}// End Auth Class


?>	