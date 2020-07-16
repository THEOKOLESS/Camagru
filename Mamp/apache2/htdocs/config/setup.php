<?php
include 'database.php';
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
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
} catch (PDOException $e) {
die('Erreur : '.$e->getMessage());
}
?>
