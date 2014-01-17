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

class Auth_model extends CI_Model{
	
	private $is_logged_in 	= FALSE;
	private $ci_session_id  = NULL;
	
	private $username		= NULL;
	private $password		= NULL;
	private $password_hash	= NULL;
	
	private $password_crypted = FALSE;
	private $validate_user	  = FALSE;
	
	private $is_admin		= FALSE;
	private $user_role		= FALSE;
	
	private	$is_account_registered = FALSE;
	private $is_account_active = FALSE;
	private	$is_account_locked =FALSE;
	
	public function __construct(){
		parent::__construct();
		
		$this->ci_session_id = $this->session->userdata('session_id');
		$this->is_logged_in = $this->is_logged_in();
		
		$this->load->library('bcrypt');
		/**
		 * bug
		 */
		//$this->is_admin = $this->is_admin($this->session->userdata('username'));
	}
	/**
	 * php.net
	 */
	public function strictBool($val=false){
    	return is_integer($val)?false:$val == 1;
	}	
	/**
	 * Allow Registration
	 */
	public function allow_register(){
		$data = $this->options_model->get_option('allow_register');
		return $this->strictBool($data[0]->option_value);
	} 
	/**
	 * Allow Login
	 */
	public function allow_login(){
		$data = $this->options_model->get_option('allow_login');
		return $this->strictBool($data[0]->option_value);
	} 
		
	public function is_logged_in(){
       $is_logged_in = $this->session->userdata('is_logged_in');
	
       if(!isset($is_logged_in) || $is_logged_in !== true){
        	$this->is_logged_in = FALSE;
		    return FALSE;
       }else{
			$this->is_logged_in = TRUE;
			return TRUE;
 	   }
    }
	
	private function is_admin($username){
		if($this->is_logged_in()){
				
			$sql = 'SELECT role FROM Users WHERE username = ? LIMIT 1';
			$query_data = $this->db->query($sql, $username);
			
			if($query_data->num_rows() == 1){
				foreach($query_data->result() as $row){
					if($row->role === 'Admin'){
						return TRUE;
					}else{
						return FALSE;
					}
				}
			}else{
				return FALSE;
			}			
		}else{
			
			return FALSE;
		}	
	}
	
	public function is_account_registered(){
				
		if($this->username){
		    
			$this->db->where('username', $this->username);
			$this->db->from('Users');
			$result = $this->db->count_all_results();
			
			return ($result == 1) ? TRUE:FALSE;
			
		}
	}
	
