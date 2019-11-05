<?php

function dataExists($db_table, $name, $value)
{
    $sql = 'SELECT $name FROM $db_table';
    $result = $db->query($sql);
    var_dump($result);
    exit ;
}