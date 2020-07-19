<?php
include "config/setup.php";

// https://www.zentut.com/php-pdo/pdo-inserting-data-into-tables/
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];




  $req = $connexion->prepare('INSERT INTO users(username, password, email) VALUES(:nom, :possesseur, :console)');
$req->execute(array(
	'nom' => $username,
	'possesseur' => $password,
	'console' => $email,
	));



?>
