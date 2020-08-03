

<!-- https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4678891-nouvelle-fonctionnalite-afficher-des-commentaires  mvc -->
<!-- include "../config/setup.php"; -->

<?php
	require 'config/setup.php';
	$errors = array();
	$username = '';
	$email = '';
	$pwd = '';
	$pwd_bis = '';
	$db = dbConnect();
	$flag = 0; // clear form ou pas
	$cle = md5(microtime(TRUE)*100000);


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
		global  $username, $email, $pwd, $db, $cle;
		
	  	$req = $db->prepare('INSERT INTO users(username, pwd, email, cle) VALUES(:username, :pwd, :email, :cle)');
		$req->execute(array(
		'username' => $username,
		'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
		'email' => strtolower($email),
		'cle' => $cle
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
			$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
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
		if(count($errors) === 0){
		?>
			<div class="alert alert-success">
				<p>Vous allez recevoir un mail de confirmation a l'adresse indique</p>
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
	function send_mail(){
		global $username, $cle, $email;
		$destinataire = $email;
		$sujet = "clique ici many" ;
		$entete = "From: Faisconfiancefrr@Gros.Hacker" ;
		$message = 'Bienvenue sur donnetessous.com,

		Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
		ou copier/coller dans votre navigateur Internet.
		
		c\'est sans danger fais confiance. 
		
		Apres si on te demande tes infos banquaire, tu peux les donner sans craintes, c\'est juste pour un test, y va rien t\'arriver

		Vazy clique mon sauce :p =>	http://localhost:8080/validation.php?log='.urlencode($username).'&cle='.urlencode($cle).'

		---------------
		Ceci est un mail un peu automatique, si tu reponds tu perds ton temps.';
		if(!mail($destinataire, $sujet, $message, $entete)){
			 $errors[] = 'Error sending email';
		}
	}

	function start_form(){
		global $flag;
		// $mail_msg = '';
		// if user submitted the form
		if(isset($_POST['submit']))
		{
			// validate form
			if(validate_form())
			{	
				//check si l'user existe deja
				if(check_bdd()){
					send_mail();
					add_user(); 
					$flag = 1;
				}
			}
		}
	}

	start_form();

?>
<head>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="menu.css">
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
	<form action="register.php" method="POST" class="form-horizontal">
		<fieldset>
			<legend>Inscritpion Camagru</legend>
			<?php include("message.php");?>
		<div class="control-group">
			<label for="username" class="control-label">Name:</label>
			<div class="controls">
				<input type="text"
					   maxlength="25"
					   name="username"
					   id="username"
					   value="<?php if ($flag == 0){display_value('username');}else{ echo '';}?>"
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
					   value="<?php if ($flag == 0){display_value('email');}else{ echo '';}?>"
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
				       value="<?php if ($flag == 0){display_value('pwd');}else{ echo '';}?>"
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
					   value="<?php if ($flag == 0){display_value('pwd_bis');}else{ echo '';}?>"
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