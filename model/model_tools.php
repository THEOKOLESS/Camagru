<?php

    function get_user_info_from_username($db, $username){
        $stmt = $db->prepare("SELECT id, pwd, actif, email FROM users WHERE username LIKE :username");
        $stmt->execute(array('username' => $username));
        $res = $stmt->fetch();
        echo "coucou new username : " . $username . " ANCIEN ->  " . $res['username'];
        return($res);
    }
  
    function update_username_from_username($db, $username, $res){

        $reponse = $db->query('SELECT username FROM users');
        while ($donnees = $reponse->fetch())
		{
			if($donnees['username'] == $res['username']){
                $errors[] = "Nom d'utilisateur deja pris";
                return false;
			}
        }	

        // echo "coucou new username : " . $username . " ANCIEN ->  " . $res['username'];
        
        $sql = "UPDATE users SET username=? WHERE username=?";
        $db->prepare($sql)->execute([$username, $res['username']]);
        
        return($res);
    }

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
?>