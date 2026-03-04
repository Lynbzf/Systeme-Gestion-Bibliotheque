<?php
// Cette ligne inclut l'autoloader de Composer, ce qui rend toutes les bibliothèques installées disponibles.
require_once 'vendor/autoload.php';

// Importation de la classe génératrice de code-barres dans l'espace de noms courant.
use Picqer\Barcode\BarcodeGeneratorPNG;

// Vérifie si un paramètre 'code' est fourni dans l'URL (ex : generate_barcode.php?code=KIT1004VNS)
if (isset($_GET['code']) && !empty($_GET['code'])) {

    // Récupération du texte du code-barres depuis l'URL.
    $code = $_GET['code'];

    // Validation des caractères pour CODE 128
    if (!preg_match('/^[\x20-\x7E]+$/', $code)) {
        header("HTTP/1.0 400 Bad Request");
        echo "Caractères invalides pour CODE 128.";
        exit;
    }

    // Création d'une instance du générateur de code-barres (PNG)
    $generator = new BarcodeGeneratorPNG();

    try {
        // Génération des données de l'image du code-barres
        // Paramètres : texte, type de code-barres, largeur, hauteur, couleur
        // TYPE_CODE_128 équivaut à BCGcode128.
        $barcode_image = $generator->getBarcode($code, $generator::TYPE_CODE_128, 2, 50);

        // Définir l'en-tête HTTP pour indiquer que le navigateur reçoit une image PNG
        header('Content-Type: image/png');

        // Affichage des données brutes de l'image
        echo $barcode_image;

    } catch (Exception $e) {
        // Si la génération du code-barres échoue, afficher un message d'erreur
        header('Content-Type: text/plain');
        echo 'Erreur lors de la génération du code-barres : ' . $e->getMessage();
    }

} else {
    // Si aucun code n'est fourni, renvoyer une réponse "mauvaise requête"
    header("HTTP/1.0 400 Bad Request");
    echo "Texte du code-barres non fourni.";
}
?>
