function recuperation(){ //fonction AJAX qui, via une méthode "POST", récupère les données concernant un scénario
                        // déroulé par un utilisateur et permet d'afficher ces données dans un "ul"
    let ul = document.querySelector("#tab_datas");
    let scenario = document.querySelector("#nom_scenario");
    let etudiant = document.querySelector("#nom_etudiant");
    ul.innerHTML = "";
    const xhr = new XMLHttpRequest(); //initialisation de la requête HTTP
    xhr.onreadystatechange = function (){
        if(this.readyState === 4 && this.status === 200){ //statut de la réponse
            var response = JSON.parse(this.responseText); //transformation de la réponse en objet JS
        }
        for(let r in response){ //parcours des données de la réponse
            let li = document.createElement("li"); //création d'un élément "li"
            li.textContent = r + " : " + response[r];
            ul.appendChild(li); //ajout du fils "li" au parent "ul"
        }
    };
    let params = "nom_scenario="+scenario.value+"&nom_etudiant="+etudiant.value; //initialisation de la requête
    xhr.open("POST", "../../Controleur/Scenario/control_log_patient.php", true); //initialisation de la requête
    xhr.send(params); //envoi de la requête HTTP
}

let button = document.querySelector("#rechercher_s"); //initialisation de la fonctionnalité du bouton
button.addEventListener("click", function(event){ //ajout de l'évènement
    event.preventDefault(); //suppression de la fonction principale du bouton
    recuperation(); // exécution de la fonction
});
