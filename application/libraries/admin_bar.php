<?php

class Admin_Bar{
	
	public function __construct(){
		$this->ci =& get_instance();
	}
	
	/**
	 * Show admin bar
	 * @var bool
	 */
	public function show($is_logged_in = FALSE){
		
	  if($is_logged_in){
	  	
		$admin_home = base_url()."admin/";	
		$view_site = base_url();
		$logout_url = base_url()."auth/logout";
			
		echo '<div style="background:#efefef;height:20px;padding:5px;">
		<a style="color:#000;" href="'.$admin_home.'" class="" >Admin</a>&nbsp;|&nbsp;
		<a style="color:#000;" href="'.$view_site.'" class="" >View Site</a>
  		<a style="color:red;" href="'.$logout_url.'" class="right" >Log out</a>
  		
		</div>
		
		<div class="clearfix"></div>';
	  }
	}		
}
	