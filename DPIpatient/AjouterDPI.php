<?php
session_start();
?>
<html>
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
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
            <button onclick="location.href='DPI.php'">PATIENTS</button> // ohé l'arborescence ici?
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <!-- zone de connexion -->
    <div class="droite">
        <div class="bas">
            <script>

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
                        <p class="infoForm"><li><u>Certaines informations ne sont pas necéssaires et se définissent par "*".</u></li></p>
                        <label> Nom : </label>
                        <!-- Demande à l'utilisateur de saisir le nom de la personne -->
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
                        <!-- Demande à l'utilisateur de saisir le prénom de la personne -->
                        <input type="text" placeholder="Saisir un prenom" name="prenom" value="<?= $_SESSION['prenomp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['prenomf'])):?>
                            <p>
                                <?= $_SESSION['prenomf'] ?>
                                <?php $_SESSION['prenomf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir la date de naissance de la personne -->
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
                        <!-- Demande à l'utilisateur de saisir la taille de la personne  -->
                        <label> Taille en CM :</label>
                        <input type="number"placeholder="Saisir une taille en cm" name="taille" value="<?= $_SESSION['taillep'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['taillef'])):?>
                            <p>
                                <?= $_SESSION['taillef'] ?>
                                <?php $_SESSION['taillef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le poids de la personne -->
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
                        <!-- Demande à l'utilisateur de saisir l'adresse de la personne -->
                        <label> Adresse :</label>
                        <input type="text" placeholder="Saisir une adresse" name="adresse" value="<?= $_SESSION['adressep'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['adressef'])):?>
                            <p>
                                <?= $_SESSION['adressef'] ?>
                                <?php $_SESSION['adressef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <label> Code Postal : </label>
                        <!-- Demande à l'utilisateur de saisir le code postal de la personne -->
                        <input type="number" placeholder="Saisir un code postal"  name="CP" value="<?= $_SESSION['CPp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['CPf'])):?>
                            <p>
                                <?= $_SESSION['CPf'] ?>
                                <?php $_SESSION['CPf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir la ville de la personne -->
                        <label> Ville :</label>
                        <input type="text"placeholder="Saisir une Ville" name="ville" value="<?= $_SESSION['villep'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['villef'])):?>
                            <p>
                                <?= $_SESSION['villef'] ?>
                                <?php $_SESSION['villef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le numéro de téléphone personnel de la personne -->
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
                        <!-- Demande à l'utilisateur de saisir le numéro de téléphone professionnel de la personne -->
                        <label> *Téléphone Profesionnel : </label>
                        <input type="text" placeholder="Saisir un numéro de téléphone professionnel"  name="telpro"  value="<?= $_SESSION['telprop'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir les allergies de la personne -->
                        <label> *Allergies:</label>
                        <input type="text"placeholder="Saisir les allergies" name="allergies" value="<?= $_SESSION['allergiesp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir les antécédents de la personne -->
                        <label> *Antecedents : </label>
                        <input type="text" placeholder="Saisir les antécédents" name="antecedents" value="<?= $_SESSION['antecedentsp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir les obsetricaux de la personne -->
                        <label> *Obstericaux :</label>
                        <input type="text" placeholder="Saisir les Obsetricaux" name="Obs" value="<?= $_SESSION['Obsp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir les documents médicaux de la personne -->
                        <label> *Documents Médicaux : </label>
                        <input type="text" placeholder="Saisir le document médical"  name="docMed" value="<?= $_SESSION['docMedp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir les documents chirurgicaux de la personne -->
                        <label> *Documents Chirurgicaux :</label>
                        <input type="text" placeholder="Saisir le document chirurgical" name="docChir" value="<?= $_SESSION['docChirp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe1">
                        <label> Mesure de protection :</label>
                        <div class="Boolean">
                            <input type="radio" name="MP" id="MP" value="true" <?php if(isset($_SESSION['MPp'])&&$_SESSION['MPp'] == "true"):?> checked <?php endif ?>>
                            <label for="MP">OUI</label>
                            <input type="radio" name="MP" value="false" <?php if(isset($_SESSION['MPp'])&&$_SESSION['MPp'] == "false"):?> checked <?php endif ?>>
                            <label>NON</label>
                            <?php if (isset($_SESSION['MPf'])):?>
                                <p>
                                    <?= $_SESSION['MPf'] ?>
                                    <?php $_SESSION['MPf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> A-il une Assistante Sociale :</label>
                        <div class="Boolean">
                            <input type="radio" name="AC" value="true" <?php if(isset($_SESSION['APp'])&&$_SESSION['ACp'] == "true"):?> checked <?php endif ?>>
                            <label>OUI</label>
                            <input type="radio" name="AC" value="false" <?php if(isset($_SESSION['APp'])&&$_SESSION['ACp'] == "false"):?> checked <?php endif ?>>
                            <label>NON</label>
                            <?php if (isset($_SESSION['ACf'])):?>
                                <p>
                                    <?= $_SESSION['ACf'] ?>
                                    <?php $_SESSION['ACf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le mode de vie de la personne -->
                        <label> *Mode de Vie :</label>
                        <input type="text"placeholder="Saisir le mode de vie" name="MDV" value="<?= $_SESSION['MDVp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir la synthèse d'entrée de la personne -->
                        <label> Synthèse d'Entrée :</label>
                        <input type="text"placeholder="Saisir la sythèse d'entrée" name="synEntree" value="<?= $_SESSION['synEntreep'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['synEntreef'])):?>
                            <p>
                                <?= $_SESSION['synEntreef'] ?>
                                <?php $_SESSION['synEntreef'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le traitement à domicile de la personne -->
                        <label> *Traitement à domicile :</label>
                        <input type="text"placeholder="Saisir le traitement à domicile" name="tradomi" value="<?= $_SESSION['tradomip'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir les données physique et/ou psychologique de la personne -->
                        <label> *Donnée physique et/ou psychologique :</label>
                        <input type="text"placeholder="Saisir les Données physiques et/ou psychologiques " name="doPhyPsy" value="<?= $_SESSION['doPhyPsyp'] ?? '' ?>"/>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à se Déplacer :</label>
                        <div class="Boolean">
                            <input type="radio" name="CD" value="1" <?php if(isset($_SESSION['CDp'])&&$_SESSION['CDp'] == 1):?> checked <?php endif ?>>
                            <label>Autonome</label>
                            <input type="radio" name="CD" value="2" <?php if(isset($_SESSION['CDp'])&&$_SESSION['CDp'] == 2):?> checked <?php endif ?>>
                            <label>Aide Partielle</label>
                            <input type="radio" name="CD" value="3" <?php if(isset($_SESSION['CDp'])&&$_SESSION['CDp'] == 3):?> checked <?php endif ?>>
                            <label>Aide Totale</label>
                            <?php if (isset($_SESSION['CDf'])):?>
                                <p>
                                    <?= $_SESSION['CDf'] ?>
                                    <?php $_SESSION['CDf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à Manger :</label>
                        <div class="Boolean">
                            <input type="radio" name="CM" value="1" <?php if(isset($_SESSION['CMp'])&&$_SESSION['CMp'] == 1):?> checked <?php endif ?>>
                            <label>Autonome</label>
                            <input type="radio" name="CM" value="2" <?php if(isset($_SESSION['CMp'])&&$_SESSION['CMp'] == 2):?> checked <?php endif ?>>
                            <label>Aide Partielle</label>
                            <input type="radio" name="CM" value="3" <?php if(isset($_SESSION['CMp'])&&$_SESSION['CMp'] == 3):?> checked <?php endif ?>>
                            <label>Aide Totale</label>
                            <?php if (isset($_SESSION['CMf'])):?>
                                <p>
                                    <?= $_SESSION['CMf'] ?>
                                    <?php $_SESSION['CMf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à se Laver:</label>
                        <div class="Boolean">
                            <input type="radio" name="CL" value="1" <?php if(isset($_SESSION['CLp'])&&$_SESSION['CLp'] == 1):?> checked <?php endif ?>>
                            <label>Autonome</label>
                            <input type="radio" name="CL" value="2" <?php if(isset($_SESSION['CLp'])&&$_SESSION['CLp'] == 2):?> checked <?php endif ?>>
                            <label>Aide Partielle</label>
                            <input type="radio" name="CL" value="3" <?php if(isset($_SESSION['CLp'])&&$_SESSION['CLp'] == 3):?> checked <?php endif ?>>
                            <label>Aide Totale</label>
                            <?php if (isset($_SESSION['CLf'])):?>
                                <p>
                                    <?= $_SESSION['CLf'] ?>
                                    <?php $_SESSION['CLf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à aller au Toilette :</label>
                        <div class="Boolean">
                            <input type="radio" name="CT" value="1" <?php if(isset($_SESSION['CTp'])&&$_SESSION['CTp'] == 1):?> checked <?php endif ?>>
                            <label>Autonome</label>
                            <input type="radio" name="CT" value="2" <?php if(isset($_SESSION['CTp'])&&$_SESSION['CTp'] == 2):?> checked <?php endif ?>>
                            <label>Aide Partielle</label>
                            <input type="radio" name="CT" value="3" <?php if(isset($_SESSION['CTp'])&&$_SESSION['CTp'] == 3):?> checked <?php endif ?>>
                            <label>Aide Totale</label>
                            <?php if (isset($_SESSION['CTf'])):?>
                                <p>
                                    <?= $_SESSION['CTf'] ?>
                                    <?php $_SESSION['CTf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité à s'habiller :</label>
                        <div class="Boolean">
                            <input type="radio" name="CH" value="1" <?php if(isset($_SESSION['CHp'])&&$_SESSION['CHp'] == 1):?> checked <?php endif ?>>
                            <label>Autonome</label>
                            <input type="radio" name="CH" value="2" <?php if(isset($_SESSION['CHp'])&&$_SESSION['CHp'] == 2):?> checked <?php endif ?>>
                            <label>Aide Partielle</label>
                            <input type="radio" name="CH" value="3" <?php if(isset($_SESSION['CHp'])&&$_SESSION['CHp'] == 3):?> checked <?php endif ?>>
                            <label>Aide Totale</label>
                            <?php if (isset($_SESSION['CHf'])):?>
                                <p>
                                    <?= $_SESSION['CHf'] ?>
                                    <?php $_SESSION['CHf'] = null ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="Groupe1">
                        <label> Capacité de continance :</label>
                        <div class="Boolean">
                            <input type="radio" name="conti" value="1" <?php if(isset($_SESSION['contip'])&&$_SESSION['contip'] == 1):?> checked <?php endif ?>>
                            <label>Autonome</label>
                            <input type="radio" name="conti" value="2" <?php if(isset($_SESSION['contip'])&&$_SESSION['contip'] == 2):?> checked <?php endif ?>>
                            <label>Aide Partielle</label>
                            <input type="radio" name="conti" value="3" <?php if(isset($_SESSION['contip'])&&$_SESSION['contip'] == 3):?> checked <?php endif ?>>
                            <label>Aide Totale</label>
                            <?php if (isset($_SESSION['contif'])):?>
                                <p>
                                    <?= $_SESSION['contif'] ?>
                                    <?php $_SESSION['contif'] = null ?>
                                </p>
                            <?php endif ?>
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
                        <!-- Demande à l'utilisateur de saisir le nom de la personne à contacter -->
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
                        <!-- Demande à l'utilisateur de saisir le prénom de la personne à contacter -->
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
                        <!-- Demande à l'utilisateur de saisir le numéro de téléphone de la personne à contacter -->
                        <label> Téléphone :</label>
                        <input type="text"placeholder="Saisir le numéro de téléphone" name="telCT" value="<?= $_SESSION['telCTp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['telCTf'])):?>
                            <p>
                                <?= $_SESSION['telCTf'] ?>
                                <?php $_SESSION['telCTf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le lien de paranté de la personne à contacter -->
                        <label> Lien Parenté :</label>
                        <input type="text"placeholder="Saisir le lien parenté" name="lienCT" value="<?= $_SESSION['lienCTp'] ?? '' ?>"/>
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
                        <!-- Demande à l'utilisateur de saisir le nom de la personne de confiance -->
                        <label> Nom :</label>
                        <input type="text" placeholder="Saisir le nom" name="nomC" value="<?= $_SESSION['nomCp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['nomCf'])):?>
                            <p>
                                <?= $_SESSION['nomCf'] ?>
                                <?php $_SESSION['nomCf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le prénom de la personne de confiance -->
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
                        <!-- Demande à l'utilisateur de saisir le numéro de téléphone de la personne de confiance -->
                        <label> Téléphone :</label>
                        <input type="text"placeholder="Saisir le numéro de téléphone" name="telC" value="<?= $_SESSION['telCp'] ?? '' ?>"/>
                        <?php if (isset($_SESSION['telCf'])):?>
                            <p>
                                <?= $_SESSION['telCf'] ?>
                                <?php $_SESSION['telCf'] = null ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="Groupe">
                        <!-- Demande à l'utilisateur de saisir le lien de parenté de la personne de confiance -->
                        <label> Lien Parenté :</label>
                        <input type="text"placeholder="Saisir le lien parenté" name="lienC" value="<?= $_SESSION['lienCp'] ?? '' ?>"/>
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
            $_SESSION['telprop'] =null;
            $_SESSION['allergiesp'] =null;
            $_SESSION['antecedentsp'] =null;
            $_SESSION['Obsp'] =null;
            $_SESSION['docMedp'] =null;
            $_SESSION['docChirp'] =null;
            $_SESSION['MPp'] =null;
            $_SESSION['ACp'] =null;
            $_SESSION['MDVp'] =null;
            $_SESSION['synEntreep'] =null;
            $_SESSION['tradomip'] =null;
            $_SESSION['doPhyPsyp'] =null;
            $_SESSION['CDp'] =null;
            $_SESSION['CMp'] =null;
            $_SESSION['CLp'] =null;
            $_SESSION['CTp'] =null;
            $_SESSION['CHp'] =null;
            $_SESSION['contip'] =null;


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
