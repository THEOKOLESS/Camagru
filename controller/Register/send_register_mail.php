<?php function send_mail($username, $email, &$errors, $cle){

$destinataire = $email;
$sujet = "clique ici many" ;
$entete = "From: Faisconfiancefrr@Gros.Hacker" ;
$message = 'Bienvenue sur donnetessous.com,

Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
ou copier/coller dans votre navigateur Internet.

c\'est sans danger fais confiance. 

Apres si on te demande tes infos banquaire, tu peux les donner sans craintes, c\'est juste pour un test, y va rien t\'arriver

Vazy clique mon sauce :p =>	http://localhost:8080/validation?log='.urlencode($username).'&cle='.urlencode($cle).'

---------------
Ceci est un mail un peu automatique, si tu reponds tu perds ton temps.';
if(!mail($destinataire, $sujet, $message, $entete)){
     $errors[] = 'Error sending email';
     return(false);
}
return(true);
}