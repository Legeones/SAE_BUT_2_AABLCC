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

    function creation_input($dbh): void
    {
        $donnees = takeDPI($dbh);
        $colonnes = takeColumnPatient($dbh);
        $name = 0;
        $cpt =0;
        $cp =0;
        $id = 1;
        foreach ($donnees as $row){
            $strrow = "".$row;
            if($strrow!="" && $cpt%2==0){
                echo "<label style='padding-left: 7px; text-effect: engrave'> $colonnes[$cp]</label>";
                echo "<br>";
                echo "<input id='$id' name='$name' value='$strrow' size='50px' width='50px' style='color: purple; border-radius: 50px; border-color: mediumpurple; background-color: peachpuff;
                                        text-align: justify-all; padding: 7px'> ";
                echo "<br><br>";
                $cpt+=1;
                $cp +=1;

            }
            else{ $cpt+=1;}
        }


        function ajout_scenario($db): void
        {
            $idscenario = search_indscenario($db);
            $copy = takeDPI($db);
            $date = function ($db){$d = $db->prepare("select current_date"); $d->execute();};
            //insertion des données dans la table scenario
            $insertion = $db->prepare("insert into scenario (idscenario, date, dpi_etu) VALUES (?,?,?)");
            $insertion->bindparam(1, $idscenario);
            $insertion->bindparam(2, $date);
            $insertion->bindparam(3, $copy);

            $insertion->execute();

        }

        function search_indscenario($db)
        {
            $src = $db->prepare("select max(idscenario)
            from scenario");
            return $src[0]+1;
        }

    }



}


?>
