<?php

require ('../Controleur/Verifiant/Verifiant.php');

final class InscriptionTest extends TestCase
{
    // test pour les vérification de contenus //
    
        // test fonction VerifEmptyContent //
        
            // test fonction de contenu vide avec valeur vide //
            public function testEmptyContentInput()
            {
                $this -> assertEquals(
                    VerifEmptyContent(""),
                    0, "Empty Content Should return 0"
                    );
            }
            
            // test fonction de contenu vide avec valeur non vide //
            public function testNonEmptyContentInput()
            {
                $this -> assertEquals(
                    VerifEmptyContent("notempty"),
                    1, "Empty Content Should return 1"
                    );
            }
    
        // test fonction VerifMail //
        
            // test fonction validation email avec email invalide //
            public function testInvalidMailInput()
            {
                $this -> assertEquals(
                    VerifEmail("notamail.com"),
                    0, "Email Should return 0"
                    );
            }
            
            // test fonction validation email avec email valide //
            public function testValidMailInput()
            {
                $this -> assertEquals(
                    VerifEmail("abc@dot.com"),
                    1, "Email Should return 1"
                    );
            }
    
        // test fonction VerifPassword_Equality //
        
            // test fonction validation mot de passe avec mot de passe inégale //
            public function testUnequalPassword()
            {
                $this -> assertEquals(
                    VerifPassword_Equality("passA","PassB"),
                    0, "Email Should return 0"
                    );
            }
            
            // test fonction validation mot de passe avec mot de passe égale //
            public function testEqualPassword()
            {
                $this -> assertEquals(
                    VerifPassword_Equality("Password","Password"),
                    1, "Email Should return 1"
                    );
            }
            
        // test fonction VerifPassword_Length //
        
            // test fonction validation mot de passe avec moins de 8 caractère //
            public function testPasswordInvalideSize()
            {
                $this -> assertEquals(
                    VerifPassword_Lenght("pass"),
                    0, "Email Should return 0"
                    );
            }
            
            // test fonction validation mot de passe avec plus de 8 caractère //
            public function testPasswordValideSize()
            {
                $this -> assertEquals(
                    VerifPassword_Lenght("passordslength"),
                    1, "Email Should return 1"
                    );
            }
            
        // test fonction VerifPassword_Uppercase //
            
            // test fonction validation mot de passe avec aucune majuscule //
            public function testPasswordNoUppercase()
            {
                $this -> assertEquals(
                    VerifPassword_Uppercase("pass"),
                    0, "Email Should return 0"
                    );
            }
            
            // test fonction validation mot de passeavec au moins 1 majuscule //
            public function testPasswordWithUppercase()
            {
                $this -> assertEquals(
                    VerifPassword_Uppercase("PASS"),
                    1, "Email Should return 1"
                    );
            }
            
        // test fonction VerifPassword_Lowercase //
            
            // test fonction validation mot de passe avec aucune minuscule  //
            public function testPasswordNoLowercase()
            {
                $this -> assertEquals(
                    VerifPassword_Lowercase("PASS"),
                    0, "Email Should return 0"
                    );
            }
            
            // test fonction validation mot de passe avec au moins 1 minuscule //
            public function testPasswordWithLowercase()
            {
                $this -> assertEquals(
                    VerifPassword_Lowercase("pass"),
                    1, "Email Should return 1"
                    );
            }
            
        // test fonction VerifPassword_Number //
            
            // test fonction validation mot de passe avec aucun chiffre  //
            public function testPasswordNoNumber()
            {
                $this -> assertEquals(
                    VerifPassword_Number("pass"),
                    0, "Email Should return 0"
                    );
            }
            
            // test fonction validation mot de passe avec au moins 1 chiffre //
            public function testPasswordWithNumber()
            {
                $this -> assertEquals(
                    VerifPassword_Number("1234"),
                    1, "Email Should return 1"
                    );
            }
    
    // fin de test //
}