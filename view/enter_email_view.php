<?php 
$title = 'Mot de passe oublié - Camagru'; ?>
<?php ob_start(); ?>
<div class="center">
	<?php include("view/message.php");?>
    <h1 class="title is-2">Reset password</h1>
	<form action="enter_email" method="POST">
			<label>Your email address</label>
			<input type="email" name="email">
		<div>
			<button type="submit" name="submit">Submit</button>
		</div>
	</form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>