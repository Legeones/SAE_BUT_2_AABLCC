function alterner(id){
    /*
    The function alterner permit to the element with ID to change of background color
     */
    let doc = document.getElementById(id);
    if(doc.style.backgroundColor=="cornflowerblue"){
        doc.style.backgroundColor = "white";
    } else{
        doc.style.backgroundColor = "cornflowerblue";
    }
}

function show_data_patient_div(id){
    console.log(id);
    let doc = document.getElementById(id);
    if (doc.style.display == "block") {
        doc.style.display = "none";
    } else {
        doc.style.display = "block";
    }

}
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
    if (bouton.style.background = '#66CCCC') {
        bouton.style.background = 'red';
        bouton1.style.background = '#66CCCC';
        bouton2.style.background = '#66CCCC';
    }
}

