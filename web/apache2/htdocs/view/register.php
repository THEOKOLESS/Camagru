

<!-- // https://www.zentut.com/php-pdo/pdo-inserting-data-into-tables/ -->
<!-- include "../config/setup.php"; -->

<?php

	define('MAIL_TO','theophile.vitoux@gmail.com');
	$errors = array();

	$username = '';
	$email = '';
	$password = '';


    function checkPassword($pwd, &$errors) {
        $errors_init = $errors;

        if (strlen($pwd) < 8) {
            $errors[] = "Votre Mot de passe doit contenir au moins 8 characteres!";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors[] = "Password must include at least one number!";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors[] = "Password must include at least one letter!";
        }
        if (!preg_match("#[a-z]+#", $pwd)) {
            $errors[] = "Password must include at least one lowercase letter!";
        }
        if (!preg_match("#[A-Z]+#", $pwd)) {
            $errors[] = "Password must include at least one uppercase letter!";
        }

        return ($errors == $errors_init);
    }

	function validate_form(){

		global $errors, $username, $email, $password, $message;

		// validate name
		if($_POST['username'] != ''){
			$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			if($username != $_POST['username']){
				$errors[] = 'Nom d\'utilisateur invalide';
			}
		}else{
			$errors[] = 'Veuiller rentrer un nom d\'utilisateur';
		}
		// validate email
		if($_POST['email'] != ''){
			$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors[] = 'Veuiller rentrer un email valide';
			}
		}else{
			$errors[] = 'Veuiller rentrer un email';
		}

		// validate subject
		if($_POST['password'] != ''){
		     checkPassword($_POST['password'], $errors);
		}else{
			$errors[] = 'Veuillez rentrer un mot de passe';
		}


		if(count($errors)){
			return false;
		}else{
			return true;
		}
	}


	function display_value($fieldName){
		echo isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
	}


	function display_message($errors){
		if(!isset($_POST['submit'])){
			return;
		}
		//
		if(count($errors) === 0){
		?>
			<div class="alert alert-success">
				<p>Thank you! you message has been sent.</p>
			</div>
		<?php
		}else{
		?>
			<div class="alert alert-block alert-error fade in">
				<p>The following error(s) occurred:</p>
				<ul>
				<?php
					foreach ($errors as $error) {
						echo "<li>$error</li>";
					}
				?>
				</ul>
			</div>
		<?php
		}
	}

	/**
	 * start form processing
	 */
	function start_form(){
		global $errors, $username, $email, $password, $message;

		$mail_msg = '';
		// if user submitted the form
		if(isset($_POST['submit']))
		{
			// validate form
			if(validate_form())
			{
				$mail_msg .= 'From: ' . $username . "\n";
				$mail_msg .= 'Email: ' . $email . "\n";;
				$mail_msg .= 'Message: ' . $message . "\n";

				// send email to the MAIL_TO email address
				if(!@mail(MAIL_TO, $password, $mail_msg)){
					$errors[] = 'Error sending email';
				}
			}
		}
	}

	// start form processing
	start_form();

?>
<!DOCTYPE html>
<html>
<head>
<title>Contact Form</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    8
<div class="container">
	<form action="register.php" method="POST" class="form-horizontal">
		<fieldset>
			<legend>Inscritpion Camagru</legend>
			<?php
				display_message($errors);
			?>
		<div class="control-group">
			<label for="username" class="control-label">Name:</label>
			<div class="controls">
				<input type="text"
					   name="username"
					   id="username"
					   value="<?php display_value('username')?>"
					   class="input-xlarge"
					   placeholder="Name"/>
			</div>
		</div>

		<div class="control-group">
			<label for="email" class="control-label">Email:</label>
			<div class="controls">
				<input type="email"
					   name="email"
					   id="email"
					   value="<?php display_value('email')?>"
					   class="input-xlarge"
					   placeholder="Email"/>
			</div>
		</div>

		<div class="control-group">
			<label for="subject" class="control-label">Mot de passe:</label>
			<div class="controls">
				<input type="text"
				       name="password"
				       id="password"
				       value="<?php display_value('password')?>"
				       class="input-xlarge"
				       placeholder="Mot de passe" />
			</div>
		</div>


		<div class="control-group">
			<div class="controls">
				<input type="submit" name="submit" value="Send"	class="btn">
				<input type="reset" name="reset" value="Reset"	class="btn">
			</div>
		</div>
		</fieldset>
	</form>
</div>
</body>
</html>


<?php

//add a la bdd

//   $req = $connexion->prepare('INSERT INTO users(username, password, email) VALUES(:username, :password, :email)');
// $req->execute(array(
// 	'username' => $username,
// 	'password' => $password,
// 	'email' => $email,
// 	));


?>
