<?php

function DataBase_Creator_Unit()
{
    $db_username = 'theo';
    $db_password = 'theo';
    $db_name = 'postgres';
    $db_host = 'localhost';
    
    return new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
}

function Hasher($val,$hashed)
{
    $options = [ 'cost' => $val, ];
    return password_hash($hashed,PASSWORD_BCRYPT, $options);
}

?>