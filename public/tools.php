<?php

function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

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

    return ($errors == $errors_init);
}


function display_value($fieldName){
    echo isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
}