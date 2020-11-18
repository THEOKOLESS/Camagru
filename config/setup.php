<?php
require 'database.php';

define( 'DB_NAME', 'camagrubdd' );
define( 'DB_TABLE', 'users' );
define( 'DB_TABLE2', 'photo' );
define( 'DB_TABLE3', 'likes' );
define( 'DB_TABLE4', 'coms' );

$database = $DB_DSN.';'.'dbname=camagrubdd';

dbCreate( $DB_USER, $DB_PASSWORD, $DB_DSN, $pdoOptions);
$db = dbConnect($database, $DB_USER, $DB_PASSWORD, $pdoOptions);

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
function dbCreate($DB_USER, $DB_PASSWORD, $DB_DSN, $pdoOptions){
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
        $requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
        $pdo->prepare($requete)->execute();
}

//connect to camagrubdd
function dbConnect($database, $DB_USER, $DB_PASSWORD, $pdoOptions){
        $db = new PDO($database, $DB_USER, $DB_PASSWORD, $pdoOptions);
        return($db);
}
