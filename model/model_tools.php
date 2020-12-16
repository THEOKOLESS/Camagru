<?php

	

    function get_user_info_from_username($db, $username){
        $stmt = $db->prepare("SELECT id, pwd, actif, email FROM users WHERE username LIKE :username");
        $stmt->execute(array('username' => $username));
		$res = $stmt->fetch();
        return($res);
	}

	function agreed_to_get_mail($db,$id){
		$stmt = $db->prepare("SELECT email_on_com FROM users WHERE users.id LIKE :id");
		$stmt->execute(array(
			'id' => $id));
			$res = $stmt->fetch();
			return($res[0]);
	}
	
    function get_user_info_from_id($db){
        $stmt = $db->prepare("SELECT username, pwd, actif, email FROM users WHERE id LIKE :id");
        $stmt->execute(['id' => $_SESSION['id']]);
		$res = $stmt->fetch();
        return($res);
	}
	
	function update_email_on_com($db, $mail_com){
		$sql = "UPDATE users SET email_on_com=? WHERE id=?";
        $db->prepare($sql)->execute([$mail_com, $_SESSION['id']]);
	}

    function update_username_from_username($db, $username){
        $sql = "UPDATE users SET username=? WHERE username=?";
        $db->prepare($sql)->execute([$username, $_SESSION['username']]);
        $_SESSION['username'] = $username;
	}
	
	function update_email_from_email($db, $email){
        $sql = "UPDATE users SET email=? WHERE email=?";
        $db->prepare($sql)->execute([$email, $_SESSION['email']]);
        $_SESSION['email'] = $email;
    }

    function check_bdd(&$errors, $username, $email, $db)
	{	
		$reponse = $db->query('SELECT username, email FROM users');
		while ($donnees = $reponse->fetch())
		{
			if(!isset($_SESSION['username']) OR (isset($_SESSION['username']) 
			&& $_SESSION['username'] != $username && $donnees['username'] == $username)){
					$errors[] = "Nom d'utilisateur deja pris";
			}
		
			if(!isset($_SESSION['email']) OR (isset($_SESSION['email']) 
			&& $_SESSION['email'] != $email && $donnees['email'] == $email)){
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
?>