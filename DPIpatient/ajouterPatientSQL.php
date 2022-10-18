<?php
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


$VerifEmptyContent1=VerifEmptyContent($_POST["IPP"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["nom"]);
$VerifEmptyContent3=VerifEmptyContent($_POST["date"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_POST["IPP"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_POST["IPP"]);

if($VerifEmptyContent1==0 or $VerifEmptyContent2==0 or $VerifEmptyContent3==0){
    header('Location: ajouterPatient.php?erreur=1');
}

elseif ($VerifPassword_Uppercase==1 or $VerifPassword_Lowercase==1){
    header('Location: ajouterPatient.php?erreur=3');
}

else {
    $db_username = 'iutinfo86';
    $db_password = 'pmD5t+DV';
    $db_name = 'iutinfo86';
    $db_host = 'iutinfo-sgbd.uphf.fr';

    try {
        $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
        $stmt2 = $dbh->prepare("SELECT count(*) FROM patient WHERE IPP=?");
        $stmt2->bindParam(1, $_POST['IPP']);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        if($res==1){
            header('Location: ajouterPatient.php?erreur=2');
        }
        else{
            $stmt = $dbh->prepare("INSERT INTO patient values (?,?,?)");
            $stmt->bindParam(1, $_POST['IPP']);
            $stmt->bindParam(2, $_POST['nom']);
            $stmt->bindParam(3, $_POST['date']);
            $stmt->execute();
            header('Location: principale.php');
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}