<?php
define( 'DB_TMP', 'password_reset_temp' );

require('model/pass_recover.php');
require('controller/Pass_Recover/send_reset_mail.php');

function check_mail($email, &$errors, $db){

	$email = filter_var($email,FILTER_SANITIZE_EMAIL);

	if ($email == ''){
		$errors[] = 'Veuiller renseigner votre email';
		return false;
	  }
	if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
		$errors[] = 'Veuiller rentrer un email valide';
		return false;
	}
	tmp_table($db);
	if (check_bdd_mail($db, $email, $errors))
		return true;
	return false;
}

function start_form($db){
	$email = isset($_POST['email']) ? $_POST['email'] : NULL;
	$errors = array();
	if(isset($_POST['submit'])){
		if (check_mail($email, $errors, $db)){
			reset_mail($db, $email, $errors);
			//  echo 'we stayy';
		}
	}
	return ($errors);
}

$errors = start_form($db);

require('view/enter_email_view.php');

?>

