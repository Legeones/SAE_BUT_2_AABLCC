<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['selectDPI'])){
        $_SESSION['val'] = $_POST['valueipp'];
        if (empty($_SESSION['val'])) {
            echo "<p style='color: red'>il n'y a pas de données </p>";
            // Un message d'erreur apparaît quand il n'y a pas de données
        }
    }

    if(!empty($_POST['type_categorie'])){
        $_SESSION['type_categorie'] = $_POST['type_categorie'];
    }else{
        echo "<p style='color: red'>le type de catégorie est vide</p>";
        // Un message d'erreur apparaît quand le type de la catégorie est vide
    }

    if(!empty($_POST['nbevent'])){
        $_SESSION['nbevent'] = $_POST['nbevent'];
    }else{
        echo "<p style='color: red'> les données des évènements ne sont pas remplies</p>";
        // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
    }

    if(!empty($_POST['nbevent_alea'])){
        $_SESSION['nbevent_alea'] = $_POST['nbevent_alea'];
    }else{
        echo "<p style='color: red'> les données des évènements ne sont pas remplies</p>";
        // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
    }

    if(!empty($_POST['debut'])){
        $_SESSION['debut'] = $_POST['debut'];
    }else{
        echo "<p style='color: red'>le debut d'évènement est vide </p>";
        // Un message d'erreur apparaît quand le début de l'évènement est vide
    }

    if(!empty($_POST['fin'])){
        $_SESSION['fin'] = $_POST['fin'];
    }else{
        echo "<p style='color: red'>la fin d'évènement est vide </p>";
        // Un message d'erreur apparaît quand la fin de l'événement est vide
    }

    if($_POST['debut'] >= $_POST['fin']){
        echo "<p style='color: #cc0000'> Le respect des dates n'est pas fait !</p>";
    }

    if(isset($_POST['value'])){
        $_SESSION['values'] = $_POST['value'];
    }
}
?>