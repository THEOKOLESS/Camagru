<?php
require 'database.php';


define( 'DB_NAME', 'camagrubdd' );
define( 'DB_TABLE', 'users' );

$db_dsn1 = $DB_DSN;
$db_user1 = $DB_USER;
$db_password1 = $DB_PASSWORD;
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

dbCreate($DB_USER, $DB_PASSWORD, $pdoOptions);
$db = dbConnect();

if($db){
    // on creer la table users et ses champs si elle n'existe pas
        $sql = "CREATE TABLE IF NOT EXISTS `".DB_TABLE."` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        pwd VARCHAR(255) NOT NULL,
        email VARCHAR(50) NOT NULL,
        cle VARCHAR(32),
        actif INT(6) DEFAULT 0,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $db->prepare($sql)->execute();
    }
//creation de la bdd si elle n'existe pas
function dbCreate($DB_USER, $DB_PASSWORD, $pdoOptions){
    

    try {
        $pdo = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD, $pdoOptions);
    } catch (PDOException $e) {
        die('Erreur : '.$e->getMessage());
    }

    $requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
    $pdo->prepare($requete)->execute();
}


function dbConnect(){
    try {
        global $db_dsn1, $db_user1, $db_password1, $pdoOptions;
        $db = new PDO($db_dsn1, $db_user1, $db_password1, $pdoOptions);
        return($db);

    } catch (PDOException $e) {
        die('Erreur : '.$e->getMessage());
    }
}