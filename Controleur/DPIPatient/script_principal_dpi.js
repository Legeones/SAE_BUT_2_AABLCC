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

let mousePositionElement = document.getElementById('1');
let onApparaitElement = false;
function apparait(id) {
    if (id != "null"){
        mousePositionElement = document.getElementById(id);
    }
    let elt = document.getElementById(id);
    if (elt.style.visibility == "visible") {
        elt.style.visibility = "hidden";
        onApparaitElement = false;
    } else {
        elt.style.visibility = "visible";
        onApparaitElement = true;
    }
}
// Ajoute un écouteur d'événement qui sera appelé chaque fois que la souris bouge
let x = 0;
let y = 0;
let poscote = 0;
let posbas = 0;
document.addEventListener("mousemove", (event) => {
// Met à jour l'élément HTML avec la position de la souris
if (onApparaitElement){
    //console.log(event.x+(mousePositionElement.offsetTop+document.getElementById('haut').offsetHeight));
    if (poscote > document.body.offsetWidth){
        x = event.x-document.getElementById('gauche').offsetWidth-mousePositionElement.offsetWidth-30;
        poscote = event.x+mousePositionElement.offsetWidth+40;
    } else {
        x = event.x-document.getElementById('gauche').offsetWidth;
        poscote = event.x+mousePositionElement.offsetWidth+40;
    }
    if (posbas > document.body.offsetHeight){
        y = event.y-document.getElementById('haut').offsetHeight-mousePositionElement.offsetHeight-document.getElementById('formulaire_recherche').offsetHeight;
        posbas = event.y+mousePositionElement.offsetHeight+40;
        console.log(document.body.offsetHeight+":"+(event.y+mousePositionElement.offsetHeight));
    } else {
        y = event.y-document.getElementById('haut').offsetHeight-document.getElementById('formulaire_recherche').offsetHeight;
        posbas = event.y+mousePositionElement.offsetHeight+40;
    }
        mousePositionElement.style.left = `${x}px`;
        mousePositionElement.style.top = `${y}px`;
    }

});

function patientParcour(select, admi, recherche, callback){
    var xhr = new XMLHttpRequest();
    let selectURL = "";
    let admiURL = "";
    let rechercheURL = "";
    if (select!=="") selectURL = "select="+select;
    if (admi!=="") admiURL = "&admi="+admi;
    if (recherche!=="") rechercheURL = "&recherche_barre="+recherche;

    // Gestionnaire d'événement pour la réponse
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
    // La requête a été traitée avec succès
    var responseHTML = xhr.responseText;
    callback(null, JSON.parse(responseHTML))
} else {
    var error = new Error('Erreur de requête. Statut : ' + xhr.status);
    callback(error, null);
}
};
    // Ouverture de la requête GET vers la page PHP
    xhr.open("GET", "../../Controleur/DPIPatient/actionPrincipale.php?"+selectURL+admiURL+rechercheURL, true);

    // Envoi de la requête
    xhr.send();
}


function patientParcour_exam(name_senario, callback){
    var xhr = new XMLHttpRequest();

    if (name_senario!=="") name_senarioURL = "DPI="+name_senario;

    // Gestionnaire d'événement pour la réponse
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
    // La requête a été traitée avec succès
            var responseHTML = xhr.responseText;
            callback(null, JSON.parse(responseHTML))
        } else {
            var error = new Error('Erreur de requête. Statut : ' + xhr.status);
            callback(error, null);
        }
    };
    // Ouverture de la requête GET vers la page PHP
    xhr.open("GET", "../../Controleur/DPIPatient/actionPrincipale.php?"+name_senarioURL, true);

    // Envoi de la requête
    xhr.send();
}

