<div id="mainMenu">
	<?php if($is_logged_in){
		
	// get the uri segement
	$uri = $this->uri->segment(2);

	// Menu items
	$menu_items = array( 
	 '0' => 'dashboard',
	 '1' => 'posts',
	 '2' => 'pages',
	 '3' => 'assets',
	 '4' => 'themes',
	 '5' => 'users',
	 '6' => 'options',
	 '7' => 'routes'
	 );
	// Get the class selector
	$selected = $this->template->selected_menu_item($menu_items, $uri);
	
	?>
	<ul>
		<li><a href="<?php echo base_url() . 'admin/dashboard'; ?>" class="<?php echo $selected[0]; ?>"><span class="plus_btn right"></span>Dashboard</a></li>
		<li><a href="<?php echo base_url() . 'admin/posts'; ?>" class="<?php echo $selected[1]; ?>"><span class="customer_btn right"></span>Posts</a></li>
		<li><a href="<?php echo base_url() . 'admin/pages'; ?>" class="<?php echo $selected[2]; ?>"><span class="customer_btn right"></span>Pages</a></li>
		<div style="border-bottom: thin solid #000;"></div>
		<li><a href="<?php echo base_url() . 'admin/assets'; ?>" class="<?php echo $selected[3]; ?>"><span class="check_btn right"></span>Assets</a></li>
		<li><a href="<?php echo base_url() . 'admin/themes'; ?>" class="<?php echo $selected[4]; ?>"><span class="check_btn right"></span>Themes</a></li>
		<div style="border-bottom: thin solid #000;"></div>
		<li><a href="<?php echo base_url() . 'admin/users'; ?>" class="<?php echo $selected[5]; ?>"><span class="check_btn right"></span>Users</a></li>
		<li><a href="<?php echo base_url() . 'admin/options'; ?>" class="<?php echo $selected[6]; ?>"><span class="check_btn right"></span>Options</a></li>
		<li><a href="<?php echo base_url() . 'admin/routes'; ?>" class="<?php echo $selected[7]; ?>"><span class="check_btn right"></span>Routes</a></li>
	</ul>
	<?php } ?>
</div>