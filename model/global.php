<?php
function ft_isset($value)
{
    //check if value is not null and if value exists != regular isset just check if value is declared
    if (!isset($value) || !$value)
        return false;
    return (true);
}