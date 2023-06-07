function recuperation(){
    let ul = document.querySelector("#tab_datas");
    let scenario = document.querySelector("#nom_scenario");
    let etudiant = document.querySelector("#nom_etudiant");
    ul.innerHTML = "";
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
        if(this.readyState === 4 && this.status === 200){
            console.log(this.responseText);
            var response = JSON.parse(this.responseText);
        }
        for(let r in response){
            let li = document.createElement("li");
            li.textContent = r + " : " + response[r];
            ul.appendChild(li);
        }
    };
    xhr.open("GET", "../../Controleur/Scenario/control_log_patient.php?nom_scenario="+scenario.value+"&nom_etudiant="+etudiant.value, true);
    xhr.send();
}

let button = document.querySelector("#rechercher_s");
button.addEventListener("click", function(event){
    event.preventDefault();
    recuperation();
})