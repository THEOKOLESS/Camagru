<?php
$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$request = parse_url($current_url, PHP_URL_PATH);

try{
  session_start();
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

function register(){
    require('register.php');
}

function contact_us(){
   require('connexion.php');
}

function page404(){
    die('Page not found. Please try some different url.');
}

  //If url is http://localhost/route/home or user is at the maion page(http://localhost/route/)
  if($request == '/index.php' or $request == '/')
      home();
//If url is http://localhost/route/about-us
else if($request == '/register.php')
  register();
//If url is http://localhost/route/contact-us
else if($request == '/connexion.php')
  contact_us();
//If user entered something else
else
  page404();
