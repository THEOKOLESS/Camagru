<?php

  require('model/connexion_validation.php');

function connect_form($db){
    $id = 0;
    $errors = array();
		$username = isset($_POST['username']) ? $_POST['username'] : NULL;
		$email = isset($_POST['email']) ? $_POST['email'] : NULL;
		$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : NULL;
  if(isset($_POST['submit']))
  {
      if(check_log($db, $id, $errors, $email, $username, $pwd)){
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
      }
      return($errors);
  }
}

$errors = connect_form($db);
require('view/connexion_view.php');
?>

