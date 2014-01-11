<!DOCTYPE HTML>
<html>
	
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php 

echo $css."\n";

echo $js."\n";

echo $meta."\n";
 
if($is_logged_in){ 
?>
<script>

var csfr_token_name  = "<?php echo $this->security->get_csrf_token_name(); ?>"; 
var csfr_token_value = "<?php echo $this->security->get_csrf_hash(); ?>";

var base_url = "<?php echo base_url(); ?>";

</script>
<?php } ?>

<meta name="msvalidate.01" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

</head>

<body>

	<div id="header">
		<div id="headerWrap">  
<?php 
if($this->auth_model->current_user_role('admin')){
echo $this->admin_bar->show($is_logged_in)."\n"; 
}
?>
		</div>
	</div>
<div class="asd"></div>
<div id="container">
	<div id="containerWrap">