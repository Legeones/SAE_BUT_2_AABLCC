<?php
session_start();
require "RecupInfoBDD_AjouterDPI.php";

for ($i = 2 ; $i<=31 ; $i++) {
    if ($i == 17 || $i == 18){
        $i +=1;
    }
    $name = 'val'.$i;
    $_SESSION[$name] = StockDPI()[$i];
}

header('Location: MDFDPI.php');
?>
