<?php
session_start();
require_once 'core/pdo_connect.php';
$db = db_connection();                          //CONNECTION NOT WORKING BUT WHY??!!

$createTables = "
    CREATE TABLE `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `login` VARCHAR(15) NOT NULL,
        `role` ENUM('client', 'admin', 'unverified') NOT NULL,
        `email` VARCHAR(80) NOT NULL,
        `creation_date` DATE NOT NULL);
        
    CREATE TABLE `private` (
        `usr_id` INT NOT NULL,
        `pwd` BLOB NOT NULL);

    CREATE TABLE `codes` (
        `usr_id` INT NOT NULL,
        `usage` ENUM('new_pwd', 'verify_email') NOT NULL,
        `code` BLOB NOT NULL);";

if (!$affected = $db->exec($createTables)) {
    echo "oups something went wrong !";
} else {
    echo "affected = " . $affected;
}