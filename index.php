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
    if ($handle = opendir('.')) {

      while (false !== ($entry = readdir($handle))) {
  
          if ($entry != "." && $entry != "..") {
  
              echo "$entry\n";
          }
      }
  
      closedir($handle);
  }
}

function register($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions){
    require('controller/register.php');
}

function contact_us(){
   require('connexion.php');
}

function page404(){
    die('Page not found. Please try some different url.');
}

    if($request == '/index.php' or $request == '/')
        home();
    else if($request == '/register')
        register($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
    else if($request == '/connexion.php')
        contact_us();
    else
        page404();
