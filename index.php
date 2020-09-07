<?php
try{
    session_start();
    require 'config/setup.php';
    require 'controller/front.php';
}catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}