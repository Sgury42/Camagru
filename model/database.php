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
        WHERE `usr_id` = '" . $id . "'
        LIMIT 1;";
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
        WHERE `usr_id` = '" . $id . "'
        LIMIT 1;";
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

function imgToDb($path, $imgId, $usrId)
{
    $db = db_connection();
    // $base64 = pngToB64($path, $imgId);
    $sql = "INSERT INTO `usr_images` (`usr_id`, `img_id`)
            VALUES ('". $usrId ."', '". $imgId ."');";
    if (!$affected = $db->exec($sql)) {
        return false ;
    }
    return true ;
}

function getUsrImgs($usrId)
{
    $db = db_connection();
    $usrImgs = [];
    $sql = "SELECT `img_id`, `likes_nb`, `comments_nb`, `published` FROM `usr_images`
            WHERE `usr_id` = '". $usrId ."';";
    $result = $db->query($sql);
    if (!$result) {
        return ($usrImgs);
    }
    $usrImgs = $result->fetchAll(PDO::FETCH_ASSOC);
    return $usrImgs;
}

function getImgOwner($imgId)
{
    $db = db_connection();
    $sql = "SELECT `usr_id` FROM `usr_images`
            WHERE `img_id` = '". $imgId ."'
            LIMIT 1;";
    $result = $db->query($sql);
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    $usrId = $fetch[0]["usr_id"];
    return $usrId;
}

function getFeedImgs($limit, $offset)
{
    $db = db_connection();
    $feedImgs = [];
    $sql = "SELECT * FROM `usr_images`
            WHERE `published` = 'y'
            LIMIT ". $limit ."
            OFFSET ". $offset .";";
    $result = $db->query($sql);
    if (!$result) {
        return $feedImgs;
    }
    $feedImgs = $result->fetchAll(PDO::FETCH_ASSOC);
    return $feedImgs;
}

function getGeneralData($toSelect) {
    $db = db_connection();
    $sql = "SELECT ". $toSelect ." FROM `general`;";
    $result = $db->query($sql);
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return ($fetch);
}

function updateGeneral($column, $newValue)
{
    $db = db_connection();
    $sql = "UPDATE `general`
            SET ". $column ." = ". $newValue .";";
    if (!$affected = $db->exec($sql)) {
        return false;
    }
    return true;
}

function dbCount($table, $targetName, $value)
{
    $db = db_connection();
    $sql = "SELECT COUNT(*) AS `total` FROM `". $table ."`
            WHERE `". $targetName . "` = '". $value ."';";
    $result = $db->query($sql);
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch[0]["total"];
}

function newCommentToDb($commentId, $comment, $imgId, $usrId)
{
    $db = db_connection();
    $stmt = $db->prepare("INSERT INTO `comments` 
                (`comment_id`, `usr_id`, `img_id`, `text`, `date`)
                VALUES (?, ?, ?, ?, NOW());");
    $params = array($commentId, $usrId, $imgId, $comment);
    try {
        $stmt->execute($params);
    } catch (Exception $e) {
        $error = $e->getMessage();
    } finally {
        if ($stmt !== null) {
            $stmt->closeCursor();
        }
    }
}