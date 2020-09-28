<?php

require('model/model_tools.php');

function check_log($db, &$id, &$errors, &$email, $username, $pwd)
{
    if ($pwd == '' || $username == ''){
        $errors[] = 'Veuiller renseigner votre nom d\'utilisateur ET votre mot de passe';
        return false;
    }
    $res = get_user_info_from_username($db, $username);
    $id = $res['id'];
    $email = $res['email'];
    $isPasswordCorrect = password_verify($pwd, $res['pwd']);
    if(!$res){
        $errors[] = 'Veuiller verifier votre nom d\'utilisateur';
        return false;
    }
    else if (!$isPasswordCorrect)
    {
        $errors[] = 'MDP faux !';
        return false;
    }
    else if (!$res['actif'])
    {
        $errors[] = 'compte pas activé, go check tes mails';
        return false;
    }
        return true;
}

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

