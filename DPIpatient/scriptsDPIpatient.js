function alterner(id){
    /*
    The function alterner permit to the element with ID to change of background color
     */
    var doc = document.getElementById(id);
    if(doc.style.backgroundColor=="cornflowerblue"){
        doc.style.backgroundColor = 'white';
    } else{
        doc.style.backgroundColor = "cornflowerblue";
    }
}