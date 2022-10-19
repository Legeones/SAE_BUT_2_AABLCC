<?php

require('../BDD/DataBase.php');

function Key_Validation()
{
    session_start();
    
    if ( $_POST['Key'] == $_SESSION['Code'] )
    {
        header('Location: ../Verif_Test/MailCode_Formulaire.php?after=0');
        DataBase_Add_User();
    }
    else
    {
        header('Location: ../Verif_Test/MailCode_Formulaire.php?after=1');
    }
}

Key_Validation();

?>
