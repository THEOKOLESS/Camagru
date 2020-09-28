<?php $title = 'Edition de Profil Camagru'; ?>
<?php ob_start(); ?>
   
<body>
<div class="container">
	<form action="edit_profile" method="POST" class="form-horizontal">
		<fieldset>
			<legend>edition profil</legend>
			<?php include("view/message.php");?>
		<div class="control-group">
			<label for="username" class="control-label">USERNAME:</label>
			<div class="controls">
				<input type="text"
					   maxlength="25"
					   name="username"
					   id="username"
					   value="<?php echo $errors ? $_POST['username'] : $_SESSION['username'] ;?>"
					   class="input-xlarge"
					/>
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
					   value="<?php echo $errors ? $_POST['email'] : $_SESSION['email'] ;?>"
					   class="input-xlarge"
					   />
			</div>
		</div>

		<div class="control-group">
         <p><b>changer de Mdp</p></b>
			<label for="pwd" class="control-label">taper votre Mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="pwd"
				       id="pwd"
				       class="input-xlarge"
				       placeholder="Mot de passe" />
			</div>
		</div>

       
        <div class="control-group">
			<label for="new_pwd" class="control-label">nouveau mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="new_pwd"
				       id="new_pwd"
				       class="input-xlarge"
                       placeholder="Nouveau mot de passe" 
				 />
			</div>
		</div>


		<div class="control-group">
			<label for="new_pwd_bis" class="control-label">répeter le mot de passe:</label>
			<div class="controls">
				<input type="password"
					   maxlength="45"
				       name="new_pwd_bis"
				       id="new_pwd_bis"
				       class="input-xlarge"
                       placeholder="Repeter le nouveau mot de passe" 
				      />
			</div>
		</div>



		<div class="control-group">
			<div class="controls">
				<input type="submit" name="submit" value="Mettre à jour mon profil !" class="btn">
			</div>
		</div>
		</fieldset>
	</form>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>