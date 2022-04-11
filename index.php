<?php
session_start();
// require('controller/Register/send_register_mail.php');
$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$request = parse_url($current_url, PHP_URL_PATH);

if (substr_count($request, '/') > 1)
    header('Location: http://localhost/');

try{
  require 'config/setup.php';
}catch(Exception $e) { // S'il y a eu une erreur, alors...
  echo 'THIS IS  A CAAAAATCH LOL : ' . $e->getMessage();
}


function home($db){
    require('view/Galerie/pagination.php');
}

function register($db, $request){
    require('controller/Register/register.php');
}

function connexion($db, $request){
   require('controller/connexion.php');
}

function validation($db){
    require('model/validation.php');
 }

function profile($db){
    require('controller/profile.php');
}

function enter_email($db, $request){
    require('controller/Pass_Recover/enter_email.php');
}

function reset_pwd($db, $request){
    require('controller/reset_pwd.php');
}

function edit_profile($db, $request){
    require('controller/edit_profile.php');
}

function montage($db, $request){
        require('controller/montage.php');
}

function bad_link($db, $request){
    require('view/Reset_Mdp/bad_link.php');
}

function expired_link($db, $request){
    require('view/Reset_Mdp/expired_link.php');
}

function pwd_reset($db, $request){
    require('view/Reset_Mdp/pwd_reset.php');
}

function page404(){
    require('view/404.php');
}

    switch($request){
        case '/index.php':
        case '/':
            home($db);
            // send_mail('man', 'theophile.vitoux@gmail.com', $errors, '1234');

        break;
        case '/register':
            register($db, $request);
        break;
        case '/validation':
            validation($db);
        break;
        case '/connexion':
            connexion($db, $request);
        break;
        case '/profile':
            profile($db);
        break;
        case '/enter_email':
            enter_email($db, $request);
        break;
        case '/reset_pwd':
            reset_pwd($db, $request);
        break;
        case '/edit_profile':
            edit_profile($db, $request);
        break;
        case '/montage':
            montage($db, $request);
        break;
        case '/bad_link':
            bad_link($db, $request);
        break;
        case '/expired_link':
            expired_link($db, $request);
        break;
        case '/pwd_reset':
            pwd_reset($db, $request);
        break;
        default:
            page404();
    }

