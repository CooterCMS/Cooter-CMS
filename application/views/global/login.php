<div id="content">

<div style="width: 100%; min-height: 200px;">
<style>

	#login{
		position:relative;
		top:100px;
		left:30%;
		padding:20px;
		width:380px;
		min-height:200px;
		color:#FFF;
		border-radius:15px;	
		box-shadow:3px 3px 3px #000;
		background: url(/assets/admin/camo_cloth_black_512.png);
	}
	#login ul{
		list-style:none;
	}
	#login input{
		margin:3px 0px;
		padding:5px;
	}
input[type=text], input[type=password], textarea {
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid #DDDDDD;
}

input[type=text]:focus, input[type=password]:focus, textarea:focus {
  box-shadow: 0 0 15px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(81, 203, 238, 1);
}
	#login h2{
		font-weight:bold;
	}
</style>
<div id="login">
	<h2>Login</h2>
		<?php
		//echo form_fieldset('Login');
		echo form_open(base_url(). 'auth/login'); 
		
		echo '<ul>';
		
		echo '<li>'.form_label('Username').'</li>';
		echo '<li class="text-box">'.form_input('username').'</li>';
		echo '<li class="error">'.form_error('username').'</li>';
		echo '<li>'.form_label('Password').'</li>';
		echo '<li class="text-box">'.form_password('password').'</li>';
		echo '<li class="error">'.form_error('password').'</li>';
		
		echo '<li>'.@$recaptcha.'</li>';
		echo '<li class="error">'.form_error('recaptcha_challenge_field').'</li>';
		
		$btn_extra_data = 'class="login_btn"';
		echo '<li>'.form_submit('', 'Login', $btn_extra_data).'</li>';
		
		echo '</ul>';
		
		echo form_close(); 
		//echo form_fieldset_close();
		?>
</div>

</div>
	<div class="clearfix"></div>
	
</div>