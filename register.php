<?php

	// require('config/database.php');
	// require('model/Dbco.php');
	require('config/setup.php');


	echo $DB_DSN;
	$errors = array();
	$flag = 0; // clear form ou pas

	function check_bdd(&$errors, $username, $email, $db)
	{	
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
	function add_user($username, $email, $pwd, $db, $cle){	
	  	$req = $db->prepare('INSERT INTO users(username, pwd, email, cle) VALUES(:username, :pwd, :email, :cle)');
		$req->execute(array(
		'username' => $username,
		'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
		'email' => strtolower($email),
		'cle' => $cle
		));
	}
	
	require('controller/checkregisterform.php');
	require('controller/send_mail.php');
	
	function start_form($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions){
		global $flag, $errors;
		$username = isset($_POST['username']) ? $_POST['username'] : NULL;
		$email = isset($_POST['email']) ? $_POST['email'] : NULL;
		$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : NULL;
		$pwd_bis = isset($_POST['pwd_bis']) ? $_POST['pwd_bis'] : NULL;;
		$db = dbConnect($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
		$cle = md5(microtime(TRUE)*100000);
		if(isset($_POST['submit']))
		{
			if(validate_form($errors, $username, $email, $pwd, $pwd_bis))
			{	
				//check si l'user existe deja
				if(check_bdd($errors, $username, $email, $db)){
					if(send_mail($username, $email, $errors, $cle)){
						add_user($username, $email, $pwd, $db, $cle);
						$flag = 1; 
					}
				}
			}
		}
	}
	start_form($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
?>

<?php require('view/registerview.php')?>
