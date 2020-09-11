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
    require('controller/front.php');
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
    require('profile.php');
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
        default:
            page404();
    }

