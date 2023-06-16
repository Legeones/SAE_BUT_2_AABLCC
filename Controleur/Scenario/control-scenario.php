<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['selectDPI'])){ //vérification que la variable "selectDPI" n'est pas vide
        $_SESSION['val'] = $_POST['valueipp'];
        if (empty($_SESSION['val'])) {
            echo "<p style='color: red'>il n'y a pas de données </p>";
            // Un message d'erreur apparaît quand il n'y a pas de données
        }
    }

    if(!empty($_POST['type_categorie'])){ //vérification que la variable "type_categorie" n'est pas vide
        $_SESSION['type_categorie'] = $_POST['type_categorie'];
    }else{
        echo "<p style='color: red'>le type de catégorie est vide</p>";
        // Un message d'erreur apparaît quand le type de la catégorie est vide
    }

    if(!empty($_POST['nbevent'])){ //vérification que la variable "nbevent" n'est pas vide
        $_SESSION['nbevent'] = $_POST['nbevent'];
    }else{
        echo "<p style='color: red'> les données des évènements ne sont pas remplies</p>";
        // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
    }

    if(!empty($_POST['nbevent_alea'])){ //vérification que la variable "nbevent_alea" n'est pas vide
        $_SESSION['nbevent_alea'] = $_POST['nbevent_alea'];
    }else{
        echo "<p style='color: red'> les données des évènements ne sont pas remplies</p>";
        // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
    }

    if(!empty($_POST['debut'])){ //vérification que la variable "debut" n'est pas vide
        $_SESSION['debut'] = $_POST['debut'];
    }else{
        echo "<p style='color: red'>le debut d'évènement est vide </p>";
        // Un message d'erreur apparaît quand le début de l'évènement est vide
    }

    if(!empty($_POST['fin'])){ //vérification que la variable "fin" n'est pas vide
        $_SESSION['fin'] = $_POST['fin'];
    }else{
        echo "<p style='color: red'>la fin d'évènement est vide </p>";
        // Un message d'erreur apparaît quand la fin de l'événement est vide
    }

    if($_POST['debut'] >= $_POST['fin']){ //vérification que la variable "debut" est inférieur à la variable "fin"
        echo "<p style='color: #cc0000'> Le respect des dates n'est pas fait !</p>";
    }

    if(isset($_POST['value'])){ //vérification que la variable "value" est initialisée
        $_SESSION['values'] = $_POST['value'];
    }
}
?>