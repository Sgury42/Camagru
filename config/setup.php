<?php
require_once "model/database.php";

function setupAction() {
  $db = db_connection();
  // if (!$affected = $db->exec($createTables)) {
  //     echo "oups something went wrong !";
  // } else {
  //     echo "affected = " . $affected;
  // }
  // $db->query('CREATE DATABASE IF NOT EXISTS `db_camagru`');
  $db->query("CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `login` VARCHAR(15) NOT NULL,
    `role` ENUM('client', 'admin', 'unverified') NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `notifications` ENUM('y', 'n') DEFAULT 'y',
    `creation_date` DATE NOT NULL);')");

  $db->query("CREATE TABLE IF NOT EXISTS `private` (
    `usr_id` INT NOT NULL,
    `pwd` BLOB NOT NULL);");

  $db->query("CREATE TABLE IF NOT EXISTS `codes` (
    `usr_id` INT NOT NULL,
    `usage` ENUM('new_pwd', 'verify_email') NOT NULL,
    `code` BLOB NOT NULL);");

  $db->query("CREATE TABLE IF NOT EXISTS `usr_images` (
    `usr_id` INT NOT NULL,
    `img_id` INT NOT NULL,
    `comments_id` VARCHAR(255),
    `likes_id` VARCHAR(255),
    `comments_nb` INT NOT NULL DEFAULT 0,
    `likes_nb` INT NOT NULL DEFAULT 0,
    `published` DATETIME DEFAULT NOW());");

    $db->query("CREATE TABLE IF NOT EXISTS `general` (
      `total_img` INT NOT NULL DEFAULT 0,
      `total_usr` INT NOT NULL DEFAULT 0);
      INSERT INTO `general` (`total_img`, `total_usr`)
      VALUE (0, 0);");

    $db->query("CREATE TABLE IF NOT EXISTS `comments` (
      `comment_id` VARCHAR(25) NOT NULL, 
      `usr_id` INT NOT NULL,
      `img_id` INT NOT NULL,
      `text` VARCHAR(255) NOT NULL,
      `date` DATETIME NOT NULL);");

  header("Location: index.php?action=index");
}