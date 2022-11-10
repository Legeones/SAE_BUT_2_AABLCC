<?php

require('../BDD/DataBase_User.php');

function Key_Validation()
{
    session_start();
    
    if ( $_SESSION['Key_Index'] == 1 )
    {
        if ( $_POST['Key'] == $_SESSION['Code'] )
        {
            DataBase_Add_User();
            header('Location: ../Connexion/login.php?after=1');
        }
        else
        {
            header('Location: ../Verif_Test/MailCode_Formulaire.php?after=2');
        }
    }
    else if ( $_SESSION['Key_Index'] == 2 )
    {
        if ( $_POST['Key'] == $_SESSION['Code'] )
        {
            DataBase_User_New_Pass_Check();
        }
        else
        {
            header('Location: ../Verif_Test/MailCode_Formulaire.php?after=2');
        }
    }
}

Key_Validation();
