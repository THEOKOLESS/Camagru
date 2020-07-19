<?php
include 'database.php';

define( 'DB_NAME', 'camagrubdd' );
define( 'DB_TABLE', 'users' );
/**
 * PDO options / configuration details.
 * I'm going to set the error mode to "Exceptions".
 * I'm also going to turn off emulated prepared statements.
 */
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

/**
 * Connect to MySQL and instantiate the PDO object.
 */


try {
    $pdo = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD, $pdoOptions);
} catch (PDOException $e) {
die('Erreur : '.$e->getMessage());
}

$requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$pdo->prepare($requete)->execute();

/**
 * Connect to camagrubdd.
 */

try {
    $connexion = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
} catch (PDOException $e) {
die('Erreur : '.$e->getMessage());
}

if($connexion){
	// on creer la table users et ses champs
  $sql = "CREATE TABLE IF NOT EXISTS `".DB_TABLE."` (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  // $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_EMAILS."` (
	// 			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	// 			`email` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	// 			`created` DATETIME NOT NULL
	// 			) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

	// on prépare et on exécute la requête
	$connexion->prepare($sql)->execute();
}
?>
