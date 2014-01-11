<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MadNatter_Template_Lib
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
 * An open source Template Library for PHP 5.1.6 or newer
 *
 * @package		MadNatter_Template_Lib
 * @author		Kyle Coots
 * @copyright	Copyright (c) 2012 - 2013, Mad Natter
 * @since		Version 1.0
 * @filesource  https://github.com/snowballrandom/MadNatter_Template_Lib
 *
 */

class Template{
			
	private $template_version	= 'v1.1';
	private $system_version;

	private $is_logged_in		= FALSE;
	private $allow_register		= FALSE;
	
	private $admin_bar			= '';
	
	private $template_dir 		= '';
	private $template_index		= '';
	private $template_header	= '';
	private $template_menu		= '';
	private $template_footer	= '';
	private $template_title 	= '';
	// View passed in through the load function.
	private $template_view		= 'welcome_message';
	
	private $template_assets_dir = 'assets';
	private $template_css		= '';
	private $template_js		= '';
	private $template_footer_js	= '';
	private $template_meta		= '<meta charset="UTF-8">';
	
	public function __construct(){
			
		date_default_timezone_set('America/Chicago');
		
		$this->ci =& get_instance();
		
		$this->system_version = $this->ci->config->item('version'); 
		
		$meta = array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no',
		);
		//$this->addmeta($meta);
		
	}
	
	public function load($view='', $view_data=''){

		if(isset($view) && $view !== ''){		
  	$this->template_view = (is_array($view) || is_object($view)) ? $this->template_view : $view;
		} 
		
		$template_data = new stdClass;
		
		$template_data->template_version = $this->template_version;
		$template_data->system_version 	 = $this->system_version;
		 
		$template_data->title		= $this->template_title;
		$template_data->template	= $this->template_index;
		$template_data->header_view = $this->template_header;
		$template_data->menu_view 	= $this->template_menu;
		$template_data->css			= $this->template_css;
		$template_data->js			= $this->template_js;
		$template_data->extra_js 	= '';
		$template_data->footer_js	= $this->template_footer_js;
		$template_data->meta		= $this->template_meta;
		$template_data->body_view	= $this->template_view;
		$template_data->footer_view = $this->template_footer;
		
		$template_data->is_logged_in 	= $this->ci->session->userdata('is_logged_in');
		$template_data->allow_login 	= $this->ci->auth_model->allow_login();
		$template_data->allow_register  = $this->ci->auth_model->allow_register();
		 
		//$template_data->admin_bar = $this->admin_bar();
		
		if(is_array($view_data) || is_object($view_data)){
			foreach($view_data as $key => $value){	
				$template_data->$key = $value;
			}
		}else{
				
		$template_data->view_data = $view_data;

		}
		return $template_data;
	}

	/**
	 *  Main Template Directory
	 */	
	public function set_template_dir($dir='', $template_dir=FALSE){
		if($template_dir === FALSE){
			$this->template_dir = ($dir !== '') ? $dir.'/' : $this->template_dir.'/';
		}else{
			$this->template_dir = ($dir !== '') ? $this->template_dir.'/'.$dir.'/' : $this->template_dir.'/';
		}		
	}
	public function get_template_dir(){
		return $this->template_dir;
	}
	
	/**
	 *  Assets Directory
	 */
	public function set_template_assets_dir($dir='', $template_dir=FALSE){
		if($template_dir === FALSE){
			$this->template_assets_dir = ($dir !== '') ? $dir.'/' : $this->template_assets_dir.'/';
		}else{
			$this->template_assets_dir = ($dir !== '') ? $this->template_assets_dir.'/'.$dir.'/' : $this->template_assets_dir.'/';
		}		
	}
	public function get_template_assets_dir(){
		return $this->template_assets_dir;
	}	
	
	public function set_template_index($file='', $template_dir=FALSE){
		if($template_dir === FALSE){
			$this->template_index = ($file !== '') ? $this->template_dir.'/'.$file : $this->template_dir.'/'.$this->template_index;
		}else{
			$this->template_index = ($file !== '') ? $file : $this->template_dir.'/'.$this->template_index;
		}
	}		
	public function set_header($header='', $template_dir=FALSE){
		if($template_dir === FALSE){
			$this->template_header = ($header !== '') ? $this->template_dir.'/'.$header : $this->template_dir.'/'.$this->template_header;
		}else{
			$this->template_header = ($header !== '') ? $header : $this->template_dir.'/'.$this->template_header;
		}	
	}
	public function set_menu($menu='', $template_dir=FALSE){
		if($template_dir === FALSE){
			$this->template_menu = ($menu !== '') ? $this->template_dir.'/'.$menu : $this->template_dir.'/'.$this->template_menu;
		}else{
			$this->template_menu = ($menu !== '') ? $menu : $this->template_dir.'/'.$this->template_menu;
		}	
	}	
	public function set_footer($footer='', $template_dir=FALSE){
		if($template_dir === FALSE){
			$this->template_footer = ($footer !== '') ? $this->template_dir.'/'.$footer : $this->template_dir.'/'.$this->template_footer;
		}else{
			$this->template_footer = ($footer !== '') ? $footer : $this->template_dir.'/'.$this->template_footer;
		}
	}
	
	public function set_default_title($title=null){
		$this->template_title = $title;
	}
	public function addtitle($title='', $post=TRUE, $site_title=TRUE){
		
		if($site_title == FALSE){
			$this->template_title = '';
		}
			
		if($post == FALSE){
			$this->template_title = $this->template_title.' - '.$title;
		}else{
			$this->template_title = $title.' - '.$this->template_title;
		}
		
	}

	public function addtagline($title='', $post=TRUE, $site_title=TRUE){
		
		if($site_title == FALSE){
			$this->template_title = '';
		}
			
		if($post == FALSE){
			$this->template_title = $this->template_title.' | '.$title;
		}else{
			$this->template_title = $title.' | '.$this->template_title;
		}
		
	}	
	/**
	 * Add Css adds css to the template object
	 * When adding css you only need the name with OUT the ext (i.e. "my_css")
	 * You can specify if the file is a remote css file with the second param,
	 * by default it's false. 
	 * 
	 * @param $css[string]
	 * @param $remote[bool]
	 * @return [string]
	 */
	public function addcss($src = '', $remote = FALSE, $attributes=''){
		
		if(isset($src) && $src !== ''){
				
			$attributes = $this->attributes_to_string($attributes);	
	
			if($remote == FALSE){
				$src = $this->url().$this->template_assets_dir.'/'.$this->stripExt($src).'.css';
			}
			
			$this->template_css = $this->template_css.
			'<link rel="stylesheet" type="text/css" href="'.$src.'"'.$attributes.' />'."\n";
		}
	}
	/**
	 * Add Java script to the template. 
	 * @param src, source of the file
	 * 
	 */
	public function addjs($src = '', $remote = FALSE, $attributes='', $footer = FALSE){
			
		if(isset($src) && $src !== ''){
				
			$attributes = $this->attributes_to_string($attributes);	

			if($remote === FALSE){
				$src = $this->url().$this->template_assets_dir.'/'.$this->stripExt($src).'.js';
			}
			
		if($footer === TRUE){
			$this->template_footer_js = $this->template_footer_js.
			'<script type="text/javascript" src="'.$src.'"'.$attributes.' ></script>'."\n";
		}else{
			$this->template_js = $this->template_js.
			'<script type="text/javascript" src="'.$src.'"'.$attributes.' ></script>'."\n";
		}
		
		}
	}

	
	public function addmeta($meta_data = ''){
		
		if($meta_data !== ''){
								
			if(is_array($meta_data) && count($meta_data) > 2){
					
				foreach($meta_data as $key => $value){
						
					$meta_atts = $this->attributes_to_string($value);
					$this->template_meta = $this->template_meta.'<meta'.$meta_atts.'>'."\n";

				}
					
			}else{
				
				$meta_atts = $this->attributes_to_string($meta_data);
				$this->template_meta = $this->template_meta.'<meta'.$meta_atts.'>'."\n";

			}
			
		}

	}

	/** 
	 * @return array
	 */ 
	public function selected_menu_item($menu_items, $uri, $class_a='', $class_b=''){
		// Set the class selector	
		$a = $class_a == '' ? 'selected' : $class_a;
		$b = $class_b == '' ? 'menu-button' : $class_b;
		// loop over menu items and compare them to the uri segment
		$rows = array();
		foreach($menu_items as $key => $value){
			$rows[] = ($uri == $value) ? $a : $b;	
		}
		// Return it!
		return $rows;
	}
	
	public function attributes_to_string($attributes=''){
		
		if(isset($attributes) && $attributes !== ''){
			if(is_array($attributes) || is_object($attributes)){
				
			$atts = '';
			foreach ($attributes as $key => $val){
				$atts .= ' '.$key.'="'.$val.'"';
			}
			return $atts;
			}
		}
	}

	public function stripExt($str, $ext=''){
		
		if(is_string($str) && is_string($ext)){
			
			$haystack = $str; 	
			$ext = ($ext !== '') ? $ext : '.';
			$new_str = substr($haystack, 0, strrpos($haystack, $ext));
			
			if($new_str === ''){
				return $str;
			}else{
				return $new_str;
			}		
		}
	}
	
	public function url(){
	  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
	  return $protocol . "://" . $_SERVER['HTTP_HOST'].'/';
	}
	
}
