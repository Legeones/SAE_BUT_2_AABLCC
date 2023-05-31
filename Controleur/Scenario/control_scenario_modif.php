<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['nbevent'])) {
        if ($_POST['nbevent'] < 0) {
            echo "<p style='color: red'> Le nombre d'évènement est incorrecte !</p>";
            // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
        }
    }

    if (!empty($_POST['nbevent_alea'])) {
        if ($_POST['nbevent_alea'] < 0) {
            echo "<p style='color: red'> Le nombre d'évènement aléatoire est incorrecte !</p>";
            // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
        }
    }

    if (!empty($_POST['debut']) && !empty($_POST['fin'])) {
        if ($_POST['debut'] >= $_POST['fin']) {
            echo "<p style='color: #cc0000'> Le respect des dates n'est pas fait !</p>";
        }
    }

    if(isset($_POST["ipp"])){
        $_SESSION["dpi_ipp"] = $_POST["ipp"];
    }

}
?>