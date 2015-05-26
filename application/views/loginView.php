<div class="big_login">
	<div class="login">
	
	<?php echo form_open('verifylogin'); ?>
		<form method="POST" action="<?=base_url('auth/process')?>" name='process'>
			<input type="text" name="username" placeholder='Username' id="username"><br><span class="errorR"><?=form_error('username');?></span>	
			<input type="password" name="password" placeholder='Password' id="passowrd"><br><span class="errorR"><?=form_error('password');?></span>	
			<input type="submit" name="submit" value="Login" class='button buttons_hover'>
		</form>	
		<a href="<?=base_url('login/register')?>" class='register_a buttons_hover'>Register</a>
		<!-- <a href="<?=base_url('auth/loginByFacebook');?>" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in with Facebook</a> -->
		<div class='clear'></div>
	</div>
</div>