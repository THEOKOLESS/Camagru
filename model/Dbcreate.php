<?php 

require_once('model/Dbco.php');
class Dbcreation extends Dbco
{
    public function tableCreate($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions)
    {
        $db = $this->dbConnect($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
        $sql = "CREATE TABLE IF NOT EXISTS users (
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

    public function dbCreate($DB_USER, $DB_PASSWORD, $pdoOptions){
        $pdo = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD, $pdoOptions);
        $requete = "CREATE DATABASE IF NOT EXISTS camagrubdd DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
        $pdo->prepare($requete)->execute();
        
    }
}