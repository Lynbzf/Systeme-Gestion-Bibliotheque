<?php

include('session.php');

// Étape 1 : Désactivez toutes les variables de session.
// Cette fonction accepte AUCUN argument.
session_unset();

// Étape 2 : Détruire complètement la session.
session_destroy();

// Étape 3 : Rediriger l’utilisateur vers la page de connexion.
header('location : index.php');

// Étape 4 : Ajoutez exit() pour vous assurer qu’aucun code n’est exécuté après la redirection.
exit();
?>