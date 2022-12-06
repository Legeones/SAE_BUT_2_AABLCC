function alterner(id){
    /*
    The function alterner permit to the element with ID to change of background color
     */
    let doc = document.getElementById(id);
    if(doc.style.backgroundColor=="cornflowerblue"){
        doc.style.backgroundColor = "white";
    } else if (doc.style.backgroundColor=="white"){
        doc.style.backgroundColor = "cornflowerblue";
    } else if (doc.style.backgroundColor=="gray"){
        doc.style.backgroundColor = "gray";
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