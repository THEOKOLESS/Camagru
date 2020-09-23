<?php 


function check_bdd_mail($db, $email, &$errors){
     $stmt = $db->prepare("SELECT email FROM users WHERE email LIKE :email");
  	 $stmt->execute(array(
     'email' => $email));
  	 $res = $stmt->fetch();
	   if(!$res){
	 	$errors[] = 'Nous n\'avons aucun compte associé à cette email, veuillez verifier votre email';
	 	return false;
	   }
	   return true;
}


function tmp_table($db){
	if($db){
			$sql = "CREATE TABLE IF NOT EXISTS `".DB_TMP."` (
 			`email` varchar(250) NOT NULL,
  			`cle` varchar(250) NOT NULL,
  			`expDate` datetime NOT NULL
			)";
			$db->prepare($sql)->execute();
		}
}

