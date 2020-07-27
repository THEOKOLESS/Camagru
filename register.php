

<!-- https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4678891-nouvelle-fonctionnalite-afficher-des-commentaires  mvc -->
<!-- include "../config/setup.php"; -->

<?php
	require 'config/setup.php';
	define('MAIL_TO','theophile.vitoux@gmail.com');
	$errors = array();
	$username = '';
	$email = '';
	$pwd = '';
	$pwd_bis = '';
	$db = dbConnect();


	function check_bdd()
	{
		global $errors, $username, $email, $pwd, $db;
		
		$reponse = $db->query('SELECT username, email FROM users');
		while ($donnees = $reponse->fetch())
		{
			if($donnees['username'] == $username){
				$errors[] = "Nom d'utilisateur deja pris";
			}
			 if($donnees['email'] == strtolower($email)){
				$errors[] = "Email deja pris";
			 }
		}	
		$reponse->closeCursor();
		if(count($errors)){
			return false;
		}else{
			return true;
		}
	}

	//add a la bdd
	function add_user(){
		global  $username, $email, $pwd, $db;
		
	  $req = $db->prepare('INSERT INTO users(username, pwd, email) VALUES(:username, :pwd, :email)');
		$req->execute(array(
		'username' => $username,
		'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
		'email' => strtolower($email)
		));
	}
	
	
	
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

		global $errors, $username, $email, $pwd;

		// validate name
		if($_POST['username'] != ''){
			$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			if($username != $_POST['username'] || strlen($username > 25) ){
				$errors[] = 'Nom d\'utilisateur invalide';
			}
		}else{
			$errors[] = 'Veuiller rentrer un nom d\'utilisateur';
		}
		// validate email
		if($_POST['email'] != ''){
			$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
			if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
				$errors[] = 'Veuiller rentrer un email valide';
			}
		}else{
			$errors[] = 'Veuiller rentrer un email';
		}
		// validate password
		if($_POST['pwd'] != ''){
			$pwd = $_POST['pwd'];
			 checkPassword($pwd, $errors);
		}else{
			$errors[] = 'Veuillez rentrer un mot de passe';
		}

		if($_POST['pwd_bis'] != ''){
			$pwd_bis = $_POST['pwd_bis'];
			if ($pwd != $pwd_bis){
				$errors[] = 'Les mots de passe doivent correspondre';
			}
		}else{
			$errors[] = 'Veuillez répeter votre mot de passe';
		}
		echo "pwd 1 [ " . password_hash($pwd, PASSWORD_DEFAULT) . " ] \n" . " Pwd 2 [ " .  password_hash($pwd_bis, PASSWORD_DEFAULT) . " ] \n";
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
		if(count($errors) === 0){
		?>
			<div class="alert alert-success">
				<p>Bienvenue !</p>
			</div>
		<?php
		}else{
		?>
			<div class="alert alert-block alert-error fade in">
				<p>Les erreurs suivante sont apparues:</p>
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
		// $mail_msg = '';
		// if user submitted the form
		if(isset($_POST['submit']))
		{
			// validate form
			if(validate_form())
			{
				//check si l'user existe deja
				if(check_bdd()){
					add_user();
					$_POST = array();
				}
				// // send email to the MAIL_TO email address
				// if(!@mail(MAIL_TO, $password, $mail_msg)){
					// $errors[] = 'Error sending email';
			}
		}
	}

	// start form processing
	start_form();

?>
<head>
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<?php include("menu.php"); ?>
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
					   maxlength="25"
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
					   maxlength="45"
					   name="email"
					   id="email"
					   value="<?php display_value('email')?>"
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
				       value="<?php display_value('pwd')?>"
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
				       value="<?php display_value('pwd_bis')?>"
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
</div>
</body>