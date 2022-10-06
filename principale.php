<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="PrincipaleStyle.css" media="screen" type="text/css" />
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
            <button onclick="location.href='principale.php'">PATIENT</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <form action="principale.php" method="get">
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
        $db_username = 'theo';
        $db_password = 'theo';
        $db_name = 'postgres';
        $db_host = 'localhost';

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

                $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;','theo','theo');
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
        <div class="grid-container">
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient1'])) print $_SESSION['patient1']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient2'])) print $_SESSION['patient2']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient3'])) print $_SESSION['patient3']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient4'])) print $_SESSION['patient4']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient5'])) print $_SESSION['patient5']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient6'])) print $_SESSION['patient6']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient7'])) print $_SESSION['patient7']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient8'])) print $_SESSION['patient8']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient9'])) print $_SESSION['patient9']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient10'])) print $_SESSION['patient10']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient11'])) print $_SESSION['patient11']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient12'])) print $_SESSION['patient12']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient13'])) print $_SESSION['patient13']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient14'])) print $_SESSION['patient14']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient15'])) print $_SESSION['patient15']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient16'])) print $_SESSION['patient16']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient17'])) print $_SESSION['patient17']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient18'])) print $_SESSION['patient18']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient19'])) print $_SESSION['patient19']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient20'])) print $_SESSION['patient20']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient21'])) print $_SESSION['patient21']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient22'])) print $_SESSION['patient22']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient23'])) print $_SESSION['patient23']; ?></div>
            <div onclick="location.href='ajoutPatient.html';" style="cursor:pointer;">
                <?php if(isset($_SESSION['patient24'])) print $_SESSION['patient24']; ?></div>
        </div>

    </div>

</div>

</body>
</html>














