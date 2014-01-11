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
	
	public function __construct(){
		parent::__construct();
		
		$this->ci_session_id = $this->session->userdata('session_id');
		$this->is_logged_in = $this->is_logged_in();
		
		$this->load->library('bcrypt');
		
		$this->is_admin = $this->is_admin($this->session->userdata('username'));
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
	
	public function is_admin($username){
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
	
	public function login($post_data){
		if($this->allow_login()){
			
		if(isset($post_data) && (is_object($post_data)) ){
				
			$this->username = $post_data->username;
			$this->password = $post_data->password;
			
			$this->validate_user();

			if($this->validate_user !== FALSE){
			
				$new_data = array(
					'username' => $post_data->username,
					'is_logged_in' => TRUE
				);
				$this->session->set_userdata($new_data);
				
				return TRUE;
			
			}else{
				
				return FALSE;
			}
			
		}else{
			return FALSE;
		}
		
		}else{
			return FALSE;
		}
		
	}
	
	public function add_user($data){
	 	
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
	 * Validate Password 
	 */	
    private function validate_user(){
		
		$bcrypt = new Bcrypt(15);
		
		$account_sql = "SELECT password FROM Users WHERE username = ? LIMIT 1";
		$account_data = $this->db->query($account_sql, array($this->username));
		
		if($account_data->num_rows() == 1){
		
		  foreach($account_data->result() as $row){
		  	
			$this->validate_user = $bcrypt->verify($this->password, $row->password);
			  
		  }
		  
		}
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