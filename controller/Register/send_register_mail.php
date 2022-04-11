<?php function send_mail($username, $email, &$errors, $cle){
$destinataire = $email;
$sujet = " Camagru - Over here bro " ;
$headers = "From: Camagru@big.hack \r\n".'Reply-To: ' . $email. "\r\n".'X-Mailer: PHP/' . phpversion();
// $headers  = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// // Additional headers

// $headers .= 'From: Unsuspisious guy <safe@big.hack>' . "\r\n";
$message = "
Hello ".$username. " ! Welcome to Camagru, click on this href=\"http://localhost/validation?log=".urlencode($username)."&cle=".urlencode($cle)."\">Link. to get your account activated !!!
";
// $message = "<html><body>
// <p>Hello ".$username. " ! <br / > Welcome to Camagru, click on this " . "<a href=\"http://localhost/validation?log=".urlencode($username)."&cle=".urlencode($cle)."\">Link</a>. to get your account activated !!!</p>
// </body>
// </html>";

if(!mail($destinataire, $sujet, $message, $headers)){
     // $errors[] = 'Error sending email';
     return(false);
}
return(true);
}