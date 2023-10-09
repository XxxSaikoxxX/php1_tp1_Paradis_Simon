<?php

function validerMotDePasse($motDePasseSaisi, $motDePasseEnregistre) {
    // Vérifier si le mot de passe saisi correspond au mot de passe enregistré
    if ($motDePasseSaisi === $motDePasseEnregistre) {
        // Définir le salt 
        $salt = "ABC1234@";

        // Concaténer le salt au mot de passe saisi
        $motDePasseSalt = $motDePasseSaisi . $salt;

        // Chiffrer le mot de passe avec SHA-1
        $motDePasseChiffre = sha1($motDePasseSalt);

        $message = "Mot de passe correct !<br>";
        $message .= "Mot de passe : $motDePasseSaisi<br>";
        $message .= "Salt : $salt<br>";
        $message .= "Mot de passe chiffré (SHA-1) : $motDePasseChiffre";
        return $message;
    } else {
        return "Mot de passe incorrect. Réessayez.";
    }
}

?>
