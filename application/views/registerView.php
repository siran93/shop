<div class="big_login">
	<div class="login">
		<form method="POST">
			<input type='text' name="firstname" placeholder='Firstname' value="<?=set_value('firstname')?>">
				<span class="errorR"><?=form_error('firstname');?></span><br>
			<input type="text" name="username" placeholder='Username' value="<?=set_value('username');?>">
				<span class="errorR"><?=form_error('username');?></span><br>
			<input type="password" name="password" placeholder='Password'>
				<span class="errorR"><?=form_error('password');?></span><br>
			<input type="submit" name="register" value="Register" class="button buttons_hover">
			<a href="<?=base_url('login')?>" class="register_a buttons_hover">Login</a>
		</form>
		<div class='clear'></div>
	</div>
</div>