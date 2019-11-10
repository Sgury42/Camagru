<?php

function dataExists($db_table, $name, $target)
{
    $db = db_connection();
    $sql = "SELECT " . $name . " FROM " . $db_table . ";";
    $result = $db->query($sql);
    $array = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($array as $value) {
        if ($value[$name] == $target) {
            return true;
        }
    }
    return false;
}

function accountExists($login, $email)
{
    $db = db_connection();
    $sql = "SELECT * FROM users;";
    $result = $db->query($sql);
    $array = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($array as $value) {
        if ($value["email"] == $email) {
            if ($value["login"] == $login) {
                return true;
            }
        }
    }
    return false;
}

function getValue($db_table, $name, $targetName, $target)
{
    $db = db_connection();
    $sql = "SELECT `" . $name ."` FROM `" . $db_table . 
            "` WHERE `" . $targetName . "` = '". $target ."';";
    $result = $db->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function addPasswd($id, $passwd)
{
    $db = db_connection();
    $sql = "INSERT INTO `private` (`usr_id`, `pwd`)
        VALUES ('" . $id . "', AES_ENCRYPT('" . $passwd . "', 'secret'));";
    if (!$affected = $db->exec($sql)) {
        return false;
    }
    return true;
}

function addCode($id, $usage)
{
    $db = db_connection();
    $code = random_code(10);
    echo "code = " . $code;
    $sql = "INSERT INTO `codes` (`usr_id`, `usage`, `code`)
        VALUE ('". $id ."', '". $usage . "', 
        AES_ENCRYPT('". $code . "', 'uniquecodeforsafety'));";
    if (!$affected = $db->exec($sql)) {
        return false;
    }
    return true;
}

function checkPasswd($login, $passwd)
{
    $db = db_connection();
    $id = getValue("users", "id", "login", $login);
    $id = $id[0]["id"];
    $sql = "SELECT AES_DECRYPT(`pwd`, 'secret')
        AS `pwd` FROM `private`
        WHERE `usr_id` = '" . $id . "';";
    $result = $db->query($sql);
    $pwd = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($passwd == $pwd[0]['pwd']) {
        return true;
    }
    return false;
}

function getCode($id) {
    $db = db_connection();
    $sql = "SELECT AES_DECRYPT(`code`, 'uniquecodeforsafety')
        AS `code` FROM `codes`
        WHERE `usr_id` = '" . $id . "';";
        $result = $db->query($sql);
        $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
        $code = $fetch[0]["code"];
        return $code;
}

function newUsr($login, $role, $email, $passwd)
{
    $db = db_connection();
    $addusr = "INSERT INTO `users` (`login`, `role`, `email`, `creation_date`)
            VALUES ('" . $login . "', '" . $role . "', '" . $email . "', date(now()));";
    if (!$affected = $db->exec($addusr)) {
        return false;
    }
    $newId = getValue("users", "id", "login", $login);
    $newId = $newId[0]['id'];
    if (!addPasswd($newId, $passwd)) {
        return false;
    }
    if (!addCode($newId, "verify_email")) {
        return false;
    }
    return true;
}

function removeUsr($login)
{
    $db = db_connection();
    $result = getValue("users", "id", "login", $login);
    $id = $result[0]["id"];
    $sql = "DELETE FROM `users`
        WHERE `id` = '" . $id . "';
        DELETE FROM `private`
        WHERE `usr_id` = '" . $id ."';
        DELETE FROM `codes`
        WHERE `usr_id` = '". $id . "'";
    if (!$affected = $db->exec($sql)) {
        return false;
    }
    return true;
}

function editData($table, $column, $newValue, $targetName, $target)
{
    $db = db_connection();
    $sql = "UPDATE `". $table ."`
        SET `". $column ."` = '". $newValue . "'
        WHERE `". $targetName ."` = '". $target ."'";
    if (!$affected = $db->exec($sql)) {
        return false;
    }
    return true;
}

function removeData($table, $selector, $value)
{
    $db = db_connection();
    $sql = "DELETE FROM `". $table ."`
        WHERE `". $selector ."` = '". $value ."';";
    if (!$affected = $db->exec($sql)) {
        return false;
    }
    return true;
}