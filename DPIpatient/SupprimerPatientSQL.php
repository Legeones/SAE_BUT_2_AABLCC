<?php
session_start();



function VerifEmptyContent($text)
{
    if ($text == "")
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Lowercase($pw1)
{
    $pw1seg = str_split($pw1);
    $lowercasecheck = false;

    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[a-z]/', $pw1seg[$i]) == 1)  { $lowercasecheck = true;   /*echo "LowerCase Found <br>";*/ } }

    if ( $lowercasecheck == false )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Uppercase($pw1)
{
    $pw1seg = str_split($pw1);
    $uppercasecheck = false;

    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[A-Z]/', $pw1seg[$i]) == 1)  { $uppercasecheck = true;   /*echo "UpperCase Found <br>";*/ } }

    if ( $uppercasecheck == false )
    { return 0; }
    else
    { return 1; }
}


$VerifEmptyContent=VerifEmptyContent($_SESSION["IPP_SUPP"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_SESSION["IPP_SUPP"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_SESSION["IPP_SUPP"]);


if($VerifEmptyContent==0){
    header('Location: SupprimerPatient.php?erreur=1');
}

elseif ($VerifPassword_Uppercase==1 or $VerifPassword_Lowercase==1){
    header('Location: SupprimerPatient.php?erreur=3');
}


else {
    $db_username = 'iutinfo86';
    $db_password = 'pmD5t+DV';
    $db_name = 'iutinfo86';
    $db_host = 'iutinfo-sgbd.uphf.fr';

    try {
        $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
        $stmt2 = $dbh->prepare("SELECT count(*) FROM patient WHERE IPP=?");
        $stmt2->bindParam(1, $_SESSION["IPP_SUPP"]);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        if($res==0){
            header('Location: SupprimerPatient.php?erreur=2');
        }
        else{
            $stmt = $dbh->prepare("DELETE FROM patient WHERE IPP=?");
            $stmt->bindParam(1, $_SESSION["IPP_SUPP"]);
            $stmt->execute();
            header('Location: principale.php');
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}