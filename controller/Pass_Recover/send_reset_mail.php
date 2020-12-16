<?php 

function reset_mail($db, $email, &$errors){
	$expFormat = mktime(
		date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
		);
		$expDate = date("Y-m-d H:i:s",$expFormat);
		$cle = md5(microtime(TRUE)*100000);

		$stmt = $db->prepare("SELECT email FROM password_reset_temp WHERE email LIKE :email");
		$stmt->execute(array(
	  'email' => $email));
		$res = $stmt->fetch();
		
		if ($res){
			$req = $db->prepare("DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
			$req->execute();
		}

		$req = $db->prepare('INSERT INTO password_reset_temp(email, cle, expDate) VALUES(:email, :cle, :expDate)');
		$req->execute(array(
		'email' => $email,
		'cle' => $cle,
		'expDate' => $expDate
		));
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		
		$headers .= 'From: Unsuspisious guy <safe@big.hack>' . "\r\n";

		$message = "<html><body>

		You asked for a  Camagru password recovery. Here is your link => ". "<a href=\"http://localhost/reset_pwd?email=".urlencode($email)."&cle=".urlencode($cle)."&action=reset\">Link</a>
		</body>
		</html>";
		
		$subject = "Password Recovery - CAMAGRU.com";

		if(!mail($email, $subject, $message, $headers)){
			$errors[] = 'Error sending email';
	   }
}
