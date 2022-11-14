<?php
session_start();
?>
<html>
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="AjouterDPI_CSS.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <!-- Ajout du logo -->
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<div class="global">
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
    <!-- zone de connexion -->
    <div class="droite">
        <form action="DPI.php" method="get">
            <input name="recherche_barre"/>
            <select name="select">
                <option name="aucun">Aucun</option>
                <option name="dh">Date hospitalisation</option>
                <option name="oa">Ordre alphabetique</option>
            </select>
            <button type="submit">Rechercher</button>
            <button name="next">Next</button>
            <button name="back">Back</button>
        </form>

        <div class="basMDF">
            <script>
                function retirer(text){
                    var titre1 = document.getElementById(text);
                    if(titre1.style.visibility == "hidden"){
                        titre1.style.visibility="visible";
                    } else {
                        titre1.style.visibility="hidden";
                    }
                    console.log("un click à été éffectué");
                };

                function suivant(div1, div2){
                    var defaut = document.getElementById(div1);
                    var autre = document.getElementById(div2)
                    defaut.style.display = 'none';
                    autre.style.display = 'block';
                }

                function suivantCourt (div1, div2, div3){
                    var defaut = document.getElementById(div1);
                    var autre = document.getElementById(div2);
                    var autre1 = document.getElementById(div3);
                    if (defaut.style.display == 'none'){
                        if (autre.style.display == 'block'){
                            autre.style.display = 'none';
                        }
                        else if (autre1.style.display == 'block'){
                            autre1.style.display = 'none';
                        }
                        defaut.style.display = 'block';
                    }
                }
                function changeCouleurBouton(b1,b2,b3) {
                    var bouton = document.getElementById(b1);
                    var bouton1 = document.getElementById(b2);
                    var bouton2 = document.getElementById(b3);
                    if (bouton.style.background = '#66CCCC'){
                        bouton.style.background = 'red';
                        bouton1.style.background = '#66CCCC';
                        bouton2.style.background = '#66CCCC';
                    }

                }

            </script>

            <form id="formMDF" action="" method="post">
                <div id="formDPI" style="display: block">
                    <div class="Titreform" align="center">
                        <h1><u>Ajouter un DPI</u></h1>
                    </div>

                    <div class="Validation" align="center">
                        <input type="submit" value="Valider">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
