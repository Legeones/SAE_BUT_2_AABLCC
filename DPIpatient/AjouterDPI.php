<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="AjouterDPI_CSS.css" media="screen" type="text/css" />
</head>
<body>
<header>
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
    <div class="droite">
        <form action="principale.php" method="get">
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

        <div class="bas">
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

            <div class="lesForms" align="center">
                <button id="boutondebut" style="background-color:red" onclick="suivantCourt('formDPI','formContact','formConfiance'), changeCouleurBouton('boutondebut','boutondebut1','boutondebut2')">Ajouter_DPI</button>
                <button id="boutondebut1" style="background-color:#66CCCC" onclick="suivantCourt('formContact','formDPI','formConfiance'), changeCouleurBouton('boutondebut1','boutondebut','boutondebut2')">Contact</button>
                <button id="boutondebut2" style="background-color:#66CCCC" onclick="suivantCourt('formConfiance','formDPI','formContact'), changeCouleurBouton('boutondebut2','boutondebut','boutondebut1')"">Confiance</button>

            </div>
            <form id="form" action="AjouterDPIPHP.php" method="post">
                <div id="formDPI" style="display: block">
                    <div class="Titreform">
                        <h1><u>Ajouter un DPI</u></h1>
                    </div>
                    <div class="Groupe">

                        <?php if (isset($_SESSION['MessErreur']) && !empty($_SESSION['MessErreur'])):?>
                            <div class="groupeErreur">
                                <p>
                                    <?= $_SESSION['MessErreur'] ?>
                                    <?php $_SESSION['MessErreur'] = null ?>
                                </p>
                            </div>
                        <?php endif ?>
                        <p class="infoForm"><li><u>Certaines informations ne sont pas nécessaires et se défisse par "*".</u></li></p>
                        <label> Nom : </label>
                        <input type="text" placeholder="Saisir un nom" name="nom" value="<?= $_SESSION['nomp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['nomf'])):?>
                            <p>
                                <?= $_SESSION['nomf'] ?>
                                <?php $_SESSION['nomf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Prénom :</label>
                        <input type="text" placeholder="Saisir un prenom" name="prenom" value="<?= $_SESSION['prenomp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['prenomf'])):?>
                            <p>
                                <?= $_SESSION['prenomf'] ?>
                                <?php $_SESSION['prenomf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Date de Naissance : </label>
                        <input type="date" placeholder="Saisir une date de naissance"  name="DDN" value="<?= $_SESSION['DDNp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['DDNf'])):?>
                            <p>
                                <?= $_SESSION['DDNf'] ?>
                                <?php $_SESSION['DDNf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Taille en CM :</label>
                        <input type="number"placeholder="Saisir une taille en cm" name="taille" value="<?= $_SESSION['taillep'] ?? '' ?>" />
                        <?php if (isset($_SESSION['taillef'])):?>
                            <p>
                                <?= $_SESSION['taillef'] ?>
                                <?php $_SESSION['taillef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Poids en KG : </label>
                        <input type="number" step="0.1" placeholder="Saisir un poids en kg" name="poids" value="<?= $_SESSION['poidsp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['poidsf'])):?>
                            <p>
                                <?= $_SESSION['poidsf'] ?>
                                <?php $_SESSION['poidsf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Adresse :</label>
                        <input type="text" placeholder="Saisir une adresse" name="adresse" value="<?= $_SESSION['adressep'] ?? '' ?>" />
                        <?php if (isset($_SESSION['adressef'])):?>
                            <p>
                                <?= $_SESSION['adressef'] ?>
                                <?php $_SESSION['adressef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Code Postal : </label>
                        <input type="number" placeholder="Saisir un code postal"  name="CP" value="<?= $_SESSION['CPp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['CPf'])):?>
                            <p>
                                <?= $_SESSION['CPf'] ?>
                                <?php $_SESSION['CPf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Ville :</label>
                        <input type="text"placeholder="Saisir une Ville" name="ville" value="<?= $_SESSION['villep'] ?? '' ?>" />
                        <?php if (isset($_SESSION['villef'])):?>
                            <p>
                                <?= $_SESSION['villef'] ?>
                                <?php $_SESSION['villef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Téléphone Personnel :</label>
                        <input type="text" placeholder="Saisir un numéro de téléphone personnel" name="telperso" value="<?= $_SESSION['telpersop'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['telpersof'])):?>
                            <p>
                                <?= $_SESSION['telpersof'] ?>
                                <?php $_SESSION['telpersof'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> *Téléphone Profesionnel : </label>
                        <input type="text" placeholder="Saisir un numéro de téléphone professionnel"  name="telpro"/>
                    </div>

                    <div class="Groupe">
                        <label> *Allergies:</label>
                        <input type="text"placeholder="Saisir les allergies" name="allergies" />
                    </div>

                    <div class="Groupe">
                        <label> *Antecedents : </label>
                        <input type="text" placeholder="Saisir les antécédents" name="antecedents" />
                    </div>

                    <div class="Groupe">
                        <label> *Obstericaux :</label>
                        <input type="text" placeholder="Saisir les Obsetricaux" name="Obs" />
                    </div>

                    <div class="Groupe">
                        <label> *Document Médicaux : </label>
                        <input type="text" placeholder="Saisir le document médical"  name="docMed"/>
                    </div>

                    <div class="Groupe">
                        <label> *Document Chirurgicaux :</label>
                        <input type="text"placeholder="Saisir le document chirurgical" name="docChir" />
                    </div>

                    <div class="Groupe1">
                        <label> Mesure de protection :</label>
                        <div class="Boolean">
                            <input type="radio" name="MP" value="1">
                            <label>OUI</label>
                            <input type="radio" name="MP" value="0">
                            <label>NON</label>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> A-il une Assistante Sociale :</label>
                        <div class="Boolean">
                            <input type="radio" name="AC" value="1">
                            <label>OUI</label>
                            <input type="radio" name="AC" value="0">
                            <label>NON</label>
                        </div>
                    </div>

                    <div class="Groupe">
                        <label> *Mode de Vie :</label>
                        <input type="text"placeholder="Saisir le mode de vie" name="MDV" />
                    </div>

                    <div class="Groupe">
                        <label> Synthèse d'Entrée :</label>
                        <input type="text"placeholder="Saisir la sythèse d'entrée" name="synEntree" />
                    </div>

                    <div class="Groupe">
                        <label> *Traitement à domicile :</label>
                        <input type="text"placeholder="Saisir le traitement à domicile" name="tradomi" />
                    </div>

                    <div class="Groupe">
                        <label> *Donnée physique et/ou psychologique :</label>
                        <input type="text"placeholder="Saisir les Données physiques et/ou psychologiques " name="doPhyPsy" />
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à se Déplacer :</label>
                        <div class="Boolean">
                            <input type="radio" name="CD" value="1">
                            <label>Autonome</label>
                            <input type="radio" name="CD" value="2">
                            <label>Aide Partielle</label>
                            <input type="radio" name="CD" value="3">
                            <label>Aide Totale</label>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à Manger :</label>
                        <div class="Boolean">
                            <input type="radio" name="CM" value="1">
                            <label>Autonome</label>
                            <input type="radio" name="CM" value="2">
                            <label>Aide Partielle</label>
                            <input type="radio" name="CM" value="3">
                            <label>Aide Totale</label>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à se Laver:</label>
                        <div class="Boolean">
                            <input type="radio" name="CL" value="1">
                            <label>Autonome</label>
                            <input type="radio" name="CL" value="2">
                            <label>Aide Partielle</label>
                            <input type="radio" name="CL" value="3">
                            <label>Aide Totale</label>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à aller au Toilette :</label>
                        <div class="Boolean">
                            <input type="radio" name="CT" value="1">
                            <label>Autonome</label>
                            <input type="radio" name="CT" value="2">
                            <label>Aide Partielle</label>
                            <input type="radio" name="CT" value="3">
                            <label>Aide Totale</label>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à s'habiller :</label>
                        <div class="Boolean">
                            <input type="radio" name="Mob" value="1">
                            <label>Autonome</label>
                            <input type="radio" name="Mob" value="2">
                            <label>Aide Partielle</label>
                            <input type="radio" name="Mob" value="3">
                            <label>Aide Totale</label>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité de continance :</label>
                        <div class="Boolean">
                            <input type="radio" name="conti" value="1">
                            <label>Autonome</label>
                            <input type="radio" name="conti" value="2">
                            <label>Aide Partielle</label>
                            <input type="radio" name="conti" value="3">
                            <label>Aide Totale</label>
                        </div>
                    </div>

                    <div class="Validation" align="center">
                        <button type="button" id="boutonSuivant2" onclick="suivant('formDPI','formContact'), changeCouleurBouton('boutondebut1','boutondebut','boutondebut2')">Suivant !</button>
                    </div>
                </div>
                <!*****************************************************************************************************>
                <div id="formContact" style="display:none">
                    <div class="Titreform">
                        <h1><u>Ajouter une Personne à Contacter </u></h1>
                    </div>
                    <div class="Groupe">
                        <label> Nom :</label>
                        <input type="text" placeholder="Saisir le nom" name="nomCT" value="<?= $_SESSION['nomCTp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['nomCTf'])):?>
                            <p>
                                <?= $_SESSION['nomCTf'] ?>
                                <?php $_SESSION['nomCTf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Prénom : </label>
                        <input type="text" placeholder="Saisir le prénom"  name="prenomCT" value="<?= $_SESSION['prenomCTp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['prenomCTf'])):?>
                            <p>
                                <?= $_SESSION['prenomCTf'] ?>
                                <?php $_SESSION['prenomCTf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Téléphone :</label>
                        <input type="text"placeholder="Saisir le numéro de téléphone" name="telCT" value="<?= $_SESSION['telCTp'] ?? '' ?>" />
                        <?php if (isset($_SESSION['telCTf'])):?>
                            <p>
                                <?= $_SESSION['telCTf'] ?>
                                <?php $_SESSION['telCTf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Lien Parenté :</label>
                        <input type="text"placeholder="Saisir le lien parenté" name="lienCT" value="<?= $_SESSION['lienCTp'] ?? '' ?>" />
                        <?php if (isset($_SESSION['lienCTf'])):?>
                            <p>
                                <?= $_SESSION['lienCTf'] ?>
                                <?php $_SESSION['lienCTf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Validation" align="center">
                        <button type="button" id="precedent2" onclick="suivant('formContact','formDPI'), changeCouleurBouton('boutondebut','boutondebut1','boutondebut2')">Précedent</button>
                        <button type="button" id="suivant2" onclick="suivant('formContact','formConfiance'), changeCouleurBouton('boutondebut2','boutondebut','boutondebut1')">Suivant</button>
                    </div>
                </div>

                <!*****************************************************************************************************>
                <div id="formConfiance" style="display:none">
                    <div class="Titreform">
                        <h1><u>Ajouter une Personne de Confiance</u></h1>
                    </div>
                    <div class="Groupe">
                        <label> Nom :</label>
                        <input type="text" placeholder="Saisir le nom" name="nomC" value="<?= $_SESSION['nomCp'] ?? '' ?>" />
                        <?php if (isset($_SESSION['nomCf'])):?>
                            <p>
                                <?= $_SESSION['nomCf'] ?>
                                <?php $_SESSION['nomCf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Prénom : </label>
                        <input type="text" placeholder="Saisir le prénom"  name="prenomC" value="<?= $_SESSION['prenomCp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['prenomCf'])):?>
                            <p>
                                <?= $_SESSION['prenomCf'] ?>
                                <?php $_SESSION['prenomCf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Téléphone :</label>
                        <input type="text"placeholder="Saisir le numéro de téléphone" name="telC" value="<?= $_SESSION['telCp'] ?? '' ?>" />
                        <?php if (isset($_SESSION['telCf'])):?>
                            <p>
                                <?= $_SESSION['telCf'] ?>
                                <?php $_SESSION['telCf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Lien Parenté :</label>
                        <input type="text"placeholder="Saisir le lien parenté" name="lienC" value="<?= $_SESSION['lienCp'] ?? '' ?>" />
                        <?php if (isset($_SESSION['lienCf'])):?>
                            <p>
                                <?= $_SESSION['lienCf'] ?>
                                <?php $_SESSION['lienCf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Validation" align="center">
                        <button type="button" id="precedent3" onclick="suivant('formConfiance','formContact'), changeCouleurBouton('boutondebut1','boutondebut2','boutondebut')">Précedent</button>
                        <input type="submit" value="Valider">
                    </div>
                </div>
            </form>
            <?php $_SESSION['nomp'] = null ;
            $_SESSION['prenomp']= null;
            $_SESSION['DDNp'] = null;
            $_SESSION['taillep'] = null;
            $_SESSION['poidsp'] =null;
            $_SESSION['adressep'] =null;
            $_SESSION['CPp'] =null;
            $_SESSION['villep'] =null;
            $_SESSION['telpersop'] =null;

            $_SESSION['nomCTp'] =null;
            $_SESSION['prenomCTp'] =null;
            $_SESSION['telCTp'] =null;
            $_SESSION['lienCTp'] =null;

            $_SESSION['nomCp'] =null;
            $_SESSION['prenomCp'] =null;
            $_SESSION['telCp'] =null;
            $_SESSION['lienCp'] =null;
            ?>
        </div>
    </div>
</div>
</body>
</html>