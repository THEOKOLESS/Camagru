<?php

function check_password($pwd, &$errors, $pwd_bis){
    // $errors_init = $errors;

    if($pwd == ''){
        $errors[] = 'Please, add a password';
    }
    if (strlen($pwd) < 8) {
        $errors[] = "Your password should have at least 8 char !";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Your password should have at least 1 number !";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Your password should have at least 1 letter !";
    }
    if (!preg_match("#[a-z]+#", $pwd)) {
        $errors[] = "Your password should have at least 1 lowercase letter !";
    }
    if (!preg_match("#[A-Z]+#", $pwd)) {
        $errors[] = "Your password should have at least 1 uppercase letter !";
    }  

    if($pwd_bis != ''){
        if ($pwd != $pwd_bis){
            $errors[] = 'Both password have to match';
        }
    }else{
        $errors[] = 'Please, reapat your password';
    }

    // return ($errors == $errors_init);
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
                $errors[] = 'I don\'t like this username sorry';
        }
        else if (preg_match('/[^a-z_ \-0-9]/i', $username))
        {
            $errors[] = 'Please, choose a normal username... no space or weird char you know ';
        }
    }else{
        $errors[] = 'Please, fill the username field :)';
    }

    return ($errors == $errors_init);
}


function check_email(&$errors, $email){
    $errors_init = $errors;

    if($email != ''){
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email > 45)){
            $errors_init[] = 'Don\'t mess with the email field';
        }
    }else{
        $errors[] = 'Please, enter a Email';
    }

    return ($errors == $errors_init);
}