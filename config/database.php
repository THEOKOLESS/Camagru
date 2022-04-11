<?php
// bitnami
// $DB_DSN = 'mysql:host=127.0.0.1';
// $DB_USER = 'root';
// $DB_PASSWORD = 'rootroot';

// wamp
$DB_DSN = 'mysql:host=127.0.0.1';
$DB_USER = 'root';
$DB_PASSWORD = '';

// docker lamp
// $DB_DSN = 'mysql:host=database:3306';
// $DB_USER = 'root';
// $DB_PASSWORD = 'tiger';


$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);