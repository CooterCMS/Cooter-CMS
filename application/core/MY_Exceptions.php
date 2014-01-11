<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Social Jesus Freaks
 *
    Copyright (C) <2012-2013>  <Kyle Coots>

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
 * An open source Social Networking Site PHP 5.1.6 or newer
 *
 * @package		Social Jesus Freaks
 * @author		Kyle Coots
 * @copyright	Copyright (c) 2012 - 2013, Social Jesus Freaks
 * @license		http://socialjesusfreaks.com/
 * @link		http://socialjesusfreaks.com/
 * @since		Version 1.2
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Social Jesus Freaks Application 
 *
 * This class object is the Freaks model class. 
 *
 * @package		Social Jesus Freaks
 * @subpackage  Exceptions
 * @category	MY_Exceptions
 * @author		Kyle Coots
 * @link		http://socialjesusfreaks.com/
 */
class MY_Exceptions extends CI_Exceptions {

	
    public function __construct(){
        parent::__construct();
    }
	
	private function requireSSL(){
   		if($_SERVER["HTTPS"] == "on"){
		    header("Location: https://" . $_SERVER["HTTP_HOST"] . '/lost');
		    exit();
		}else{
			header("Location: http://" . $_SERVER["HTTP_HOST"] . '/lost');
			exit();
		}
    }
	 /**
	  * This function is ran anytime a a show_404() function is called.
	  * For the alternate 404 check My_404 controller
 	  * @category Errors
	  * @see My_404 controller  
	  */
    public function show_404(){ // error page logic
    	$this->requireSSL();
    }

	function show_error(){
		//var_dump($_SERVER["HTTPS"]);
		$this->requireSSL();
	}
}
?>