function recherche_DPI_senario_mode_exam(){
    let select = document.querySelector("#DPI_Patient").value;
    patientParcour_exam(select, function (error, response) {
        if (error){
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
}
function recherche_DPI_accueil() {
    patientParcour("", "", "", function (error, response) {
        if (error) {
            console.log(response);
        } else {
            console.log(response);
            tableauPatients(response);
        }
    });
}

function session_mode_exam(value){
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../../Controleur/DPIPatient/actionPrincipale.php?valeur_session=' + value, true)
    xhr.send();
}

function visible_bouton(bt1,bt2){
    bt1.style.display = "block"
    bt2.style.display = "none"
}


document.getElementById('bt1_exam').addEventListener("click", function (event){
    event.preventDefault();
    session_mode_exam(2);
    const div_none = document.getElementById('select');
    const body = document.body;
    div_none.style.display = "block";
    body.style.background = "linear-gradient(20deg,white,#fcb55a)";
    const div_ON = document.getElementById('select2');
    if (div_ON !== null){
        div_ON.style.display = 'block'
    }
    recherche_DPI_senario_mode_exam();
    recherche_DPI_senario_mode_exam();
    recherche_DPI_senario_mode_exam();
    document.getElementById('bt_affiche_dpi').style.display = 'block'
    visible_bouton(document.getElementById('bt1_examOn'),this)
})


document.getElementById('bt1_examOn').addEventListener("click", function (event) {
    event.preventDefault();
    session_mode_exam(1);
    const div_none = document.getElementById('select');
    const body = document.body;
    div_none.style.display = "none";
    this.style.borderColor = "#f7a947";
    this.style.backgroundColor = "#feba64";
    body.style.background = "linear-gradient(20deg,white,#a5f4f4)";
    const div_ON = document.getElementById('select2');
    if (div_ON !== null){
        div_ON.style.display = 'none'
    }
    recherche_DPI_accueil();
    recherche_DPI_accueil();
    recherche_DPI_accueil();
    document.getElementById('bt_affiche_dpi').style.display = 'none'
    visible_bouton(document.getElementById('bt1_exam'),this)
})




window.onload = () => {
        session_mode_exam(1);
        recherche_DPI_accueil();
};

        document.querySelector("#rechercher").addEventListener('click', (event) => {
        event.preventDefault();
        let select = document.querySelector("#ordre").value;
        let admi = document.querySelector("#admission").value;
        let recherche = document.querySelector("#recherche_barre").value;
        patientParcour(select, admi, recherche, function (error, response) {
        if (error){
        console.log(response);
    } else {
        console.log(response);
        tableauPatients(response);
    }
    });
    })

    document.getElementById("bt_affiche_dpi").addEventListener('click', (event) => {
        event.preventDefault();
        recherche_DPI_senario_mode_exam();
    })

        function cleanTableau(){
        let form = document.querySelector("#form");
        form.innerHTML = "";
    }

        function tableauPatients(reponse){
        cleanTableau();
        let form = document.querySelector("#form");
        for (let i = 1; i < 25; i++){
        let patientActuel = reponse["patient"+i];
        let id = ""+i;
        let input = document.createElement("input");
        input.classList.add("input_form_patients");
        input.type = "submit";
        input.style.cursor = "pointer";
        if (patientActuel){
        input.addEventListener('mouseover', () => {
        apparait(id);
    });
        input.addEventListener('mouseout', () => {
        apparait(id);
    });
    }

        if (patientActuel){
        input.name = patientActuel[0];
        input.value = patientActuel["nom"]+"_"+patientActuel["prenom"];
    } else {
        input.value = "";
    }
        form.appendChild(input);
        if (patientActuel) {
        let div = document.createElement("div");
        div.classList.add("hide");
        div.id = id;
        if (patientActuel) {
        div.innerHTML = "IPP : " + patientActuel["ipp"] + "<br>";
        if (patientActuel["iep"]) div.innerHTML += "IEP : " + patientActuel["iep"] + "<br>";
        if (patientActuel["datedebut"]) div.innerHTML += "Date d'hospitalisation : " + patientActuel["datedebut"];
    }
        form.appendChild(div);
    }
    }
}


