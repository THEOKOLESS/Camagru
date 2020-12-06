
<?php 
$title = 'Insctription'; ?>
<?php ob_start(); ?>

	<form action="register" method="POST"  class="form-control">
		<fieldset>
			<legend>Inscritpion Camagru</legend>
			<?php include("view/message.php");?>
		<div class="control-group">
			<label for="username" class="control-label">Name:</label>
			<div class="controls">
				<input type="text"
					   maxlength="25"
					   name="username"
					   id="username"
					   value="<?php display_value($errors ? 'username' : '');?>"
					   class="input-xlarge"
					   placeholder="Name"/>
			</div>
		</div>

		<div class="control-group">
			<label for="email" class="control-label">Email:</label>
			<div class="controls">
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
		<div class="control-group">
			<label for="pwd" class="control-label">Mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="pwd"
				       id="pwd"
					   value="<?php display_value($errors ? 'pwd' : '');?>"
				       class="input-xlarge"
				       placeholder="Mot de passe" />
			</div>
		</div>

		<div class="control-group">
			<label for="pwd_bis" class="control-label">répeter le mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="pwd_bis"
				       id="pwd_bis"
					   value="<?php display_value($errors ? 'pwd_bis' : '');?>"
				       class="input-xlarge"
				       placeholder="répeter le mot de passe" />
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" name="submit" value="s'inscrire"	class="btn">
			</div>
		</div>
		</fieldset>
	</form>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>