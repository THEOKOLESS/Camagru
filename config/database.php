<?php

$DB_DSN = 'mysql:dbname=camagrubdd;host=127.0.0.1';
$DB_USER = 'root';
$DB_PASSWORD = 'rootroot';

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);