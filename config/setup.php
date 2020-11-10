<?php
require 'database.php';

define( 'DB_NAME', 'camagrubdd' );
define( 'DB_TABLE', 'users' );
define( 'DB_TABLE2', 'photo' );
define( 'DB_TABLE3', 'likes' );
define( 'DB_TABLE4', 'coms' );

$db_dsn1 = $DB_DSN;
$db_user1 = $DB_USER;
$db_password1 = $DB_PASSWORD;


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

          // on creer la table likes et ses champs si elle n'existe pas
          $sql = "CREATE TABLE IF NOT EXISTS `".DB_TABLE3."` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            id_user INT(6) NOT NULL,
            id_photo INT(6) NOT NULL
            )";
            $db->prepare($sql)->execute();

        // on creer la table coms et ses champs si elle n'existe pas
        $sql = "CREATE TABLE IF NOT EXISTS `".DB_TABLE4."` (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                id_user INT(6) NOT NULL,
                id_photo INT(6) NOT NULL,
                com VARCHAR(255) NOT NULL
                )";
                $db->prepare($sql)->execute();
        // on creer la table photo et ses champs si elle n'existe pas
        $sql = "CREATE TABLE IF NOT EXISTS `".DB_TABLE2."` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        file_pic_path VARCHAR(255) NOT NULL,
        id_user INT(6) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $db->prepare($sql)->execute();

    }
//creation de la bdd si elle n'existe pas
function dbCreate($DB_USER, $DB_PASSWORD, $pdoOptions){
        $pdo = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD, $pdoOptions);
        $requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
        $pdo->prepare($requete)->execute();
}


function dbConnect(){
        global $db_dsn1, $db_user1, $db_password1, $pdoOptions;
        $db = new PDO($db_dsn1, $db_user1, $db_password1, $pdoOptions);
        return($db);
}
