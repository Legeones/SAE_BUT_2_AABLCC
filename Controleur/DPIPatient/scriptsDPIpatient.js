function alterner(id){
    /*
    La fonction "alterner(id)" permet de changer la couleur de fond de l'élément HTML qui a l'ID spécifié en paramètre.
    Elle vérifie la couleur de fond actuelle de l'élément, et si elle est "cornflowerblue", elle la change en "white",
    sinon elle la change en "cornflowerblue".
     */
    let doc = document.getElementById(id);
    console.log(doc.style.backgroundColor)
    if(doc.style.backgroundColor==="rgb(165, 244, 244)"){
        doc.style.backgroundColor = "white";
    } else if (doc.style.backgroundColor==="white"){
        doc.style.backgroundColor = "rgb(165, 244, 244)";
    } else if (doc.style.backgroundColor==="gray"){
        doc.style.backgroundColor = "gray";
    }
}

function show_data_patient_div(id){
    /*
    La fonction "show_data_patient_div(id)" permet d'afficher ou masquer un élément HTML en fonction de son ID en paramètre,
    en utilisant la propriété CSS "display" pour mettre en place l'affichage ou masquage.
     */
    console.log(id);
    let doc = document.getElementById(id);
    if (doc.style.display == "block") {
        doc.style.display = "none";
    } else {
        doc.style.display = "block";
    }

}
function suivant(div1, div2){
    /*
    La fonction "suivant(div1, div2)" permet de changer les éléments affichés en "cachant"
    un élément (div1) et en "affichant" un autre élément (div2) en utilisant la propriété CSS "display"
     */
    var defaut = document.getElementById(div1);
    var autre = document.getElementById(div2)
    defaut.style.display = 'none';
    autre.style.display = 'block';
}

function suivantCourt (div1, div2, div3){
    /*
    Page Modification des données patient l'utilise.
    La fonction suivantCourt() prend en entrée trois paramètres : div1, div2 et div3. Ces paramètres sont des
    identifiants pour les éléments HTML sur lesquels la fonction va agir. La fonction fait appel à la propriété
    "style.display" pour changer les éléments en question. Si l'élément div1 n'est pas visible (avec "style.display == 'none'"),
    les éléments div2 et div3 sont vérifiés, s'ils sont visibles, ils deviennent invisibles et enfin l'élément div1 est rendu visible.
     */
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
    /*
    La fonction changeCouleurBouton() est utilisée pour changer la couleur d'arrière-plan de trois boutons,
    elle prend en entrée b1, b2 et b3 qui sont des identifiants pour les boutons. La fonction vérifie si la couleur
    d'arrière-plan du bouton b1 est égale à #66CCCC et si c'est le cas, il change la couleur de b1 en rouge,
    et les boutons b2 et b3 prennent la couleur #66CCCC
     */
    var bouton = document.getElementById(b1);
    var bouton1 = document.getElementById(b2);
    var bouton2 = document.getElementById(b3);
    if (bouton.style.background = '#66CCCC') {
        bouton.style.background = 'whitesmoke';
        bouton1.style.background = '#66CCCC';
        bouton2.style.background = '#66CCCC';
    }
}

function openForm(id) {
    document.getElementById(id).style.display = "block";
}
/*
Les fonctions openForm() et closeForm() servent à montrer ou cacher un élément HTML en utilisant la propriété
"style.display". La fonction openForm() prend un identifiant en entrée et utilise la propriété pour rendre
l'élément visible en utilisant "block", la fonction closeForm() rend l'élément invisible en utilisant "none".
 */
function closeForm(id) {
    document.getElementById(id).style.display = "none";
}

