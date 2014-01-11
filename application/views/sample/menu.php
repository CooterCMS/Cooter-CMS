<?php
// get the uri segement
  $uri = $this->uri->segment(1);

// Menu items
$array = array( 
 '0' => 'new',
 '1' => 'customers',
 '2' => 'appointments',
 '3' => 'checkedin',
 '4' => 'completed',
 '5' => 'trash',
 '6' => 'services',
 '7' => 'employee',
 '8' => 'options',
 '9' => 'admin',
 '10' => 'coupons',
 '11' => 'pages'
);

// Get the class selector
  $a = $this->template->selected_menu_item($array, $uri);
	
?>
<div id="menu">
  <div id="menuWrap">

<nav class="clearfix">		
  
  <ul class="clearfix">			
	<li>	
<a href="<?php echo base_url() . 'pages'; ?>" class="<?php echo $a[0]; ?>"><span class="plus_btn right"></span>Pages</a>
<a href="<?php echo base_url() . 'posts'; ?>" class="<?php echo $a[1]; ?>"><span class="customer_btn right"></span>Posts</a>
<a href="<?php echo base_url() . 'tags'; ?>" class="<?php echo $a[2]; ?>"><span class="table_btn right"></span>Tags</a>
<a href="<?php echo base_url() . 'admin'; ?>" class="<?php echo $a[2]; ?>"><span class="table_btn right"></span>Admin</a>	  
	</li>
  </ul>

</nav>

  </div>
</div>

<a href="#" id="pull">Menu Tab</a>

<div class="clearfix"></div>