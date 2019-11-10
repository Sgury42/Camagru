<?php
function db_connection()
{
    try {
        $dsn = 'mysql:host=localhost;dbname=db_camagru';
        $db = new PDO($dsn, 'root', 'sandra');
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