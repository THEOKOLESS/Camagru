<?php
//https://www.allphptricks.com/forgot-password-recovery-reset-using-php-and-mysql/
session_start();
define( 'DB_TMP', 'password_reset_temp' );
require 'config/setup.php';
$db = dbConnect();
$errors = array();
$email = '';

function reset_mail(){
	global $db, $email, $errors;
	$expFormat = mktime(
		date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
		);
		$expDate = date("Y-m-d H:i:s",$expFormat);
		$cle = md5(microtime(TRUE)*100000);
		$req = $db->prepare('INSERT INTO password_reset_temp(email, cle, expDate) VALUES(:email, :cle, :expDate)');
		$req->execute(array(
		'email' => $email,
		'cle' => $cle,
		'expDate' => $expDate
		));
			$entete = "From: Faisconfiancefrr@Gros.Hacker" ;
			$message = 'Bienvenue sur donnetessous.com,

		Pour reset UI RESEEET ton mdp, veuillez cliquer sur le lien ci-dessous
		ou copier/coller dans votre navigateur Internet.
		
		c\'est sans danger fais confiance. 
		
		Apres si on te demande tes infos banquaire, tu peux les donner sans craintes, c\'est juste pour un test, y va rien t\'arriver

		Vazy clique mon sauce :p =>	http://localhost:8080/reset-pwd.php?email='.urlencode($email).'&cle='.urlencode($cle).'&action=reset

		---------------
		Ceci est un mail un peu automatique, si tu reponds tu perds ton temps.';
			$subject = "Password Recovery - CAMAGRU.com";

			if(!mail($email, $subject, $message, $entete)){
				$errors[] = 'Error sending email';
		   }
}

function tmp_table(){
	global $db;
	if($db){
			$sql = "CREATE TABLE IF NOT EXISTS `".DB_TMP."` (
 			`email` varchar(250) NOT NULL,
  			`cle` varchar(250) NOT NULL,
  			`expDate` datetime NOT NULL
			)";
			$db->prepare($sql)->execute();
		}
}

function check_mail(){
	global $email, $errors, $db;
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

	if ($email == ''){
		$errors[] = 'Veuiller renseigner votre Email';
		return false;
	  }
	if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
		$errors[] = 'Veuiller rentrer un email valide';
		return false;
	}
	$stmt = $db->prepare("SELECT email FROM users WHERE email LIKE :email");
  	$stmt->execute(array(
    'email' => $email));
  	$res = $stmt->fetch();
	  if(!$res){
		$errors[] = 'Veuillez verifier votre email';
		return false;
	  }

	  return true;
}

function reset_pwd(){
	if(isset($_POST['submit'])){
		if (check_mail()){
			tmp_table();
			reset_mail();
		}
	}
}

reset_pwd();

?>

<head>
    <meta charset="utf-8" />
    <!-- <meta http-equiv="Cache-control" content="no-cache"> -->
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="menu.css">
</head>
<body>
    <?php include("menu.php");?>
	<?php include("message.php");?>
	<form action="enter_email.php" method="POST">
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
