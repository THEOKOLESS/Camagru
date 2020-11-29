<?php 
$title = 'Mot de passe oublié - Camagru'; ?>
<?php ob_start(); ?>
<body>
	<?php include("view/message.php");?>
	<form action="enter_email" method="POST">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
		<div class="form-group">
			<label>Your email address</label>
			<input type="email" name="email">
		</div>
		<div class="form-group">
			<button type="submit" name="submit">Submit</button>
		</div>
	</form>
</body>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>