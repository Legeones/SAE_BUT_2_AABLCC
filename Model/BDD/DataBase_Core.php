<?php

function DataBase_Creator_Unit(): PDO
{
    //Zone de connexion à la base de données
    $db_username = 'iutinfo86';
    $db_password = 'pmD5t+DV';
    $db_name     = 'iutinfo86';
    $db_host     = 'iutinfo-sgbd.uphf.fr';
    
    return new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
}

function Hasher($val,$hashed): string
{
    $options = [ 'cost' => $val, ];
    return password_hash($hashed,PASSWORD_BCRYPT, $options);
}

?>