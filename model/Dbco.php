<?php

class Dbco
{
    public function dbConnect($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions)
    {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $pdoOptions);
        return $db;
    }
}