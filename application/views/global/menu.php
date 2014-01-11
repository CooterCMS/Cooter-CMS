<?php
// get the uri segement
$uri = $this->uri->segment(1);
// Menu items
$menu_items = array( 
 '0' => 'pages',
 '1' => 'posts'
);
// Get the class selector
$selected = $this->template->selected_menu_item($menu_items, $uri);
?>

<div id="menu">
  <div id="menuWrap">

<nav class="clearfix">		
  
  <ul class="clearfix">			
	<li>	
<a href="<?php echo base_url() . 'pages'; ?>" class="<?php echo $selected[0]; ?>"><span class="plus_btn right"></span>Pages</a>
<a href="<?php echo base_url() . 'posts'; ?>" class="<?php echo $selected[1]; ?>"><span class="customer_btn right"></span>Posts</a>  
	</li>
  </ul>

</nav>

  </div>
</div>

<a href="#" id="pull">Menu Tab</a>

<div class="clearfix"></div>