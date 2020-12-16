<?php
function check_bdd(&$errors, $username, $email, $db)
	{	
		$reponse = $db->query('SELECT username, email FROM users');
		while ($donnees = $reponse->fetch())
		{
			if($donnees['username'] == $username){
				$errors[] = "Username aleready taken";
			}
			 if($donnees['email'] == strtolower($email)){
				$errors[] = "Email aleready taken";
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
    ?>