<?php

function check_password($pwd, &$errors, $pwd_bis){
    $errors_init = $errors;

    if($pwd == ''){
        $errors[] = 'Veuillez rentrer un mot de passe';
    }
    if (strlen($pwd) < 8) {
        $errors[] = "Votre Mot de passe doit contenir au moins 8 characteres !";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Votre mot de passe doit contenir au moins un chiffre !";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Votre mot de passe doit contenir au moins une lettre !";
    }
    if (!preg_match("#[a-z]+#", $pwd)) {
        $errors[] = "Votre mot de passe doit contenir au moins une lettre minuscule !";
    }
    if (!preg_match("#[A-Z]+#", $pwd)) {
        $errors[] = "Votre mot de passe doit contenir au moins une lettre majuscule !";
    }  

    if($pwd_bis != ''){
        if ($pwd != $pwd_bis){
            $errors[] = 'Les mots de passe doivent correspondre';
        }
    }else{
        $errors[] = 'Veuillez répeter votre mot de passe';
    }

    return ($errors == $errors_init);
}


function display_value($fieldName){
    echo isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
}


function init_value($fieldName){
    return isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
}

function check_username(&$errors, $username){
    $errors_init = $errors;

    if($username != ''){
        $namecheck = filter_var($username,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $namecheck = trim($namecheck);
        if($username != $namecheck || strlen($username) > 25 || strlen($username) < 3 ){
                $errors[] = 'Nom d\'utilisateur invalide';
        }
        else if (preg_match('/[^a-z_ \-0-9]/i', $username))
        {
            $errors[] = 'Nom d\'utilisateur ne doit pas avoir de char trop chelou tas vu';
        }
    }else{
        $errors[] = 'Veuiller rentrer un nom d\'utilisateur';
    }

    return ($errors == $errors_init);
}


function check_email(&$errors, $email){
    $errors_init = $errors;

    if($email != ''){
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
            $errors_init[] = 'Veuiller rentrer un email valide';
        }
    }else{
        $errors[] = 'Veuiller rentrer un email';
    }

    return ($errors == $errors_init);
}