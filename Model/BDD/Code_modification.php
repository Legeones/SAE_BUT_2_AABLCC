<?php
function list_deroulante_dpi($dbh){ //affiche la liste des scénarios enregistrés
    $recuppatient = $dbh->prepare('select idScenario,nom from Scenario');
    $recuppatient->execute();
    while ($row = $recuppatient->fetch(PDO::FETCH_ASSOC)){
        $id=$row['idScenario'];
        $nom=$row['nom'];
        echo "<option value='$id'>$nom</option>";

    }
}

function recuperation_id_scenario($dbh){ //recupération d'un id scenario via son nom
    $req = $dbh->prepare("select idscenario from scenario where nom = ?");
    $req->bindparam(1,$_POST["nom_scenario"]);
    $req->execute();
    $result = $req->Fetch();
    echo $result;
    return $result;
}


function modification_to_add_dpi($dbh){ //permet d'ajouter des dpi à un scénario nommé
    $dpi_restant = $_SESSION["dpi_ipp"];
    $id_scenario = recuperation_id_scenario($dbh);
    foreach ($dpi_restant as $dpi){
        $insert = $dbh->prepare("insert into dpiScenario (ipp, idS) values (?,?)");
        $insert->bindparam(1, $dpi);
        $insert->bindparam(2, $id_scenario);
        $insert->execute();
    }
}
?>