<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['selectDPI'])){
        $_SESSION['val'] = $_POST['valueipp'];
        if (empty($_SESSION['val'])) {
            echo "il n'y a pas de données";
        }
    }

    if(!empty($_POST['debut'] && $_POST['fin'])){
        $_SESSION['debut'] = $_POST['debut'];
        $_SESSION['fin'] = $_POST['fin'];
        if ($_SESSION['fin'] < $_SESSION['debut']){
            echo "<p style='color: red'> Erreur : dates non conformes ! </p>";
        }
    }
    else {echo "<p style='color: red'>Vous avez oublié de remplir des champs ! </p>";}


    if(!empty($_POST['nbevent'])){
        $_SESSION['nb_event'] = $_POST['nbevent'];

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

    }



}


?>
