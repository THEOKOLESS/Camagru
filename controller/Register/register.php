<?php

	require('model/add_register.php');
	require('controller/Register/check_register_form.php');
	require('controller/Register/send_register_mail.php');
	
	function start_form($db){
		$errors = array();
		$username = isset($_POST['username']) ? $_POST['username'] : NULL;
		$email = isset($_POST['email']) ? $_POST['email'] : NULL;
		$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : NULL;
		$pwd_bis = isset($_POST['pwd_bis']) ? $_POST['pwd_bis'] : NULL;;
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
