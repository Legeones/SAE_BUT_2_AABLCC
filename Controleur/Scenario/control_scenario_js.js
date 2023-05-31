function remplissage_id_input_dpi(){
    document.getElementById('selectScenario').addEventListener('change', function() {
        document.getElementById('nom_scenario').value = this.options[this.selectedIndex].textContent;
    });
}

remplissage_id_input_dpi();