	public function is_account_active(){
		if($this->username){
			
			$this->db->select('active');			    
			$this->db->where('username', $this->username);
			$result = $this->db->get('Users', 1);
		  
		  if($result->num_rows() == 1){
			foreach($result->result() as $val){
				return $this->strictBool($val->active);
			}
		  }else{
			return FALSE;
		  }
		  
		}
	}
	public function is_account_locked(){
		if($this->username){
			
			$this->db->select('locked');			    
			$this->db->where('username', $this->username);
			$result = $this->db->get('Users', 1);
		  
		  if($result->num_rows() == 1){
			foreach($result->result() as $val){
				return $this->strictBool($val->locked);
			}
		  }else{
			return TRUE;
		  }
		  
		}
	}
	/**
	 * Validate Password 
	 */	
    private function validate_user(){
		
		$bcrypt = new Bcrypt(15);
		
		$account_sql = "SELECT password FROM Users WHERE username = ? LIMIT 1";
		$account_data = $this->db->query($account_sql, array($this->username));
		
		if($account_data->num_rows() == 1){
		
		  foreach($account_data->result() as $row){		  	
			$verify = $bcrypt->verify($this->password, $row->password);
			 return ($verify !== FALSE) ? TRUE:FALSE;
			 exit;
		  }
		  
		}		
		return FALSE;
		exit;
    }		
	/**
	 * Checks current user role
	 * @var string
	 * @return bool
	 */
	public function current_user_role($role){
		
		$current_user = $this->session->userdata('username');
		
		$this->db->select('role');
		$this->db->where('username', $current_user);
		$data = $this->db->get('Users', 1);
		if($data->num_rows() == 1){
			foreach ($data->result() as $user_role) {
				if(strcasecmp($user_role->role, $role) == 0){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		}else{
			return FALSE;
		}
	}
	/**
	 * Set the user session data
	 */ 
	private function auth_set_session_data(){
		if(isset($this->username)){
	  	  $new_data = array(
	  	   	'username' => $this->username,
	        'is_logged_in' => TRUE
	      );
	      $this->session->set_userdata($new_data);
		}
	}
	public function login($post_data){
			
		// New returnable obj	
		$return_data = new stdClass;
		$return_data->login_valid = FALSE;
        $return_data->post_data = $post_data;
		$return_data->error_code = '500.1';
		$return_data->error_message = 'Login';
		$return_data->theme = '';
		$return_data->page  = 'login';
		  
		if(!isset($post_data) || !isset($post_data->username) || !isset($post_data->password)){
		  $return_data->login_valid = FALSE;
		  $return_data->post_data = $post_data;
		  $return_data->error_code = '500.2';
		  $return_data->error_message = 'Invalid data type!';
		  $return_data->theme = '';
		  $return_data->page  = '';
		  return $return_data;
		  exit;
		}else{
		
		  // Check if login is allowed	
		  if(!$this->allow_login()){
			$return_data->login_valid = FALSE;
		    $return_data->post_data = $post_data;
		    $return_data->error_code = '500.3';
		    $return_data->error_message = 'Login Disabled!';
		    $return_data->theme = '';
		    $return_data->page  = 'login_disabled';
			return $return_data;
			exit;
		  }else{
		  	
		  // Post data
		  $this->username = $post_data->username;
		  $this->password = $post_data->password;

		    // Check if account is registered
		    if(!$this->is_account_registered()){
		      $return_data->login_valid = FALSE;	
		      $return_data->post_data = $post_data;
		      $return_data->error_code = '500.4';
		      $return_data->error_message = 'Account not registered!';
		      $return_data->theme = '';
		      $return_data->page  = 'register';
			  return $return_data;
			  exit;
		    }	
					    			
		    // Check if account is active
		    if(!$this->is_account_active()){
		      $return_data->login_valid = FALSE;	
		      $return_data->post_data = $post_data;
		      $return_data->error_code = '500.5';
		      $return_data->error_message = 'Account not active!';
		      $return_data->theme = '';
		      $return_data->page  = 'account_activate';
			  return $return_data;
			  exit;
		    }

			// Check if user account is locked
		  	if($this->is_account_locked()){
		  	  $return_data->login_valid = FALSE;
		      $return_data->post_data = $post_data;
		      $return_data->error_code = '500.6';
		      $return_data->error_message = 'Account is locked!';
		      $return_data->theme = '';
		      $return_data->page  = 'account_locked';
			  return $return_data;
			  exit;
		  	}
			
			// Check if user account is valid
		  	if(!$this->validate_user()){
		  	  $return_data->login_valid = FALSE;
		      $return_data->post_data = $post_data;
		      $return_data->error_code = '500.7';
		      $return_data->error_message = 'Account password incorect!';
		      $return_data->theme = '';
		      $return_data->page  = 'login';
			  return $return_data;
			  exit;
		  	}else{
		  		
		  	  // Log them in	
			  $this->auth_set_session_data();
		  	  $return_data->login_valid = TRUE;
		  	  $return_data->post_data = $post_data;
			  $return_data->error_code = '500.8';
			  $return_data->error_message = 'Login';
			  $return_data->theme = '';
			  $return_data->page = '';
			  return $return_data;
			  exit; 
		  	}
			
		  }
		
		}
		
		return $return_data;
		exit;
	}
	
	public function add_user($data){
	 		
	 	// use bcrypt
	 	// Else use php_hash();
	 	
	 if(is_object($data)){
	 			  	
		$this->username 	= $data->username;
		$this->password 	= $data->password;
		$this->user_role	= $data->user_role;
		
		if($this->is_admin){
		
			$user_exsist = $this->user_exsist();
			
			if($user_exsist){
				
				return 'User Exsist';
	
			}else{
				
				// Secure the password
				$this->crypt_password();
		
				if($this->password_crypted != FALSE){
								
					// Insert User
					$this->insert_user();
					return 'User Created';
					
				}else{
						
					return 'Bad Password';
		
				}
			}
			
		}else{
		
			return 'You are not an Admin!';
				
		}	
		
	 }else{
		
		return 'Not The Right Data Format';

	 }	
									
	}
	
	private function user_exsist(){
		$sql = 'SELECT * FROM Users WHERE Username = ? LIMIT 1';
		$query_data = $this->db->query($sql, $this->username);
		
		if($query_data->num_rows() == 1){
			return TRUE;	
		}else{
			return FALSE;
		}
	}
	
	private function insert_user(){
		
		$insert_data = new stdClass;
		$insert_data->username  = $this->username;
		$insert_data->password  = $this->password_hash;
		$insert_data->role 		= $this->user_role;
		$this->db->insert('Users', $insert_data);
	}
		
	/**
	 * Create a secures password using bcrypt
	 * 
	 * @return bool 
	 */
	private function crypt_password(){

        $bcrypt = new Bcrypt(15);
        $this->password_hash 	= $bcrypt->hash($this->password);
        $this->password_crypted = $bcrypt->verify($this->password, $this->password_hash);

	}

	   /**
    * Set a Form Submit Log
    * @param $form 
    * * Form_Name
    * @see get_form_submit_count()
    * @return NULL
    */
	public function set_form_submit($form){
		if($form){
		// Insert this attempt into the table
        $new_attempt_data = array(
	          'IP'	 		=> $_SERVER['REMOTE_ADDR'],
	          'When' 		=> date("Y-m-d H:i:s"),
	          'Session_Id'	=> $this->ci_session_id,
	          'User_Agent' 	=> $_SERVER['HTTP_USER_AGENT'],
	          'Form' 		=> $form
          			   );
		$this->db->insert('Forms', $new_attempt_data);// Insert data
		}
	}
	/**
	 * Returns a number of times a $form has been submitted from the From table
	 * 
	 */
	public function get_form_submit_count($form, $time){

	  $seconds = $time;
	  
      $time_str_minus_seconds 	= strtotime(date('Y-m-d H:i:s').' - '.$seconds.' seconds');
	  $time_date_past 			= date('Y-m-d H:i:s',$time_str_minus_seconds);

	  $recent_count_sql = 'SELECT count(*) as number 
                    FROM Forms
                    WHERE `ip` = '.$this->db->escape($_SERVER['REMOTE_ADDR']).'
                 	AND `When` >= '.$this->db->escape($time_date_past).'
                 	AND `Session_Id` = '.$this->db->escape($this->ci_session_id).'
                 	AND `User_Agent` = '.$this->db->escape($_SERVER['HTTP_USER_AGENT']).'
                    AND `Form` = '.$this->db->escape($form).' ';

		// Query the database
        $recent_count_data  = $this->db->query($recent_count_sql);

        if ($recent_count_data->num_rows() > 0){
        	foreach($recent_count_data->result() as $attempt){
            	$attempts = $attempt->number;
				return $attempts;
            }// End foreach 
        }// End if count					
		
	}	
	
}// End Class
?>