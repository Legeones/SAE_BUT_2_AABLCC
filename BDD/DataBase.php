<?php
//Connexion à la base de données//
    function DataBase_Creator_Unit()
    {
        $db_username = 'theo';
        $db_password = 'theo';
        $db_name = 'postgres';
        $db_host = 'localhost';
        
        return new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
    }
    
    function Hasher($val,$hashed)
    {
        $options = [ 'cost' => $val, ];
        return password_hash($hashed,PASSWORD_BCRYPT, $options);
    }

    function Database_Add_User()
    {
        $password_hashed = Hasher(12,$_SESSION['PASSWORD']);
        
        try {
            $dbh = DataBase_Creator_Unit();
            $stmt = $dbh->prepare("select count(*) from utilisateur where email= ?");
            $stmt->bindParam(1, $_SESSION['EMAIL']);
            $stmt->execute();
            $stmt3 = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
            $stmt3->bindParam(1, $_SESSION['IDENTIFIANT']);
            $stmt3->execute();
            $result = $stmt->fetchColumn(0);
            $result2 = $stmt3->fetchColumn(0);
            
            if($result==1){
                header('Location: ../Inscription/Inscription_formulaire.php?erreur=7');
            }
            
            elseif($result2==1){
                header('Location: ../Inscription/Inscription_formulaire.php?erreur=7');
            }
            
            try {
                $dbh = DataBase_Creator_Unit();
                $stmt2 = $dbh->prepare("INSERT INTO utilisateur values (?,?,?,?)");
                $stmt2->bindParam(1, $_SESSION["IDENTIFIANT"]);
                $stmt2->bindParam(2, $password_hashed);
                $stmt2->bindParam(3, $_SESSION['EMAIL']);
                $stmt2->bindParam(4, $_SESSION['ROLE']);
                
                $stmt2->execute();
                    //Gestion des erreurs//
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
            //Gestion des erreurs//
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function Database_Check_User_Exist($username,$password)
    {
        session_start();
        
        try {
            $dbh = DataBase_Creator_Unit();
            $stmt = $dbh->prepare("SELECT mdp FROM utilisateur where login = ? ");
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $stmt2 = $dbh->prepare("SELECT role FROM utilisateur where login = ? ");
            $stmt2->bindParam(1, $username);
            $stmt2->execute();
            $result = $stmt->fetchColumn(0);
            $result2 = $stmt2->fetchColumn(0);
            
            echo $result;
            if($res=password_verify($password, $result)){
                $res2=5;
            } else {
                $res2=0;
            }
            if($res2==5 and $result2=='prof'){
                $_SESSION['username'] = $username;
                header('Location: ../DPIpatient/principale.php');
            }
            elseif ($res2==5 and $result2=='etu'){
                $_SESSION['username'] = $username;
                header('Location: ../DPIpatient/principal-etu.php');
            }
            else{
                header('Location: ../Connexion/login.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function Database_User_New_Pass_Check($ID,$email)
    {
        try {
            $dbh = DataBase_Creator_Unit();
            $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
            $stmt->bindParam(1, $ID);
            $stmt->execute();
            $result = $stmt->fetchColumn(0);
            
            if($result==1)
            {
                header('Location: ../MDP/change_mdp.php');    
            }
            else{
                header('Location: ../MDP/MDPoublier.php?erreur=1');
            }
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function Database_User_New_Pass_Modify($ID,$password)
    {
        $res2 = Hasher(12,$password);
        
        try {
            $dbh = DataBase_Creator_Unit();
            $stmt = $dbh->prepare("UPDATE utilisateur SET mdp=? WHERE login=?");
            $stmt->bindParam(1, $res2);
            $stmt->bindParam(2, $ID);
            
            $stmt->execute();
            header('Location: ../Connexion/login.php');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function Patient_Parcour($p,$rm){
        $o = 1;
        if(isset($_SESSION['patient1']) && $_SESSION['patient1']!=null){
            $pat = 'patient'.$o;
            for($i=0;$i<$_SESSION['incrPat']+24;$i++){
                if (isset($_SESSION[$pat])!=null){
                    $_SESSION[$pat]=null;
                }
                $o+=1;
                $pat='patient'.$o;
            }
        }

        $dbh = DataBase_Creator_Unit();
        if($rm!='aucun'){
            $stmt = $dbh->prepare("SELECT IPP, nom FROM patient WHERE nom like ? LIMIT ? OFFSET ?");
            $stmt->bindParam(1,$rm);
            $lim = $_SESSION['incrPat']+25;
            $stmt->bindParam(2,$lim);
            $stmt->bindParam(3,$_SESSION['incrPat']);
            $stmt->execute();
        }
        if ($p=='Date hospitalisation' && $rm=='aucun') {
            $stmt = $dbh->prepare("SELECT patient.ipp,nom FROM patient JOIN admission ON admission.idadmission = patient.iep ORDER BY admission LIMIT ? OFFSET ?");
            $lim = $_SESSION['incrPat']+25;
            $stmt->bindParam(1,$lim);
            $stmt->bindParam(2,$_SESSION['incrPat']);
            $stmt->execute();
        } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
            $stmt = $dbh->prepare("SELECT IPP,nom FROM patient ORDER BY nom LIMIT ? OFFSET ?");
            $lim = $_SESSION['incrPat']+25;
            $stmt->bindParam(1,$lim);
            $stmt->bindParam(2,$_SESSION['incrPat']);
            $stmt->execute();
        } elseif($rm=='aucun') {
            $stmt = $dbh->prepare("SELECT IPP,nom FROM patient LIMIT ? OFFSET ?");
            $lim = $_SESSION['incrPat']+25;
            $stmt->bindParam(1,$lim);
            $stmt->bindParam(2,$_SESSION['incrPat']);
            $stmt->execute();
        }
        $i = 1;
        foreach ($stmt as $p){
            if($i<$_SESSION['incrPat']){
                $i = $i+1;
            } else {
                $_SESSION['np'] = "patient".$i;
                $_SESSION[$_SESSION['np']] = $p;
                $i = $i+1;
            }
        }
        header('Location: ../DPIpatient/principale.php');
    }

/**
 * @param $nomPatient
 * @param $nomCateg
 * @return void
 */
function Data_Patient_Querry($nomPatient, $nomCateg){
        $pdo = DataBase_Creator_Unit();
        if ($nomCateg == "macrocible"){
            $stmt = $pdo->prepare("SELECT * FROM patient LEFT JOIN personneconfiance p on patient.idpcon = p.idpcon LEFT JOIN personnecontacte p2 on patient.idptel = p2.idptel LEFT JOIN admission a on patient.ipp = a.ipp LEFT JOIN patientmedecin p3 on patient.ipp = p3.ipp WHERE patient.nom = ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];

        } elseif ($nomCateg == "observations"){
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        } elseif ($nomCateg == "prescription"){
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        } elseif ($nomCateg == "diagramme"){
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        } elseif ($nomCateg == "biologie"){
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        } elseif ($nomCateg == "imagerie"){
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        } elseif ($nomCateg == "courriers"){
            $stmt = $pdo->prepare("SELECT * FROM patient WHERE ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        }
        foreach ($stmt as $item){
            $_SESSION['infosPatient']+=$item;
        }
        header("Location: ../DPIpatient/DPIpatientMacrocible.php");

    }
?>
