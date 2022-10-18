<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../PrincipaleStyle.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<div class="global">
    <!--<script type="text/javascript">
        $(document).ready(function(){
            $("#showit").click(function(){
                $("#myform").css("display","block");
            });
        });
    </script>-->
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='principale.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <form action="DPI.php" method="get">
            <input name="recherche_barre"></input>
            <select name="select">
                <option name="aucun">Aucun</option>
                <option name="dh">Date hospitalisation</option>
                <option name="oa">Ordre alphabetique</option>
            </select>
            <button type="submit">Rechercher</button>
            <button name="next">Next</button>
            <button name="back">Back</button>
        </form>

        </p>
        <?php

        if(!isset($_SESSION['incrPat'])){
            $_SESSION['incrPat']=0;
        }

        try {
            function change($p,$rm){
                $o = 1;
                if($_SESSION['patient1']!=null){
                    $pat = 'patient'.$o;
                    for($i=0;$i<$_SESSION['incrPat']+24;$i++){
                        if (isset($_SESSION[$pat])!=null){
                            $_SESSION[$pat]=null;
                        }
                        $o+=1;
                        $pat='patient'.$o;
                    }
                }
                $db_username = '.';
                $db_password = '.';
                $db_name     = '.';
                $db_host     = '.';

                $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
                if($rm!='aucun'){
                    $stmt = $dbh->prepare("SELECT IPP, nom FROM patient WHERE nom like ? LIMIT ?");
                    $stmt->bindParam(1,$rm);
                    $lim = $_SESSION['incrPat']+25;
                    $stmt->bindParam(2,$lim);
                    $stmt->execute();
                }
                if ($p=='Date hospitalisation' && $rm=='aucun') {
                    $stmt = $dbh->prepare("SELECT IPP,nom FROM patient ORDER BY admission LIMIT ?");
                    $lim = $_SESSION['incrPat']+25;
                    $stmt->bindParam(1,$lim);
                    $stmt->execute();
                } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
                    $stmt = $dbh->prepare("SELECT IPP,nom FROM patient ORDER BY nom LIMIT ?");
                    $lim = $_SESSION['incrPat']+25;
                    $stmt->bindParam(1,$lim);
                    $stmt->execute();
                } elseif($rm=='aucun') {
                    $stmt = $dbh->prepare("SELECT IPP,nom FROM patient LIMIT ?");
                    $lim = $_SESSION['incrPat']+25;
                    $stmt->bindParam(1,$lim);
                    $stmt->execute();
                }
                return $stmt;
            }
            if(isset($_GET['next'])){
                $_SESSION['incrPat']+=24;

            }
            if(isset($_GET['back'])){
                if($_SESSION['incrPat']>0){
                    $_SESSION['incrPat']-=24;
                }

            }

            if(isset($_GET['select'])){
                $_SESSION['paramRecherche']=$_GET['select'];
            } else {
                $_SESSION['paramRecherche']='aucun';
            }

            if(isset($_GET['recherche_barre']) && $_GET['recherche_barre']!=''){
                $_SESSION['rechercheManu']=$_GET['recherche_barre'];
            } else {
                $_SESSION['rechercheManu']='aucun';
            }

            $stmt = change($_SESSION['paramRecherche'],$_SESSION['rechercheManu']);
            $i = 1;

            foreach ($stmt as $p){
                if($i<$_SESSION['incrPat']){
                    $i = $i+1;
                } else {
                    $_SESSION['np'] = "patient".$i;
                    $_SESSION[$_SESSION['np']] = $p[1];
                    $i = $i+1;
                }

            }
        } catch (PDOException $e){
            print "Erreur:".$e->getMessage();
        }

        ?>
        <script>
            function apparait(id){
                var elt = document.getElementById(id);
                if(elt.style.visibility=="visible"){
                    elt.style.visibility = "hidden";
                } else {
                    elt.style.visibility = "visible";
                }
            }
        </script>
        <div class="grid-container">
            <?php
            for($i=1;$i<25;$i++){
                $_SESSION['patientActuel']='patient'.$i;
                $id = ''.$i;
                $_SESSION['idActuel'] = $id;
                ?> <div onclick="location.href='principale.php';" style="cursor:pointer;" onmouseover="apparait(<?php echo $_SESSION['idActuel'] ?>)" onmouseout="apparait(<?php echo $_SESSION['idActuel'] ?>)">
                    <?php if(isset($_SESSION[$_SESSION['patientActuel']])) print $_SESSION[$_SESSION['patientActuel']]; ?>
                    <div class="<?php if($_SESSION['idActuel']%6==0) echo 'hideLeft'; else echo 'hide'; ?>" id=<?php echo $_SESSION['idActuel'] ?>>WOW</div>
                </div>
            <?php }
            ?>

        </div>

    </div>

</body>
</html>
