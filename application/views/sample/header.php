<!DOCTYPE HTML>
<html>
	
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<script>

var csfr_token_name  = "<?php echo $this->security->get_csrf_token_name(); ?>"; 
var csfr_token_value = "<?php echo $this->security->get_csrf_hash(); ?>";

var base_url = "<?php echo base_url(); ?>";

</script>
<?php 

echo $css."\n";

echo $js."\n";

echo $meta."\n";
 
?>

<meta name="msvalidate.01" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

</head>

<body>
<?php 
if($this->auth_model->current_user_role('admin')){
echo $this->admin_bar->show($is_logged_in)."\n"; 
}
?>

<div id="container">
		
  <div id="header" style="background:#252525;">
	<div id="headerWrap">  
	

  <a href="<?php echo base_url(); ?>">
	<h1 class="">Cooter CMS</h1>
  </a>  
	
  <div id="socialIcons">
	<ul>
	  <li class="facebook">
		<a href="https://www.facebook.com/pages/"  title="Facebook">
			<img src="<?php echo base_url() . 'assets/images/social/facebook.png'; ?>" alt="Facebook">
		</a>
	  </li>
	  <li class="google">
		<a href="http://gplus.to/" >
			<img src="<?php echo base_url() . 'assets/images/social/google.png'; ?>" alt="Goolge">
		</a>
	  </li>
	</ul>
  </div>

	
	 
	</div>
  </div>