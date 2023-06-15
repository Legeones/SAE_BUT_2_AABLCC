/*
    Ce code JavaScript définit une fonction apparait() qui rend visible ou invisible
    un élément HTML en fonction de son état actuel. L'élément cible est défini en utilisant
    l'argument d'entrée id pour récupérer un élément HTML en utilisant document.getElementById(id).
    Il vérifie également si le paramètre d'entrée est égal à "null" pour éviter les erreurs.

    Il y a également une variable onApparaitElement qui est utilisée pour détecter si l'élément
    est actuellement visible ou non.

    Il y a un écouteur d'événement qui est ajouté à document qui est appelé à chaque fois que
    la souris bouge, cela permet de mettre à jour la position de l'élément cible lorsqu'il est
    visible en utilisant les propriétés event.x et event.y pour récupérer les coordonnées de la souris.
    Il y a des conditions pour vérifier si l'élément est sorti de la zone visible et le décaler à sa place.
*/
// Déclaration de la variable mousePositionElement qui est initialisée avec l'élément ayant l'ID '1'
let mousePositionElement = document.getElementById('1');
// Variable utilisée pour déterminer si l'élément est actuellement visible ou non
let onApparaitElement = false;

// Définition de la fonction apparait qui rend visible ou invisible un élément HTML en fonction de son état actuel
function apparait(id) {
    // Vérifie si l'ID n'est pas "null" pour éviter les erreurs
    if (id != "null") {
        // Récupère l'élément HTML correspondant à l'ID passé en argument
        mousePositionElement = document.getElementById(id);
    }
    // Récupère l'élément HTML correspondant à l'ID passé en argument
    let elt = document.getElementById(id);
    // Vérifie si l'élément est actuellement visible ou non
    if (elt.style.visibility == "visible") {
        // Rend l'élément invisible
        elt.style.visibility = "hidden";
        onApparaitElement = false;
    } else {
        // Rend l'élément visible
        elt.style.visibility = "visible";
        onApparaitElement = true;
    }
}

// Ajout d'un écouteur d'événement sur le mouvement de la souris pour mettre à jour la position de l'élément cible lorsqu'il est visible
document.addEventListener("mousemove", (event) => {
    if (onApparaitElement) {
        // Calcule les coordonnées x et y de l'élément en fonction de la position de la souris
        let x = event.x - document.getElementById('gauche').offsetWidth;
        let y = event.y - document.getElementById('haut').offsetHeight - document.getElementById('formulaire_recherche').offsetHeight;
        // Met à jour la position de l'élément en utilisant les coordonnées calculées
        mousePositionElement.style.left = `${x}px`;
        mousePositionElement.style.top = `${y}px`;
    }
});

// Fonction pour effectuer une requête AJAX vers un serveur PHP pour récupérer des données sur les patients
function patientParcour(select, admi, recherche, action, callback) {
    var xhr = new XMLHttpRequest();
    let selectURL = "";
    let admiURL = "";
    let rechercheURL = "";
    let pos = "&action=" + action;
    if (select !== "") selectURL = "select=" + select;
    if (admi !== "") admiURL = "&admi=" + admi;
    if (recherche !== "") rechercheURL = "&recherche_barre=" + recherche;

    // Gestionnaire d'événement pour la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La requête a été traitée avec succès
            var responseHTML = xhr.responseText;
            callback(null, JSON.parse(responseHTML));
        } else {
            var error = new Error('Erreur de requête. Statut : ' + xhr.status);
            callback(error, null);
        }
    };

    // Ouverture de la requête GET vers la page PHP avec les paramètres appropriés
    xhr.open("GET", "../../Controleur/DPIPatient/actionPrincipale.php?" + selectURL + admiURL + rechercheURL + pos, true);

    // Envoi de la requête
    xhr.send();
}

// Fonction pour effectuer une requête AJAX vers un serveur PHP pour récupérer des données sur un patient spécifique
function patientParcour_exam(name_senario, callback) {
    var xhr = new XMLHttpRequest();
    let name_senarioURL = "";

    if (name_senario !== "") name_senarioURL = "DPI=" + name_senario;

    // Gestionnaire d'événement pour la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La requête a été traitée avec succès
            var responseHTML = xhr.responseText;
            callback(null, JSON.parse(responseHTML));
        } else {
            var error = new Error('Erreur de requête. Statut : ' + xhr.status);
            callback(error, null);
        }
    };

    // Ouverture de la requête GET vers la page PHP avec les paramètres appropriés
    xhr.open("GET", "../../Controleur/DPIPatient/actionPrincipale.php?" + name_senarioURL, true);

    // Envoi de la requête
    xhr.send();
}

