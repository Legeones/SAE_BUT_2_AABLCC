<?php


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["textArea"])){
        $t= 'Vous devez saisir des données dans la zone de texte';
    }else{
        $t = $_POST["textArea"];
    }

    echo 'vous avez entré les données suivantes :' . $t;
}

if (isset($_POST['selectDPI']) && $_POST['selectDPI'] != 'defaut') {

    echo "Vous avez choisi <b>" . $_POST['selectDPI'] . "</b>";

}


?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['selectDPI'])){
        if (!empty($id)) {
            $dpi = $id;
            echo "voici le dpi" . $dpi;
        }
    }
    if (isset($_POST['valideSimu'])){
        $motC = $_POST['textArea'];

    }

}
?>
