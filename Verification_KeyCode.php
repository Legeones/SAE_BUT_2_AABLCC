<?php
function Key_Validation()
{
    session_start();
    
    if ( $_POST['Key'] == $_SESSION['Code'] )
    { header('Location: MailCode_Formulaire.php?after=0'); }
    else
    { header('Location: MailCode_Formulaire.php?after=1'); }
}

Key_Validation();

?>