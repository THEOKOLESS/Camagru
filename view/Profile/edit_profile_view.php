<?php $title = 'Edit profil - Camagru'; ?>
<?php ob_start(); ?>
   

<div class="container">
	<div class="center">
		<form action="edit_profile" method="POST">		
			<h1 class="title is-2">Edit profile</h1>
				<?php include("view/message.php");?>
	
				<label for="username" class="control-label">Username:</label>
		
					<input type="text"
						maxlength="25"
						name="username"
						id="username"
						value="<?php echo $errors ? $_POST['username'] : $_SESSION['username'] ;?>"
						class="input-xlarge"
						/>
		
						</br >
				<label for="email" class="control-label">Email:</label>
			
					<input type="email"
						maxlength="45"
						name="email"
						id="email"
						placeholder="Camagru@abc.fr"
						value="<?php echo $errors ? $_POST['email'] : $_SESSION['email'] ;?>"
						class="input-xlarge"
						/>
						</br >
						</br >
			<p><strong>Change password</strong></p>
			</br >
				<label for="pwd" class="control-label">Old password:</label>
			
					<input type="password"
						maxlength="45"
						name="pwd"
						id="pwd"
						class="input-xlarge"
						placeholder="old password" />
			

						</br >

				<label for="new_pwd" class="control-label">New password:</label>
	
					<input type="password"
						maxlength="45"
						name="new_pwd"
						id="new_pwd"
						class="input-xlarge"
						placeholder="New password" 
					/>
		
					</br >

	
				<label for="new_pwd_bis" class="control-label">Repeat new password:</label>
			
					<input type="password"
						maxlength="45"
						name="new_pwd_bis"
						id="new_pwd_bis"
						class="input-xlarge"
						placeholder="New password again" 
						/>
	

						</br >
						</br >
						<input type="checkbox" id="subscribeNews" name="subscribe" value="1" <?php echo $mail_com ? 'checked ' :'' ?> >
   						<label for="subscribeNews">Wanna get an email when someone comment your pictures ?</label>
			<div class="control-group">
			</br >
			</br >
				<div class="controls">
					<input type="submit" name="submit" value="Update profile" class="btn">
				</div>
			</div>

		</form>
	</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>