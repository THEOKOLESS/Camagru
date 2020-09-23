<?php 

function validate_form(&$errors, $username, $email, $pwd, $pwd_bis){
    // validate name
    if($username != ''){
        $namecheck = filter_var($username,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        if($username != $namecheck || strlen($username) > 25 ){
            $errors[] = 'Nom d\'utilisateur invalide';
        }
    }else{
        $errors[] = 'Veuiller rentrer un nom d\'utilisateur';
    }
// validate email
    if($email != ''){
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
            $errors_init[] = 'Veuiller rentrer un email valide';
        }
    }else{
        $errors[] = 'Veuiller rentrer un email';
    }
// validate password
    if($pwd != ''){
        checkPassword($pwd, $errors);
    }else{
        $errors[] = 'Veuillez rentrer un mot de passe';
    }

    if($pwd_bis != ''){
        if ($pwd != $pwd_bis){
            $errors[] = 'Les mots de passe doivent correspondre';
        }
    }else{
        $errors[] = 'Veuillez répeter votre mot de passe';
    }
 
    if(count($errors)){
        return false;
    }else{
        return true;
    }
}
require('public/tools.php');
