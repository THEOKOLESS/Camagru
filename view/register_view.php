
<?php 
$title = 'Camagru - Register'; ?>
<?php ob_start(); ?>
<div class="center">
	<h1 class="title is-2">Camagru - Register</h1>
	<?php include("view/message.php");?>
	<form action="register" method="POST">			
		<div>
			<label for="username" class="control-label">Name:</label>
			<div>
				<input type="text"
					   maxlength="25"
					   name="username"
					   id="username"
					   value="<?php display_value($errors ? 'username' : '');?>"
					   class="input-xlarge"
					   placeholder="Name"/>
			</div>
		</div>

		<div>
			<label for="email" class="control-label">Email:</label>
			<div>
				<input type="email"
					   maxlength="45"
					   name="email"
					   id="email"
					   placeholder="Camagru@abc.fr"
					   value="<?php display_value($errors ? 'email' : '');?>"
					   class="input-xlarge"
					   placeholder="Email"/>
			</div>
		</div>
		<div>
			<label for="pwd" class="control-label">Password</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="pwd"
				       id="pwd"
					   value="<?php display_value($errors ? 'pwd' : '');?>"
				       class="input-xlarge"
				       placeholder="Password" />
			</div>
		</div>

		<div>
			<label for="pwd_bis" class="control-label">Reapeat password:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="pwd_bis"
				       id="pwd_bis"
					   value="<?php display_value($errors ? 'pwd_bis' : '');?>"
				       class="input-xlarge"
				       placeholder="reapeat password" />
			</div>
		</div>
			<div >
				<input type="submit" name="submit" value="s'inscrire"	class="btn">
			</div>
	
	</form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>