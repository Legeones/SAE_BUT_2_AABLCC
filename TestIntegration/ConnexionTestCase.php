<?php

require ('DataBase_Testing.php');

final class ConnexionTest extends TestCase
{
    // test pour la connexion d'un utilisateur pré-existant //
        // test avec entrée valide //
        public function testConnexionWithValidIInput(): void
        { 
            $this -> assertEquals(
                DataBase_Check_User_Exist_ForTest("rtyu","Tokyoghoul12"),
                true, "Connexion Test Should return TRUE"
                );
        }
    
        // test avec nom d'utilisateur invalide
        public function testConnexionWithInvalidUsernameInput(): void
        {
            $this -> assertEquals(
                DataBase_Check_User_Exist_ForTest("thisisnotaname","Tokyoghoul12"),
                false, "Connexion Test Should return FALSE"
                );
        }
    
        // test avec un mot de passe invalide
        public function testConnexionWithInvalidPasswordInput(): void
        {
            $this -> assertEquals(
                DataBase_Check_User_Exist_ForTest("rtyu","thisisnotapassword"),
                false, "Connexion Test Should return FALSE"
                );
        }
        
    // fin de test //
}