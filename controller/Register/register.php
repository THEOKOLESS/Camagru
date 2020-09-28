<?php

	require('model/add_register.php');
	require('controller/Register/send_register_mail.php');
	require('public/tools.php');

	function validate_form(&$errors, $username, $email, $pwd, $pwd_bis){
		check_username($errors, $username);
		check_email($errors, $email);   
		check_password($pwd, $errors, $pwd_bis);
		if(count($errors)){
			return false;
		}else{
			return true;
		}
	}
	
	function start_form($db){
		$errors = array();
		$username = init_value('username');
		$email = init_value('email');
		$pwd = init_value('pwd');
		$pwd_bis = init_value('pwd_bis');
		$cle = md5(microtime(TRUE)*100000);
		if(isset($_POST['submit']))
		{
			if(validate_form($errors, $username, $email, $pwd, $pwd_bis))
			{			
				//check si l'user existe deja
				if(check_bdd($errors, $username, $email, $db)){
					if(send_mail($username, $email, $errors, $cle)){
						add_user($username, $email, $pwd, $db, $cle);
					}
				}
			}
			return $errors;
		}
	}
	$errors = start_form($db);

?>

<?php require('view/register_view.php')?>
