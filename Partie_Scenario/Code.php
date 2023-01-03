<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['selectDPI'])){
        $_SESSION['val'] = $_POST['valueipp'];
        if (empty($_SESSION['val'])) {
            echo "il n'y a pas de données";
        }
    }

    function takeDPI($dbh)
    {
        $dpi = $dbh->prepare("select *
                            from patient where IPP=?");
        $id = $_SESSION['val'];
        $dpi->bindparam(1,$id);
        $dpi->execute();
        $donnees = array();
        foreach($dpi as $row){
            $donnees += $row;
        }
        return($donnees);
    }

    function takeColumnPatient($dbh): array
    {
        $info = $dbh->prepare("select  column_name
                        from  information_schema.columns where table_name= ? order by ordinal_position");
        $val = 'patient';
        $info->bindparam(1,$val);
        $info->execute();
        $donnees = [];
        foreach ($info as $row){
            $donnees[] = $row[0];
        }
        return $donnees;
    }

    function modif_dpi($dbh): string
    {
        $donnees = takeDPI($dbh);
        $requete = $dbh->prepare("update patient
                        set ipp = ?, iep= ?, nom= ?, prenom= ?, ddn= ?, taille_cm= ?, poids_kg= ?, adresse= ?, cp= ?, ville= ?, telpersonnel= ?,
                        telprofessionnel= ?, allergies= ?, antecedents= ?, obstericaux= ?, domedicaux= ?, dochirurgicaux= ?, idpcon= ?, idptel= ?,
                        mesuredeprotection= ?, asistantsocial= ?, mdv= ?, synentre= ?, traidomi= ?, dophypsy= ?, mobilite= ?, alimentation= ?,
                        hygiene= ?, toilette= ?, habit= ?, continence = ?
                            where ipp = ?");

        for($i=1; $i<= sizeof($donnees); $i++){
            $requete->bindparams($i, $_SESSION[$i]);
        }
        $requete->execute();
        return "fait";

    }

}


?>