// Fonction pour effectuer une recherche dans la base de données des patients en mode examen
function recherche_DPI_senario_mode_exam() {
    let select = document.querySelector("#DPI_Patient").value;
    patientParcour_exam(select, function(error, response) {
        if (error) {
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
}

// Fonction pour effectuer une recherche dans la base de données des patients en mode accueil
function recherche_DPI_accueil() {
    patientParcour("", "", "", "", function(error, response) {
        if (error) {
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
}

// Fonction pour mettre à jour la session en mode examen
function session_mode_exam(value) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../../Controleur/DPIPatient/actionPrincipale.php?valeur_session=' + value, true);
    xhr.send();
}

// Fonction pour rendre visible le bouton bt1 et masquer bt2
function visible_bouton(bt1, bt2) {
    bt1.style.display = "block";
    bt2.style.display = "none";
}

// Écouteur d'événement pour le bouton bt1_exam qui active le mode examen
document.getElementById('bt1_exam').addEventListener("click", function(event) {
    event.preventDefault();
    session_mode_exam(2);
    const div_none = document.getElementById('select');
    const body = document.body;
    div_none.style.display = "block";
    body.style.background = "linear-gradient(20deg,white,#fcb55a)";
    const div_ON = document.getElementById('select2');
    if (div_ON !== null) {
        div_ON.style.display = 'block';
    }
    recherche_DPI_senario_mode_exam();
    recherche_DPI_senario_mode_exam();
    recherche_DPI_senario_mode_exam();
    document.getElementById('bt_affiche_dpi').style.display = 'block';
    visible_bouton(document.getElementById('bt1_examOn'), this);
});

// Écouteur d'événement pour le bouton bt1_examOn qui active le mode accueil
document.getElementById('bt1_examOn').addEventListener("click", function(event) {
    event.preventDefault();
    session_mode_exam(1);
    const div_none = document.getElementById('select');
    const body = document.body;
    div_none.style.display = "none";
    this.style.borderColor = "#f7a947";
    this.style.backgroundColor = "#feba64";
    body.style.background = "linear-gradient(20deg,white,#a5f4f4)";
    const div_ON = document.getElementById('select2');
    if (div_ON !== null) {
        div_ON.style.display = 'none';
    }
    recherche_DPI_accueil();
    recherche_DPI_accueil();
    recherche_DPI_accueil();
    document.getElementById('bt_affiche_dpi').style.display = 'none';
    visible_bouton(document.getElementById('bt1_exam'), this);
});

var select = "";
var admi = "";
var recherche = "";

// Fonction appelée lors du chargement de la page
window.onload = () => {
    session_mode_exam(1);
    recherche_DPI_accueil();
};

// Écouteur d'événement pour le bouton rechercher qui effectue la recherche dans la base de données des patients
document.querySelector("#rechercher").addEventListener('click', (event) => {
    event.preventDefault();
    select = document.querySelector("#ordre").value;
    admi = document.querySelector("#admission").value;
    recherche = document.querySelector("#recherche_barre").value;
    patientParcour(select, admi, recherche, "", function(error, response) {
        if (error) {
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
});

// Écouteur d'événement pour le bouton next qui affiche la page suivante de résultats
document.getElementById('next').addEventListener('click', (event) => {
    event.preventDefault();
    console.log("next");
    patientParcour(select, admi, recherche, "next", function(error, response) {
        if (error) {
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
});

// Écouteur d'événement pour le bouton back qui affiche la page précédente de résultats
document.getElementById('back').addEventListener('click', (event) => {
    event.preventDefault();
    patientParcour(select, admi, recherche, "back", function(error, response) {
        if (error) {
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
});

// Écouteur d'événement pour le bouton bt_affiche_dpi qui affiche les DPI des patients en mode examen
document.getElementById("bt_affiche_dpi").addEventListener('click', (event) => {
    event.preventDefault();
    recherche_DPI_senario_mode_exam();
});

// Fonction pour nettoyer le tableau des patients affiché à l'écran
function cleanTableau() {
    let form = document.querySelector("#form");
    form.innerHTML = "";
}

// Fonction pour afficher les informations des patients dans le tableau
function tableauPatients(reponse) {
    cleanTableau();
    let form = document.querySelector("#form");
    for (let i = 1; i < 25; i++) {
        let patientActuel = reponse["patient" + i];
        let id = "" + i;
        let input = document.createElement("input");
        input.classList.add("input_form_patients");
        input.type = "submit";
        input.style.cursor = "pointer";
        if (patientActuel) {
            input.addEventListener('mouseover', () => {
                apparait(id);
            });
            input.addEventListener('mouseout', () => {
                apparait(id);
            });
        }

        if (patientActuel) {
            input.style.backgroundColor = "#a7f1e2";
            input.style.borderColor = "#a7f1e2";
            input.addEventListener('click', () => {
                let DPI_Patient = document.querySelector("#DPI_Patient");
                DPI_Patient.value = patientActuel.DPI;
                recherche_DPI_senario_mode_exam();
            });
        } else {
            input.style.backgroundColor = "#c0c0c0";
            input.style.borderColor = "#c0c0c0";
            input.style.cursor = "not-allowed";
        }

        form.appendChild(input);
    }
}