<?php

require_once "config/database.php";

function db_connection()
{
    try {
        $dsn = 'mysql:host=localhost;dbname=db_camagru';
        global $DB_DSN;
        global $DB_USER;
        global $DB_PASSWORD;
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
     if ($db) {
         return $db;
     } else {
         echo "connection error: " . $error;
     }
     return false;
}