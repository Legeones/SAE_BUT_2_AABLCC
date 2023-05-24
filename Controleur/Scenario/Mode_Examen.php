<?php
require ("../../Model/BDD/DataBase_Scenario.php");



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['bt1_exam'])){
    if ($_POST['bt1_exam']== 0){
        $_SESSION['exam'] = 1;
    }else{
        $_SESSION['exam'] = 0;
    }
    echo '<script>history.back();</script>';
}
function liste_nom_senario(){
    return lst_deroulante_nom_Scenario();
}


if (isset($_POST['bt_affiche_dpi'])){
    $_SESSION['name_senario'] = $_POST['DPI'];
    echo '<script>history.back();</script>';
}



