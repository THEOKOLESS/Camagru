<?php
session_start();
$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$request = parse_url($current_url, PHP_URL_PATH);

try{
  require 'config/setup.php';
}catch(Exception $e) { // S'il y a eu une erreur, alors...
  echo 'THIS IS  A CAAAAATCH LOL : ' . $e->getMessage();
}

function home(){
    require('view/index_view.php');
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

function montage($db){
        require('montage.php');
}

function page404(){
    die('Page not found. Please try some different url.');
}

    switch($request){
        case '/index.php':
        case '/':
            home();
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
            montage($db);
        break;
        default:
            page404();
    }

