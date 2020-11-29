<?php 

function reset_mail($db, $email, &$errors){
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

		Vazy clique mon sauce :p =>	http://localhost:8080/reset_pwd?email='.urlencode($email).'&cle='.urlencode($cle).'&action=reset

		---------------
		Ceci est un mail un peu automatique, si tu reponds tu perds ton temps.';
		$subject = "Password Recovery - CAMAGRU.com";

		if(!mail($email, $subject, $message, $entete)){
			$errors[] = 'Error sending email';
	   }
}
